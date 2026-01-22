<?php

/**
 * @author Jesús Temprano Gallego
 * @since 16/01/2026
 */

// Si se ha pulsado el botón de volver, redirigimos a la página anterior
if(isset($_REQUEST['volver'])){
    $temp = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = $temp;
    header('Location: index.php');
    exit;
}

// Si se ha enviado una fecha, obtenemos la foto de la NASA para esa fecha
if (isset($_REQUEST['fecha'])) {
    // Validamos la fecha el minimo siendo la fecha que la NASA empezo a publicar imagenes, eL maximo la fecha actual
    if (empty(validacionFormularios::validarFecha($_REQUEST['fecha'], date('d/m/Y'), '16/06/1995', 1))) {
        $fotoNasa = REST::getFotoDiaNasa($_REQUEST['fecha']);
        $_SESSION["REST"]["nasa"] = $fotoNasa;
    }
}
// Si no se ha enviado una fecha, obtenemos la foto de hoy
else if (empty($_SESSION["REST"]["nasa"]) || $_SESSION["REST"]["nasa"]->getFecha() === null) {
    $fotoNasa = REST::getFotoDiaNasa(date('Y-m-d'));
    $_SESSION["REST"]["nasa"] = $fotoNasa;
}

// Inicializamos el array de datos de la vista
$avREST = [
    "nasa" => $_SESSION["REST"]["nasa"],
];

$titulo = "REST";

require_once $vista['layout'];