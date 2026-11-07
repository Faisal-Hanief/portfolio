import { getJson } from "./api";
import { reveal } from "./animations";

// Inline SVG icons (no icon library needed). Unknown keys fall back to the "code" icon.
const ICONS = {
    Frontend:
        '<rect x="3" y="4" width="18" height="16" rx="2.5"/><path d="M3 9h18"/>',
    Backend:
        '<rect x="3" y="4" width="18" height="7" rx="2"/><rect x="3" y="13" width="18" height="7" rx="2"/><path d="M7 7.5h.01"/><path d="M7 16.5h.01"/>',
    Database:
        '<ellipse cx="12" cy="6" rx="7" ry="3"/><path d="M5 6v6c0 1.7 3.1 3 7 3s7-1.3 7-3V6"/><path d="M5 12v6c0 1.7 3.1 3 7 3s7-1.3 7-3v-6"/>',
    Tools: '<path d="M4 20l4.5-1 10-10a2.1 2.1 0 00-3-3l-10 10L4 20z"/><path d="M14 7l3 3"/>',
    image: '<rect x="3" y="4" width="18" height="16" rx="2.5"/><circle cx="9" cy="10" r="1.6"/><path d="M21 16l-5-5-8 8"/>',
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

function createIcon(key, className = "h-6 w-6 shrink-0 text-sky-300") {
    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");

    svg.setAttribute("viewBox", "0 0 24 24");
    svg.setAttribute("class", className);
    svg.setAttribute("fill", "none");
    svg.setAttribute("stroke", "currentColor");
    svg.setAttribute("stroke-width", "1.8");
    svg.setAttribute("stroke-linecap", "round");
    svg.setAttribute("stroke-linejoin", "round");
    svg.setAttribute("aria-hidden", "true");
    svg.innerHTML = ICONS[key] ?? DEFAULT_ICON;

    return svg;
}

// Shows only one panel (loading, error or ready) at a time inside a section.
function createPanelSwitcher(root) {
    const panels = root.querySelectorAll("[data-when]");

    return (state) => {
        panels.forEach((panel) => {
            panel.hidden = panel.dataset.when !== state;
        });
    };
}

// Loads a list from our API into a grid. Handles loading, error and the retry button.
function loadSection({ rootId, gridId, retryId, path, render }) {
    const root = document.getElementById(rootId);
    if (!root) return;

    const show = createPanelSwitcher(root);
    const grid = document.getElementById(gridId);
    const retry = document.getElementById(retryId);

    const load = async () => {
        show("loading");

        try {
            const items = await getJson(path);

            if (!Array.isArray(items) || !items.length) {
                throw new Error("No data returned");
            }

            grid.replaceChildren(...items.map(render));
            show("ready");
            reveal(grid.querySelectorAll("[data-reveal]"));
        } catch (error) {
            console.error(`Failed to load ${path}:`, error);
            show("error");
        }
    };

    retry?.addEventListener("click", load);
    load();
}

// ----- Skills (grouped by category: Frontend, Backend, Database, Tools) -----

function createCategoryCard(group, index) {
    const card = el("div", "glass rounded-2xl p-5");
    card.setAttribute("data-reveal", "");
    card.style.setProperty("--reveal-delay", index * 80 + "ms");

    const header = el("div", "mb-4 flex items-center gap-3");
    header.append(
        createIcon(group.category),
        el("h3", "text-lg font-medium text-white", group.category),
    );

    const chips = el("div", "flex flex-wrap gap-2");
    group.skills.forEach((skill) =>
        chips.append(el("span", "skill-chip", skill.name)),
    );

    card.append(header, chips);

    return card;
}

export function initSkills() {
    loadSection({
        rootId: "skills-root",
        gridId: "skills-grid",
        retryId: "skills-retry",
        path: "/skills",
        render: createCategoryCard,
    });
}

// ----- Projects -----

// A link button when the URL exists, otherwise a disabled "soon" placeholder.
// Only http(s) links are accepted, as an extra safety check on data coming from the API.
function createActionLink(label, url) {
    if (url && /^https?:\/\//i.test(url)) {
        const link = el("a", "project-action", label);
        link.href = url;
        link.target = "_blank";
        link.rel = "noopener noreferrer";

        return link;
    }

    const placeholder = el(
        "span",
        "project-action project-action-off",
        label + " ",
    );
    placeholder.setAttribute("aria-disabled", "true");
    placeholder.title = "Coming soon";
    placeholder.append(el("small", "", "soon"));

    return placeholder;
}

function createProjectCard(project, index) {
    const wrapper = el("article", "project-card h-full");
    wrapper.setAttribute("data-reveal", "");
    wrapper.style.setProperty("--reveal-delay", index * 100 + "ms");

    const card = el("div", "fx-card flex h-full flex-col");

    // Thumbnail, or a gradient placeholder while the project has no image yet
    const shot = el("div", "project-shot");

    if (project.thumbnail_url) {
        const image = el("img", "h-full w-full object-cover");
        image.src = project.thumbnail_url;
        image.alt = "Screenshot of " + project.title;
        image.loading = "lazy";
        shot.append(image);
    } else {
        shot.classList.add("project-shot-empty");
        shot.append(
            createIcon("image", "h-7 w-7"),
            el("span", "", "Screenshot coming soon"),
        );
    }

    const body = el("div", "flex flex-1 flex-col p-5");
    body.append(
        el("h3", "text-lg font-semibold text-white", project.title),
        el(
            "p",
            "mt-2 flex-1 text-sm leading-relaxed text-slate-300",
            project.summary,
        ),
    );

    const chips = el("div", "mt-4 flex flex-wrap gap-2");
    project.skills.forEach((skill) =>
        chips.append(el("span", "skill-chip", skill.name)),
    );

    const actions = el("div", "mt-5 flex flex-wrap gap-3");
    actions.append(
        createActionLink("GitHub", project.github_url),
        createActionLink("Demo", project.demo_url),
    );

    body.append(chips, actions);
    card.append(shot, body);
    wrapper.append(card);

    return wrapper;
}

export function initProjects() {
    loadSection({
        rootId: "projects-root",
        gridId: "projects-grid",
        retryId: "projects-retry",
        path: "/projects",
        render: createProjectCard,
    });
}

// ----- Experiences (work and organization) -----

function formatExperienceDate(date) {
    if (!date) return "Present";

    return new Date(date + "T00:00:00").toLocaleDateString("en-US", {
        month: "short",
        year: "numeric",
    });
}

function createExperienceCard(experience, index) {
    const card = el("article", "glass rounded-2xl p-6");
    card.setAttribute("data-reveal", "");
    card.style.setProperty("--reveal-delay", index * 100 + "ms");

    const header = el(
        "div",
        "flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between",
    );

    const information = el("div");
    information.append(
        el("h3", "text-lg font-semibold text-white", experience.title),
        el("p", "mt-1 text-sm text-sky-300", experience.organization),
    );

    const start = formatExperienceDate(experience.start_date);
    const end = experience.is_current
        ? "Present"
        : formatExperienceDate(experience.end_date);

    const period = el(
        "p",
        "text-sm text-slate-400 sm:text-right",
        start + " – " + end,
    );

    header.append(information, period);

    const description = el(
        "p",
        "mt-4 text-sm leading-relaxed text-slate-300",
        experience.description,
    );

    card.append(header, description);

    return card;
}

export function initExperiences() {
    loadSection({
        rootId: "experience-root",
        gridId: "experience-list",
        retryId: "experience-retry",
        path: "/experiences",
        render: createExperienceCard,
    });
}
