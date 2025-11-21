import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const video = document.getElementById("bg-video");

if (video) {
    // Mulai dari detik ke-1
    video.addEventListener("loadedmetadata", () => {
        video.currentTime = 1;
    });

    // Stop di detik ke-28 lalu ulang lagi dari detik ke-1
    video.addEventListener("timeupdate", () => {
        if (video.currentTime >= 25) {
            video.currentTime = 1;
            video.play();
        }
    });
}

// Toggle password
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".toggle-btn");

    if (!buttons.length) {
        console.warn(
            "⚠️ Tidak ada tombol toggle yang ditemukan di halaman ini"
        );
    }

    buttons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const container = this.closest(".relative");
            const input = container.querySelector("input");
            const icon = this.querySelector(".toggle-icon");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-fill");
                icon.classList.add("bi-eye-slash-fill");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-slash-fill");
                icon.classList.add("bi-eye-fill");
            }
        });
    });
});

// Navbar
let lastScrollTop = 0;
const navbar = document.getElementById("navbar");

window.addEventListener("scroll", function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
        // Scroll ke bawah → sembunyikan navbar (geser ke atas)
        navbar.style.transform = "translateY(-100%)";
    } else {
        // Scroll ke atas → tampilkan navbar
        navbar.style.transform = "translateY(0)";
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // supaya ga minus di atas
});

// Hamburger Menu
document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById("menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");
    const overlay = document.getElementById("mobile-overlay");
    const navbar = document.getElementById("navbar");
    const body = document.body;

    if (!menuBtn || !mobileMenu || !overlay || !navbar) return;

    let menuOpen = false;

    // set initial hidden transform (safety)
    mobileMenu.style.transform = "translateX(120%)";
    mobileMenu.setAttribute("aria-hidden", "true");
    overlay.classList.add("hidden");

    function calcPanelPosition() {
        const navRect = navbar.getBoundingClientRect();
        // panel akan menempel di bawah navbar
        const top = Math.round(navRect.bottom - 1); // -1 untuk menghilangkan garis seam
        // agar panel rata dengan sisi kanan navbar
        const rightOffset = Math.round(window.innerWidth - navRect.right);
        // lebar panel: set separuh dari lebar navbar, tapi tidak lebih dari 80vw dan tidak kurang dari 260px
        const panelWidth = Math.max(
            260,
            Math.min(navRect.width * 0.5, window.innerWidth * 0.8)
        );
        return { top, rightOffset, panelWidth };
    }

    function openMenu() {
        const pos = calcPanelPosition();

        mobileMenu.style.top = pos.top + "px";
        mobileMenu.style.right = pos.rightOffset + "px";
        mobileMenu.style.left = "auto";
        mobileMenu.style.width = pos.panelWidth + "px";

        // sambung visual dengan navbar: hapus radius atas supaya terlihat connected
        mobileMenu.style.borderTopLeftRadius = "0px";
        mobileMenu.style.borderTopRightRadius = "0px";

        // tampilkan panel dengan transform inline
        mobileMenu.style.transform = "translateX(0)";
        mobileMenu.setAttribute("aria-hidden", "false");

        overlay.classList.remove("hidden");
        overlay.classList.add("block");

        menuBtn.innerHTML = '<i class="bi bi-x-lg"></i>';
        menuBtn.setAttribute("aria-label", "Close menu");
        menuBtn.setAttribute("aria-expanded", "true");

        // stop scroll background
        body.style.overflow = "hidden";

        menuOpen = true;
    }

    function closeMenu() {
        // sembunyikan dengan transform jauh (jaminan tidak muncul 1px)
        mobileMenu.style.transform = "translateX(120%)";
        mobileMenu.setAttribute("aria-hidden", "true");

        overlay.classList.add("hidden");
        overlay.classList.remove("block");

        // reset border radius ke class default
        mobileMenu.style.borderTopLeftRadius = "";
        mobileMenu.style.borderTopRightRadius = "";

        menuBtn.innerHTML = '<i class="bi bi-list"></i>';
        menuBtn.setAttribute("aria-label", "Open menu");
        menuBtn.setAttribute("aria-expanded", "false");

        body.style.overflow = "";

        menuOpen = false;
    }

    function isOpen() {
        return menuOpen;
    }

    // toggle main button
    menuBtn.addEventListener("click", function () {
        isOpen() ? closeMenu() : openMenu();
    });

    // overlay click closes
    overlay.addEventListener("click", closeMenu);

    // close on Escape
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && isOpen()) closeMenu();
    });

    // saat resize, tutup menu atau recalc posisi
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 640 && isOpen()) {
            closeMenu();
            return;
        }
        // jika masih terbuka hitung ulang posisi dan lebar
        if (isOpen()) {
            const pos = calcPanelPosition();
            mobileMenu.style.top = pos.top + "px";
            mobileMenu.style.right = pos.rightOffset + "px";
            mobileMenu.style.width = pos.panelWidth + "px";
        }
    });

    // pastikan saat reload mobile masih tersembunyi
    closeMenu();
});

