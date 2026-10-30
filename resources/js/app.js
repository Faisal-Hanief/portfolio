import {
    initLoader,
    initNavbar,
    initReveal,
    initTyping,
    initCounters,
} from "./animations";
import { initSkills } from "./sections";

initNavbar();
initSkills();

initLoader().then(() => {
    initReveal();
    initTyping();
    initCounters();
});
