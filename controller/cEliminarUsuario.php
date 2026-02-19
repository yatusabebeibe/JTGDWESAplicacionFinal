<?php

/**
 * @author Jesús Temprano Gallego
 * @since 11/02/2026
 */

// Si no hay un usuario logueado, redirigimos al login
if (! isset($_SESSION["usuarioDAWJTGDAplicacionFinal"])) {
    $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si no encuentra el usuario hacemos que vuelva a la pagina anterior
if (! $usuarioActual = UsuarioPDO::buscarUsuarioPorCodigo($_SESSION["codUsuarioActual"])) {
    var_dump($_SESSION);
    header("Location: index.php?volver=1");
    exit;
}

// Comprobamos si se ha pulsado el botón de guardar y validamos los datos recibidos
$error = "";
if (isset($_REQUEST["eliminar"])) {

    // Comprobamos que el usuario no es el que esta ahoramismo logueado
    if ($usuarioActual->getCodigo() == $_SESSION["usuarioDAWJTGDAplicacionFinal"]->getCodigo()) {
        $error = "No se puede eliminar el usuario logueado en sesion";
    }
    // Intentamos eliminar el usuario en la base de datos y redirigimos si tiene éxito
    else if (UsuarioPDO::eliminarUsuario($usuarioActual->getCodigo())) {
        header("Location: index.php?volver=1");
        exit;
    }
    else $error = "Hubo un problema al eliminar el usuario";
}

$avEliminarUsuario = [
    "codigo" => $usuarioActual->getCodigo(),
    "descripcion" => $usuarioActual->getDesc(),
    "numAccesos" => $usuarioActual->getNumAccesos(),
    "perfil" => $usuarioActual->getPerfil(),
    "ultimaConexion" => $usuarioActual->getFechaHoraUltimaConexion()
        ? $usuarioActual->getFechaHoraUltimaConexion()->format("d-m-Y, h:i:s")
        : "Sin conexion anterior",
    "error" => $error,
];

$titulo = "Consultar Usuario " .$usuarioActual->getCodigo();

require_once $vista['layout'];