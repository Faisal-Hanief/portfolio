import { getJson } from "./api";

const reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
).matches;

// Intro loader: stays at least 900 ms, fades out once the page has loaded.
// Returns a promise that resolves when the fade-out starts.
export function initLoader() {
    return new Promise((resolve) => {
        const loader = document.getElementById("loader");

        if (!loader) {
            resolve();
            return;
        }

        const minTime = 900;
        const start = performance.now();
        document.documentElement.classList.add("overflow-hidden");

        const hide = () => {
            const wait = Math.max(0, minTime - (performance.now() - start));

            setTimeout(() => {
                loader.classList.add("is-hidden");
                document.documentElement.classList.remove("overflow-hidden");
                setTimeout(() => loader.remove(), 600);
                resolve();
            }, wait);
        };

        if (document.readyState === "complete") {
            hide();
        } else {
            window.addEventListener("load", hide, { once: true });
        }
    });
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

// Scroll reveal: elements with data-reveal fade in when they enter the screen.
let revealObserver;

function getRevealObserver() {
    if (!revealObserver) {
        revealObserver = new IntersectionObserver(
            (entries, obs) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add("is-visible");
                    obs.unobserve(entry.target);
                });
            },
            { threshold: 0.15 },
        );
    }

    return revealObserver;
}

// Can also be called for elements created later by JavaScript (e.g. skill cards).
export function reveal(items) {
    if (!("IntersectionObserver" in window)) {
        items.forEach((item) => item.classList.add("is-visible"));
        return;
    }

    items.forEach((item) => getRevealObserver().observe(item));
}

export function initReveal() {
    reveal(document.querySelectorAll("[data-reveal]"));
}

// Typing effect for the role line in the hero.
export function initTyping() {
    const element = document.getElementById("typed-role");
    if (!element) return;

    const roles = JSON.parse(element.dataset.roles || "[]");
    if (!roles.length || reduceMotion) return;

    let roleIndex = 0;
    let charIndex = 0;
    let deleting = false;

    const tick = () => {
        const role = roles[roleIndex];
        element.textContent = role.slice(0, charIndex);

        let delay = deleting ? 45 : 90;

        if (!deleting && charIndex === role.length) {
            deleting = true;
            delay = 1600;
        } else if (deleting && charIndex === 0) {
            deleting = false;
            roleIndex = (roleIndex + 1) % roles.length;
            delay = 400;
        }

        charIndex += deleting ? -1 : 1;
        setTimeout(tick, delay);
    };

    tick();
}

// Counters: numbers come from the API (/api/stats) and count up when visible.
export async function initCounters() {
    const elements = document.querySelectorAll("[data-stat]");
    if (!elements.length) return;

    let stats;

    try {
        stats = await getJson("/stats");
    } catch (error) {
        elements.forEach((element) => (element.textContent = "–"));
        return;
    }

    const countUp = (element, target) => {
        const duration = 1200;
        const start = performance.now();

        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            element.textContent = Math.round(target * eased);

            if (progress < 1) requestAnimationFrame(step);
        };

        requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const element = entry.target;
                const target = Number(stats[element.dataset.stat] ?? 0);

                if (reduceMotion) {
                    element.textContent = target;
                } else {
                    countUp(element, target);
                }

                obs.unobserve(element);
            });
        },
        { threshold: 0.6 },
    );

    elements.forEach((element) => observer.observe(element));
}

// Card effects (desktop with a mouse only): cursor spotlight and a light tilt on .fx-card.
// Uses event delegation, so cards created later by JavaScript work automatically.
export function initCardEffects() {
    const canHover = window.matchMedia(
        "(hover: hover) and (pointer: fine)",
    ).matches;
    if (!canHover || reduceMotion) return;

    const maxTilt = 4; // degrees

    document.addEventListener("pointermove", (event) => {
        if (!(event.target instanceof Element)) return;

        const card = event.target.closest(".fx-card");
        if (!card) return;

        const rect = card.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        card.style.setProperty("--mx", x + "px");
        card.style.setProperty("--my", y + "px");
        card.style.setProperty(
            "--ry",
            ((x / rect.width - 0.5) * 2 * maxTilt).toFixed(2) + "deg",
        );
        card.style.setProperty(
            "--rx",
            ((0.5 - y / rect.height) * 2 * maxTilt).toFixed(2) + "deg",
        );
        card.style.setProperty("--lift", "-4px");
    });

    document.addEventListener("pointerout", (event) => {
        if (!(event.target instanceof Element)) return;

        const card = event.target.closest(".fx-card");
        if (!card || card.contains(event.relatedTarget)) return;

        card.style.setProperty("--rx", "0deg");
        card.style.setProperty("--ry", "0deg");
        card.style.setProperty("--lift", "0px");
    });
}
