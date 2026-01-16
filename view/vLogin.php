<link rel="stylesheet" href="./webroot/css/login.css">
<div class="hero-text">
    <h1>Bienvenido a Login</h1>
    <form action=<?php echo $_SERVER["PHP_SELF"];?> method="post">
        <label class="tituloCampo">Usuario:</label>
        <!-- Ponemos los valores del array respuesta para que el usuario no tenga que escribirlo de nuevo en caso de error -->
        <input type="text" name="usuario" value="" obligatorio>

        <label class="tituloCampo">Contraseña:</label>
        <!-- Ponemos los valores del array respuesta para que el usuario no tenga que escribirlo de nuevo en caso de error -->
        <input type="password" name="contraseña" value="" obligatorio>

        <span class="error"></span>

        <div>
            <input type="submit" value="Entrar" name="entrar">
            <input type="submit" value="Cancelar" name="cancelar">
        </div>
    </form>
</div>