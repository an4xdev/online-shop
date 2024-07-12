// resources/js/welcome.js

const detailsElements = document.querySelectorAll("details");

detailsElements.forEach((details) => {
    details.querySelector("summary").addEventListener("click", () => {
        detailsElements.forEach((otherDetails) => {
            if (otherDetails !== details) {
                otherDetails.removeAttribute("open");
            }
        });
    });
});
