<form id="login" action="" method="post">
    <?php if ($_SESSION["paginaEnCurso"] == "login"): ?>
    <?php elseif (!isset($_SESSION["usuarioDAWJTGProyectoLoginLogoff"])): ?>
        <input type="submit" value="Iniciar sesión" name="login">
        <input type="submit" value="Registrarse" name="register">
    <?php else: ?>
        <input type="submit" value="Cerrar sesión" name="logoff">
    <?php endif; ?>
</form>