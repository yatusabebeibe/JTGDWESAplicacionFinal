<?php

/**
 * @author Jesús Temprano Gallego
 * @since 23/01/2026
 */

// Si no hay un usuario logueado, redirigimos al login
if (! isset($_SESSION["usuarioDAWJTGDAplicacionFinal"])) {
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si se ha pulsado el botón de editar un departamento
if(isset($_REQUEST['editar'])){
    $_SESSION["codDepActual"] = $_REQUEST['codDep'];
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "modificarDpto";
    header('Location: index.php');
    exit;
}
// Si se ha pulsado el botón de ver un departamento
if(isset($_REQUEST['ver'])){
    $_SESSION["codDepActual"] = $_REQUEST['codDep'];
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "verDpto";
    header('Location: index.php');
    exit;
}
// Si se ha pulsado el botón de borrar un departamento
if(isset($_REQUEST['borrar'])){
    $_SESSION["codDepActual"] = $_REQUEST['codDep'];
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "wip";
    header('Location: index.php');
    exit;
}


$buscar = $_REQUEST["buscar"] ?? null; // evita warning si no existe
$buscarValido = $buscar === "" || ( !empty($buscar) && empty(validacionFormularios::comprobarAlfaNumerico($buscar, minTamanio:0, obligatorio:0)) );

if ($buscarValido || !empty($_SESSION["mtoDep"])) {
    $terminoABuscar = $buscarValido ? $buscar : $_SESSION["mtoDep"];
    $aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDesc($terminoABuscar);
    $_SESSION["mtoDep"] = $terminoABuscar;
} else {
    // No hay búsqueda ni sesión, mostramos todos
    $aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDesc();
    $_SESSION["mtoDep"] = "";
}

$aDatosDepartamentos = [];
foreach ($aDepartamentos as $departamento) {
    $aDatosDepartamentos[] = [
        "codigo" => $departamento->getCodigo(),
        "descripcion" => $departamento->getDesc(),
        "fechaCreacion" => $departamento->getFechaCreacion()->format("d-m-Y"),
        "volumenDeNegocio" => $departamento->getVolumenDeNegocio(),
        "fechaBaja" => $departamento->getFechaBaja() ? $departamento->getFechaBaja()->format("d-m-Y") : null,
    ];
}


$avMtoDep = [
    "departamentos" => $aDatosDepartamentos,
    "buscado" => $_SESSION["mtoDep"],
];

$titulo = "Mantenimiento Departamentos";

require_once $vista['layout'];