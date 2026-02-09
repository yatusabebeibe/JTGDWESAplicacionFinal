<?php

/**
 * Clase que representa un juego de Steam.
 * Contiene el termino de budqueda, el nombre, el logo, o información de error si tiene.
 *
 * @author Jesús Temprano Gallego
 * @since 09/02/2026
 */
class JuegoSteam {
    private string $terminoBusqueda;
    private ?string $nombre;
    private ?string $logo;
    private ?array $error;

    /**
     * Constructor de la clase JuegoSteam.
     *
     * @param string|null $terminoBusqueda Termino de budqueda para el juego.
     * @param string|null $nombre Nombre del juego.
     * @param string|null $logo URL o ruta del logo del juego.
     * @param int|null $code Código de error si existe.
     * @param string|null $msg Mensaje de error si existe.
     */
    public function __construct(string $terminoBusqueda, ?string $nombre = null, ?string $logo = null, ?int $code = null, ?string $msg = null) {
        $this->terminoBusqueda = $terminoBusqueda;
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->error = [
            "code" => $code,
            "msg" => $msg
        ];
    }

    /**
     * Obtiene el termino de budqueda para el juego.
     *
     * @return string Termino de budqueda para el juego.
     */
    public function getTerminoBusqueda(): string {
        return $this->terminoBusqueda;
    }

    /**
     * Obtiene el nombre del juego.
     *
     * @return string|null Nombre del juego.
     */
    public function getNombre(): ?string {
        return $this->nombre;
    }

    /**
     * Obtiene la URL o ruta del logo del juego.
     *
     * @return string|null Logo del juego.
     */
    public function getLogo(): ?string {
        return $this->logo;
    }

    /**
     * Obtiene la información de error asociada al juego.
     *
     * @return array Array con las claves "code" y "msg".
     */
    public function getError(): ?array {
        return $this->error;
    }
}
