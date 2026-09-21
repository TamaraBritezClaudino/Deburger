document.addEventListener('DOMContentLoaded', () => {

    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartItemCount = document.querySelector('.cart-icon span');
    const cartItemList = document.querySelector('.cart-items');
    const cartTotal = document.querySelector('.cart-total');
    const cartIcon = document.querySelector('.cart-icon');
    const sidebar = document.getElementById('sidebar');
    const closeButton = document.querySelector('.sidebar-close');

    let cartItems = [];
    let totalAmount = 0;

    addToCartButtons.forEach((button, index) => {

        button.addEventListener('click', () => {

            const itemName = document.querySelectorAll('.card .card-title')[index].textContent;

            const itemPrice = parseFloat(
                document.querySelectorAll('.price')[index].textContent
                    .replace('$', '')
            );

            const item = {
                name: itemName,
                price: itemPrice,
                quantity: 1
            };

            const existingItem = cartItems.find(
                (cartItem) => cartItem.name === item.name
            );

            if (existingItem) {
                existingItem.quantity++;
            } else {
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
        cartItemCount.textContent = cartItems.reduce(
            (total, item) => total + item.quantity,
            0
        );
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
                <span>
                    (${item.quantity}x) ${item.name}
                </span>

                <span class="cart-item-price">
                    $${(item.price * item.quantity).toFixed(2)}

                    <button
                        class="remove-item"
                        data-index="${index}">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </span>
            `;

            cartItemList.appendChild(cartItem);
        });

        const removeButtons =
            document.querySelectorAll('.remove-item');

        removeButtons.forEach((button) => {

            button.addEventListener('click', (event) => {

                const index =
                    event.currentTarget.dataset.index;

                removeItemFromCart(index);
            });
        });
    }

    function removeItemFromCart(index) {

        const removeItem = cartItems.splice(index, 1)[0];

        totalAmount -=
            removeItem.price * removeItem.quantity;

        updateCartUI();
    }

    function updateCartTotal() {
        cartTotal.textContent =
            `$${totalAmount.toFixed(2)}`;
    }

    cartIcon.addEventListener('click', () => {
        sidebar.classList.toggle('open');
    });

    closeButton.addEventListener('click', () => {
        sidebar.classList.remove('open');
    });

});