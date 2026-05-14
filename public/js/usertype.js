(function () {
  const usertype = document.getElementById('usertype');
  const position = document.getElementById('position');
  const admin_pos = document.querySelectorAll('.admin_pos');
  usertype.addEventListener('change', () => {
    if (usertype.value == 'admin') {
      position.style.display = 'block';
      admin_pos.forEach((pos) => {
        pos.style.display = 'block';
      });
    } else {
      position.style.display = 'none';
      admin_pos.forEach((pos) => {
        pos.style.display = 'none';
      });
    }
  });
})();

(function () {})();
