<style>
    section.hero-text {
        display: grid;
        grid-template-columns: minmax(200px, auto) 1fr;
        align-content: center;
        justify-content: center;
        align-items: center;
        gap: 1.5rem;
        padding: 20px;
        background: var(--color-bg-footer);
        border-radius: 1rem;
    }
    section.hero-text > div {
        min-width: 100%;
        width: min-content;
        & > img{
            border-radius: .5rem;
            width: 100%; max-width: 200px;
            aspect-ratio: 1;
            margin-bottom: 15px;
        }
        & > form { width: 100%; }
        & > form > input { display: none; }
        & > form > label {
            display: block; width: max-content;
            padding: 10px;
            margin: 5px auto;
            background: var(--color-primary);
            border-radius: var(--border-radius);
            color: var(--color-bg-header);
            cursor: pointer;
        }
    }

    section.hero-text > form {
        height: 100%; width: 100%;
        background: #171d25;
        border-radius: .5rem;
        min-width: 50px;
        padding: 20px;

        & > * {display: block;}
        & > input {margin-bottom: 12px; width: 240px;}
    }
    section.hero-text > form > label {
        width: 100%;
        text-align: left;
        padding: 3px 3px;
    }
    section.hero-text > form > input[type="submit"] {
        margin: 0 auto;
        margin-top: 29px;
    }
</style>
<section class="hero-text">

    <div><img src="http://picsum.photos/id/103/500/500" alt=""></div>
    <form action="" method="post">
        <label for="codigoUsuario">Usuario:</label>
        <input type="text" id="codigoUsuario" name="codigoUsuario" value="<?= $_SESSION["usuarioDAWJTGDAplicacionFinal"]->getCodigo() ?>" readonly disabled>

        <label for="descUsuario">Nombre Completo:</label>
        <input type="text" id="descUsuario" name="descUsuario" value="<?= $_SESSION["usuarioDAWJTGDAplicacionFinal"]->getDesc() ?>" obligatorio>

        <input type="submit" value="Confirmar cambios" name="guardarUsuario">
    </form>
</section>