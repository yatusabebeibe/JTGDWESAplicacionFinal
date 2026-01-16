<?php if (in_array( $_SESSION["paginaEnCurso"], ["inicioPublico", "inicioPrivado"] )): ?>

<form id="idiomas" action="" method="post" class="idiomas">
    <input type="radio" name="idioma" id="ES" value="ES" <?=  $_COOKIE["idioma"]=="ES" ? "checked" : "" ?>>
    <label for="ES"><img src="./webroot/images/flags/ES.png" alt="Español"></label>

    <input type="radio" name="idioma" id="EN" value="EN" <?=  $_COOKIE["idioma"]=="EN" ? "checked" : "" ?>>
    <label for="EN"><img src="./webroot/images/flags/EN.png" alt="Inglés"></label>

    <input type="radio" name="idioma" id="JP" value="JP" <?=  $_COOKIE["idioma"]=="JP" ? "checked" : "" ?>>
    <label for="JP"><img src="./webroot/images/flags/JP.png" alt="Japonés"></label>
</form>

<script>
    const form = document.getElementById('idiomas');
    form.addEventListener('change', () => form.submit());
</script>

<?php endif; ?>