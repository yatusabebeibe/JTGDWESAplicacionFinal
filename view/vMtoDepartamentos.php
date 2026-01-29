<div id="manDep">
    <form method="post">
        <div>
            <input type="text" name="buscar" placeholder="Texto a buscar" value="<?= $avMtoDep["buscado"] ?>" autofocus>
            <input type="submit" value="Buscar">
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
                <th>Volumen de Negocio</th>
                <th>Fecha de Baja</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($avMtoDep["departamentos"] as $departamento): ?>
                <tr>
                    <td><?= $departamento["codigo"] ?></td>
                    <td><?= $departamento["descripcion"] ?></td>
                    <td><?= $departamento["fechaCreacion"] ?></td>
                    <td><?= $departamento["volumenDeNegocio"] ?></td>
                    <td><?= $departamento["fechaBaja"] ?></td>
                    <td>
                        <form action="" method="post" class="formEdicion">
                            <input type="hidden" name="codDep" value="<?= $departamento["codigo"] ?>">
                            <input type="submit" value="✏️" name="editar" title="Editar">
                            <input type="submit" value="🗑️" name="borrar" title="Borrar">
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>