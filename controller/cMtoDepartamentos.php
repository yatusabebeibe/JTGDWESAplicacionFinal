<?php

/**
 * @author Jesús Temprano Gallego
 * @since 23/01/2026
 */

// Si no hay un usuario logueado, redirigimos al login
if (! isset($_SESSION["usuarioDAWJTGDAplicacionFinal"])) {
    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si pulsamos cerrar sesion, cerramos la sesion y volvemos a inicio publico
if (isset($_REQUEST["logoff"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "inicioPublico";
    unset($_SESSION["usuarioDAWJTGDAplicacionFinal"]);

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si se ha pulsado el botón de volver, redirigimos a la página anterior
if(isset($_REQUEST['volver'])){
    $temp = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = $temp;
    header('Location: index.php');
    exit;
}

if ( (isset($_REQUEST["buscar"]) && empty(validacionFormularios::comprobarAlfaNumerico($_REQUEST["buscar"], minTamanio:0, obligatorio:1))) || !empty($_SESSION["mtoDep"]) ) {
    $aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDesc($_REQUEST["buscar"] ?? $_SESSION["mtoDep"]);
    $_SESSION["mtoDep"] = $_REQUEST["buscar"] ?? $_SESSION["mtoDep"];
} else {
    $aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDesc();
    $_SESSION["mtoDep"] = "";
}
$avMtoDep = [
    "departamentos" => $aDepartamentos,
    "buscado" => $_SESSION["mtoDep"],
];

$titulo = "Mantenimiento Departamentos";

require_once $vista['layout'];