document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll('.area__nav-link');
    const contentContainer = document.getElementById('content-container');

    links.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            let contentId = this.getAttribute('data-content');
            let content = document.getElementById(contentId);

            let allContent = contentContainer.querySelectorAll('.main__admin-right > div');
            allContent.forEach(function (item) {
                item.style.display = 'none';
            });

            content.style.display = 'block';
        });
    });

    var modalLink = document.getElementById("openModal");
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


    var modalReg = document.getElementById("OpenRegModal");
    var Regmodal = document.getElementById("regModal");
    var closeModalReg = document.getElementById("closeModalReg");

    // Открываем модальное окно при нажатии на ссылку
    modalReg.addEventListener("click", function() {
        Regmodal.style.display = "block";
    });

    // Закрываем модальное окно при нажатии на крестик
    closeModalReg.addEventListener("click", function() {
        Regmodal.style.display = "none";
    });

});

document.getElementById('priceSort').addEventListener('click', function() {
    var container = document.getElementById('productContainer');
    var products = Array.from(container.getElementsByClassName('product'));
    products.sort(function(a, b) {
        return parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'));
    });
    container.innerHTML = '';
    products.forEach(function(product) {
        container.appendChild(product);
    });
});
