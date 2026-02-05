<?php

/** @author Jesús Temprano Gallego
 *  @since 16/12/2025
 */

// Login
if (isset($_REQUEST["login"])) {

    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}
// Registro
if (isset($_REQUEST["register"])) {

    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "registro";

    // Redirigimos
    header("Location: index.php");
    exit;
}

$titulo = "Inicio Publico";

require_once $vista["layout"];
