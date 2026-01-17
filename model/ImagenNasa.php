<?php

class ImagenNasa {
    private $fecha;
    private $titulo;
    private $url;

    public function __construct($fecha, $titulo, $url) {
        $this->fecha = $fecha;
        $this->titulo = $titulo;
        $this->url = $url;
    }

    // getters
    public function getFecha() {
        return $this->fecha;
    }
    public function getTitulo() {
        return $this->titulo;
    }
    public function getUrl() {
        return $this->url;
    }
}