// Footer
document.addEventListener("DOMContentLoaded", () => {
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const target = document.querySelector(link.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth", block: "start" });
            }
        });
    });

    // Floating shapes pause on hover
    document.querySelectorAll(".animate-float").forEach((shape) => {
        shape.addEventListener("mouseenter", () => {
            shape.style.animationPlayState = "paused";
        });
        shape.addEventListener("mouseleave", () => {
            shape.style.animationPlayState = "running";
        });
    });
});

// Information Card Page
document.addEventListener("DOMContentLoaded", () => {
    const bookmarkBtn = document.getElementById("bookmark-btn");
    const shareBtn = document.getElementById("share-btn");
    const mainCard = document.getElementById("main-card");
    if (!mainCard) return;

    const mainTitle = document.getElementById("main-card-title");
    const mainDesc = document.getElementById("main-card-desc");
    const mainImg = document.getElementById("main-card-img");
    const mainTags = document.getElementById("main-card-tags");
    const mainLinks = document.getElementById("main-card-links");
    const relatedCards = document.querySelectorAll(".related-card");

    // --- BOOKMARK toggle ---
    if (bookmarkBtn) {
        bookmarkBtn.addEventListener("click", () => {
            bookmarkBtn.classList.toggle("bi-bookmark");
            bookmarkBtn.classList.toggle("bi-bookmark-fill");
            bookmarkBtn.style.color = bookmarkBtn.classList.contains(
                "bi-bookmark-fill"
            )
                ? "#FEBC2F"
                : "#0b2027";
        });
    }

    // --- SHARE toggle ---
    if (shareBtn) {
        shareBtn.addEventListener("click", () => {
            shareBtn.classList.toggle("bi-share");
            shareBtn.classList.toggle("bi-share-fill");
        });
    }

    // --- helpers ---
    function safeParseLinks(str) {
        try {
            const parsed = JSON.parse(str || "[]");
            return Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            return [];
        }
    }

    function updateTagsAndLinks(cardEl) {
        const tags = cardEl.dataset.tags ? cardEl.dataset.tags.split(",") : [];
        const links = safeParseLinks(cardEl.dataset.links);

        // Tags
        if (mainTags) {
            mainTags.innerHTML = "";
            tags.forEach((t) => {
                if (!t || !t.trim()) return;
                const span = document.createElement("span");
                span.className =
                    "px-3 py-1 bg-[#FAFAFA] border border-[#D1D1D1] text-sm rounded-full";
                span.textContent = t.trim();
                mainTags.appendChild(span);
            });
        }

        // Links
        if (mainLinks) {
            mainLinks.innerHTML = "";
            links.forEach((l) => {
                const a = document.createElement("a");
                a.href = l.url || "#";
                a.className =
                    "text-[#71ABED] hover:underline flex gap-2 items-center link-inline";
                a.innerHTML = `<i class="bi bi-box-arrow-up-right"></i><span class="link-text">${
                    l.text || ""
                }</span>`;
                mainLinks.appendChild(a);
            });
        }
    }

    function renderMainFromDataset() {
        mainTitle.textContent = mainCard.dataset.title || "";
        mainDesc.textContent = mainCard.dataset.description || "";

        const newImg = mainCard.dataset.img || "";
        if (mainImg) mainImg.src = newImg;
        const mainImgMobile = document.getElementById("main-card-img-mobile");
        if (mainImgMobile) mainImgMobile.src = newImg;

        updateTagsAndLinks(mainCard);
    }

    function renderRelatedCard(cardEl) {
        const titleEl = cardEl.querySelector("h4");
        const descEl = cardEl.querySelector("p");
        const imgEl = cardEl.querySelector("img");

        if (titleEl) titleEl.textContent = cardEl.dataset.title || "";
        if (descEl) descEl.textContent = cardEl.dataset.description || "";
        if (imgEl) imgEl.src = cardEl.dataset.img || imgEl.src;
    }

    // Initialize render (read from dataset, not from inner DOM)
    renderMainFromDataset();
    relatedCards.forEach((c) => renderRelatedCard(c));

    // --- SWAP LOGIC (swap data-* bukan hanya DOM text) ---
    const DURATION = 420;
    let isAnimating = false;

    function getCardData(el) {
        return {
            title: el.dataset.title || "",
            description: el.dataset.description || "",
            img: el.dataset.img || "",
            tags: el.dataset.tags || "",
            links: el.dataset.links || "[]",
        };
    }

    function setCardData(el, data) {
        el.dataset.title = data.title;
        el.dataset.description = data.description;
        el.dataset.img = data.img;
        el.dataset.tags = data.tags;
        el.dataset.links = data.links;
    }

    relatedCards.forEach((card) => {
        card.addEventListener("click", () => {
            if (isAnimating) return;
            isAnimating = true;

            // disable pointer while animating
            relatedCards.forEach((c) => c.classList.add("no-pointer"));
            mainCard.classList.add("swap-transition", "swap-out");
            card.classList.add("swap-transition", "swap-out");

            setTimeout(() => {
                // swap dataset values (source of truth)
                const mainData = getCardData(mainCard);
                const clickedData = getCardData(card);

                setCardData(mainCard, clickedData);
                setCardData(card, mainData);

                // re-render from dataset
                renderMainFromDataset();
                renderRelatedCard(card);

                // animate swap-in
                requestAnimationFrame(() => {
                    mainCard.classList.remove("swap-out");
                    card.classList.remove("swap-out");
                });

                setTimeout(() => {
                    relatedCards.forEach((c) =>
                        c.classList.remove("no-pointer")
                    );
                    isAnimating = false;
                }, DURATION + 30);
            }, DURATION);
        });
    });
});

