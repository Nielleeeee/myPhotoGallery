const openModalButton = document.querySelector("#open-modal-button");
const modal = document.querySelector("#modal");
const closeButton = document.querySelector(".close-button");

openModalButton.addEventListener("click", function() {
  modal.style.display = "block";
});

closeButton.addEventListener("click", function() {
  modal.style.display = "none";
});

window.addEventListener("click", function(event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
});