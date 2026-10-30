// Intro loader: stays at least 900 ms, then fades out once the page has loaded.
export function initLoader() {
    const loader = document.getElementById("loader");
    if (!loader) return;

    const minTime = 900;
    const start = performance.now();
    document.documentElement.classList.add("overflow-hidden");

    const hide = () => {
        const wait = Math.max(0, minTime - (performance.now() - start));

        setTimeout(() => {
            loader.classList.add("is-hidden");
            document.documentElement.classList.remove("overflow-hidden");
            setTimeout(() => loader.remove(), 600);
        }, wait);
    };

    if (document.readyState === "complete") {
        hide();
    } else {
        window.addEventListener("load", hide, { once: true });
    }
}

// Navbar: glass background after scrolling, mobile menu, and active link highlight.
export function initNavbar() {
    const navbar = document.getElementById("navbar");
    if (!navbar) return;

    const onScroll = () =>
        navbar.classList.toggle("is-scrolled", window.scrollY > 20);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });

    const toggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("mobile-menu");

    if (toggle && menu) {
        toggle.addEventListener("click", () => {
            const isOpen = !menu.classList.toggle("hidden");
            toggle.setAttribute("aria-expanded", String(isOpen));
        });

        menu.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
                menu.classList.add("hidden");
                toggle.setAttribute("aria-expanded", "false");
            });
        });
    }

    // Highlight the link of the section that is currently in view
    const links = document.querySelectorAll("[data-nav-link]");
    const sections = [...links]
        .map((link) => document.querySelector(link.getAttribute("href")))
        .filter(Boolean);

    if (!sections.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                links.forEach((link) => {
                    link.classList.toggle(
                        "is-active",
                        link.getAttribute("href") === "#" + entry.target.id,
                    );
                });
            });
        },
        { rootMargin: "-45% 0px -50% 0px" },
    );

    sections.forEach((section) => observer.observe(section));
}
