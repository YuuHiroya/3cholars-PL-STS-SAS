/**
 * SCHOLARSHIPS PAGE LOGIC - COMPLETE REFACTOR
 *
 * Features:
 * - Renders scholarship tiles matching reference images exactly
 * - Grid view: 3-column layout with centered logo and vertical info
 * - List view: Horizontal layout with left logo and right info
 * - Like button with debounced notifications (no spam)
 * - Proper toggle state (only one view active at a time)
 * - localStorage persistence with profile sync
 */

import { scholarshipsData } from "./data/scholarshipsData.js";
import {
    getSavedScholarships,
    toggleSaveScholarship,
    isScholarshipSaved,
} from "./utils/scholarshipUtils.js";

// ============================================================================
// DOM ELEMENTS & STATE
// ============================================================================

const container = document.getElementById("scholarshipContainer");
const gridViewBtn = document.getElementById("gridView");
const listViewBtn = document.getElementById("listView");
const searchInput = document.getElementById("searchInput");
const countryFilter = document.getElementById("countryFilter");

let currentView = "grid";
let activeNotification = null;
const NOTIFICATION_TIMEOUT = 3000;

// ============================================================================
// TILE RENDERING
// ============================================================================

/**
 * Create scholarship tile HTML matching both Grid and List views
 * @param {Object} scholarship - Scholarship data object
 * @returns {string} HTML tile markup
 */
function createScholarshipTile(scholarship) {
    const isSaved = isScholarshipSaved(scholarship.id);
    const rank = scholarship.rank ? `#${scholarship.rank.value}` : "N/A";
    const acceptance = scholarship.acceptanceRate
        ? `${scholarship.acceptanceRate}%`
        : "N/A";
    const deadline = new Date(scholarship.deadline).toLocaleDateString(
        "en-US",
        {
            year: "numeric",
            month: "short",
            day: "numeric",
        }
    );
//Design

return `
<div class="scholarship-tile bg-white rounded-2xl shadow border border-[#D1D1D1] hover:shadow-lg transition-shadow relative overflow-hidden"
    data-scholarship-id="${scholarship.id}">

    <!-- Badge tidak ikut flex, jadi tidak sejajar title -->
    <span class="absolute top-3 left-3 bg-[#1565C0] text-white text-xs font-bold px-3 py-1.5 rounded-full">
        University
    </span>

    <div class="logo-container flex justify-center items-center pt-12 pb-4">
        <img src="${scholarship.logoUrl}"
            alt="${scholarship.university}"
            class="w-24 h-24 object-contain"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />

        <div class="w-24 h-24 bg-gray-200 rounded hidden items-center justify-center text-center text-xs text-gray-600 px-2">
            <span>${scholarship.university}</span>
        </div>
    </div>

    <div class="px-6 pb-6">

        <!-- Judul dan tombol like benar benar sejajar -->
        <div class="flex items-center justify-between mb-1 mt-2">
            <h3 class="text-lg font-bold text-[#099ecf]">
                ${scholarship.university}
            </h3>

            <button class="like-btn p-1"
                data-scholarship-id="${scholarship.id}">
                <iconify-icon icon="icon-park-solid:like"
                    width="20" height="20"
                    class="like-icon transition-colors ${isSaved ? "text-red-500" : "text-[#838383]"}">
                </iconify-icon>
            </button>
        </div>

        <p class="text-sm text-[#696969] text-center mb-2">
            ${scholarship.title}
        </p>

        <div class="flex items-center gap-1.5 text-[#696969] text-sm mb-10">
            <iconify-icon icon="tdesign:location" width="16"></iconify-icon>
            <span>${scholarship.location}</span>
        </div>

        <div class="flex justify-between items-center mt-2">
            <div class="flex items-center gap-3 text-sm text-[#0B2027]">
                <div class="flex flex-col text-left">
                    <span class="text-xs text-[#696969]">Rank</span>
                    <span class="font-semibold">${rank}</span>
                </div>

                <div class="border-l h-8 border-[#E8E8E8]"></div>

                <div class="flex flex-col text-left">
                    <span class="text-xs text-[#696969]">Acceptance</span>
                    <span class="font-semibold">${acceptance}</span>
                </div>
            </div>

            <a href="/scholarships/${scholarship.id}"
                class="bg-white text-[#0B2027] py-2 px-4 rounded border border-[#D1D1D1] font-semibold text-sm hover:bg-[#F5F5F5]">
                Learn More
            </a>
        </div>

    </div>
</div>
`;
}

