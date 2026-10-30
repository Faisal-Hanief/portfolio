import { getJson } from "./api";
import { reveal } from "./animations";

// Inline SVG icons (no icon library needed). Unknown categories get the "code" icon.
const ICONS = {
    "mobile-development":
        '<rect x="7" y="2.5" width="10" height="19" rx="2.5"/><path d="M11 18.5h2"/>',
    "web-development":
        '<circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3c2.5 2.6 3.8 5.6 3.8 9s-1.3 6.4-3.8 9c-2.5-2.6-3.8-5.6-3.8-9s1.3-6.4 3.8-9z"/>',
    "database-backend":
        '<ellipse cx="12" cy="6" rx="7" ry="3"/><path d="M5 6v6c0 1.7 3.1 3 7 3s7-1.3 7-3V6"/><path d="M5 12v6c0 1.7 3.1 3 7 3s7-1.3 7-3v-6"/>',
    "design-tools":
        '<path d="M4 20l4.5-1 10-10a2.1 2.1 0 00-3-3l-10 10L4 20z"/><path d="M14 7l3 3"/>',
};

const DEFAULT_ICON =
    '<path d="M8 8l-4 4 4 4"/><path d="M16 8l4 4-4 4"/><path d="M13.5 5l-3 14"/>';

// Small helper to create an element with classes and plain text (safe against HTML in data).
function el(tag, className = "", text = "") {
    const node = document.createElement(tag);

    if (className) node.className = className;
    if (text) node.textContent = text;

    return node;
}

function createIcon(slug) {
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");

    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("class", "h-6 w-6 shrink-0 text-sky-300");
    svg.setAttribute("fill", "none");
    svg.setAttribute("stroke", "currentColor");
    svg.setAttribute("stroke-width", "1.8");
    svg.setAttribute("stroke-linecap", "round");
    svg.setAttribute("stroke-linejoin", "round");
    svg.setAttribute("aria-hidden", "true");
    svg.innerHTML = ICONS[slug] ?? DEFAULT_ICON;

    return svg;
}

function createCategoryCard(category, index) {
    const card = el("div", "glass rounded-2xl p-5");
    card.setAttribute("data-reveal", "");
    card.style.setProperty("--reveal-delay", index * 80 + "ms");

    const header = el("div", "mb-4 flex items-center gap-3");
    header.append(
        createIcon(category.slug),
        el("h3", "text-lg font-medium text-white", category.name),
    );

    const chips = el("div", "flex flex-wrap gap-2");
    category.skills.forEach((skill) =>
        chips.append(el("span", "skill-chip", skill.name)),
    );

    card.append(header, chips);

    return card;
}

// Skills: loaded from /api/skills. Only one panel (loading, error, or ready) is visible at a time.
export function initSkills() {
    const root = document.getElementById("skills-root");
    if (!root) return;

    const panels = root.querySelectorAll("[data-when]");
    const grid = document.getElementById("skills-grid");
    const retry = document.getElementById("skills-retry");

    const show = (state) => {
        panels.forEach((panel) => {
            panel.hidden = panel.dataset.when !== state;
        });
    };

    const load = async () => {
        show("loading");

        try {
            const categories = await getJson("/skills");

            if (!categories.length) throw new Error("No skills returned");

            grid.replaceChildren(...categories.map(createCategoryCard));
            show("ready");
            reveal(grid.querySelectorAll("[data-reveal]"));
        } catch (error) {
            show("error");
        }
    };

    retry?.addEventListener("click", load);
    load();
}
