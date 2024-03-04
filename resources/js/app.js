//require('./bootstrap');

console.log('Hola mundo');
$(document).ready(function () {
    $('.ejemplo-1').select2();
});

const optionsData = {

    "language": {
        "lengthMenu": 'Mostrar <select>' +
            '<option value="2">2</option>' +
            '<option value="5">5</option>' +
            '<option value="10">10</option>' +
            '<option value="20">20</option>' +
            '<option value="30">30</option>' +
            '<option value="-1">Todas</option>' +
            '</select> registros por página.',
        "zeroRecords": "No existen registros con esos parámetros.",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "No existen registros.",
        "infoFiltered": "(filtrado para un máximo de _MAX_ registros)",
        "loadingRecords": "Cargando registros...",
        "processing": "Procesando registros...",
        "search": "Buscar en la tabla: ",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": ">",
            "previous": "<"
        }
    }
}

$(document).ready(function () {
    $('#tablaAdministrador').DataTable(optionsData);
    $('#tablaUsuarios').DataTable(optionsData);
    $('#tablaEnlaces').DataTable(optionsData);
    $('#tablaRDSP').DataTable(optionsData);
    $('#tablaUsuariosRol').DataTable(optionsData);
    $('#tablaServidoresPublicos').DataTable(optionsData);
    $('#tablaOtros').DataTable(optionsData);
    $('#tablaCatgem').DataTable(optionsData);
    $('#tablaPersonales').DataTable(optionsData);
    $('#tablaCedulas').DataTable(optionsData);
    $('#tablaAdminsDesact').DataTable(optionsData);
    $('#tablaUsersDesact').DataTable(optionsData);
    $('#tablaEnlacesDesact').DataTable(optionsData);
    $('#tablaRDSPDesact').DataTable(optionsData);
    $('#tablaCedulasPublic').DataTable(optionsData);
    $('#tablaBandejaEntrada').DataTable(optionsData);
    $('#tablaCedulasRecha').DataTable(optionsData);
    $('#tablaCedulasInstruccion').DataTable(optionsData);
    $('#tablaCedulasInstRecha').DataTable(optionsData);
    $('#tablaCedulaEnv').DataTable(optionsData);
    //#Delegado
    $('#delEnviadas').DataTable(optionsData);
    $('#delPendientes').DataTable(optionsData);
    // Nuevas datatables LFGB
    $('#tablaCedulasEnviadasEnlace').DataTable(optionsData);
    $('#tablaBusquedaEnlace').DataTable(optionsData);
    $('#tablaPeriodoVacacional').DataTable(optionsData);
    // ------------------------------------------------------
})


/* let tablaGris = document.querySelector('#tablagris');
let tablaAzul = document.querySelector('#tablaazul');


let celda = tablaGris.firstChild.parentNode.childNodes[1]
let celdaAzul = tablaAzul.firstChild.parentNode.childNodes[1]

celda.classList.add('prueba-gris');
celdaAzul.classList.add('prueba-azul');
 */

