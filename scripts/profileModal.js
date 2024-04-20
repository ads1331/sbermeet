document.addEventListener("DOMContentLoaded", function () {
    var modalLink = document.getElementById("profileModal");
    var modal = document.getElementById("loginModal");
    var closeModal = document.getElementById("closeModal");

    // Открываем модальное окно при нажатии на ссылку
    modalLink.addEventListener("click", function() {
        modal.style.display = "block";
    });

    // Закрываем модальное окно при нажатии на крестик
    closeModal.addEventListener("click", function() {
        modal.style.display = "none";
    });

});