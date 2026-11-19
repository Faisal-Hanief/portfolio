import {
    initLoader,
    initNavbar,
    initReveal,
    initTyping,
    initCounters,
    initCardEffects,
} from "./animations";
import {
    initSkills,
    initProjects,
    initExperience,
    initCertificates,
} from "./sections";
import { initContactForm } from "./contact";

initNavbar();
initSkills();
initProjects();
initExperience();
initCertificates();
initCardEffects();
initContactForm();

initLoader().then(() => {
    initReveal();
    initTyping();
    initCounters();
});
