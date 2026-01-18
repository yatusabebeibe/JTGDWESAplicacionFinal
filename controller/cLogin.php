<?php

/** @author Jesús Temprano Gallego
 *  @since 16/12/2025
 */

require_once __DIR__ . '/../model/UsuarioPDO.php';

// Si se ha pulsado el botón de cancelar, redirigimos al inicio público
if (isset($_REQUEST["cancelar"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "inicioPublico";

    // Redirigimos
    header("Location: index.php");
    exit;
}
// Registro
if (isset($_REQUEST["register"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "registro";

    // Redirigimos
    header("Location: index.php");
    exit;
}

$encontrado = false; // Variable que indicará si se ha encontrado el usuario
$aRespuestas = ["usuario"=>"","contraseña"=>""]; // Array para almacenar los datos del usuario
$aErrores = ["login"=>""]; // Array para almacenar el mensaje errores en el login

// Si se ha pulsado el botón de entrar, validamos el usuario
if (isset($_REQUEST["entrar"])) {

    $aRespuestas["usuario"] = $_REQUEST["usuario"];
    $aRespuestas["contraseña"] = $_REQUEST["contraseña"];

    $usuario = UsuarioPDO::validarUsuario($aRespuestas["usuario"],$aRespuestas["contraseña"]);

    // Si el usuario es correcto, lo almacenamos en la sesión y redirigimos al inicio privado
    if ($usuario) {
        $_SESSION["usuarioDAWJTGProyectoLoginLogoff"] = $usuario;
        UsuarioPDO::actualizarUltimaConexion($usuario->getCodUsuario(), new DateTime());
        $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
        $_SESSION["paginaEnCurso"] = "inicioPrivado";

        // Redirigimos
        header("Location: index.php");
        exit;
    }
}

$titulo = "Login";

require_once $vista["layout"];