<?php

/**
 * Clase que representa una calculadora.
 *
 * @author Jesús Temprano Gallego
 * @since 19/02/2025
 */
class Calculadora {
    public float $num1;
    public float $num2;
    public string $operacion;
    public ?float $resultado;
    private ?array $error;

    /**
     * Constructor de la clase
     *
     * @param float $num1 Primer número
     * @param float $num2 Segundo número
     * @param string $operacion Tipo de operación
     * @param float|null $resultado Resultado de la operación
     * @param int|null $code Código de error
     * @param string|null $msg Mensaje de error
     */
    public function __construct(float $num1, float $num2, string $operacion, ?float $resultado = null, ?int $code = null, ?string $msg = null) {
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->operacion = $operacion;
        $this->resultado = $resultado;
        $this->error = [
            "code" => $code,
            "msg" => $msg
        ];
    }

    public function getNum1(): float {
        return $this->num1;
    }

    public function getNum2(): float {
        return $this->num2;
    }

    public function getOperacion(): string {
        return $this->operacion;
    }

    public function getResultado(): ?float {
        return $this->resultado;
    }

    public function getError(): ?array {
        return $this->error;
    }
}