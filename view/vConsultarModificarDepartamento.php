<section class="hero-text vaDep">

    <form action="" method="post">
        <label for="codigo">Codigo:</label>
        <input type="text" id="codigo" name="codigo" value="<?= $avEditDep["codigo"] ?>" readonly disabled>

        <label for="desc">Descripcion:</label>
        <input type="text" id="desc" name="desc" value="<?= $avEditDep["descripcion"] ?>" <?= $avEditDep["editable"] ? "obligatorio" : "readonly disabled" ?> >

        <label for="fechaCreacion">Fecha de Creación:</label>
        <input type="text" id="fechaCreacion" name="fechaCreacion" value="<?= $avEditDep["fechaCreacion"] ?>" readonly disabled>

        <label for="volumenNegocio">Volumen de Negocio:</label>
        <input type="text" id="volumenNegocio" name="volumenNegocio" value="<?= $avEditDep["volumenNegocio"] ?>" <?= $avEditDep["editable"] ? "obligatorio" : "readonly disabled" ?> >

        <label for="fechaBaja">Fecha de Baja:</label>
        <input type="text" id="fechaBaja" name="fechaBaja" value="<?= $avEditDep["fechaBaja"] ?>" readonly disabled>

        <div style="display: grid; grid-template-columns: 1fr 1fr;" >
            <label for="darDeBaja" style="text-align: left;">Esta de Baja:</label>
            <span style="text-align: left;"><?= !empty($avEditDep["fechaBaja"]) ? "✅" : "❌" ?></span>
        </div>

        <?php if (!empty($avEditDep["error"]) && $avEditDep["editable"]): ?>
        <span style="margin-top: 20px; font-size: 0.8rem; color:red;"><?= $avEditDep["error"] ?></span>
        <?php endif ?>

        <?php if ($avEditDep["editable"]): ?>
        <input type="submit" value="Confirmar cambios" name="guardarDep">
        <?php endif ?>
    </form>

</section>