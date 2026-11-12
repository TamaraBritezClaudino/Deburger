// Formatear precios
function formatPrice(price) {
    return price.toLocaleString('es-AR', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });
}

// Carrito
document.addEventListener('DOMContentLoaded', () => {

    const addToCartButtons =
        document.querySelectorAll('.add-to-cart');

    const cartItemCount =
        document.querySelector('.cart-icon span');

    const cartNumber =
        document.querySelector('.cart-number');

    const cartItemList =
        document.querySelector('.cart-items');

    const cartTotal =
        document.querySelector('.cart-total');

    const cartIcon =
        document.querySelector('.cart-icon');

    const sidebar =
        document.getElementById('sidebar');

    const closeButton =
        document.querySelector('.sidebar-close');

    const continueButton =
        document.querySelector('.continue-btn');


    // Sin sesión iniciada no se conserva ningún carrito
    if (!window.USUARIO_LOGUEADO) {
        localStorage.removeItem('cartItems');
    }

    // Cargar carrito guardado
    let cartItems =
        JSON.parse(localStorage.getItem('cartItems')) || [];

    // Calcular el total de los productos guardados
    let totalAmount = cartItems.reduce(
        (total, item) =>
            total + item.price * item.quantity,
        0
    );

    // Agregar productos al carrito
    addToCartButtons.forEach((button, index) => {

        button.addEventListener('click', () => {

            // Sin cuenta iniciada: mandar a iniciar sesión
            if (!window.USUARIO_LOGUEADO) {
                window.location.href =
                    'login.php?volver=takeAway.php';
                return;
            }

            const cards =
                document.querySelectorAll('.tarjetaMenu');

            const card = cards[index];

            const itemName =
                card.querySelector('h3').textContent.trim();

            const itemPrice = parseFloat(
                card.querySelector('.precioProducto p')
                    .textContent
                    .replace('$', '')
                    .replace(/\./g, '')
                    .replace(',', '.')
            );

            const image =
                card.querySelector('img');

            const itemImage =
                image ? image.src : '';

            const itemDescription =
                card.querySelector('.descripcionProducto')
                    .textContent.trim();


            const item = {
                id: card.dataset.id,
                name: itemName,
                price: itemPrice,
                image: itemImage,
                description: itemDescription,
                quantity: 1
            };


            // Buscar si el producto ya existe
            const existingItem =
                cartItems.find(
                    (cartItem) =>
                        cartItem.name === item.name
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


    // Actualizar carrito
    function updateCartUI() {

        // Guardar carrito
        localStorage.setItem(
            'cartItems',
            JSON.stringify(cartItems)
        );

        updateCartItemCount();
        updateCartItemList();
        updateCartTotal();

    }


    // Actualizar cantidad del carrito
    function updateCartItemCount() {

        const quantity =
            cartItems.reduce(
                (total, item) =>
                    total + item.quantity,
                0
            );


        if (cartItemCount) {
            cartItemCount.textContent = quantity;
        }


        if (cartNumber) {
            cartNumber.textContent = quantity;
        }

    }


    // Mostrar productos dentro del carrito
    function updateCartItemList() {

        if (!cartItemList) {
            return;
        }


        cartItemList.innerHTML = '';


        cartItems.forEach((item, index) => {

            const cartItem =
                document.createElement('div');


            cartItem.classList.add(
                'cart-item',
                'individual-cart-item'
            );


            cartItem.innerHTML = `

                <div class="cart-item-image">

                    <img
                        src="${item.image}"
                        alt="${item.name}">

                </div>


                <div class="cart-item-info">

                    <h4>${item.name}</h4>

                    <p>${item.description}</p>


                    <strong class="cart-item-price">
                        $${formatPrice(
                item.price * item.quantity
            )}
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


                        <button
                            class="remove-item btnRojo"
                            data-index="${index}">

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


    // Botones de cantidad
    function addQuantityEvents() {

        const increaseButtons =
            document.querySelectorAll('.increase');

        const decreaseButtons =
            document.querySelectorAll('.decrease');


        increaseButtons.forEach(button => {

            button.addEventListener('click', () => {

                const index =
                    button.dataset.index;


                cartItems[index].quantity++;

                totalAmount +=
                    cartItems[index].price;


                updateCartUI();

            });

        });


        decreaseButtons.forEach(button => {

            button.addEventListener('click', () => {

                const index =
                    button.dataset.index;

                const item =
                    cartItems[index];


                if (item.quantity > 1) {

                    item.quantity--;

                    totalAmount -=
                        item.price;

                }

                else {

                    totalAmount -=
                        item.price;

                    cartItems.splice(index, 1);

                }


                updateCartUI();

            });

        });

    }


    // Botones para eliminar productos
    function addRemoveEvents() {

        const removeButtons =
            document.querySelectorAll('.remove-item');


        removeButtons.forEach(button => {

            button.addEventListener('click', () => {

                const index =
                    button.dataset.index;

                removeItemFromCart(index);

            });

        });

    }


    // Eliminar producto
    function removeItemFromCart(index) {

        const removeItem =
            cartItems.splice(index, 1)[0];


        totalAmount -=
            removeItem.price *
            removeItem.quantity;


        updateCartUI();

    }


    // Actualizar total
    function updateCartTotal() {

        if (cartTotal) {

            cartTotal.textContent =
                `$${formatPrice(totalAmount)}`;

        }

    }


    // Abrir carrito
    if (cartIcon) {

        cartIcon.addEventListener('click', () => {

            sidebar.classList.toggle('open');

        });

    }


    // Cerrar carrito
    if (closeButton) {

        closeButton.addEventListener('click', () => {

            sidebar.classList.remove('open');

        });

    }


    // Continuar con la compra
    if (continueButton) {

        continueButton.addEventListener('click', () => {

            sidebar.classList.remove('open');

        });

    }


    // Mostrar el carrito guardado al cargar
    updateCartUI();

});


// Confirmar compra

const productosCompra =
    document.getElementById('productosCompra');

const totalCompra =
    document.getElementById('totalCompra');


if (productosCompra) {

    const cartItems =
        JSON.parse(
            localStorage.getItem('cartItems')
        ) || [];


    let total = 0;


    cartItems.forEach(item => {

        const subtotal =
            item.price * item.quantity;


        total += subtotal;


        const producto =
            document.createElement('div');


        producto.classList.add(
            'productoCompra'
        );


        producto.innerHTML = `

            <div class="imagenProducto">

                <img
                    src="${item.image}"
                    alt="${item.name}">

            </div>


            <div class="infoProducto">

                <h3>${item.name}</h3>

                <p>${item.description}</p>


                <div>

                    <span>
                        Cantidad: ${item.quantity}
                    </span>

                    <strong>
                        $${formatPrice(subtotal)}
                    </strong>

                </div>

            </div>

        `;


        productosCompra.appendChild(producto);

    });


    totalCompra.textContent =
        `$${formatPrice(total)}`;


    // Mandar el carrito al servidor al confirmar el pedido
    const carritoInput =
        document.getElementById('carritoInput');

    if (carritoInput) {
        carritoInput.value = JSON.stringify(
            cartItems.map(item => ({
                id: item.id,
                name: item.name,
                quantity: item.quantity
            }))
        );
    }

}


// Menu desplegable del perfil

let subMenu =
    document.getElementById("subMenu");


function toggleMenu() {

    if (subMenu) {

        subMenu.classList.toggle(
            "open-menu"
        );

    }

}


// Configuración

const mostrarDatos =
    document.querySelector(".mostrarDatos");

const cambiarDatos =
    document.querySelector(".cambiarDatos");


const editarBtn =
    document.querySelector("#editarBtn");

const confirmarBtn =
    document.querySelector("#confirmarBtn");

const cancelarBtn =
    document.querySelector("#cancelarBtn");


if (editarBtn) {
    editarBtn.addEventListener("click", () => {
        mostrarDatos.classList.add("oculto");
        cambiarDatos.classList.add("mostrar");
    });
}


// Confirmar envía el formulario (config.php) y la página se recarga mostrando los datos guardados

if (cancelarBtn) {
    cancelarBtn.addEventListener("click", () => {
        cambiarDatos.classList.remove("mostrar");
        mostrarDatos.classList.remove("oculto");
    });

}

//LOCALES
document.addEventListener("DOMContentLoaded", function () {

    const mapa = L.map("mapaLocales").setView(
        [-34.6037, -58.3816],
        12
    );

    L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            attribution: '&copy; OpenStreetMap contributors'
        }
    ).addTo(mapa);

    const tarjetas = document.querySelectorAll(".tarjetaLocal");
    const buscador = document.getElementById("buscarLocal");
    const sinResultados = document.getElementById("sinResultados");
    const contador = document.getElementById("contadorLocales");

    const marcadores = [];

    // Crear marcadores
    tarjetas.forEach((tarjeta, index) => {

        const lat = Number(tarjeta.dataset.lat);
        const lng = Number(tarjeta.dataset.lng);

        const nombre = tarjeta.dataset.nombre;
        const direccion = tarjeta.dataset.direccion;
        const horario = tarjeta.dataset.horario;

        const marcador = L.marker([lat, lng]).addTo(mapa);

        marcador.bindPopup(`
            <strong>${nombre}</strong>
            <br>
            ${direccion}
            <br>
            <small>${horario}</small>
        `);

        marcadores.push(marcador);

        // Seleccionar local desde la tarjeta
        tarjeta.addEventListener("click", function () {

            tarjetas.forEach(t => t.classList.remove("seleccionado"));

            tarjeta.classList.add("seleccionado");

            mapa.flyTo([lat, lng], 15);

            marcador.openPopup();
        });

    });

    // Buscador de sucursales
    buscador.addEventListener("input", function () {

        const busqueda = buscador.value.toLowerCase().trim();

        let encontrados = 0;

        tarjetas.forEach((tarjeta, index) => {

            const nombre = tarjeta.dataset.nombre.toLowerCase();
            const direccion = tarjeta.dataset.direccion.toLowerCase();

            const coincide =
                nombre.includes(busqueda) ||
                direccion.includes(busqueda);

            tarjeta.style.display = coincide ? "flex" : "none";

            if (coincide) {
                encontrados++;
                marcadores[index].addTo(mapa);
            } else {
                mapa.removeLayer(marcadores[index]);
                tarjeta.classList.remove("seleccionado");
            }

        });

        contador.textContent = encontrados + " locales";

        sinResultados.style.display =
            encontrados === 0 ? "block" : "none";

    });

    // Ajustar el mapa a todos los locales
    if (marcadores.length > 0) {

        const grupo = L.featureGroup(marcadores);

        mapa.fitBounds(grupo.getBounds(), {
            padding: [30, 30]
        });

    }

    // Botones para ubicar cada sucursal
    document.querySelectorAll(".verLocal").forEach(boton => {

        boton.addEventListener("click", function (e) {

            e.stopPropagation();

            boton.closest(".tarjetaLocal").click();

        });

    });

});
