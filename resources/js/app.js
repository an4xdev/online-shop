import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const detailsElements = document.querySelectorAll("details");

detailsElements.forEach((details) => {
    details.querySelector("summary").addEventListener("click", () => {
        detailsElements.forEach((otherDetails) => {
            if (otherDetails !== details) {
                if (otherDetails.id !== "mobile-categories") {
                    otherDetails.removeAttribute("open");
                }
            }
        });
        if (window.innerWidth < 1024) {
            details.scrollIntoView({ behavior: "smooth", block: "start" });
        }
    });
});
