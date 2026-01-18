<?php

class REST {
    private const NASA_KEY = '779UxkhQlroYxeSVtJe5YN16lYt0EYrLi6Y8Chhf';


    public static function getFotoDiaNasa($fecha) {
        $curl = curl_init("https://api.nasa.gov/planetary/apod?date=$fecha&api_key=".self::NASA_KEY);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $respuesta = curl_exec($curl);
        $datos = json_decode($respuesta, true);

        if (isset($datos["code"]) && ($datos["code"] == "404" || $datos["code"] == "400")) {
            // Si la fecha actual no tiene foto, devolvemos la del día anterior (si acaba de cambiar de día puede que aún no esté disponible)
            return self::getFotoDiaNasa(date('Y-m-d', strtotime($fecha . ' -1 day'))); // Llamada recursiva
        }

        return new ImagenNasa(
            $datos['date'],
            $datos['title'],
            $datos['hdurl'] ?? $datos['url']
        );
    }
}
