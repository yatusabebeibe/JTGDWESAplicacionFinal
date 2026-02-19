<?php

/**
 * Clase que representa un error en la aplicación.
 *
 * @author Jesús Temprano Gallego
 * @since 14/01/2025
 */
class AppError {
    private string $codError;
    private string $descError;
    private string $archivoError;
    private int $lineaError;
    private string $paginaSiguiente;

    /**
     * Constructor de la clase AppError.
     *
     * @param string $codError Código del error.
     * @param string $descError Descripción del error.
     * @param string $archivoError Archivo donde ocurrió el error.
     * @param int $lineaError Línea donde ocurrió el error.
     * @param string $paginaSiguiente Página a la que se redirige después del error.
     */
    public function __construct(string $codError, string $descError, string $archivoError, int $lineaError, string $paginaSiguiente) {
        $this->codError = $codError;
        $this->descError = $descError;
        $this->archivoError = $archivoError;
        $this->lineaError = $lineaError;
        $this->paginaSiguiente = $paginaSiguiente;
    }

    /** Obtiene el código del error.
     *
     * @return string El código del error.
     */
    public function getCodError(): string {
        return $this->codError;
    }

    /** Obtiene la descripción del error.
     *
     * @return string La descripción del error.
     */
    public function getDescError(): string {
        return $this->descError;
    }

    /** Obtiene el archivo donde ocurrió el error.
     *
     * @return string El archivo donde ocurrió el error.
     */
    public function getArchivoError(): string {
        return $this->archivoError;
    }

    /** Obtiene la línea donde ocurrió el error.
     *
     * @return int La línea donde ocurrió el error.
     */
    public function getLineaError(): int {
        return $this->lineaError;
    }

    /** Obtiene la página a la que se redirige después del error.
     *
     * @return string La página a la que se redirige después del error.
     */
    public function getPaginaSiguiente(): string {
        return $this->paginaSiguiente;
    }
}
