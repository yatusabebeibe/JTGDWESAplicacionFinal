<?php

/** @author Jesús Temprano Gallego
 *  @since 16/12/2025
 */

require_once("./config/confAPP.php");
require_once("./config/confDB.php");

session_start();

if (empty($_SESSION["paginaEnCurso"])) {
    $_SESSION["paginaEnCurso"] = "inicioPublico";
}

// Comprobamos si se ha enviado un idioma por formulario
if (!empty($_REQUEST["idioma"])) {

    // Creamos la cookie 'idioma' con el valor enviado y duración de 1 hora
    setcookie("idioma", $_REQUEST["idioma"], time() + 60*60);

    // Recargamos la página principal para aplicar el cambio de idioma
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

// Si no existe la cookie de idioma
if (empty($_COOKIE["idioma"])) {

    // la creamos con valor por defecto 'ES'
    setcookie("idioma", "ES", time() + 60*60);

    // Recargamos la página para que la cookie esté disponible
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

require_once($controlador[$_SESSION["paginaEnCurso"]]);