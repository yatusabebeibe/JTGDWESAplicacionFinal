<link rel="stylesheet" href="./webroot/css/login.css">
<div class="hero-text">
    <h1>Formulario Registro</h1>
    <form action=<?php echo $_SERVER["PHP_SELF"];?> method="post">
        <label class="tituloCampo">Usuario:</label>
        <input type="text" name="usuario" value="" obligatorio>

        <label class="tituloCampo">Nombre Completo:</label>
        <input type="text" name="nombre" value="" obligatorio>

        <label class="tituloCampo">Contraseña:</label>
        <input type="password" name="contraseña1" value="" obligatorio>

        <label class="tituloCampo">Repetir Contraseña:</label>
        <input type="password" name="contraseña2" value="" obligatorio>

        <label class="tituloCampo">Respuesta pregunta seguridad:</label>
        <input type="text" name="resPregSeg" value="" obligatorio>

        <span class="error"><?= $sErrorRegistro ?></span>

        <div>
            <input type="submit" value="Aceptar" name="aceptar">
            <input type="submit" value="Cancelar" name="cancelar">
        </div>
    </form>
</div>