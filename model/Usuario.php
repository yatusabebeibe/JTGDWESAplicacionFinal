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

    // getter methods
    public function getCodUsuario(): string {
        return $this->codUsuario;
    }
    public function getDescUsuario(): string {
        return $this->descUsuario;
    }
    public function getNumAccesos(): int {
        return $this->numAccesos;
    }
    public function getFechaHoraUltimaConexion(): DateTime {
        return $this->fechaHoraUltimaConexion;
    }
    public function getFechaHoraUltimaConexionAnterior(): ?DateTime {
        return $this->fechaHoraUltimaConexionAnterior;
    }
    public function getPerfil(): string {
        return $this->perfil;
    }

}
