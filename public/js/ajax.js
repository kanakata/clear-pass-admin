const pag = document.querySelectorAll(".pag")

pag.forEach(pagination => {
    pagination.addEventListener("click", () => {
        fetch('/ajax')
          .then((responce) => {
            return responce.json();
          })
          .then((data) => console.log(data))
          .catch((error) => {
            console.log(error);
          });
    })
});