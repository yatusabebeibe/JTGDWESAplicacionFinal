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
                __FILE__,
                __LINE__,
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
    static function buscaDepartamentosPorDesc(string $desc = "", ?string $estado = null) : ?Array {

        $condicion = match ($estado) {
            "alta" => "AND T02_FechaBajaDepartamento IS NULL",
            "baja" => "AND T02_FechaBajaDepartamento IS NOT NULL",
            default => ""
        };
        $consulta = <<<CONSULTA
        SELECT * FROM T02_Departamento
        WHERE T02_DescDepartamento LIKE CONCAT('%', :descripcion, '%')
        $condicion
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
                __FILE__,
                __LINE__,
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
     * Busca departamentos cuya descripción contenga el texto indicado. (Paginados)
     *
     * @param string $desc Texto a buscar en la descripción
     * @return array Array de objetos Departamento (vacío si no hay resultados)
     */
    static function buscaDepartamentosPorDescPaginado(string $desc = "", ?string $estado = null, int $numeroPagina = 1) : ?Array {

        $resultadosPorPagina = ResultadosPorPagina;
        $pagina = ($numeroPagina - 1) * $resultadosPorPagina;

        $condicion = match ($estado) {
            "alta" => "AND T02_FechaBajaDepartamento IS NULL",
            "baja" => "AND T02_FechaBajaDepartamento IS NOT NULL",
            default => ""
        };
        $consulta = <<<CONSULTA
        SELECT * FROM T02_Departamento
        WHERE T02_DescDepartamento LIKE CONCAT('%', :descripcion, '%')
        $condicion
        ORDER BY T02_FechaCreacionDepartamento DESC
        LIMIT $resultadosPorPagina OFFSET $pagina;
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
                __FILE__,
                __LINE__,
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
                __FILE__,
                __LINE__,
                $_SESSION["paginaEnCurso"]
            );
            $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
            $_SESSION["paginaEnCurso"] = "error";

            header("Location: index.php");
            exit;
        }

        return $resultado && $resultado->rowCount() === 1;
    }

    /**
     * Elimina un departamento de forma física de la base de datos.
     *
     * @param string $codigo Código del departamento
     * @return bool Devuelve true si se eliminó exactamente un registro, false si no
     */
    static function eliminarDepartamento(string $codigo): bool {
        $consulta = <<<CONSULTA
        DELETE FROM T02_Departamento
        WHERE T02_CodDepartamento = :codigo;
        CONSULTA;

        $parametros = [
            ":codigo" => $codigo,
        ];

        try {
            $resultado = DBPDO::ejecutarConsulta($consulta, $parametros);
        } catch (PDOException $exception) {
            $_SESSION['error'] = new AppError(
                $exception->getCode(),
                $exception->getMessage(),
                __FILE__,
                __LINE__,
                $_SESSION["paginaEnCurso"]
            );
            $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
            $_SESSION["paginaEnCurso"] = "error";

            header("Location: index.php");
            exit;
        }

        return $resultado && $resultado->rowCount() === 1;
    }

    /**
     * Crea un nuevo departamento en la base de datos.
     *
     * @param Departamento $departamento Objeto Departamento a crear
     * @return Departamento|null Devuelve el departamento creado o null si no se insertó
     */
    static function crearDepartamento(Departamento $departamento): ?Departamento {
        $consulta = <<<CONSULTA
        INSERT INTO T02_Departamento (
            T02_CodDepartamento,
            T02_DescDepartamento,
            T02_FechaCreacionDepartamento,
            T02_VolumenDeNegocio,
            T02_FechaBajaDepartamento
        ) VALUES (
            :codigo,
            :descripcion,
            :fechaCreacion,
            :volumen,
            :fechaBaja
        );
        CONSULTA;

        $parametros = [
            ":codigo"        => $departamento->getCodigo(),
            ":descripcion"   => $departamento->getDesc(),
            ":fechaCreacion" => $departamento->getFechaCreacion()->format('Y-m-d H:i:s'),
            ":volumen"       => $departamento->getVolumenDeNegocio(),
            ":fechaBaja"     => $departamento->getFechaBaja()
                ? $departamento->getFechaBaja()->format('Y-m-d H:i:s')
                : null
        ];

        $resultado = null;

        try {
            $resultado = DBPDO::ejecutarConsulta($consulta, $parametros);
        } catch (PDOException $exception) {
            $_SESSION['error'] = new AppError(
                $exception->getCode(),
                $exception->getMessage(),
                __FILE__,
                __LINE__,
                $_SESSION["paginaEnCurso"]
            );
            $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
            $_SESSION["paginaEnCurso"] = "error";

            header("Location: index.php");
            exit;
        }

        // Devolvemos el objeto solo si se insertó exactamente 1 fila
        return ($resultado && $resultado->rowCount() === 1) ? $departamento : null;
    }

    /**
     * Devuelve el número total de páginas según los resultados por página y opción
     *
     * @param string|null $estado "alta", "baja" o null
     * @return int Número total de páginas
     */
    static function contarTotalPaginas(string $desc = "", ?string $estado = null) : int {

        $resultadosPorPagina = ResultadosPorPagina;

        $condicion = match ($estado) {
            "alta" => "AND T02_FechaBajaDepartamento IS NULL",
            "baja" => "AND T02_FechaBajaDepartamento IS NOT NULL",
            default => ""
        };

        $consulta = <<<CONSULTA
            SELECT COUNT(*) AS total FROM T02_Departamento
            WHERE T02_DescDepartamento LIKE CONCAT('%', :descripcion, '%')
            $condicion
        CONSULTA;

        $parametros = [
            ":descripcion" => $desc,
        ];

        try {
            $datos = DBPDO::ejecutarConsulta($consulta, $parametros);
        } catch (PDOException $exception) {
            $_SESSION['error'] = new AppError(
                $exception->getCode(),
                $exception->getMessage(),
                __FILE__,
                __LINE__,
                $_SESSION["paginaEnCurso"]
            );
            $_SESSION["paginaAnterior"][] = $_SESSION["paginaEnCurso"];
            $_SESSION["paginaEnCurso"] = "error";
            header("Location: index.php");
            exit;
        }

        $fila = $datos->fetch(PDO::FETCH_ASSOC);
        $totalRegistros = $fila['total'];
        $totalPaginas = ceil($totalRegistros / $resultadosPorPagina);
        return $totalPaginas;
    }
}