/**
 * Render tiles based on current filters and view
 */
function renderTiles(scholarships = scholarshipsData) {
    if (!container) {
        console.error("scholarshipContainer element not found");
        return;
    }

    scholarships.forEach((scholarship) => {
        const tileHTML = createScholarshipTile(scholarship);
        const tileElement = document.createElement("div");
        tileElement.innerHTML = tileHTML;
        container.appendChild(tileElement.firstElementChild);
    });

    attachLikeButtonListeners();
    console.log(`✓ Rendered ${scholarships.length} scholarship tiles`);
}

// ============================================================================
// LIKE BUTTON & NOTIFICATIONS
// ============================================================================

/**
 * Attach like button event listeners with debouncing
 */
function attachLikeButtonListeners() {
    document.querySelectorAll(".like-btn").forEach((btn) => {
        btn.removeEventListener("click", handleLikeClick);
        btn.addEventListener("click", handleLikeClick);
    });
}

/**
 * Handle like button click with state management & debouncing
 */
function handleLikeClick(e) {
    e.preventDefault();
    e.stopPropagation();

    const btn = e.currentTarget;
    const scholarshipId = btn.dataset.scholarshipId;
    const scholarship = scholarshipsData.find((s) => s.id === scholarshipId);

    if (!scholarship) {
        console.error(`❌ Scholarship not found: ${scholarshipId}`);
        return;
    }

    // Prevent rapid clicks
    if (btn.disabled) return;
    btn.disabled = true;

    const result = toggleSaveScholarship(scholarship);

    // Update UI icon
    const icon = btn.querySelector(".like-icon");
    if (result.isSaved) {
        icon.classList.remove("text-[#838383]");
        icon.classList.add("text-red-500");
        btn.setAttribute("aria-pressed", "true");
    } else {
        icon.classList.remove("text-red-500");
        icon.classList.add("text-[#838383]");
        btn.setAttribute("aria-pressed", "false");
    }

    // Show single notification (debounced)
    showToast(
        result.isSaved
            ? `✓ Saved to My Scholarships`
            : `✗ Removed from My Scholarships`
    );

    // Sync to profile
    syncSavedScholarshipsToProfile();

    // Re-enable button
    setTimeout(() => {
        btn.disabled = false;
    }, 200);
}

/**
 * Show toast notification - DEBOUNCED (only one at a time)
 */
function showToast(message) {
    // Remove existing notification
    if (activeNotification) {
        clearTimeout(activeNotification.timeout);
        activeNotification.element?.remove();
    }

    const toast = document.createElement("div");
    toast.textContent = message;
    toast.className =
        "fixed bottom-6 right-6 bg-[#1565C0] text-white px-6 py-3 rounded-lg shadow-2xl z-50 font-semibold text-sm transition-all duration-300";
    document.body.appendChild(toast);

    // Animate in
    toast.style.opacity = "0";
    toast.style.transform = "translateY(20px)";
    toast.offsetHeight; // Trigger reflow
    toast.style.opacity = "1";
    toast.style.transform = "translateY(0)";

    // Store and auto-dismiss
    activeNotification = {
        element: toast,
        timeout: setTimeout(() => {
            toast.style.opacity = "0";
            toast.style.transform = "translateY(20px)";
            setTimeout(() => {
                toast.remove();
                activeNotification = null;
            }, 300);
        }, NOTIFICATION_TIMEOUT),
    };
}

/**
 * Sync saved scholarships to profile page via event
 */
function syncSavedScholarshipsToProfile() {
    const event = new CustomEvent("scholarshipsSaved", {
        detail: { saved: getSavedScholarships() },
    });
    window.dispatchEvent(event);
    console.log("📡 Synced saved scholarships");
}

// ============================================================================
// VIEW TOGGLE (GRID/LIST)
// ============================================================================

/**
 * Set view mode - ENSURES ONLY ONE BUTTON ACTIVE AT A TIME
 */
