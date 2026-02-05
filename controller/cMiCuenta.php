<?php

// Si se ha pulsado el botón de guardar, validamos la descripción y actualizamos el usuario
if (isset($_REQUEST["guardarUsuario"])) {
    if (empty(validacionFormularios::comprobarAlfaNumerico($_REQUEST["descUsuario"],255,3,1))) {
        UsuarioPDO::modificarUsuario($_SESSION["usuarioDAWJTGDAplicacionFinal"]->getCodUsuario(),$_REQUEST["descUsuario"]);
    }
}

$titulo = "Cuenta";

require_once $vista['layout'];