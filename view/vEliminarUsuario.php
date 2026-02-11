<section class="hero-text vaDep">

    <form action="" method="post">
        <label for="codigo">Codigo:</label>
        <input type="text" id="codigo" name="codigo" value="<?= $avEliminarUsuario["codigo"] ?>" readonly disabled>

        <label for="descripcion">Descripcion:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?= $avEliminarUsuario["descripcion"] ?>" readonly disabled>

        <label for="numAccesos">Nº Accesos:</label>
        <input type="text" id="numAccesos" name="numAccesos" value="<?= $avEliminarUsuario["numAccesos"] ?>" readonly disabled>

        <label for="perfil">Perfil:</label>
        <input type="text" id="perfil" name="perfil" value="<?= $avEliminarUsuario["perfil"] ?>" readonly disabled>

        <label for="ultimaConexion">Ultima conexion:</label>
        <input type="datetime" id="ultimaConexion" name="ultimaConexion" value="<?= $avEliminarUsuario["ultimaConexion"] ?>" readonly disabled>

        <?php if (!empty($avEliminarUsuario["error"])): ?>
        <span style="margin-top: 20px; font-size: 0.8rem; color:red;"><?= $avEliminarUsuario["error"] ?></span>
        <?php endif ?>

        <input type="submit" value="Confirmar eliminar" name="eliminar">
    </form>

</section>