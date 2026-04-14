//alert function
const alert_message = document.querySelector('.alert');
document.querySelector('.close').addEventListener('click', () => {
  alert_message.setAttribute('style', 'display: none;');
  document.querySelector('body').setAttribute('style', 'overflow: scroll;');
});
