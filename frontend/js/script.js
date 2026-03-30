let toggle = document.querySelector(".menu-toggle")
let navlist = document.querySelector(".nav-list")
let carrosel_membros = document.querySelector(".carrossel-membros")

toggle.addEventListener("click", () => {
    navlist.classList.toggle("active")
})