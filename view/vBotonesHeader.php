<?php $estaLogeado = isset($_SESSION["usuarioDAWJTGDAplicacionFinal"]); ?>
<?php $estaEnInicio = in_array( $_SESSION["paginaEnCurso"], ["inicioPublico", "inicioPrivado"] ); ?>


<!-- Botones de cambio de idioma -->
<?php if ($estaEnInicio): // Solo mostramos los botones de idioma en las páginas de inicio ?>
<form id="form_idiomas" action="" method="post" class="idiomas">
    <input type="radio" name="idioma" id="ES" value="ES" <?=  $_COOKIE["idioma"]=="ES" ? "checked" : "" ?>>
    <label for="ES"><img src="./webroot/images/flags/ES.png" alt="Español"></label>

    <input type="radio" name="idioma" id="EN" value="EN" <?=  $_COOKIE["idioma"]=="EN" ? "checked" : "" ?>>
    <label for="EN"><img src="./webroot/images/flags/EN.png" alt="Inglés"></label>

    <input type="radio" name="idioma" id="JP" value="JP" <?=  $_COOKIE["idioma"]=="JP" ? "checked" : "" ?>>
    <label for="JP"><img src="./webroot/images/flags/JP.png" alt="Japonés"></label>
</form>
<script>
    const form = document.getElementById('form_idiomas');
    form.addEventListener('change', () => form.submit());
</script>
<?php endif; ?>

<!-- Botones para ir al apartado de miCuenta -->
<?php if ($estaLogeado && $_SESSION["paginaEnCurso"] != "cuenta"): ?>
<form id="form_cuenta" action="" method="post">
    <?php
    $letra = strtoupper($_SESSION["usuarioDAWJTGDAplicacionFinal"]->getDescUsuario()[0]);
    $hue = (ord($letra) * 37) % 360; // matiz distinto según la letra
    $colorFondo = "hsl($hue, 70%, 50%)"; // un poco más oscuro para que contraste
    ?>
    <input type="submit" id="boton_cuenta" name="cuenta"
        value="<?= $letra ?>"
        style="background: <?= $colorFondo ?>;"
    >

</form>
<?php endif; ?>


<!-- Boton para volver a la página anterior -->
<?php if (!$estaEnInicio && !in_array( $_SESSION["paginaEnCurso"], ["login", "registro"] ) ): ?>
<form id="form_volver" action="" method="post">
    <input type="submit" value="Volver" name="volver">
</form>
<?php endif; ?>


<!-- Botones de login/logoff/registro -->
<form id="form_login" action="" method="post">
    <?php if ($estaLogeado): ?>
        <input type="submit" value="Cerrar sesión" name="logoff">
    <?php else: ?>
        <?php if ($_SESSION["paginaEnCurso"] != "login"): // No mostramos el botón de login si ya estamos en la página de login ?>
            <input type="submit" value="Iniciar sesión" name="login">
        <?php endif; ?>
        <?php if ($_SESSION["paginaEnCurso"] != "registro"): // No mostramos el botón de registro si ya estamos en la página de registro ?>
            <input type="submit" value="Registrarse" name="register">
        <?php endif; ?>
    <?php endif; ?>
</form>