//Carrito
document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartItemCount = document.querySelector('.cart-icon span');
    const cartNumber = document.querySelector('.cart-number');
    const cartItemList = document.querySelector('.cart-items');
    const cartTotal = document.querySelector('.cart-total');
    const cartIcon = document.querySelector('.cart-icon');
    const sidebar = document.getElementById('sidebar');
    const closeButton = document.querySelector('.sidebar-close');
    const continueButton = document.querySelector('.continue-btn');

    let cartItems = [];
    let totalAmount = 0;

    addToCartButtons.forEach((button, index) => {

        button.addEventListener('click', () => {

            const cards = document.querySelectorAll('.card');

            const card = cards[index];

            const itemName =
                card.querySelector('.card-title').textContent;

            const itemPrice = parseFloat(
                card.querySelector('.price').textContent
                    .replace('$', '')
                    .replace('.', '')
                    .replace(',', '.')
            );

            const image = card.querySelector('img');

            const itemImage = image
                ? image.src
                : '';

            const descriptionElement =
                card.querySelector('.card-description');

            const itemDescription = descriptionElement
                ? descriptionElement.textContent
                : 'Producto seleccionado';


            const item = {
                name: itemName,
                price: itemPrice,
                image: itemImage,
                description: itemDescription,
                quantity: 1
            };

            const existingItem = cartItems.find(
                (cartItem) => cartItem.name === item.name
            );

            if (existingItem) {
                existingItem.quantity++;
            }

            else {

                cartItems.push(item);
            }

            totalAmount += item.price;
            updateCartUI();
        });

    });

    function updateCartUI() {

        updateCartItemCount();
        updateCartItemList();
        updateCartTotal();
    }

    function updateCartItemCount() {
        const quantity = cartItems.reduce(
            (total, item) => total + item.quantity,
            0
        );

        cartItemCount.textContent = quantity;

        if (cartNumber) {
            cartNumber.textContent = quantity;
        }
    }

    function updateCartItemList() {
        cartItemList.innerHTML = '';

        cartItems.forEach((item, index) => {
            const cartItem = document.createElement('div');

            cartItem.classList.add(
                'cart-item',
                'individual-cart-item'
            );

            cartItem.innerHTML = `
                <div class="cart-item-image">
                    <img src="${item.image}" alt="${item.name}">
                </div>

                <div class="cart-item-info">
                    <h4>${item.name}</h4>
                    <p>${item.description}</p>

                    <strong class="cart-item-price">
                        $${formatPrice(item.price * item.quantity)}
                    </strong>
                
                    <div class="cart-item-bottom">
                        <div class="quantity-controls">
                            <button
                                class="quantity-btn decrease btnRojo"
                                data-index="${index}">
                                −
                            </button>

                            <span>
                                ${item.quantity}
                            </span>

                            <button
                                class="quantity-btn increase btnRojo"
                                data-index="${index}">
                                +
                            </button>
                        </div>

                        <button class="remove-item btnRojo" data-index="${index}">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </div>
                </div>
            `;

            cartItemList.appendChild(cartItem);
        });
        addQuantityEvents();
        addRemoveEvents();
    }

    function addQuantityEvents() {

        const increaseButtons =
            document.querySelectorAll('.increase');

        const decreaseButtons =
            document.querySelectorAll('.decrease');


        increaseButtons.forEach(button => {
            button.addEventListener('click', () => {
                const index = button.dataset.index;
                cartItems[index].quantity++;
                totalAmount += cartItems[index].price;
                updateCartUI();
            });
        });

        decreaseButtons.forEach(button => {
            button.addEventListener('click', () => {
                const index = button.dataset.index;
                const item = cartItems[index];

                if (item.quantity > 1) {
                    item.quantity--;
                    totalAmount -= item.price;
                }
                else {
                    totalAmount -= item.price;
                    cartItems.splice(index, 1);
                }

                updateCartUI();
            });

        });

    }

    function addRemoveEvents() {
        const removeButtons =
            document.querySelectorAll('.remove-item');

        removeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const index = button.dataset.index;
                removeItemFromCart(index);
            });
        });
    }

    function removeItemFromCart(index) {
        const removeItem = cartItems.splice(index, 1)[0];
        totalAmount -= removeItem.price * removeItem.quantity;
        updateCartUI();
    }

    function formatPrice(price) {
        return price.toLocaleString('es-AR', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });
    }

    function updateCartTotal() {
        cartTotal.textContent = `$${formatPrice(totalAmount)}`;
    }

    cartIcon.addEventListener('click', () => {
        sidebar.classList.toggle('open');
    });


    closeButton.addEventListener('click', () => {
        sidebar.classList.remove('open');
    });

    continueButton.addEventListener('click', () => {
        sidebar.classList.remove('open');
    });
});

//Menu desplegable del perfil
let subMenu = document.getElementById("subMenu");
function toggleMenu() {
    subMenu.classList.toggle("open-menu");
}

//Configuración
const mostrarDatos = document.querySelector(".mostrarDatos");
const cambiarDatos = document.querySelector(".cambiarDatos");

const editarBtn = document.querySelector("#editarBtn");
const confirmarBtn = document.querySelector("#confirmarBtn");
const cancelarBtn = document.querySelector("#cancelarBtn");

if (editarBtn) {
    editarBtn.addEventListener("click", () => {
        mostrarDatos.classList.add("oculto");
        cambiarDatos.classList.add("mostrar");
    });
}

if (confirmarBtn) {
    confirmarBtn.addEventListener("click", () => {
        cambiarDatos.classList.remove("mostrar");
        mostrarDatos.classList.remove("oculto");
    });
}

if (cancelarBtn) {
    cancelarBtn.addEventListener("click", () => {
        cambiarDatos.classList.remove("mostrar");
        mostrarDatos.classList.remove("oculto");
    });
}