function setViewMode(view) {
    if (!gridViewBtn || !listViewBtn || !container) {
        console.error("❌ View toggle elements not found");
        return;
    }

    currentView = view;

    // Reset BOTH buttons to inactive first
    gridViewBtn.classList.remove("bg-[#0B2027]");
    gridViewBtn.classList.add("bg-white");
    const gridIcon = gridViewBtn.querySelector(".view-icon");
    if (gridIcon) {
        gridIcon.classList.remove("text-white");
        gridIcon.classList.add("text-[#0B2027]");
    }

    listViewBtn.classList.remove("bg-[#0B2027]");
    listViewBtn.classList.add("bg-white");
    const listIcon = listViewBtn.querySelector(".view-icon");
    if (listIcon) {
        listIcon.classList.remove("text-white");
        listIcon.classList.add("text-[#0B2027]");
    }

    if (view === "grid") {
        // Activate ONLY grid button
        gridViewBtn.classList.remove("bg-white");
        gridViewBtn.classList.add("bg-[#0B2027]");
        if (gridIcon) {
            gridIcon.classList.remove("text-[#0B2027]");
            gridIcon.classList.add("text-white");
        }

        // Grid layout: 3 columns
        container.classList.remove(
            "flex",
            "flex-col",
            "gap-4",
            "gap-6",
            "scholarship-list"
        );
        container.classList.add(
            "grid",
            "grid-cols-3",
            "gap-8",
            "scholarship-grid"
        );

        // Reset tile styling
        document.querySelectorAll(".scholarship-tile").forEach((tile) => {
            tile.classList.remove(
                "flex",
                "flex-row",
                "gap-4",
                "items-start",
                "p-4"
            );
            tile.classList.add("flex", "flex-col", "items-stretch");

            const logo = tile.querySelector(".logo-container");
            if (logo) {
                logo.classList.remove("w-24", "h-24", "flex-shrink-0");
                logo.classList.add("mb-4", "pt-4");
            }
        });
    } else if (view === "list") {
        // Activate ONLY list button
        listViewBtn.classList.remove("bg-white");
        listViewBtn.classList.add("bg-[#0B2027]");
        if (listIcon) {
            listIcon.classList.remove("text-[#0B2027]");
            listIcon.classList.add("text-white");
        }

        // List layout: single column, horizontal cards
        container.classList.remove(
            "grid",
            "grid-cols-3",
            "gap-8",
            "scholarship-grid"
        );
        container.classList.add(
            "flex",
            "flex-col",
            "gap-6",
            "scholarship-list"
        );

        // Update tile styling for list
        document.querySelectorAll(".scholarship-tile").forEach((tile) => {
            tile.classList.remove("flex-col", "items-stretch");
            tile.classList.add(
                "flex",
                "flex-row",
                "gap-4",
                "items-start",
                "p-4"
            );

            const logo = tile.querySelector(".logo-container");
            if (logo) {
                logo.classList.add("w-24", "h-24", "flex-shrink-0");
                logo.classList.remove("mb-4", "pt-4");
            }
        });
    }

    console.log(`✓ Switched to ${view} view`);
}

// ============================================================================
// SEARCH & FILTER
// ============================================================================

/**
 * Filter scholarships based on search and country
 */
function filterScholarships() {
    const searchTerm = searchInput?.value.toLowerCase() || "";
    const selectedCountry = countryFilter?.value || "";

    const filtered = scholarshipsData.filter((sch) => {
        const matchesSearch =
            sch.title.toLowerCase().includes(searchTerm) ||
            sch.university.toLowerCase().includes(searchTerm) ||
            sch.location.toLowerCase().includes(searchTerm) ||
            (sch.tags &&
                sch.tags.some((tag) => tag.toLowerCase().includes(searchTerm)));

        const matchesCountry =
            !selectedCountry || sch.location.includes(selectedCountry);

        return matchesSearch && matchesCountry;
    });

    renderTiles(filtered);
    console.log(`🔍 Filtered to ${filtered.length} results`);
}

// ============================================================================
// INITIALIZATION
// ============================================================================

/**
 * Initialize scholarships page
 */
function initializeScholarshipsPage() {
    if (!container || !gridViewBtn || !listViewBtn) {
        console.error("❌ Critical elements missing from DOM");
        return;
    }

    // Set initial view to grid
    setViewMode("grid");

    // Render all scholarships
    renderTiles();

    // Attach event listeners
    gridViewBtn.addEventListener("click", () => {
        if (currentView !== "grid") {
            setViewMode("grid");
        }
    });

    listViewBtn.addEventListener("click", () => {
        if (currentView !== "list") {
            setViewMode("list");
        }
    });

    searchInput?.addEventListener("input", filterScholarships);
    countryFilter?.addEventListener("change", filterScholarships);

    console.log("✓ Scholarships page initialized");
}

// Initialize when DOM is ready
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initializeScholarshipsPage);
} else {
    initializeScholarshipsPage();
}
