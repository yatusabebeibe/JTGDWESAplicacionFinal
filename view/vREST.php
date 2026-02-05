<div class="gridLayout">
    <section>
        <h1 style="padding-bottom: 10PX;">NASA</h1>
        <?php $fotoNasa = $avREST["nasa"] ?>
        <!-- Favoritas 2019-02-12, 2019-02-13, 2018-05-24 -->
        <form method="post" id="nasa" name="nasa">
            <input type="date" name="fecha" id="fecha" value="<?= $fotoNasa->getFecha() ?>"  obligatorio>
            <input type="submit" value="Enviar">
        </form>
        <?php if ($fotoNasa->getError()["code"] != null): ?>
            <div class="error">
                <h3>Ha ocurrido un error al obtener la imagen de la NASA para la fecha <?= $fotoNasa->getFecha() ?>:</h3>
                <p><b><?= $fotoNasa->getError()["code"] ?>:</b> <?= $fotoNasa->getError()["msg"] ?></p>
            </div>
        <?php else: ?>
            <figure>
                <img src="<?= $fotoNasa->getUrl() ?>" alt="" width="100%">
            </figure>
            <form action="" method="post" style="margin: 15px 50px;">
                <input type="submit" value="Ver en detalle" name="detalleNasa">
            </form>
        <?php endif; ?>
    </section>
</div>