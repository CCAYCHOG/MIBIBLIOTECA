function BIB_RegistrarAutor(){
    $("#loader").show(); 
    let IdAutor = $("#IdAutor").val();
    if(IdAutor == ''){
        let datos = {
            nombre_autor: $("#nombre_autor").val(),
            apellido_autor: $("#apellido_autor").val(),
            nacionalidad_autor: $("#pais_id").val(),
            fnacimiento_autor: $("#fnacimiento_autor").val(),
            estado_autor: $("#estado_autor").val(),
            usuario: getUrlParameter("idusuario")
        }
        $.post("controlador/BIB_RegistrarAutor.php", { datos: datos }, function(RegistrarAutor) {
            $("#loader").hide();
            if (RegistrarAutor && RegistrarAutor.length > 0) {
                BIB_ObtenerAutoresActivos();
                $("#IdAutor").val(RegistrarAutor[0].Datos);
                Swal.fire({
                    title: RegistrarAutor[0].Mensaje,
                    icon: RegistrarAutor[0].Tipo,
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                });
            } else {
                Swal.fire({
                    title: "Sin respuesta del servidor",
                    icon: "warning",
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        }, "json").fail(function(xhr, status, error) {
            $("#loader").hide();
            Swal.fire({
                title: "Error en la conexión",
                text: error,
                icon: "error",
                showConfirmButton: true
            });
        });
    }
}

function BIB_ActualizarAutor(){
    $("#loader").show(); 
    let IdAutor = $("#IdAutor").val();
    if(IdAutor != ''){
        let datos = {
            IdAutor: $("#IdAutor").val(),
            nombre_autor: $("#nombre_autor").val(),
            apellido_autor: $("#apellido_autor").val(),
            nacionalidad_autor: $("#pais_id").val(),
            fnacimiento_autor: $("#fnacimiento_autor").val(),
            estado_autor: $("#estado_autor").val(),
            usuario: getUrlParameter("idusuario")
        }
        $.post("controlador/BIB_ActualizarAutor.php", { datos: datos }, function(ActualizarAutor) {
            $("#loader").hide();             
            if (ActualizarAutor && ActualizarAutor.length > 0) {
                BIB_ObtenerAutoresActivos();
                $("#btnCancelarAutor").click();
                Swal.fire({
                    title: ActualizarAutor[0].Mensaje,
                    icon: ActualizarAutor[0].Tipo,
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true
                });
            } else {
                Swal.fire({
                    title: "Sin respuesta del servidor",
                    icon: "warning",
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        }, "json").fail(function(xhr, status, error) {
            $("#loader").hide();
            Swal.fire({
                title: "Error en la conexión",
                text: error,
                icon: "error",
                showConfirmButton: true
            });
        });
    }
}

function BIB_ObtenerAutoresActivos(pInicio = 1, pCantidad = 12) {
    let pFiltro = $("#FiltroAutor").val();
    $.post("controlador/BIB_ContarAutoresActivos.php", {}, function (ContarAutoresActivos) {
        if (ContarAutoresActivos && ContarAutoresActivos[0].Datos) {
            let totalRegistros = ContarAutoresActivos[0].Datos;
            let totalPaginas = Math.ceil(totalRegistros / pCantidad);
            $.post("controlador/BIB_ObtenerAutoresActivos.php", { pInicio, pCantidad, pFiltro}, function (ObtenerAutoresActivos) {
                $("#table-autor").find("tbody").empty();
                $("#table-autor").find("tbody").html(ObtenerAutoresActivos);
                let paginacion = `<nav><ul class="pagination pagination-sm mb-0">`;
                for (let i = 1; i <= totalPaginas; i++) {
                    let activo = (i === Math.ceil(pInicio / pCantidad)) ? "active" : "";
                    paginacion += `
                        <li class="page-item ${activo}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                        </li>`;
                }
                paginacion += `</ul></nav>`;
                $("#pagination-container").html(paginacion);
                $("#pagination-container .page-link").click(function (e) {
                    e.preventDefault();
                    let pagina = $(this).data("page");
                    let nuevoInicio = (pagina - 1) * pCantidad + 1;
                    BIB_ObtenerAutoresActivos(nuevoInicio, pCantidad);
                });
            }).fail(function (xhr, status, error) {
                Swal.fire({
                    title: "Error en la conexión",
                    text: error,
                    icon: "error",
                    showConfirmButton: true
                });
            });
        }
    }, "json").fail(function(xhr, status, error) {
        Swal.fire({
            title: "Error en la conexión",
            text: error,
            icon: "error",
            showConfirmButton: true
        });
    });
}

function BIB_ObtenerAutorPorId(Id){    
    $("#loader").show(); 
    $.post("controlador/BIB_ObtenerAutorPorId.php", {IdAutor: Id}, function(ObtenerAutorPorId){
        $("#loader").hide();
        if(ObtenerAutorPorId && ObtenerAutorPorId.Codigo == 200){
            $("#IdAutor").val(Id);
            let autor = ObtenerAutorPorId.Datos[0];
            $("#nombre_autor").val(autor.Nombre ? autor.Nombre.toUpperCase() : "");
            $("#apellido_autor").val(autor.Apellido ? autor.Apellido.toUpperCase() : "");
            $("#nacionalidad_autor").val(autor.Nacionalidad ? autor.Nacionalidad.toUpperCase() : "");
            $("#fnacimiento_autor").val(autor.FechaNacimiento || "");
            $("#estado_autor").val(autor.Estado || "");
            $("#autor_usuarioregistra").val(autor.UsuarioRegistra ? autor.UsuarioRegistra.toUpperCase() : "");
            $("#autor_usuarioedita").val(autor.UsuarioEdita ? autor.UsuarioEdita.toUpperCase() : "");
            $("#autor_fecharegistra").val(autor.FechaRegistra ? autor.FechaRegistra.toUpperCase() : "");
            $("#autor_fechaedita").val(autor.FechaEdita ? autor.FechaEdita.toUpperCase() : "");
            $("#autor_ipregistra").val(autor.IpRegistra ? autor.IpRegistra.toUpperCase() : "");
            $("#autor_ipedita").val(autor.IpEdita ? autor.IpEdita.toUpperCase() : "");
            $("#pais_id").val(autor.IdPais ? autor.IdPais : "");
        }
    }, "json").fail(function(xhr, status, error) {
        $("#loader").hide(); 
        Swal.fire({
            title: "Error en la conexión",
            text: error,
            icon: "error",
            showConfirmButton: true
        });
    });
}

function BIB_EliminarAutorPorId(Id) {    
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6', // Azul
        cancelButtonColor: '#d33',     // Rojo
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {        
        if (result.isConfirmed) {
            $("#loader").show(); 
            $.post("controlador/BIB_EliminarAutorPorId.php", { IdAutor: Id, usuario: getUrlParameter("idusuario")}, function (BIB_EliminarAutorPorId) {
                $("#loader").hide();
                if(BIB_EliminarAutorPorId && BIB_EliminarAutorPorId.length > 0){
                    BIB_ObtenerAutoresActivos();
                    Swal.fire({
                        title: BIB_EliminarAutorPorId[0].Mensaje,
                        icon: BIB_EliminarAutorPorId[0].Tipo,
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                } else{
                    Swal.fire({
                        title: "Sin respuesta del servidor",
                        icon: "warning",
                        timer: 2000,
                        showConfirmButton: false
                    });
                }                
            }).fail(function(xhr, status, error) {
                $("#loader").hide(); 
                Swal.fire({
                    title: "Error en la conexión",
                    text: error,
                    icon: "error",
                    showConfirmButton: true
                });
            });
        }
    });
}

function NuevoAutor(){
    $("#IdAutor").val("");
    $("#nombre_autor").val("");
    $("#apellido_autor").val("");
    $("#nacionalidad_autor").val("");
    $("#fnacimiento_autor").val("");
    $("#estado_autor").val(1);
    $("#autor_usuarioregistra").val("");
    $("#autor_usuarioedita").val("");
    $("#autor_fecharegistra").val("");
    $("#autor_fechaedita").val("");
    $("#autor_ipregistra").val("");
    $("#autor_ipedita").val("");
}

$(function() {
    $("#nacionalidad_autor").autocomplete({
        source: function(request, response) {
            $.post("controlador/BIB_BuscarPaises.php", { term: request.term }, function(data) {
                response($.map(data, function(item) {
                    return {
                        label: item.Nombre.toUpperCase(), // lo que muestra en la lista
                        value: item.Nombre.toUpperCase(), // lo que coloca en el input
                        id: item.IdPais     // id oculto
                    };
                }));
            }, "json");
        },
        minLength: 2, // mínimo de letras para buscar
        appendTo: "#modal-autor",
        select: function(event, ui) {
            $("#pais_id").val(ui.item.id); // guarda el IdPais en hidden
        },
        open: function() {
            // Ajustar el ancho al del input
            $(".ui-autocomplete").css("width", $("#nacionalidad_autor").outerWidth() + "px");
        }
    });
});