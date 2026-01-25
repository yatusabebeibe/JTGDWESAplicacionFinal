<?php

/**
 * @author Jesús Temprano Gallego
 * @since 15/01/2026
 */

// Si se ha pulsado el botón de volver, limpiamos el error y redirigimos a la página anterior
if(isset($_REQUEST['volver'])){

    // Limpiamos el error de la sesión
    unset($_SESSION['error']);

    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    header('Location: index.php');
    exit;
}

// Login
if (isset($_REQUEST["login"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}
// Registro
if (isset($_REQUEST["register"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "registro";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Array para pasar a la vista
$avError = [
    'codError' => '',
    'descError' => '',
    'archivoError' => '',
    'lineaError' => '',
    'paginaSiguiente' => ''
];
// Si existe un error en la sesión, lo recogemos y lo almacenamos en un array para pasarlo a la vista
if (isset($_SESSION['error'])) {
    $oError = $_SESSION['error'];
    $avError = [
        'codError' => $oError->getCodError(),
        'descError' => $oError->getDescError(),
        'archivoError' => $oError->getArchivoError(),
        'lineaError' => $oError->getLineaError(),
        'paginaSiguiente' => $oError->getPaginaSiguiente()
    ];
}

$titulo = "Error {$avError['codError']}";

require_once $vista['layout'];