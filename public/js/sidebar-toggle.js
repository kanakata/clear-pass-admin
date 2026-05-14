const sidebar = document.querySelector('.sidebar');
const logo_close = document.querySelector('.logo-close');
let option = localStorage.getItem('sidebar');
if (option !== '') {
  sidebar.classList.toggle('small-screen');
}
//check if a cookie exists.
logo_close.addEventListener("click", () => {
    if (option == "") {
        localStorage.setItem('sidebar', 'small-screen');
        sidebar.classList.toggle("small-screen")
    } else {
        sidebar.classList.toggle("small-screen")
        localStorage.setItem("sidebar", "")
    }
})