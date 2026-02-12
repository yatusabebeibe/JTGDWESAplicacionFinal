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
    $_SESSION["paginaEnCurso"] = "eliminarDpto";
    header('Location: index.php');
    exit;
}
// Si se ha pulsado el botón de crear un departamento
if(isset($_REQUEST['crear'])){
    $_SESSION["codDepActual"] = $_REQUEST['codDep'];
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "crearDpto";
    header('Location: index.php');
    exit;
}
// Si se ha pulsado el botón para dar de alta o baja un departamento
if (isset($_REQUEST["altabaja"])) {
    // Obtenemos el departamento
    $departamentoAB = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['codDep']);

    // Si tiene fecha de baja → se la quitamos
    // Si no tiene → se la ponemos a hoy
    if ($departamentoAB->getFechaBaja()) {
        $departamentoAB->setFechaBaja(null);
    } else {
        $departamentoAB->setFechaBaja(new DateTime());
    }

    // Actualizamos en BD
    DepartamentoPDO::editarDepartamento($departamentoAB);
}

// Recogemos inputs y valores de sesión
$estadoSeleccionado = $_REQUEST["estado"] ?? $_SESSION["mtoDep"]["estado"] ?? "alta";
$buscar = $_REQUEST["buscar"] ?? null;
$paginaSolicitada = isset($_REQUEST["pagina"]) && is_numeric($_REQUEST["pagina"])
    ? (int)$_REQUEST["pagina"]
    : ($_SESSION["mtoDep"]["nPagina"] ?? 1);

// Validamos el término de búsqueda: vacío o alfanumérico válido
$buscarValido = $buscar === "" || (!empty($buscar) && empty(
    validacionFormularios::comprobarAlfaNumerico($buscar, minTamanio:0, obligatorio:0)
));

// Comprobamos si cambió el término de búsqueda o el estado
$terminoHaCambiado = $buscarValido && $buscar !== ($_SESSION["mtoDep"]["terminoBusqueda"] ?? "");
$estadoHaCambiado = $estadoSeleccionado !== ($_SESSION["mtoDep"]["estado"] ?? "alta");

// Reiniciamos página si cambió búsqueda o estado
$paginaActual = ($terminoHaCambiado || $estadoHaCambiado) ? 1 : $paginaSolicitada;

// Calculamos total de páginas y ajustamos la página actual
$totalPaginas = DepartamentoPDO::contarTotalPaginas($estadoSeleccionado);

// Guardamos estado y página en sesión
$_SESSION["mtoDep"]["estado"] = $estadoSeleccionado;
$_SESSION["mtoDep"]["nPagina"] = max(1, min($paginaActual, $totalPaginas));

// Determinamos el término de búsqueda final
$terminoABuscar = $buscarValido ? $buscar : ($_SESSION["mtoDep"]["terminoBusqueda"] ?? "");

// Consultamos los departamentos según término y estado
if ($terminoABuscar !== "") {
    $aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDescPaginado($terminoABuscar, $estadoSeleccionado, $_SESSION["mtoDep"]["nPagina"]);
    $_SESSION["mtoDep"]["terminoBusqueda"] = $terminoABuscar;
} else {
    $aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDescPaginado(estado: $estadoSeleccionado, numeroPagina: $_SESSION["mtoDep"]["nPagina"]);
    $_SESSION["mtoDep"]["terminoBusqueda"] = "";
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
    "buscado" => $_SESSION["mtoDep"]["terminoBusqueda"],
    "estado" => $_SESSION["mtoDep"]["estado"],
    "totalPaginas" => $totalPaginas,
    "paginaActual" => $_SESSION["mtoDep"]["nPagina"],
];

$titulo = "Mantenimiento Departamentos";

require_once $vista['layout'];