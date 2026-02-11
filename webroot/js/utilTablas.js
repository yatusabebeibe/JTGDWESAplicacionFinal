export const crearCelda = (valor) => {
    let celda = document.createElement("td");

    celda.innerText = valor;

    return celda;
}

export const crearCeldaOpciones = (codigo) => {
    let celda = document.createElement("td");

    let formulario = document.createElement("form");
        formulario.setAttribute("method", "post");
        formulario.setAttribute("class", "formEdicion");

        formulario.appendChild( crearInputCustom("hidden", "codUsuario", codigo ?? "") );
        formulario.appendChild( crearInputCustom("submit", "ver", "👁️", "Ver") );
        formulario.appendChild( crearInputCustom("submit", "borrar", "🗑️", "Borrar") );

    celda.appendChild(formulario)
    return celda;
}

export const crearInputCustom = (type, name, value, title=null) => {
    let input = document.createElement("input");

    input.setAttribute("type", type);
    input.setAttribute("value", value);
    input.setAttribute("name", name);
    if (title) {
        input.setAttribute("title", title);
    }

    return input;
}

export const generarTabla = async (listaUsuarios, tabla) => {
    for (const usuario of listaUsuarios) {
        let tr = document.createElement("tr");

        tr.appendChild(crearCelda(usuario.codigo));
        tr.appendChild(crearCelda(usuario.descripcion));
        tr.appendChild(crearCelda(usuario.numConexiones));
        tr.appendChild(crearCelda(usuario.perfil));
        const fecha = new Date(usuario.ultimaConexion);
        tr.appendChild(crearCelda(fecha.toLocaleString()));
        tr.appendChild(crearCeldaOpciones(usuario.codigo));

        tabla.appendChild(tr)
    }
}