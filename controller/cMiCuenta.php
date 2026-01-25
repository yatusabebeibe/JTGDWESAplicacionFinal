<?php

// Si se ha pulsado el botón de volver, redirigimos a la página de detalle
if (isset($_REQUEST["volver"])) {

    $_SESSION["paginaEnCurso"] = $_SESSION["paginaAnterior"];
    $_SESSION["paginaAnterior"] = "detalle";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si se ha pulsado el botón de guardar, validamos la descripción y actualizamos el usuario
if (isset($_REQUEST["guardarUsuario"])) {
    if (empty(validacionFormularios::comprobarAlfaNumerico($_REQUEST["descUsuario"],255,3,1))) {
        UsuarioPDO::modificarUsuario($_SESSION["usuarioDAWJTGDAplicacionFinal"]->getCodUsuario(),$_REQUEST["descUsuario"]);
    }
}

$titulo = "Cuenta";

require_once $vista['layout'];