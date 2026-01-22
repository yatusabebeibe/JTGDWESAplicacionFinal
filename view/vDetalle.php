<style> .hero-text > div:first-child { margin-top: 1.3rem; } </style>
<div class="hero-text">
    <?php
        // Creamos un array con las superglobales para recorrerlas fácilmente
        $variablesSuperglobales = [
            '_SESSION' => $_SESSION ?? [], // Lo crea si no esta creado
            '_COOKIE' => $_COOKIE,
            '_SERVER' => $_SERVER,
            '_REQUEST' => $_REQUEST,
            '_GET' => $_GET,
            '_POST' => $_POST,
            '_FILES' => $_FILES,
            '_ENV' => $_ENV
        ];

        // Recorremos cada superglobal
        foreach ($variablesSuperglobales as $nombresVariables=>$variables) {
            echo "<div class='center $nombresVariables'>";
            echo "<h2>" . $nombresVariables . "</h2>"; // Mostramos el nombre de la superglobal
            echo "<table><tr>"; // Creamos la tabla para mostrar sus valores
            foreach ($variables as $valor => $datos) {

                // Si el valor no es string, lo convertimos a string usando print_r
                if (is_array($datos) || is_object($datos)) {
                    // Usamos nl2br para convertir los `/n` en `<br>` y que haya saltos de linea
                    $datos = "<pre>" . print_r($datos, true) . "</pre>";
                }

                // Mostramos cada clave y su valor en la tabla
                echo '<tr><td class="e">' . $valor . '</td><td class="v">' . $datos . '</pre></td></tr>';
            }
            echo "</tr></table>";
            echo "</div>";
        }
        // Mostramos la información completa de PHP
        echo "<div>".phpinfo()."</div>";
    ?>
</div>
<style>
    body { background: var(--color-bg-body); }
    a:link{ color: var(--color-primary); text-decoration: unset; background-color: unset; }
    th { top: 67px; }
    @media (prefers-color-scheme: light) { body { color: #E2E4EF; } table { color: #222;} }
</style>