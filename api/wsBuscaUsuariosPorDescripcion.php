<?php

/** @author Jesús Temprano Gallego
 *  @since 05/02/2026
 */

require_once '../core/231018libreriaValidacion.php';
require_once "../config/confDB.php";
require_once '../model/DBPDO.php';
require_once '../model/Usuario.php';
require_once '../model/UsuarioPDO.php';

// Recogemos la descripción a buscar
$buscar = $_REQUEST["desc"] ?? "";

// Validamos la descripción: alfanumérico, max 50, min 0, no obligatorio
$error = validacionFormularios::comprobarAlfaNumerico($buscar, 255, 0, 0);

// Si hay error, devolvemos JSON vacío y salimos
if ($error !== null) {
    header('Content-Type: application/json');
    echo json_encode([
        "error" => $error,
    ]);
    exit;
}

// Buscamos los usuarios
$usuarios = UsuarioPDO::buscarUsuariosPorDescripcion($buscar);

// Convertimos los objetos Usuario a arrays
$resultado = [];
foreach ($usuarios as $usuario) {
    $resultado[] = [
        "codigo" => $usuario->getCodUsuario(),
        "descripcion" => $usuario->getDescUsuario(),
        "numConexiones" => $usuario->getNumAccesos(),
        "ultimaConexion" => $usuario->getFechaHoraUltimaConexion() ? $usuario->getFechaHoraUltimaConexion()->format("d-m-Y H:i:s") : null,
        "perfil" => $usuario->getPerfil()
    ];
}

// Indicamos que es JSON
header('Content-Type: application/json');
echo json_encode($resultado);
