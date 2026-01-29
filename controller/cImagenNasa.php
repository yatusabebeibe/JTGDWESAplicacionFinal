<?php

/**
 * @author Jesús Temprano Gallego
 * @since 16/01/2026
 */

// Si no hay un usuario logueado, redirigimos al login
if (! isset($_SESSION["usuarioDAWJTGDAplicacionFinal"])) {
    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si se ha pulsado el boton detalleNasa
if (isset($_REQUEST['detalleNasa'])) {
    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "detalleNasa";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Inicializamos el array de datos de la vista
$avImagenNasa = [
    "fecha" => $_SESSION["REST"]["nasa"]->getFecha(),
    "titulo" => $_SESSION["REST"]["nasa"]->getTitulo(),
    "urlImagen" => $_SESSION["REST"]["nasa"]->getUrl(),
    "urlImagenHd" => $_SESSION["REST"]["nasa"]->getHdurl(),
    "explicacion" => $_SESSION["REST"]["nasa"]->getExplicacion(),
    "copyright" => $_SESSION["REST"]["nasa"]->getCopyright(),
];

$titulo = "REST";

require_once $vista['layout'];