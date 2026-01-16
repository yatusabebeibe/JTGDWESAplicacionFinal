<?php

/** @author Jesús Temprano Gallego
 *  @since 16/12/2025
 */

require_once 'core/231018libreriaValidacion.php';

require_once 'model/DBPDO.php';
require_once 'model/Usuario.php';
require_once 'model/UsuarioPDO.php';
require_once 'model/AppError.php';

$controlador = [
    "inicioPublico" => "controller/cInicioPublico.php",
    "login" => "controller/cLogin.php",
    "inicioPrivado" => "controller/cInicioPrivado.php",
    "detalle" => "controller/cDetalle.php",
    "registro" => "controller/cRegistro.php",
    "wip" => "controller/cWIP.php",
    "error" => "controller/cError.php",
    "rest" => "controller/cREST.php",
];

$vista = [
    "layout" => "view/layout.php",
    "inicioPublico" => "view/vInicioPublico.php",
    "login" => "view/vLogin.php",
    "inicioPrivado" => "view/vInicioPrivado.php",
    "detalle" => "view/vDetalle.php",
    "registro" => "view/vRegistro.php",
    "wip" => "view/vWIP.php",
    "error" => "view/vError.php",
    "rest" => "view/vREST.php",
];