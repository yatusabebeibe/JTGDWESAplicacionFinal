<div class="gridLayout">
    <section>
        <?php $fotoNasa = $avREST["nasa"] ?>
        <!-- Favoritas 2019-02-12, 2019-02-13, 2018-05-24 -->
        <form method="post" id="nasa" name="nasa">
            <input type="date" name="fecha" id="fecha" value="<?= $fotoNasa->getFecha() ?>" max="<?= date('Y-m-d') ?>" class="obligatorio">
            <input type="submit" value="Enviar">
        </form>
        <figure>
            <img src="<?= $fotoNasa->getUrl() ?>" alt="" width="100%">
            <figcaption><?= $fotoNasa->getTitulo() ?></figcaption>
        </figure>
    </section>
</div>