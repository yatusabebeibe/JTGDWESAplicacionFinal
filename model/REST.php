<?php

/**
 * Encargada de realizar peticiones a APIs REST externas.
 *
 * @author Jesus Temprano Gallego
 * @since 23/01/2026
 */
class REST {
    // La clave de API de la NASA para acceder a la API esta en el archivo configAPP.php

    /**
     * Obtiene la foto del día de la NASA (APOD) para una fecha concreta.
     *
     * Realiza una petición a la API de la NASA y devuelve un objeto ImagenNasa
     * con los datos de la imagen o con la información del error si ocurre.
     *
     * @param string $fecha Fecha en formato YYYY-MM-DD
     * @param int $numIntentos Número de intentos de la petición
     * @return ImagenNasa Objeto con la imagen o el error producido
     */
    public static function getFotoDiaNasa(string $fecha, int $numIntentos = 0) {
        // Inicializamos una sesión cURL con la URL de la API de NASA, incluyendo la fecha y la clave de API.
        $curl = curl_init("https://api.nasa.gov/planetary/apod?date=$fecha&api_key=".NASA_KEY);

        // Configuramos cURL para que devuelva la respuesta como una cadena porque por defecto cURL imprime la respuesta directamente.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $respuesta = curl_exec($curl); // Ejecutamos la solicitud cURL y obtenemos la respuesta.
        $datos = json_decode($respuesta, true); // Decodificamos la respuesta JSON en un array asociativo.

        // comprobamos si ha habido un error en la solicitud cURL
        if (curl_errno($curl)) {
            return new ImagenNasa(
                fecha: $fecha,
                code: curl_errno($curl), // esta función devuelve el código de error de la solicitud cURL
                msg: curl_error($curl) // esta función devuelve una descripción del error de la solicitud cURL
            );
        }

        // comprobamos si la respuesta contiene un error
        // Si la respuesta contiene un error genérico, lo asignamos a $datos para manejarlo en el mismo if abajo
        if (isset($datos["error"])) { $datos = $datos["error"]; }

        if (isset($datos["code"])) {
            // Si hay un error guardamos el mensaje del error
            return new ImagenNasa(
                fecha: $fecha,
                code: $datos['code'],
                msg: $datos['msg'] || $datos['message']
            );
        }

        return new ImagenNasa( // Si no hay errores, devolvemos la imagen con los datos obtenidos
            fecha: $datos['date'],
            titulo: $datos['title'],
            url: $datos['url'] ?? "",
            hdurl: $datos['hdurl'] ?? null,
            explicacion: $datos['explanation'] ?? "",
            copyright: $datos['copyright'] ?? "N/A"
        );
    }

    /**
     * Obtiene información de un juego de Steam por su nombre.
     *
     * Realiza una petición a la API de búsqueda de Steam y devuelve un objeto JuegoSteam
     * con los datos del juego o con la información del error si ocurre.
     *
     * @param string $nombreJuego Nombre del juego a buscar.
     * @return JuegoSteam Objeto con los datos del juego o con el error producido.
     */
    public static function getJuegoSteam(string $nombreJuego = ""): JuegoSteam {
        // Inicializamos una sesión cURL con la URL de búsqueda de Steam
        $curl = curl_init("https://store.steampowered.com/search/results?json=1&term=" . urlencode($nombreJuego));

        // Configuramos cURL para que devuelva la respuesta como cadena
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $respuesta = curl_exec($curl); // Ejecutamos la solicitud cURL
        $errorCode = curl_errno($curl); // Código de error cURL
        $errorMsg = curl_error($curl);  // Mensaje de error cURL

        // Si hay error en la solicitud cURL, devolvemos un objeto con el error
        if ($errorCode) {
            return new JuegoSteam($nombreJuego, code: $errorCode, msg: $errorMsg);
        }

        $datos = json_decode($respuesta, true); // Decodificamos la respuesta JSON

        // Comprobamos si la respuesta tiene algún error
        if (!isset($datos['items']) || count($datos['items']) === 0) {
            return new JuegoSteam($nombreJuego, code: 404, msg: "Juego no encontrado");
        }

        // Tomamos el primer resultado como ejemplo
        $primerJuego = $datos['items'][0];

        $nombre = $primerJuego['name'] ?? null;
        $logo = $primerJuego['logo'] ?? null;

        return new JuegoSteam($nombreJuego, $nombre, $logo);
    }

    /**
     * Realiza una operación de calculadora mediante el web service.
     *
     * @param float $num1 Primer número
     * @param float $num2 Segundo número
     * @param string $operacion Operación a realizar: suma, resta, multiplica, divide
     * @return Calculadora Objeto con el resultado o error
     */
    public static function calculadora(float $num1, float $num2, string $operacion): Calculadora {
        $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $dominio   = $_SERVER['HTTP_HOST'];

        // carpeta raiz del proyecto (ej: /JTGDWESAplicacionFinal)
        $carpetaProyecto = dirname($_SERVER['SCRIPT_NAME']);
        $carpetaProyecto = str_replace('\\', '/', $carpetaProyecto);
        $carpetaProyecto = $carpetaProyecto === '/' ? '' : $carpetaProyecto;

        $url = "$protocolo://$dominio$carpetaProyecto/api/wsCalculadora.php?num1=$num1&num2=$num2&operacion=$operacion";
        $_SESSION["logUlr"] = $url;

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $respuesta = curl_exec($curl);
        $errorCode = curl_errno($curl);
        $errorMsg = curl_error($curl);

        if ($errorCode) {
            return new Calculadora($num1, $num2, $operacion, null, $errorCode, $errorMsg);
        }

        $datos = json_decode($respuesta, true);

        if (isset($datos['error'])) {
            return new Calculadora($num1, $num2, $operacion, null, 1, $datos['error']);
        }

        return new Calculadora($num1, $num2, $operacion, $datos['resultado']);
    }
}
