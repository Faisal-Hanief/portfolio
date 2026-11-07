import {
    initLoader,
    initNavbar,
    initReveal,
    initTyping,
    initCounters,
    initCardEffects,
} from "./animations";
import { initSkills, initProjects, initExperiences } from "./sections";
import { initContactForm } from "./contact";

initNavbar();
initSkills();
initProjects();
initExperiences();
initCardEffects();
initContactForm();

initLoader().then(() => {
    initReveal();
    initTyping();
    initCounters();
});
