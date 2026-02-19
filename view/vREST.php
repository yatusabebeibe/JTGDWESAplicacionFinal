<style>  form > * { flex: 1 1 140px; }  </style>
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

    <section>
        <h1 style="padding-bottom: 10px;">Juego Steam</h1>
        <?php $juegoSteam = $avREST["juego"] ?>
        <form method="post" id="steam" name="steam">
            <input type="text" name="juego" id="juego" placeholder="Nombre del juego" value="<?= htmlspecialchars($juegoSteam->getTerminoBusqueda() ?? "") ?>">
            <input type="submit" value="Buscar">
        </form>
        <?php if ($juegoSteam->getError()["code"] != null): ?>
            <div class="error">
                <h3>Ha ocurrido un error al obtener la información del juego:</h3>
                <p><b><?= $juegoSteam->getError()["code"] ?>:</b> <?= $juegoSteam->getError()["msg"] ?></p>
            </div>
        <?php else: ?>
            <?php if ($juegoSteam->getLogo()): ?>
                <figure>
                    <img src="<?= $juegoSteam->getLogo() ?>" alt="<?= htmlspecialchars($juegoSteam->getNombre()) ?>" width="100%">
                    <figcaption><?= htmlspecialchars($juegoSteam->getNombre()) ?></figcaption>
                </figure>
            <?php else: ?>
                <p>No se encontró imagen para el juego <?= htmlspecialchars($juegoSteam->getNombre()) ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </section>

    <section>
        <h1 style="padding-bottom: 10px;">Calculadora</h1>
        <?php $calc = $avREST["calculadora"] ?>
        <form method="post" id="calculadora" name="calculadora">
            <input type="number" step="any" name="num1" value="<?= $calc->getNum1() ?>" obligatorio>
            <input type="number" step="any" name="num2" value="<?= $calc->getNum2() ?>" obligatorio>
            <select name="operacion">
                <option value="suma" <?= $calc->getOperacion() === 'suma' ? 'selected' : '' ?>>Suma</option>
                <option value="resta" <?= $calc->getOperacion() === 'resta' ? 'selected' : '' ?>>Resta</option>
                <option value="multiplicacion" <?= $calc->getOperacion() === 'multiplicacion' ? 'selected' : '' ?>>Multiplicacion</option>
                <option value="division" <?= $calc->getOperacion() === 'division' ? 'selected' : '' ?>>Division</option>
            </select>
            <input type="submit" value="Calcular">
        </form>

        <?php if ($calc->getError()["code"] !== null): ?>
            <div class="error">
                <p><b>Error <?= $calc->getError()["code"] ?>:</b> <?= htmlspecialchars($calc->getError()["msg"]) ?></p>
            </div>
        <?php else: ?>
            <p>Resultado: <?= $calc->getResultado() ?></p>
        <?php endif; ?>
    </section>
</div>