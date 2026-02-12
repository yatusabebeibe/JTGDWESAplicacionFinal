<style>
    #man > table .deBaja { color: gray; }
    #man > .formularios {
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

    #man > .formularios > form > div:nth-child(2) {
        align-items: center;

        > * { height: min-content; }
        > div { display: flex; gap: 12px; }
        & input { display: none; }
        & label {
            cursor: pointer;
            padding: 8px 12px;
            font-size: 13.3333px;
            background: var(--color-primary);
            color: var(--color-bg-header);
            font-weight: bold;
            border-radius: var(--border-radius);
        }
        & input:checked + label {
            background: hsl(204, 64%, 45%);
            transform: scale(1.15);
            color: var(--color-text);
        }
        label#filtroActual {
            background: hsl(204, 64%, 54%);
            color: yellow;
        }
    }
</style>

<div id="man" class="manDep">
    <div class="formularios">
        <form method="post" class="x">
            <div>
                <input type="text" name="buscar" placeholder="Texto a buscar" value="<?= $avMtoDep["buscado"] ?>" autofocus>
                <input type="submit" value="Buscar">
            </div>
            <div>
                <p>Filtrar por:</p>
                <div>
                    <input type="radio" name="estado" id="alta" value="alta" <?= $avMtoDep["estado"] === "alta" ?"checked" :""; ?> >
                    <label for="alta" <?= $avMtoDep["estado"] === "alta" ?"id='filtroActual'" :""; ?> >Alta</label>

                    <input type="radio" name="estado" id="baja" value="baja" <?= $avMtoDep["estado"] === "baja" ?"checked " :""; ?> >
                    <label for="baja" <?= $avMtoDep["estado"] === "baja" ?"id='filtroActual'" :""; ?> >Baja</label>

                    <input type="radio" name="estado" id="todo" value="todo" <?= $avMtoDep["estado"] === "todo" ?"checked" :""; ?> >
                    <label for="todo" <?= $avMtoDep["estado"] === "todo" ?"id='filtroActual'" :""; ?> >Todo</label>
                </div>
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

    <style>
        #man {position: relative;}
        #man > .paginacion {
            position: absolute;
            bottom: 50px; left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 4px;
            justify-content: center;
        }
        #man > .paginacion > button {
            background: none;
            border: none;
            font-weight: 900;
            font-size: 1.5rem;
            color: var(--color-primary);
            cursor: pointer;
        }
        #man > .paginacion {
            & > #pagActual {
                cursor: context-menu;
                color: whitesmoke;
            }
            & > button:disabled {
                cursor: context-menu;
                color: gray;
            }
        }
    </style>

    <form class="paginacion" method="post">
        <?php $esPrimera = $avMtoDep["paginaActual"] == 1; ?>
        <button name="pagina" value="1" <?= $esPrimera ? 'disabled' : '' ?>>&NestedLessLess;</button>
        <button name="pagina" value="<?= $avMtoDep["paginaActual"] - 1 ?>" <?= $esPrimera ? 'disabled' : '' ?>>&lt;</button>

        <?php for($nPag = 1; $nPag <= $avMtoDep["totalPaginas"]; $nPag++): ?>
            <button name="pagina" value="<?= $nPag ?>" <?= $nPag == $avMtoDep["paginaActual"] ? 'id="pagActual"' : '' ?>>
                <?= $nPag ?>
            </button>
        <?php endfor; ?>

        <?php $esUltima = $avMtoDep["paginaActual"] == $avMtoDep["totalPaginas"]; ?>
        <button name="pagina" value="<?= $avMtoDep["paginaActual"] + 1 ?>" <?= $esUltima ? 'disabled' : '' ?>>&gt;</button>
        <button name="pagina" value="<?= $avMtoDep["totalPaginas"] ?>" <?= $esUltima ? 'disabled' : '' ?>>&NestedGreaterGreater;</button>
    </form>
</div>