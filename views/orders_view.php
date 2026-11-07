<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis pedidos</title>
</head>

<?php if (isset($_GET['nuevo'])) { ?>
<script>
    // Pedido confirmado: se vacía el carrito
    try { localStorage.removeItem('cartItems'); } catch (e) {}
</script>
<?php } ?>

<main id="mainOrders">
    <h1>Historial de pedidos</h1>

    <div class="historial">

        <?php if (count($pedidos) === 0) { ?>
        <div class="historialVacio">
            <i class="bi bi-box-seam"></i>
            <p>Todavia no hiciste ningun pedido</p>
        </div>
        <?php } ?>

        <?php foreach ($pedidos as $pedido) { ?>
        <div class="pedido">
            <div class="pedidoCabecera">
                <div>
                    <h2>Pedido #<?php echo str_pad($pedido['id'], 3, '0', STR_PAD_LEFT); ?></h2>
                    <p><?php echo date('d/m/Y', strtotime($pedido['fecha'])); ?></p>
                </div>

                <span class="estadoPedido"><?php echo htmlspecialchars($pedido['estado'] ?? ''); ?></span>
            </div>

            <hr>

            <div class="productosPedido">
                <?php foreach ($pedido['productos'] as $prod) { ?>
                <div>
                    <p><?php echo htmlspecialchars($prod['nombre']); ?> x<?php echo (int) $prod['cantidad']; ?></p>
                    <p>$<?php echo number_format($prod['precio'] * $prod['cantidad'], 0, ',', '.'); ?></p>
                </div>
                <?php } ?>
            </div>

            <hr>

            <div class="totalPedido">
                <p>Total:</p>
                <strong>$<?php echo number_format($pedido['total'], 0, ',', '.'); ?></strong>
            </div>
        </div>
        <?php } ?>

    </div>
</main>
