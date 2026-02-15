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

// Comprobamos si se ha pulsado el botón de crear y validamos los datos recibidos
$error = "";
if (isset($_REQUEST["crearDep"])) {
    $error = "Codigo: ". $_REQUEST["codigo"] !== strtoupper($_REQUEST["codigo"]) ? "El codigo tiene que estar en mayusculas" : $error;
    $error = "Codigo: ". validacionFormularios::comprobarAlfabetico($_REQUEST["codigo"],3,3,1) ?? $error;
    $error = "Descripcion: ". validacionFormularios::comprobarAlfaNumerico($_REQUEST["desc"],255,3,1) ?? $error;
    $error = "VolNegocio: ". validacionFormularios::comprobarFloat($_REQUEST["volumenNegocio"],obligatorio:1, max: 999999, min:0) ?? $error;

    if (empty($error)) {
        $departamento = new Departamento(
            $_REQUEST["codigo"],
            $_REQUEST["desc"],
            new DateTime(),
            $_REQUEST["volumenNegocio"]
        );

        // Intentamos actualizar el departamento en la base de datos y redirigimos si tiene éxito
        if (DepartamentoPDO::crearDepartamento($departamento)) {
            header("Location: index.php?volver=1");
            exit;
        }
        $error = "No se pudo crear el departamento";
    }
}

$avEditDep = [
    "codigo" => $_REQUEST["codigo"] ?? null,
    "descripcion" => $_REQUEST["desc"] ?? null,
    "volumenNegocio" => $_REQUEST["volumenNegocio"] ?? null,
    "error" => $error,
];

$titulo = "Crear Departamento";

require_once $vista['layout'];