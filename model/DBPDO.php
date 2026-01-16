<?php

/**
 * @author Jesús Temprano Gallego
 * @since 18/12/2025
 *
 * Clase para gestionar consultas a la base de datos usando PDO.
 */
class DBPDO {
    /**
     * Ejecuta una consulta SQL preparada con parámetros.
     *
     * @param string $sentenciaSQL La sentencia SQL a ejecutar.
     * @param array $parametros Array con los parámetros para la sentencia SQL.
     * @return PDOStatement Devuelve el objeto PDOStatement de la consulta.
     */
    public static function ejecutarConsulta(string $sentenciaSQL, array $parametros = []) {
        try {
            $miDB = new PDO(DSN, DBUser, DBPass);

            $consulta = $miDB->prepare($sentenciaSQL);

            $consulta->execute($parametros);

            return $consulta;

        } catch (PDOException $exception) {
            $_SESSION['error'] = new AppError(
                $exception->getCode(),
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine(),
                $_SESSION['paginaEnCurso']
            );
            $_SESSION["paginaAnterior"] = $_SESSION["paginaEnCurso"];
            $_SESSION["paginaEnCurso"] = "error";

            // Redirigimos
            header("Location: indexLoginLogoff.php");
            exit;
        }
    }
}