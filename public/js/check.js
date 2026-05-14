const scrollBtn = document.querySelector('.scroll-top');
const pagNextAndPrev = document.querySelectorAll('.move');
scrollBtn.addEventListener('click', () => {
  window.scrollTo({
    top: 0,
    left: 0,
    behavior: 'smooth',
  });
});

pagNextAndPrev.forEach((btn) => {
  btn.addEventListener('click', () => {
    btn.classList.toggle('active');
  });
});
