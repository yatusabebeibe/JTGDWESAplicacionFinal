<style>
    #manDep > table .deBaja { color: gray; }
    #manDep > .formularios {
        margin-bottom: 30px;
        display: grid;
        --espacios: 1fr;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: auto auto;
        grid-template-areas:
            ". x x y ."
            ". x x y .";
    }
    .x { grid-area: x; }
    .y { grid-area: y; }
</style>

<div id="manDep">
    <div class="formularios">
        <form method="post" class="x">
            <div>
                <input type="text" name="buscar" placeholder="Texto a buscar" value="<?= $avMtoDep["buscado"] ?>" autofocus>
                <input type="submit" value="Buscar">
            </div>
        </form>
        <form method="post" class="y"><input type="submit" value="Crear departamento" name="crear"></form>
    </div>

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
                <tr class="<?= !empty($departamento["fechaBaja"]) ? "deBaja" : "" ?>" >
                    <td><?= $departamento["codigo"] ?></td>
                    <td><?= $departamento["descripcion"] ?></td>
                    <td><?= $departamento["fechaCreacion"] ?></td>
                    <td><?= $departamento["volumenDeNegocio"] ?></td>
                    <td><?= $departamento["fechaBaja"] ?></td>
                    <td>
                        <form action="" method="post" class="formEdicion">
                            <input type="hidden" name="codDep" value="<?= $departamento["codigo"] ?>">
                            <input type="submit" value="👁️" name="ver" title="Ver">
                            <input type="submit" value="✏️" name="editar" title="Editar">
                            <input type="submit" value="🗑️" name="borrar" title="Borrar">
                            <input type="submit" value="<?= empty($departamento["fechaBaja"]) ? "⬇️" : "⬆️" ?>" name="altabaja" title="Dar de <?= empty($departamento["fechaBaja"]) ? "baja" : "alta" ?>">
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>