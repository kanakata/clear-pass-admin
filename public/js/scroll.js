const scrollBtn = document.querySelector('.scroll-top');
scrollBtn.addEventListener('click', () => {
  // 3. Perform the scroll
  window.scrollTo({
    top: 0,
    left: 0,
    behavior: 'smooth', // This creates the gliding effect
  });
});
