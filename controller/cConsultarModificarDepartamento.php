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

// Si no encuentra el departamento hacemos que vuelva a la pagina anterior
if (! $departamentoActual = DepartamentoPDO::buscaDepartamentoPorCod($_SESSION["codDepActual"])) {
    header("Location: index.php?volver=1");
    exit;
}

// Comprobamos si se ha pulsado el botón de guardar y validamos los datos recibidos
$error = "";
if (isset($_REQUEST["guardarDep"])) {
    $error = "Descripcion: ". validacionFormularios::comprobarAlfaNumerico($_REQUEST["desc"],255,3,1);
    $error = "VolNegocio: ". validacionFormularios::comprobarFloat($_REQUEST["volumenNegocio"],obligatorio:1, max: 999999, min:0) ?? $error;

    if (empty($error)) {
        $departamento = $departamentoActual;
        $departamento->setDesc($_REQUEST["desc"]);
        $departamento->setVolumenDeNegocio($_REQUEST["volumenNegocio"]);

        // Intentamos actualizar el departamento en la base de datos y redirigimos si tiene éxito
        if (DepartamentoPDO::editarDepartamento($departamento)) {
            header("Location: index.php");
            exit;
        }
        $error = "No se pudo editar el departamento";
    }
}

$avEditDep = [
    "codigo" => $departamentoActual->getCodigo(),
    "descripcion" => $departamentoActual->getDesc(),
    "fechaCreacion" => $departamentoActual->getFechaCreacion()->format("d-m-Y"),
    "volumenNegocio" => $departamentoActual->getVolumenDeNegocio(),
    "fechaBaja" => $departamentoActual->getFechaBaja() ? $departamentoActual->getFechaBaja()->format("d-m-Y") : null,
    "error" => $error,
    "editable" => $_SESSION["paginaEnCurso"] == "modificarDpto" ? true : false,
];

$titulo = ($avEditDep["editable"] ? "Editar" : "Consultar") . " Departamento " .$departamentoActual->getCodigo();

require_once $vista['layout'];