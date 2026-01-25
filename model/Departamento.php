<?php

/**
 * Representa un departamento con su código, descripción, fecha de creación,
 * volumen de negocio y fecha de baja opcional.
 *
 * @author Jesus Temprano Gallego
 * @since 23/01/2026
 */
class Departamento {
    private string $codigo;
    private string $desc;
    private DateTime $fechaCreacion;
    private float $volumenDeNegocio;
    private ?DateTime $fechaBaja;

    public function __construct(
        string $codigo,
        string $desc,
        DateTime $fechaCreacion,
        float $volumenDeNegocio,
        ?DateTime $fechaBaja = null
    ) {
        $this->codigo = $codigo;
        $this->desc = $desc;
        $this->fechaCreacion = $fechaCreacion;
        $this->volumenDeNegocio = $volumenDeNegocio;
        $this->fechaBaja = $fechaBaja;
    }

    // CODIGO
    public function getCodigo(): string {
        return $this->codigo;
    }

    // DESC
    public function getDesc(): string {
        return $this->desc;
    }
    public function setDesc(string $desc): void {
        $this->desc = $desc;
    }

    // FECHA CREACION
    public function getFechaCreacion(): DateTime {
        return $this->fechaCreacion;
    }
    public function setFechaCreacion(DateTime $fechaCreacion): void {
        $this->fechaCreacion = $fechaCreacion;
    }

    // VOLUMEN DE NEGOCIO
    public function getVolumenDeNegocio(): float {
        return $this->volumenDeNegocio;
    }
    public function setVolumenDeNegocio(float $volumenDeNegocio): void {
        $this->volumenDeNegocio = $volumenDeNegocio;
    }

    // FECHA BAJA
    public function getFechaBaja(): ?DateTime {
        return $this->fechaBaja;
    }
    public function setFechaBaja(?DateTime $fechaBaja): void {
        $this->fechaBaja = $fechaBaja;
    }
}