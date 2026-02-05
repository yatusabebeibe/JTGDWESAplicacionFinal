<div class="imagen-nasa">
    <h2><?= $avImagenNasa["titulo"] ?></h2>

    <p><strong>Fecha:</strong> <?= $avImagenNasa["fecha"] ?></p>

    <img src="<?= $avImagenNasa["urlImagen"] ?>" alt="<?= $avImagenNasa["titulo"] ?>">

    <?php if (!empty($avImagenNasa["urlImagenHd"])): ?>
        <p>
            <a href="<?= $avImagenNasa["urlImagenHd"] ?>" target="_blank">
                Ver imagen en HD
            </a>
        </p>
    <?php endif; ?>

    <p><?= $avImagenNasa["explicacion"] ?></p>

    <?php if (!empty($avImagenNasa["copyright"])): ?>
        <p><em>© <?= $avImagenNasa["copyright"] ?></em></p>
    <?php endif; ?>
</div>
<style>
.imagen-nasa {
    max-width: 900px;
    margin: 2rem auto;
    padding: 1.5rem 2rem;
    background-color: #0b0f1a;
    color: #eaeaea;
    border-radius: 14px;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.6);
    font-family: system-ui, sans-serif;
}

.imagen-nasa h2 {
    margin-top: 0;
    text-align: center;
    font-size: 1.8rem;
}

.imagen-nasa p {
    line-height: 1.6;
    margin: 0.75rem 0;
}

.imagen-nasa img {
    display: block;
    width: 100%;
    height: auto;
    margin: 1.2rem 0;
    border-radius: 10px;
}

.imagen-nasa a {
    display: inline-block;
    margin-top: 0.5rem;
    color: #5aa9ff;
    font-weight: bold;
    text-decoration: none;
}

.imagen-nasa a:hover {
    text-decoration: underline;
}

.imagen-nasa em {
    display: block;
    margin-top: 1.5rem;
    text-align: right;
    font-size: 0.9rem;
    color: #aaa;
}
</style>
