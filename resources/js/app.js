import {
    initLoader,
    initNavbar,
    initReveal,
    initTyping,
    initCounters,
    initCardEffects,
} from "./animations";
import { initSkills, initProjects } from "./sections";

initNavbar();
initSkills();
initProjects();
initCardEffects();

initLoader().then(() => {
    initReveal();
    initTyping();
    initCounters();
});