// Profile Page Logic
document.addEventListener("DOMContentLoaded", function () {
    const editBtn = document.getElementById("edit-btn");
    const cancelBtn = document.getElementById("cancel-btn");
    const actionButtons = document.getElementById("action-buttons");
    const cameraLabel = document.getElementById("camera-label");
    const profileForm = document.getElementById("profile-form");
    const countryDisplay = document.getElementById("country-display");
    const countryInputBox = document.getElementById("country-input-box");

    // Ambil semua display yang harus disembunyikan saat edit
    const displayFields = document.querySelectorAll(".editable-display");
    const inputFields = document.querySelectorAll(".editable-input");

    const profileUpload = document.getElementById("profile-upload");
    if (profileUpload) {
        profileUpload.addEventListener("change", previewProfile);
    }

    if (editBtn) {
        editBtn.addEventListener("click", () => {
            editBtn.classList.add("hidden");
            actionButtons.classList.remove("hidden");
            cameraLabel.classList.remove("hidden");

            // Hide all display fields
            displayFields.forEach((el) => {
                if (el.id !== "country-display") {
                    el.classList.add("hidden");
                } else {
                    // Keep country-display visible so chips show alongside input
                    el.classList.remove("hidden");
                }
            });

            // Show all input fields
            inputFields.forEach((el) => {
                if (el.id === "country-input-box") {
                    el.style.display = "block";
                    el.classList.remove("hidden");
                } else {
                    el.classList.remove("hidden");
                    if (el.tagName === "TEXTAREA") {
                        el.style.display = "block";
                    }
                }
            });

            // Sinkronisasi nilai dari input display ke hidden inputs di form
            syncFormInputs();
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener("click", () => {
            editBtn.classList.remove("hidden");
            actionButtons.classList.add("hidden");
            cameraLabel.classList.add("hidden");

            // Show all display fields
            displayFields.forEach((el) => el.classList.remove("hidden"));

            // Hide all input fields
            inputFields.forEach((el) => {
                el.classList.add("hidden");
                if (el.tagName === "TEXTAREA") {
                    el.style.display = "none";
                } else if (el.id === "country-input-box") {
                    el.style.display = "none";
                }
            });

            // Reset country input box
            if (countryInputBox) {
                countryInputBox.value = "";
            }
        });
    }

    // Fungsi sinkronisasi input dengan hidden inputs
    function syncFormInputs() {
        // Get all input elements
        const locationInput = document.querySelector(".location-input");
        const fieldInput = document.querySelector(".field-input");
        const educationInput = document.querySelector(".education-input");
        const gpaInput = document.querySelector(".gpa-input");
        const aboutInput = document.getElementById("about-input");
        const aboutHidden = document.getElementById("about-hidden");

        // Sync location
        if (locationInput && document.querySelector('input[name="location"]')) {
            locationInput.addEventListener("input", (e) => {
                document.querySelector('input[name="location"]').value =
                    e.target.value;
            });
        }

        // Sync field of study
        if (fieldInput && document.querySelector('input[name="field"]')) {
            fieldInput.addEventListener("input", (e) => {
                document.querySelector('input[name="field"]').value =
                    e.target.value;
            });
        }

        // Sync education
        if (
            educationInput &&
            document.querySelector('input[name="education"]')
        ) {
            educationInput.addEventListener("input", (e) => {
                document.querySelector('input[name="education"]').value =
                    e.target.value;
            });
        }

        // Sync GPA
        if (gpaInput && document.querySelector('input[name="gpa"]')) {
            gpaInput.addEventListener("input", (e) => {
                document.querySelector('input[name="gpa"]').value =
                    e.target.value;
            });
        }

        // Sync About Me textarea
        if (aboutInput && aboutHidden) {
            aboutInput.addEventListener("input", (e) => {
                aboutHidden.value = e.target.value;
            });
        }
    }

    if (profileForm) {
        profileForm.addEventListener("submit", () => {
            console.log("📝 Form submit event triggered");
            
            // Sync username
            const nameInput = document.querySelector("#name-input");
            if (nameInput) {
                document.querySelector('input[name="username"]').value =
                    nameInput.value;
            }

            // Sync location
            const locationInput = document.querySelector(".location-input");
            if (locationInput) {
                document.querySelector('input[name="location"]').value =
                    locationInput.value;
            }

            // Sync field
            const fieldInput = document.querySelector(".field-input");
            if (fieldInput) {
                document.querySelector('input[name="field"]').value =
                    fieldInput.value;
            }

            // Sync education
            const educationInput = document.querySelector(".education-input");
            if (educationInput) {
                document.querySelector('input[name="education"]').value =
                    educationInput.value;
            }

            // Sync GPA
            const gpaInput = document.querySelector(".gpa-input");
            if (gpaInput) {
                document.querySelector('input[name="gpa"]').value =
                    gpaInput.value;
            }

            // Sync about
            const aboutInput = document.querySelector(".about-input");
            if (aboutInput) {
                document.getElementById("about-hidden").value =
                    aboutInput.value;
            }

            // Sync preferred country - country-hidden is already updated by the country logic
            // Just ensure the value is in the correct format
            const countryHidden = document.getElementById("country-hidden");
            if (countryHidden) {
                console.log("✅ Form submit - Country hidden value:", countryHidden.value);
                // Country hidden is already maintained by renderCountries() function
                // Nothing extra needed here - it's already synced
            }
        });
    }
});

// Preferred Country Logic
document.addEventListener("DOMContentLoaded", () => {
    const countryDisplay = document.getElementById("country-display");
    const countryInputBox = document.getElementById("country-input-box");
    const countryHidden = document.getElementById("country-hidden");

    if (!countryDisplay || !countryInputBox || !countryHidden) {
        console.warn("⚠️ Country input elements not found");
        return;
    }

    // Parse default countries from hidden input
    let countries =
        countryHidden.value && countryHidden.value !== "-"
            ? countryHidden.value
                  .split(",")
                  .map((c) => c.trim())
                  .filter((c) => c)
            : [];

    // Render chips and sync to hidden input
    function renderCountries() {
        countryDisplay.innerHTML = "";

        if (countries.length === 0) {
            countryDisplay.innerHTML =
                '<p class="text-[#838383] text-sm italic">No countries selected yet</p>';
        } else {
            countries.forEach((c) => {
                if (!c) return;
                const chip = document.createElement("span");
                chip.className =
                    "bg-[#1565C0] text-white text-sm px-4 py-1 rounded-full";
                chip.textContent = c;
                countryDisplay.appendChild(chip);
            });
        }

        // Sync to hidden input for database
        countryHidden.value = countries.length > 0 ? countries.join(", ") : "-";
        console.log("🔄 renderCountries() updated:", {
            countriesArray: countries,
            hiddenInputValue: countryHidden.value,
        });
    }

    // Event listener for Enter key
    countryInputBox.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            const val = countryInputBox.value.trim();

            // Validate: Only add non-empty, non-duplicate entries
            if (!val) {
                showToast("Please enter a country name");
                return;
            }

            if (countries.includes(val)) {
                showToast(`${val} already added`);
                countryInputBox.value = "";
                return;
            }

            countries.push(val);
            countryInputBox.value = "";
            renderCountries();
            showToast(`Added: ${val}`);
        }
    });

    // Initial render
    renderCountries();
});

