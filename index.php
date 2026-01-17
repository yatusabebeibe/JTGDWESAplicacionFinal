<?php

/** @author Jesús Temprano Gallego
 *  @since 16/12/2025
 */

require_once("./config/confAPP.php");
require_once("./config/confDB.php");

session_start();

// Si no esta inicializada la página en curso, la inicializamos a inicioPublico
$_SESSION["paginaEnCurso"] ??= "inicioPublico";

// Comprobamos si se ha enviado un idioma por formulario
if (!empty($_REQUEST["idioma"])) {
    setcookie("idioma", $_REQUEST["idioma"], time() + 60*60); // Creamos la cookie enviada con duración de 1 hora
    header("Location: " . $_SERVER["PHP_SELF"]); // Recargamos la página para que la cookie esté disponible
    exit;
}

// Si no existe la cookie de idioma la creamos
if (empty($_COOKIE["idioma"])) {
    setcookie("idioma", "ES", time() + 60*60); // Creamos la cookie con valor por defecto 'ES' y duración de 1 hora
    header("Location: " . $_SERVER["PHP_SELF"]); // Recargamos la página para que la cookie esté disponible
    exit;
}

require_once($controlador[$_SESSION["paginaEnCurso"]]);