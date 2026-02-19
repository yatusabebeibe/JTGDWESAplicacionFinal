<?php

/** @author Jesús Temprano Gallego
 *  @since 25/01/2025
 */

// Si se ha pulsado el botón de guardar, validamos la descripción y actualizamos el usuario
if (isset($_REQUEST["guardarUsuario"])) {
    if (empty(validacionFormularios::comprobarAlfaNumerico($_REQUEST["descUsuario"],255,3,1))) {
        UsuarioPDO::modificarUsuario($_SESSION["usuarioDAWJTGDAplicacionFinal"]->getCodigo(),$_REQUEST["descUsuario"]);
    }
}

$titulo = "Cuenta";

require_once $vista['layout'];