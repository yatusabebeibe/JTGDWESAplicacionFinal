<div class="hero-text">
    <h1>Ha habido un error inesperado</h1>
    <style>
        pre {margin: 5px; margin-bottom: 15px;}
    </style>
    <br>
    <h2>Código de error:</h2>
    <pre><?= $avError['codError'] ?></pre>
    <h3>Descripción del error:</h3>
    <pre><?= $avError['descError'] ?></pre>
    <h3>Archivo donde se ha producido el error:</h3>
    <pre><?= $avError['archivoError'] ?></pre>
    <h3>Línea del archivo donde se ha producido el error:</h3>
    <pre><?= $avError['lineaError'] ?></pre>
</div>