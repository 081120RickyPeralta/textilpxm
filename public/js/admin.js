/**
 * Script del panel de administración
 * Usa SweetAlert2 para confirmaciones (https://sweetalert2.github.io/)
 */
function confirmarEliminar(url, accion) {
    var titulo, texto, icono;
    switch (accion) {
        case 'eliminar':
            titulo = '¿Eliminar producto?';
            texto = 'El producto se marcará como inactivo.';
            icono = 'warning';
            break;
        default:
            titulo = '¿Continuar?';
            texto = '';
            icono = 'question';
    }
    Swal.fire({
        title: titulo,
        text: texto,
        icon: icono,
        showCancelButton: true,
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then(function(result) {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
    return false;
}
