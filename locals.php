
<?php
 require_once "includes/config.php";

 $locales = [];

 // Obtener la hora actual 
 $ahora = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
 $horaActual = $ahora->format('H:i:s');

 $consulta = mysqli_query($conn, "SELECT * FROM locales ORDER BY localidad");

 $actualizar = mysqli_prepare($conn, "UPDATE locales SET estado_abierto = ? WHERE id_local = ?");

 while ($local = mysqli_fetch_assoc($consulta)) {

    $apertura = $local['hora_apertura'];
    $cierre = $local['hora_cierre'];

    // Verificar si el local está abierto
    if ($apertura == $cierre) {
        $abierto = false;
    }
    else if ($apertura < $cierre) {
        $abierto = ($horaActual >= $apertura && $horaActual < $cierre);
    }
    else {
        $abierto = ($horaActual >= $apertura || $horaActual < $cierre);
    }

    $estado = (int) $abierto;
    mysqli_stmt_bind_param($actualizar, "ii", $estado, $local['id_local']);
    mysqli_stmt_execute($actualizar);

    $local['estado_abierto'] = $abierto;
    $local['horario'] = substr($apertura, 0, 5) . " a " . substr($cierre, 0, 5);

    $locales[] = $local;
 }

 $section = "views/locals";
 require_once "views/layout.php";
?>
