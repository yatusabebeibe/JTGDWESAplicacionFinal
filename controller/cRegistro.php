<?php

/** @author Jesús Temprano Gallego
 *  @since 16/12/2025
 */

// Comprobamos si se ha pulsado el botón 'cancelar'
if (isset($_REQUEST["cancelar"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "inicioPublico";

    // Redirigimos
    header("Location: index.php");
    exit;
}
// Login
if (isset($_REQUEST["login"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}

$sErrorRegistro = "";

// Si se ha pulsado el botón de aceptar, validamos el formulario
if (isset($_REQUEST["aceptar"])) {

    $sErrorRegistro =  validacionFormularios::comprobarAlfaNumerico($_REQUEST["usuario"], 10, 4, 1);
    $sErrorRegistro .= validacionFormularios::comprobarAlfaNumerico($_REQUEST["nombre"], 255, 4, 1);
    $sErrorRegistro .= validacionFormularios::comprobarAlfaNumerico($_REQUEST["contraseña1"], 16, 4, 1);
    $sErrorRegistro .= validacionFormularios::comprobarAlfaNumerico($_REQUEST["contraseña2"], 16, 4, 1);
    $sErrorRegistro .= validacionFormularios::comprobarAlfaNumerico($_REQUEST["resPregSeg"], 25, 1, 1);

    // Si no hay errores, procesamos el formulario
    if (empty($sErrorRegistro) && $_REQUEST["resPregSeg"] == preguntaSeguridad) {

        // Comprobamos si las contraseñas coinciden
        if ($_REQUEST["contraseña1"] === $_REQUEST["contraseña2"]) {
            // Si el alta es correcta, redirigimos al inicio público
            if (UsuarioPDO::altaUsuario($_REQUEST["usuario"], $_REQUEST["nombre"], $_REQUEST["contraseña1"])) {
                $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
                $_SESSION["paginaEnCurso"] = "inicioPrivado";
                $_SESSION["usuarioDAWJTGDAplicacionFinal"] = UsuarioPDO::validarUsuario($_REQUEST["usuario"], $_REQUEST["contraseña1"]);
                UsuarioPDO::actualizarUltimaConexion($_REQUEST["usuario"], new DateTime());

                // Redirigimos
                header("Location: index.php");
                exit;
            } else {
                $sErrorRegistro = "El usuario ya existe.";
            }
        } else {
            $sErrorRegistro = "Las contraseñas no coinciden.";
        }
    }
}

$titulo = "Registro";


require_once $vista["layout"];