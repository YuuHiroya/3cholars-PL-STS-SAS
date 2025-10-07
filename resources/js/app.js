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
        mainImg.src = mainCard.dataset.img || "";
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
