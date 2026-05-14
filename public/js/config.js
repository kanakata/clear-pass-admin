const images = document.querySelectorAll('img');
const inputs = document.querySelectorAll('input');
images.forEach((img) => {
  img.lazyLoad = true;
});

inputs.forEach((input) => {
  if (input.name == 'sirname') {
    input.required = false;
  }
  input.required = true;
});
