alert("hello")
const departments = document.querySelectorAll('.depts');
alert(departments);

/*departments.forEach((dept) => {
  dept.addEventListener('change', () => {
    const limit = document.querySelector("input[type='hidden']").value;

    const checked_checkboxes = document.querySelectorAll(
      "input[type='checkbox']:checked"
    ).length;

    if (checked_checkboxes >= limit) {
      alert('limit reached');
    }
  });
});
