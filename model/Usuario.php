<?php

/**
 * @author Jesús Temprano Gallego
 * @since 18/12/2025
 *
 * Clase que representa un usuario del sistema.
 */
class Usuario {
    private string $codUsuario;
    private string $password;
    private string $descUsuario;
    private int $numAccesos;
    private DateTime $fechaHoraUltimaConexion;
    private ?DateTime $fechaHoraUltimaConexionAnterior;
    private string $perfil;

    /**
     * Constructor de la clase Usuario.
     *
     * @param string $codUsuario
     * @param string $password
     * @param string $descUsuario
     * @param int $numAccesos
     * @param DateTime $fechaHoraUltimaConexion
     * @param ?DateTime $fechaHoraUltimaConexionAnterior
     * @param string $perfil
     */
    public function __construct(
        string $codUsuario,
        string $password,
        string $descUsuario,
        int $numAccesos,
        DateTime $fechaHoraUltimaConexion,
        ?DateTime $fechaHoraUltimaConexionAnterior,
        string $perfil
    ) {
        $this->codUsuario = $codUsuario;
        $this->password = $password;
        $this->descUsuario = $descUsuario;
        $this->numAccesos = $numAccesos;
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
        $this->perfil = $perfil;
    }

    /** Obtiene el código del usuario.
     *
     * @return string El código del usuario.
     */
    public function getCodUsuario(): string {
        return $this->codUsuario;
    }

    /** Obtiene la descripción del usuario.
     *
     * @return string La contraseña del usuario.
     */
    public function getDescUsuario(): string {
        return $this->descUsuario;
    }
    public function setDescUsuario(string $desc): void {
        $this->descUsuario = $desc;
    }

    /** Obtiene el número de accesos del usuario.
     *
     * @return int El número de accesos del usuario.
     */
    public function getNumAccesos(): int {
        return $this->numAccesos;
    }

    /** Obtiene la fecha y hora de la última conexión del usuario.
     *
     * @return DateTime La fecha y hora de la última conexión del usuario.
     */
    public function getFechaHoraUltimaConexion(): DateTime {
        return $this->fechaHoraUltimaConexion;
    }

    /** Obtiene la fecha y hora de la penúltima conexión del usuario.
     *
     * @return DateTime|null La fecha y hora de la penúltima conexión del usuario, o null si no existe.
     */
    public function getFechaHoraUltimaConexionAnterior(): ?DateTime {
        return $this->fechaHoraUltimaConexionAnterior;
    }

    /** Obtiene el perfil del usuario.
     *
     * @return string El perfil del usuario.
     */
    public function getPerfil(): string {
        return $this->perfil;
    }

}
