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
}
