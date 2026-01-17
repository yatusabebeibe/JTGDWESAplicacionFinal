<?php

/**
 * @author Jesús Temprano Gallego
 * @since 16/01/2026
 */

// Si se ha pulsado el botón de volver, redirigimos a la página anterior
if(isset($_REQUEST['volver'])){
    unset($_SESSION['REST']);
    $temp = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = $temp;
    header('Location: index.php');
    exit;
}

// Inicializamos el array de datos de la vista
$avREST = [
    "nasa" => $_SESSION["REST"]["nasa"] ?? null,
];

// Si se ha enviado una fecha, obtenemos la foto de la NASA para esa fecha
if (isset($_REQUEST['fecha'])) {
    // Validamos que la fecha no sea mayor que la fecha actual
    $fechaSeleccionada = $_REQUEST['fecha'];
    if ($fechaSeleccionada <= date('Y-m-d')) {
        $fotoNasa = REST::getFotoDiaNasa($fechaSeleccionada);
        $avREST["nasa"] = $fotoNasa;
    }
} else if (empty($avREST["nasa"]) || $avREST["nasa"]->getFecha() === null) { // Si no se ha enviado una fecha, obtenemos la foto de hoy
    $fotoNasa = REST::getFotoDiaNasa(date('Y-m-d'));
    $avREST["nasa"] = $fotoNasa;
}
// var_dump($avREST["nasa"]);

// Guardamos los datos en la sesión
$_SESSION['REST'] = $avREST;

$titulo = "REST";

require_once $vista['layout'];