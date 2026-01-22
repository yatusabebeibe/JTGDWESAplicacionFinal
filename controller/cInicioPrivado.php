<?php

/** @author Jesús Temprano Gallego
 *  @since 16/12/2025
 */

// Si no hay un usuario logueado, redirigimos al login
if (! isset($_SESSION["usuarioDAWJTGDAplicacionFinal"])) {
    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "login";

    // Redirigimos
    header("Location: index.php");
    exit;
}

// Si se ha pulsado el botón de logoff, cerramos la sesión y redirigimos al inicio público
if (isset($_REQUEST["logoff"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "inicioPublico";
    unset($_SESSION["usuarioDAWJTGDAplicacionFinal"]);

    // Redirigimos
    header("Location: index.php");
    exit;
}
// Detalle
if (isset($_REQUEST["detalle"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "detalle";

    // Redirigimos
    header("Location: index.php");
    exit;
}
// Mantenimiento de departamentos
if (isset($_REQUEST["departamentos"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "wip";

    // Redirigimos
    header("Location: index.php");
    exit;
}
// REST
if (isset($_REQUEST["REST"])) {

    $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
    $_SESSION["paginaEnCurso"] = "rest";

    // Redirigimos
    header("Location: index.php");
    exit;
}
// Forzamos un error para probar el manejo de errores
if (isset($_REQUEST["error"])) {
    try {
        DBPDO::ejecutarConsulta("SELECT * FROM xsghuh");
    } catch (PDOException $exception) {
        $_SESSION['error'] = new AppError(
            $exception->getCode(),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $_SESSION['paginaEnCurso']
        );
        $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
        $_SESSION["paginaEnCurso"] = "error";

        header("Location: index.php");
        exit;
    }
}

$titulo = "Inicio Privado";


// traducimos y preparamos los datos para la vista

// Obtenemos los datos del usuario logueado
$usuario = $_SESSION["usuarioDAWJTGDAplicacionFinal"];

$nombreUsuario = $usuario->getDescUsuario();
$numConexiones = $usuario->getNumAccesos();
$fechaUltConex = $usuario->getFechaHoraUltimaConexionAnterior() ?? null;

// Arrays de idiomas y traducciones
$idiomas = ['ES' => 'es_ES', 'EN' => 'en_US', 'JP' => 'ja_JP'];
$traducciones = [
    'ES' => [
        'saludo' => 'Bienvenido',
        'nConexiones' => 'Esta es la %ª vez que se conecta',
        'noConectado' => 'Usted no se había conectado antes',
        'fechaUltConex' => 'Usted se conectó por última vez el %',
        'timezone' => 'Europe/Madrid',
        'formatoFecha' => "d 'de' MMMM 'de' y 'a las' HH:mm"
    ],
    'EN' => [
        'saludo' => 'Welcome',
        'nConexiones' => 'This is your % time logging in',
        'noConectado' => "You haven't logged in before",
        'fechaUltConex' => 'Your last login was on %',
        'timezone' => 'Europe/London',
        'formatoFecha' => "MMMM d, y 'at' HH:mm"
    ],
    'JP' => [
        'saludo' => 'ようこそ',
        'nConexiones' => 'これは%回目のログインです',
        'noConectado' => '以前にログインしていません',
        'fechaUltConex' => '最後のログインは%です',
        'timezone' => 'Asia/Tokyo',
        'formatoFecha' => "y年M月d日 HH:mm"
    ]
];

// Si el idioma guardado en la cookie existe en el array $idiomas se usa; si no, se establece 'ES' como idioma por defecto
$idioma = isset($idiomas[$_COOKIE["idioma"]]) ? $_COOKIE["idioma"] : 'ES';
// Se obtiene el locale correspondiente al idioma ya validado
$locale = $idiomas[$idioma];

$formatter = new IntlDateFormatter(
    $locale,
    IntlDateFormatter::LONG,
    IntlDateFormatter::SHORT,
    $traducciones[$idioma]['timezone'],
    IntlDateFormatter::GREGORIAN,
    $traducciones[$idioma]['formatoFecha']
);

// Formateamos la fecha de la última conexión o mostramos el texto de no conectado anteriormente
$fechaUltConexTexto = $fechaUltConex
    ? str_replace('%', $formatter->format($fechaUltConex), $traducciones[$idioma]['fechaUltConex'])
    : $traducciones[$idioma]['noConectado'];

// Array para pasar a la vista
$avInicioPrivado = [
    'saludo' => "{$traducciones[$idioma]['saludo']} {$nombreUsuario}",
    'nConexiones' => str_replace('%', $numConexiones, $traducciones[$idioma]['nConexiones']),
    'fechaUltConex' => $fechaUltConexTexto
];

require_once $vista["layout"];
