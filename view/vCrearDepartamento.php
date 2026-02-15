<section class="hero-text vaDep">

    <form action="" method="post">
        <label for="codigo">Codigo:</label>
        <input type="text" id="codigo" name="codigo" value="<?= $avEditDep["codigo"] ?>" placeholder="Introduce el codigo" obligatorio>

        <label for="desc">Descripcion:</label>
        <input type="text" id="desc" name="desc" value="<?= $avEditDep["descripcion"] ?>" placeholder="Introduce descripcion" obligatorio>

        <label for="fechaCreacion">Fecha de Creación:</label>
        <input type="text" id="fechaCreacion" name="fechaCreacion" value="<?= (new DateTime())->format("d-m-Y") ?>" readonly disabled>

        <label for="volumenNegocio">Volumen de Negocio:</label>
        <input type="text" id="volumenNegocio" name="volumenNegocio" value="<?= $avEditDep["volumenNegocio"] ?>" placeholder="Introduce volumen" obligatorio>

        <label for="fechaBaja">Fecha de Baja:</label>
        <input type="text" id="fechaBaja" name="fechaBaja" readonly disabled>

        <?php if (!empty($avEditDep["error"])): ?>
        <span style="margin-top: 20px; font-size: 0.8rem; color:red;"><?= $avEditDep["error"] ?></span>
        <?php endif ?>

        <input type="submit" value="Confirmar creacion" name="crearDep">
    </form>

</section>