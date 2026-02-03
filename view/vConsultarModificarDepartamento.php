<style>
    section.hero-text {
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

        & > * {display: block; max-width: 240px;}
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

    <form action="" method="post">
        <label for="codigo">Codigo:</label>
        <input type="text" id="codigo" name="codigo" value="<?= $avEditDep["codigo"] ?>" readonly disabled>

        <label for="desc">Descripcion:</label>
        <input type="text" id="desc" name="desc" value="<?= $avEditDep["descripcion"] ?>" <?= $avEditDep["editable"] ? "obligatorio" : "readonly disabled" ?> >

        <label for="fechaCreacion">Fecha de Creación:</label>
        <input type="text" id="fechaCreacion" name="fechaCreacion" value="<?= $avEditDep["fechaCreacion"] ?>" readonly disabled>

        <label for="volumenNegocio">Volumen de Negocio:</label>
        <input type="text" id="volumenNegocio" name="volumenNegocio" value="<?= $avEditDep["volumenNegocio"] ?>" <?= $avEditDep["editable"] ? "obligatorio" : "readonly disabled" ?> >

        <label for="fechaBaja">Fecha de Baja:</label>
        <input type="text" id="fechaBaja" name="fechaBaja" value="<?= $avEditDep["fechaBaja"] ?>" readonly disabled>

        <div style="display: grid; grid-template-columns: 1fr 1fr;" >
            <label for="darDeBaja" style="text-align: left;">Dar de Baja:</label>
            <input type="checkbox" id="darDeBaja" name="darDeBaja" <?= !empty($avEditDep["fechaBaja"]) ? "checked" : "" ?> <?= $avEditDep["editable"] ? "obligatorio" : "readonly disabled" ?> >
        </div>

        <?php if (!empty($avEditDep["error"]) && $avEditDep["editable"]): ?>
        <span style="margin-top: 20px; font-size: 0.8rem; color:red;"><?= $avEditDep["error"] ?></span>
        <?php endif ?>

        <?php if ($avEditDep["editable"]): ?>
        <input type="submit" value="Confirmar cambios" name="guardarDep">
        <?php endif ?>
    </form>
</section>