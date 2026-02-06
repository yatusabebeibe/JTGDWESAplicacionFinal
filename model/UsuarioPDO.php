<?php

/**
 * @author Jesús Temprano Gallego
 * @since 18/12/2025
 *
 * Clase que gestiona operaciones sobre usuarios en la base de datos usando PDO.
 */
class UsuarioPDO {

    /**
     * Valida un usuario comprobando su código y contraseña en la base de datos.
     *
     * @param string $codUsuario Código del usuario a validar.
     * @param string $passwd Contraseña del usuario.
     * @return ?Usuario Objeto Usuario si las credenciales son válidas, null en caso contrario.
     */
    public static function validarUsuario(string $codUsuario, string $passwd) {
        $consulta = <<<CONSULTA
        SELECT * FROM T01_Usuario
        WHERE
            T01_CodUsuario = :usuario
            AND
            T01_Password = SHA2(:contrasenia, 256);
        CONSULTA;

        $parametros = [
            ":usuario" => $codUsuario ?? "",
            ":contrasenia" => $codUsuario.$passwd ?? ""
        ];

        try {
            $datos = DBPDO::ejecutarConsulta($consulta,$parametros);
        } catch (PDOException $exception) {
            $_SESSION['error'] = new AppError(
                $exception->getCode(),
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine(),
                $_SESSION["paginaEnCurso"]
            );
            $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
            $_SESSION["paginaEnCurso"] = "error";

            header("Location: index.php");
            exit;
        }

        $usuario = null;
        if ($datos && $datos->rowCount() >= 1) {
            $oDatos = $datos->fetchObject();
            $usuario = new Usuario(
                $oDatos->T01_CodUsuario,
                $oDatos->T01_Password,
                $oDatos->T01_DescUsuario,
                $oDatos->T01_NumConexiones + 1,
                new DateTime(),
                $oDatos->T01_FechaHoraUltimaConexion ? new DateTime($oDatos->T01_FechaHoraUltimaConexion) : null,
                $oDatos->T01_Perfil
            );

            return $usuario;
        }

        return null;
    }

    /**
     * Actualiza la última conexión y el número de conexiones de un usuario en la base de datos.
     *
     * @param string $codUsuario Código del usuario a actualizar.
     * @param DateTime $fecha Fecha y hora de la última conexión.
     * @return bool true si la actualización fue exitosa, false en caso contrario.
     */
    public static function actualizarUltimaConexion(string $codUsuario, DateTime $fecha) {
        $consulta = <<<CONSULTA
        UPDATE T01_Usuario
        SET
            T01_FechaHoraUltimaConexion = :fecha,
            T01_NumConexiones = T01_NumConexiones + 1
        WHERE T01_CodUsuario = :usuario ;
        CONSULTA;

        $parametros = [
            ":usuario" => $codUsuario ?? "",
            ":fecha" => $fecha->format('Y-m-d H:i:s')
        ];

        try {
            $actualizacion = DBPDO::ejecutarConsulta($consulta, $parametros);
        } catch (PDOException $exception) {
            $_SESSION['error'] = new AppError(
                $exception->getCode(),
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine(),
                $_SESSION["paginaEnCurso"]
            );
            $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
            $_SESSION["paginaEnCurso"] = "error";

            header("Location: index.php");
            exit;
        }

        return ($actualizacion && $actualizacion->rowCount() > 0) ? true : false ;
    }

    /**
     * Da de alta un nuevo usuario en la base de datos.
     *
     * @param string $codUsuario Código del nuevo usuario.
     * @param string $nombre Nombre completo del nuevo usuario.
     * @param string $passwd Contraseña del nuevo usuario.
     * @return bool true si el alta fue exitosa, false en caso contrario.
     */
    public static function altaUsuario(string $codUsuario, string $nombre, string $passwd) {
        $consulta = <<<CONSULTA
        INSERT INTO T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario)
        VALUES (:usuario, SHA2(:contrasenia, 256), :descripcion);
        CONSULTA;

        $parametros = [
            ":usuario" => $codUsuario ?? "",
            ":contrasenia" => $codUsuario.$passwd ?? "",
            ":descripcion" => $nombre ?? ""
        ];

        try {
            $insercion = DBPDO::ejecutarConsulta($consulta, $parametros);
        } catch (PDOException $exception) {
            header("Location: index.php");
            exit;
        }

        return ($insercion && $insercion->rowCount() > 0) ? true : false ;
    }

    public static function modificarUsuario(string $codUsuario, string $descUsuario) {
        $consulta = <<<CONSULTA
        UPDATE T01_Usuario
        SET T01_DescUsuario = :descripcion
        WHERE T01_CodUsuario = :usuario
        CONSULTA;

        $parametros = [
            ":usuario" => $codUsuario,
            ":descripcion" => $descUsuario,
        ];

        try {
            $datos = DBPDO::ejecutarConsulta($consulta,$parametros);
        } catch (PDOException $exception) {
            $_SESSION['error'] = new AppError(
                $exception->getCode(),
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine(),
                $_SESSION["paginaEnCurso"]
            );
            $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
            $_SESSION["paginaEnCurso"] = "error";

            header("Location: index.php");
            exit;
        }

        if ($datos->rowCount() > 0) {
            $_SESSION["usuarioDAWJTGDAplicacionFinal"]->setDesc($descUsuario);
            return true; // Se modificó el usuario
        } else {
            return false; // No se encontró el usuario o no hubo cambios
        }
    }

    /**
     * Busca usuarios cuyo nombre o descripción contiene un texto dado.
     *
     * @param string $descripcion Texto a buscar en la descripción de los usuarios.
     * @return array Array de objetos Usuario que cumplen con la búsqueda, vacío si no hay resultados.
     */
    public static function buscarUsuariosPorDescripcion(string $descripcion) {
        $consulta = <<<CONSULTA
        SELECT * FROM T01_Usuario
        WHERE T01_DescUsuario LIKE CONCAT('%', :descripcion, '%');
        CONSULTA;

        $parametros = [
            ":descripcion" => $descripcion
        ];

        try {
            $resultado = DBPDO::ejecutarConsulta($consulta, $parametros);
        } catch (PDOException $exception) {
            $_SESSION['error'] = new AppError(
                $exception->getCode(),
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine(),
                $_SESSION["paginaEnCurso"]
            );
            $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
            $_SESSION["paginaEnCurso"] = "error";

            header("Location: index.php");
            exit;
        }

        $usuarios = [];
        if ($resultado && $resultado->rowCount() > 0) {
            while ($oDatos = $resultado->fetchObject()) {
                $usuarios[] = new Usuario(
                    $oDatos->T01_CodUsuario,
                    $oDatos->T01_Password,
                    $oDatos->T01_DescUsuario,
                    $oDatos->T01_NumConexiones,
                    new DateTime($oDatos->T01_FechaHoraUltimaConexion),
                    $oDatos->T01_FechaHoraUltimaConexion ? new DateTime($oDatos->T01_FechaHoraUltimaConexion) : null,
                    $oDatos->T01_Perfil
                );
            }
        }

        return $usuarios;
    }
}
