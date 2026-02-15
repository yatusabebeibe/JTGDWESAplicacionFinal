<?php

/** @author Jesús Temprano Gallego
 *  @since 12/02/2026
 */


$num1 = isset($_GET['num1']) ? (float)$_GET['num1'] : null;
$num2 = isset($_GET['num2']) ? (float)$_GET['num2'] : null;
$operacion = $_GET['operacion'] ?? null;

header('Content-Type: application/json');

if ($num1 === null || $num2 === null || !$operacion) {
    echo json_encode(['error' => 'Faltan parámetros']);
    exit;
}
try {
    $resultado = match($operacion) {
        'suma' => $num1 + $num2,
        'resta' => $num1 - $num2,
        'multiplicacion' => $num1 * $num2,
        'division' => $num2 != 0 ? $num1 / $num2 : throw new Exception('No se puede dividir entre 0'),
        default => throw new Exception('Operación no válida'),
    };

    echo json_encode(['resultado' => $resultado]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
