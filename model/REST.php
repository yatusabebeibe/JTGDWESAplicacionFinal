<?php

class REST {
    private const NASA_KEY = '779UxkhQlroYxeSVtJe5YN16lYt0EYrLi6Y8Chhf';


    public static function getFotoDiaNasa($fecha) {
        $curl = curl_init("https://api.nasa.gov/planetary/apod?date=$fecha&api_key=".self::NASA_KEY);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $respuesta = curl_exec($curl);
        $datos = json_decode($respuesta, true);

        return new ImagenNasa(
            $datos['date'],
            $datos['title'],
            $datos['hdurl'] ?? $datos['url']
        );
    }
}
