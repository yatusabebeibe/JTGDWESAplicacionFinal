<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="./webroot/images/logo.svg">
    <title>Jesús Temprano Gallego - <?= $titulo ?></title>
    <link rel="stylesheet" href="./webroot/css/style.css">
</head>
<body>
    <header>
        <div class="logo">Steam</div>
        <h1 class="titulo"><?= $titulo ?></h1>
        <div class="header-actions">
            <?php require_once 'view/vBotonesHeader.php'; ?>
        </div>
    </header>
    <script>
        const header = document.querySelector("header");
        const posicionInicial  = header.offsetTop;

        window.addEventListener("scroll", () => {
            header.classList.toggle("desacoplado", window.scrollY > posicionInicial);
        });
    </script>

    <main>
        <?php require_once $vista[$_SESSION["paginaEnCurso"]]; ?>
    </main>

    <footer>
        <a href="https://github.com/yatusabebeibe/JTGDWESAplicacionFinal/" target="_blank">
            <img src="./webroot/images/github.svg" style="filter: invert(1);">
        </a>
        <p><a href="../../" target="_self">Jesús Temprano Gallego</a> | <a href="https://store.steampowered.com/" target="_blank">Pagina imitada</a> | 16/12/2025</p>
    </footer>
</body>
</html>