function showToast(message) {
    const toast = document.createElement("div");
    toast.textContent = message;
    toast.className =
        "fixed bottom-6 right-6 bg-[#1565C0] text-white px-4 py-2 rounded-lg shadow-lg z-50";
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = "0";
        toast.style.transition = "opacity 0.3s ease";
        setTimeout(() => toast.remove(), 300);
    }, 2000);
}

// Preview gambar profil baru
function previewProfile(event) {
    const image = document.getElementById("profile-image");
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            image.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

// ============================================================================
// PROFILE PAGE: MY SAVED SCHOLARSHIPS (from localStorage)
// ============================================================================

document.addEventListener("DOMContentLoaded", () => {
    const savedScholarshipsSection = document.querySelector('[class*="My Saved Scholarships"]')?.closest('div');
    
    if (!savedScholarshipsSection) {
        return; // Not on profile page or section doesn't exist
    }

    // Function to render saved scholarships from localStorage
    function renderSavedScholarships() {
        try {
            const saved = JSON.parse(localStorage.getItem('user_savedScholarships') || '[]');
            
            // Update count badge
            const countBadge = savedScholarshipsSection.querySelector('.bg-\\[\\#1565C0\\]');
            if (countBadge && countBadge.textContent.trim().match(/^\\d+$/)) {
                countBadge.textContent = saved.length;
            }

            // Find or create grid container
            let gridContainer = savedScholarshipsSection.querySelector('.grid');
            if (!gridContainer) {
                gridContainer = document.createElement('div');
                gridContainer.className = 'grid grid-cols-2 gap-6 mt-6';
                savedScholarshipsSection.appendChild(gridContainer);
            }

            // Clear existing items
            const existingItems = gridContainer.querySelectorAll('[data-scholarship-id]');
            existingItems.forEach(item => item.remove());

            // Show empty state if no saved scholarships
            if (saved.length === 0) {
                gridContainer.innerHTML = `
                    <div class="col-span-2 text-center py-8 text-[#696969]">
                        <p class="text-sm">No saved scholarships yet. Browse and click the heart icon to save!</p>
                    </div>
                `;
                return;
            }

            // Render each saved scholarship
            saved.forEach(item => {
                const tile = document.createElement('div');
                tile.className = 'bg-[#FAFAFA] rounded-xl border border-[#D1D1D1] p-6';
                tile.setAttribute('data-scholarship-id', item.id);
                
                const deadlineFormatted = item.deadline 
                    ? new Date(item.deadline).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
                    : 'N/A';

                tile.innerHTML = `
                    <div class="relative mb-4 h-32 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                        <img src="${item.logoUrl}" alt="${item.university}" class="max-w-full max-h-full object-contain" 
                             onerror="this.style.display='none'; this.parentElement.innerHTML='<span class=\\'text-xs text-gray-500\\'>${item.university}</span>'" />
                    </div>

                    <h3 class="text-lg font-semibold text-[#0B2027] mb-1">${item.title}</h3>
                    <p class="text-sm text-[#1565C0] font-semibold mb-3">${item.university}</p>

                    <div class="space-y-2 text-sm text-[#0B2027] mb-4">
                        <div class="flex items-center gap-2">
                            <iconify-icon icon="tdesign:location" width="18" height="18" class="text-[#696969]"></iconify-icon>
                            <span class="text-[#696969]">${item.tags ? item.tags.join(', ') : 'Scholarship'}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <iconify-icon icon="mingcute:calendar-line" width="18" height="18" class="text-[#696969]"></iconify-icon>
                            <span class="text-[#696969]">${deadlineFormatted}</span>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button class="flex-1 px-4 py-2 bg-[#EFEFEF] text-[#0B2027] rounded-lg text-sm font-medium hover:bg-[#E0E0E0] transition-colors">
                            Details
                        </button>
                        <button class="flex-1 px-4 py-2 bg-[#1565C0] text-white rounded-lg text-sm font-medium hover:bg-[#0d47a1] transition-colors flex items-center justify-center gap-2">
                            <iconify-icon icon="icon-park-outline:share" width="16" height="16"></iconify-icon>
                            Apply
                        </button>
                    </div>
                `;
                
                gridContainer.appendChild(tile);
            });

        } catch (error) {
            console.error('Error rendering saved scholarships:', error);
        }
    }

    // Initial render
    renderSavedScholarships();

    // Listen for updates from scholarships page
    window.addEventListener('scholarshipsSaved', (e) => {
        console.log('📡 Profile received scholarship update:', e.detail);
        renderSavedScholarships();
    });

    // Also listen to storage events (for multi-tab sync)
    window.addEventListener('storage', (e) => {
        if (e.key === 'user_savedScholarships') {
            console.log('💾 localStorage updated (multi-tab sync)');
            renderSavedScholarships();
        }
    });
});
