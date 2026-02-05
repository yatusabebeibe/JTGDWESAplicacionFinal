<div class="hero-text">
    <h1><?= $avInicioPrivado["saludo"] ?></h1>
    <h2><?= $avInicioPrivado["nConexiones"] ?></h2>
    <h2><?= $avInicioPrivado["fechaUltConex"] ?></h2>
    <form action=<?php echo $_SERVER["PHP_SELF"];?> method="post">
        <input type="submit" value="Detalle" name="detalle">
        <input type="submit" value="Error" name="error">
        <input type="submit" value="Mantenimiento de departamentos" name="mtoDepartamentos">
        <input type="submit" value="REST" name="REST">
        <?php if ($avInicioPrivado["tipoUsuario"] == "administrador"): ?>
            <input type="submit" value="Mantenimiento de usuarios" name="mtoUsuarios">
        <?php endif ?>
    </form>
</div>