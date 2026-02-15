<style>
    #man > table .deBaja { color: gray; }
    #man > .formularios {
        margin-bottom: 30px;
        display: grid;
        --espacios: 1fr;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: auto auto;
        grid-template-areas:
            ". x x y ."
            ". x x y .";
    }
    .x { grid-area: x; }
    .y { grid-area: y; }
</style>

<div id="man" class="manUsuarios">
    <div class="formularios">
        <form method="post" class="x">
            <div>
                <input type="text" name="buscar" placeholder="Texto a buscar" autofocus>
            </div>
        </form>
        <form method="post" class="y"><input type="submit" value="Crear usuario" name="crear"></form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Descripción</th>
                <th>Num conexiones</th>
                <th>Perfil</th>
                <th>Ultima conexion</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <script type="module">
        import { obtenerUsuarios } from "./webroot/js/utilUsuarios.js";
        import { generarTabla } from "./webroot/js/utilTablas.js";

        // elementos
        const tabla = document.querySelector("tbody");
        const busqueda = document.querySelector(
            "#man > .formularios > form:nth-child(1) input[name=buscar]"
        );

        let listaUsuarios = [];

        async function cargarUsuarios(texto = "") {
            listaUsuarios = await obtenerUsuarios(texto);
            tabla.innerHTML = "";
            generarTabla(listaUsuarios, tabla);
        }

        // cargar estado inicial
        const busquedaGuardada = sessionStorage.getItem("busquedaUsuarios");
        if (busquedaGuardada !== null) {
            busqueda.value = busquedaGuardada;
            await cargarUsuarios(busquedaGuardada);
        } else {
            await cargarUsuarios();
        }

        // evento
        busqueda.addEventListener("keyup", async () => {
            sessionStorage.setItem("busquedaUsuarios", busqueda.value);
            await cargarUsuarios(busqueda.value);
        });
    </script>
</div>