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

// Si se ha pulsado el botón de volver, redirigimos a la página anterior
if(isset($_REQUEST['volver'])){
    $temp = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = $temp;
    header('Location: index.php');
    exit;
}

if ( isset($_REQUEST["buscar"]) && empty(validacionFormularios::comprobarAlfaNumerico($_REQUEST["buscar"], minTamanio:0, obligatorio:1)) ) {
    $aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDesc($_REQUEST["buscar"]);
    $buscado = $_REQUEST["buscar"];
} else {
    $aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDesc();
    $buscado = "";
}
$avMtoDep = [
    "departamentos" => $aDepartamentos,
    "buscado" => $buscado,
];

$titulo = "Mantenimiento Departamentos";

require_once $vista['layout'];