<?php

/**
 * Clase que representa una imagen de la NASA obtenida a través de su API.
 *
 * @author Jesús Temprano Gallego
 * @since 21/01/2026
 */
class ImagenNasa {
    private $fecha;
    private $titulo;
    private $url;
    private $hdurl;
    private $explicacion;
    private $copyright;
    private $error;

    /** Constructor de la clase ImagenNasa.
     *
     * @param string $fecha La fecha de la imagen.
     * @param string|null $titulo El título de la imagen.
     * @param string|null $url La URL de la imagen.
     * @param string|null $hdurl La URL de la imagen en alta definición.
     * @param string|null $explicacion La explicación de la imagen.
     * @param string|null $copyright El copyright de la imagen.
     * @param int|null $code El código de error si existe.
     * @param string|null $msg El mensaje de error si existe.
     */
    public function __construct($fecha, $titulo = null, $url = null, $hdurl = null, $explicacion = null, $copyright = null, $code = null, $msg = null) {
        $this->fecha = $fecha;
        $this->titulo = $titulo;
        $this->url = $url;
        $this->hdurl = $hdurl;
        $this->explicacion = $explicacion;
        $this->copyright = $copyright;
        $this->error = [
            "code" => $code,
            "msg" => $msg
        ];
    }

    /** Obtiene la fecha de la imagen.
     *
     * @return string La fecha de la imagen.
     */
    public function getFecha() {
        return $this->fecha;
    }

    /** Obtiene el título de la imagen.
     *
     * @return string|null El título de la imagen.
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /** Obtiene la URL de la imagen.
     *
     * @return string|null La URL de la imagen.
     */
    public function getUrl() {
        return $this->url;
    }

    /** Obtiene la URL de la imagen en alta definición.
     *
     * @return string|null La URL de la imagen en alta definición.
     */
    public function getHdurl() {
        return $this->hdurl;
    }

    /** Obtiene la explicación de la imagen.
     *
     * @return string|null La explicación de la imagen.
     */
    public function getExplicacion() {
        return $this->explicacion;
    }

    /** Obtiene el copyright de la imagen.
     *
     * @return string|null El copyright de la imagen.
     */
    public function getCopyright() {
        return $this->copyright;
    }

    /** Obtiene el error asociado a la imagen.
     *
     * @return array El array con el código y mensaje de error.
     */
    public function getError() {
        return $this->error;
    }
}
