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





    //sort
    const select = document.querySelector('.dropdown');
    const products = document.querySelectorAll('.product');

    select.addEventListener('change', function () {
        const selectedValue = select.value.toLowerCase();

        products.forEach(product => {
            const productName = product.querySelector('h4').textContent.toLowerCase();

            if (productName.includes(selectedValue) || selectedValue === 'all') {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });

});


const priceSortLink = document.getElementById('priceSort');
const productTypeSelect = document.getElementById('productType');
const productContainer = document.getElementById('productContainer');
let priceSortAscending = true;

const products = [
    { name: 'Футболка с манжетами LE', type: 't-shirt', price: 2900 },
    { name: 'Термокружка Сберкот 500ml', type: 'cup2', price: 2200 },
    { name: 'Панама односторонняя', type: 'panama', price: 2400 },
    { name: 'Блокнот А6 Пес', type: 'note', price: 450 },
    { name: 'Ручка шариковая СБЕР', type: 'pen', price: 220 },
    { name: 'Powerbank', type: 'power', price: 5000 }
];

function renderProducts(productsToShow) {
    productContainer.innerHTML = '';
    productsToShow.forEach(product => {
        const productElement = document.createElement('div');
        productElement.classList.add('product');
        productElement.innerHTML = `
                <img src="/img/${product.type}.jpg" alt="">
                <div class="product-info">
                    <h4>${product.name}</h4>
                    <p>${product.name}</p>
                    <p>Цена: ${product.price} баллов</p>
                    <button class="shop-btn">Добавить</button>
                </div>
            `;
        productContainer.appendChild(productElement);
    });
}

renderProducts(products);

productTypeSelect.addEventListener('change', () => {
    const selectedType = productTypeSelect.value;
    if (selectedType === 'all') {
        renderProducts(products);
    } else {
        const filteredProducts = products.filter(product => product.type === selectedType);
        renderProducts(filteredProducts);
    }
});
priceSortLink.addEventListener('click', () => {
    let sortedProducts;
    if (priceSortAscending) {
        sortedProducts = [...products].sort((a, b) => a.price - b.price);
        priceSortLink.textContent = 'Сортировка по цене ↓';
    } else {
        sortedProducts = [...products].sort((a, b) => b.price - a.price);
        priceSortLink.textContent = 'Сортировка по цене ↑';
    }
    priceSortAscending = !priceSortAscending;
    renderProducts(sortedProducts);
});
