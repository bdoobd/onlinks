"use strict";

const navElement = document.querySelector(".nav");
const hamburgerIcon = document.querySelector(".hamburger");

hamburgerIcon.addEventListener("click", () => {
  navElement.classList.toggle("open-menu");
  hamburgerIcon.classList.toggle("hamburger-open");
});

navElement.addEventListener("click", (e) => {
  if (e.target.tagName === "A") {
    navElement.classList.remove("open-menu");
    hamburgerIcon.classList.remove("hamburger-open");
  }
});
