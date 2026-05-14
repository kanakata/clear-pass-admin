document.querySelector('body').setAttribute('oncontextmenu', 'return false');
// 1. Select the element with the class 'scroll-top'
localStorage.setItem('limit', 2);
window.addEventListener('scroll', () => {
  let offset = window.scrollY;
  if (offset > 10) {
    document.querySelector('nav').style.transform = 'translateY(-60px)';
  } else {
    document.querySelector('nav').style.transform = 'translateY(0px)';
  }
});

const summary_plan = document.getElementById('summary-plan');

const summary_price = document.getElementById('summary-price');
const depts = document.querySelectorAll('input[type="checkbox"]');
const departments = document.querySelector('.limit');
const plan = document.querySelector('.plan');
const price = document.querySelector('.value');
const plan_cards = document.querySelectorAll('.plan-card');
const dept_grids = document.querySelectorAll('.dept-grid');
const check_out = document.querySelector('.btn-checkout');
const plan_data = document.querySelector('.plan-card.active');
let numerator = document.querySelector('.numerator');
let denominator = document.querySelector('.denominator');

(function init() {
  plan.value = plan_data.dataset.name;
  price.value = plan_data.dataset.price;
  departments.value = plan_data.dataset.limit;
})();

plan_cards.forEach((plan_card) => {
  plan_card.addEventListener('click', () => {
    check_out.disabled = true;
    depts.forEach((dept) => {
      dept.checked = false;
      dept.disabled = false;
    });
    plan_cards.forEach((plan_card) => {
      plan_card.classList.remove('active');
    });

    plan_card.classList.add('active');
    summary_plan.textContent = plan_card.dataset.name + ' plan';
    summary_price.textContent = 'KES ' + plan_card.dataset.price;
    denominator.textContent = plan_card.dataset.limit;
    plan.value = plan_card.dataset.name;
    price.value = plan_card.dataset.price;
    departments.value = plan_card.dataset.limit;
    localStorage.setItem('limit', plan_card.dataset.limit);
  });
});

depts.forEach((dept) => {
  dept.addEventListener('change', () => {
    const limit = localStorage.getItem('limit');
    const checked_checkboxes = document.querySelectorAll(
      "input[type='checkbox']:checked"
    ).length;
    numerator.textContent = checked_checkboxes;
    depts.forEach((department) => {
      if (checked_checkboxes >= limit) {
        if (!department.checked) {
          department.disabled = true;
          check_out.disabled = false;
        }
      } else {
        department.disabled = false;
        check_out.disabled = true;
      }
    });
  });
});
