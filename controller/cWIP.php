<?php

/**
 * @author Jesús Temprano Gallego
 * @since 15/01/2026
 */

// Si se ha pulsado el botón de volver, redirigimos a la página anterior
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    header('Location: index.php');
    exit;
}

$titulo = "Work In Progress";

require_once $vista['layout'];