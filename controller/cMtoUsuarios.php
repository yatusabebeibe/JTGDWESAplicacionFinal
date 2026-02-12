<?php

/** @author Jesús Temprano Gallego
 *  @since 05/02/2025
 */

// Si no hay un usuario logueado, redirigimos al login
if (! isset($_SESSION["usuarioDAWJTGDAplicacionFinal"])) {
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si se ha pulsado el botón de ver un departamento
if(isset($_REQUEST['ver'])){
    $_SESSION["codUsuarioActual"] = $_REQUEST['codUsuario'];
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "verUsuario";
    header('Location: index.php');
    exit;
}
// Si se ha pulsado el botón de borrar un departamento
if(isset($_REQUEST['borrar'])){
    $_SESSION["codUsuarioActual"] = $_REQUEST['codUsuario'];
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "eliminarUsuario";
    header('Location: index.php');
    exit;
}

// Si no hay un usuario logueado, redirigimos al login
if (! isset($_SESSION["usuarioDAWJTGDAplicacionFinal"])) {
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";
    header("Location: index.php");
    exit;
}

$titulo = "Mantenimiento Usuarios";

require_once $vista['layout'];
