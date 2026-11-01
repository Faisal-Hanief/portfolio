import {
    initLoader,
    initNavbar,
    initReveal,
    initTyping,
    initCounters,
    initCardEffects,
} from "./animations";
import { initSkills, initProjects } from "./sections";
import { initContactForm } from "./contact";

initNavbar();
initSkills();
initProjects();
initCardEffects();
initContactForm();

initLoader().then(() => {
    initReveal();
    initTyping();
    initCounters();
});
