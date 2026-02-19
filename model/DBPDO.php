<?php

/**
 * Clase para gestionar consultas a la base de datos usando PDO.
 *
 * @author Jesús Temprano Gallego
 * @since 18/12/2025
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
        $miDB = new PDO(DSN, DBUser, DBPass);

        $consulta = $miDB->prepare($sentenciaSQL);

        $consulta->execute($parametros);

        return $consulta;
    }
}