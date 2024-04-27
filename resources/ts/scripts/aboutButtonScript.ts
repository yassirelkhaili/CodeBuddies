/**
 * @author Yassir Elkhaili
 * @license GPL-3.0
 * **/

document.addEventListener("DOMContentLoaded", () => {
    const aboutButton = document.getElementById("about-button") as HTMLButtonElement;
    aboutButton && aboutButton.addEventListener("click", () => {
        const aboutSectionHeight: number = document.getElementById("tech-section").offsetTop - 100;
        scrollTo(0, aboutSectionHeight);
    })
})