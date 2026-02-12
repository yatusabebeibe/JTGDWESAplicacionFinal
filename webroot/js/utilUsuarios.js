export const obtenerUsuarios = (descripcion = "") => {
    return fetch(`api/wsBuscaUsuariosPorDescripcion.php?desc=${descripcion}`)
        .then(res => res.json())
        .then(data => {return data;})
        .catch(() => {return null;})
};