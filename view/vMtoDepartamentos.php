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
            </tr>
        </thead>
        <tbody>
            <?php foreach($avMtoDep["departamentos"] as $departamento): ?>
                <tr>
                    <td><?= $departamento->T02_CodDepartamento ?></td>
                    <td><?= $departamento->T02_DescDepartamento  ?></td>
                    <td><?= $departamento->T02_FechaCreacionDepartamento  ?></td>
                    <td><?= $departamento->T02_VolumenDeNegocio  ?></td>
                    <td><?= $departamento->T02_FechaBajaDepartamento  ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>