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

// Si no encuentra el usuario hacemos que vuelva a la pagina anterior
if (! $usuarioActual = UsuarioPDO::buscarUsuarioPorCodigo($_SESSION["codUsuarioActual"])) {
    var_dump($_SESSION);
    header("Location: index.php?volver=1");
    exit;
}

$avConsultarUsuario = [
    "codigo" => $usuarioActual->getCodigo(),
    "descripcion" => $usuarioActual->getDesc(),
    "numAccesos" => $usuarioActual->getNumAccesos(),
    "perfil" => $usuarioActual->getPerfil(),
    "ultimaConexion" => $usuarioActual->getFechaHoraUltimaConexion()->format("d-m-Y, h:m:s"),
];

$titulo = "Consultar Usuario " .$usuarioActual->getCodigo();

require_once $vista['layout'];