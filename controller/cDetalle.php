<?php

/** @author Jesús Temprano Gallego
 *  @since 16/12/2025
 */

// Si no hay un usuario logueado, redirigimos al login
if (! isset($_SESSION["usuarioDAWJTGDAplicacionFinal"])) {
    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si se ha pulsado el botón de logoff, cerramos la sesión y redirigimos al inicio público
if (isset($_REQUEST["logoff"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "inicioPublico";
    unset($_SESSION["usuarioDAWJTGDAplicacionFinal"]);

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si se ha pulsado el botón de volver, redirigimos a la página de detalle
if (isset($_REQUEST["volver"])) {

    $_SESSION["paginaEnCurso"] = $_SESSION["paginaAnterior"];
    $_SESSION["paginaAnterior"] = "detalle";

    // Redirigimos
    header("Location: index.php");
    exit;
}

$titulo = "Detalle";

require_once $vista["layout"];
