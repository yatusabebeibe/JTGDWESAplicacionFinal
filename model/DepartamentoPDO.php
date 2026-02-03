<?php

/**
 * Clase que gestiona operaciones sobre departamentos en la base de datos usando PDO.
 *
 * @author Jesus Temprano Gallego
 * @since 23/01/2026
 */
class DepartamentoPDO {

    /**
     * Busca un departamento por su código.
     *
     * @param string $codigo Código del departamento
     * @return Departamento|null Devuelve un objeto Departamento o null si no existe
     */
    static function buscaDepartamentoPorCod(string $codigo) : ?Departamento {
        $consulta = <<<CONSULTA
        SELECT * FROM T02_Departamento
        WHERE T02_CodDepartamento = :codigo;
        CONSULTA;

        $parametros = [
            ":codigo" => $codigo,
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

        if ($datos && $datos->rowCount() >= 1) {
            $oDatos = $datos->fetchObject();
            return new Departamento(
                $oDatos->T02_CodDepartamento,
                $oDatos->T02_DescDepartamento,
                new DateTime($oDatos->T02_FechaCreacionDepartamento),
                $oDatos->T02_VolumenDeNegocio,
                $oDatos->T02_FechaBajaDepartamento ? new DateTime($oDatos->T02_FechaBajaDepartamento) : null
            );
        }
        return null;
    }

    /**
     * Busca departamentos cuya descripción contenga el texto indicado.
     *
     * @param string $desc Texto a buscar en la descripción
     * @return array Array de objetos Departamento (vacío si no hay resultados)
     */
    static function buscaDepartamentosPorDesc(string $desc = "") : ?Array {
        $consulta = <<<CONSULTA
        SELECT * FROM T02_Departamento
        WHERE T02_DescDepartamento LIKE CONCAT('%', :descripcion, '%')
        ORDER BY T02_FechaCreacionDepartamento DESC;
        CONSULTA;

        $parametros = [
            ":descripcion" => $desc,
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

        $aDepartamentos = [];
        if ($datos && $datos->rowCount() >= 1) {
            while ($departamento = $datos->fetchObject()) {
                $aDepartamentos[] = new Departamento(
                    $departamento->T02_CodDepartamento,
                    $departamento->T02_DescDepartamento,
                    new DateTime($departamento->T02_FechaCreacionDepartamento),
                    $departamento->T02_VolumenDeNegocio,
                    $departamento->T02_FechaBajaDepartamento ? new DateTime($departamento->T02_FechaBajaDepartamento) : null
                );
            }
        }
        return $aDepartamentos;
    }

    /**
     * Actualiza un departamento en la base de datos.
     *
     * @param Departamento $departamento Objeto Departamento con los datos a actualizar.
     * @return bool Devuelve `true` si se actualizó exactamente un registro, `false` si no.
     */
    static function editarDepartamento(Departamento $departamento): bool {
        $consulta = <<<CONSULTA
        UPDATE T02_Departamento
        SET
            T02_DescDepartamento = :descripcion,
            T02_VolumenDeNegocio = :volumen,
            T02_FechaBajaDepartamento = :fechaBaja
        WHERE T02_CodDepartamento = :codigo;
        CONSULTA;

        $parametros = [
            ":codigo"      => $departamento->getCodigo(),
            ":descripcion" => $departamento->getDesc(),
            ":volumen"     => $departamento->getVolumenDeNegocio(),
            ":fechaBaja"   => $departamento->getFechaBaja()
                ? $departamento->getFechaBaja()->format('Y-m-d H:i:s')
                : null
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

        return $resultado && $resultado->rowCount() === 1;
    }
}
