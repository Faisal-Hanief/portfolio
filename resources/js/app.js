import {
    initLoader,
    initNavbar,
    initReveal,
    initTyping,
    initCounters,
} from "./animations";

initNavbar();

initLoader().then(() => {
    initReveal();
    initTyping();
    initCounters();
});
