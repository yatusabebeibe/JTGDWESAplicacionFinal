<?php

/**
 * @author Jesus Temprano Gallego
 * @since 23/01/2026
 */

class DepartamentoPDO {

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
                $oDatos->T02_FechaCreacionDepartamento,
                $oDatos->T02_VolumenDeNegocio,
                $oDatos->T02_FechaBajaDepartamento,
            );
        }
        return null;
    }

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
}
