<section class="hero-text vaDep">

    <form action="" method="post">
        <label for="codigo">Codigo:</label>
        <input type="text" id="codigo" name="codigo" value="<?= $avConsultarUsuario["codigo"] ?>" readonly disabled>

        <label for="descripcion">Descripcion:</label>
        <input type="text" id="descripcion" name="descripcion" value="<?= $avConsultarUsuario["descripcion"] ?>" readonly disabled>

        <label for="numAccesos">Nº Accesos:</label>
        <input type="text" id="numAccesos" name="numAccesos" value="<?= $avConsultarUsuario["numAccesos"] ?>" readonly disabled>

        <label for="perfil">Perfil:</label>
        <input type="text" id="perfil" name="perfil" value="<?= $avConsultarUsuario["perfil"] ?>" readonly disabled>

        <label for="ultimaConexion">Ultima conexion:</label>
        <input type="datetime" id="ultimaConexion" name="ultimaConexion" value="<?= $avConsultarUsuario["ultimaConexion"] ?>" readonly disabled>
    </form>

</section>