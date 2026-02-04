<?php

/**
 * @author Jesús Temprano Gallego
 * @since 04/02/2026
 */

// Si no hay un usuario logueado, redirigimos al login
if (! isset($_SESSION["usuarioDAWJTGDAplicacionFinal"])) {
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si no encuentra el departamento hacemos que vuelva a la pagina anterior
if (! $departamentoActual = DepartamentoPDO::buscaDepartamentoPorCod($_SESSION["codDepActual"])) {
    header("Location: index.php?volver=1");
    exit;
}

// Comprobamos si se ha pulsado el botón de guardar y validamos los datos recibidos
$error = "";
if (isset($_REQUEST["eliminar"])) {

    // Intentamos eliminar el departamento en la base de datos y redirigimos si tiene éxito
    if (DepartamentoPDO::eliminarDepartamento($departamentoActual->getCodigo())) {
        header("Location: index.php?volver=1");
        exit;
    }
    $error = "Hubo un problema al eliminar el departamento";
}

$avEditDep = [
    "codigo" => $departamentoActual->getCodigo(),
    "descripcion" => $departamentoActual->getDesc(),
    "fechaCreacion" => $departamentoActual->getFechaCreacion()->format("d-m-Y"),
    "volumenNegocio" => $departamentoActual->getVolumenDeNegocio(),
    "fechaBaja" => $departamentoActual->getFechaBaja() ? $departamentoActual->getFechaBaja()->format("d-m-Y") : null,
    "error" => $error,
];

$titulo = "Editar Departamento " .$departamentoActual->getCodigo();

require_once $vista['layout'];