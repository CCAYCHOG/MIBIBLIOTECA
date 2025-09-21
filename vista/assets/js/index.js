// ======= UX helpers (búsqueda en tablas y validación) =======
$(function () {
  $("#loader").hide();
  $("#btnGuardarAutor").on("click", function(){
    if($("#IdAutor").val() == ''){
      BIB_RegistrarAutor();
    }else{
      BIB_ActualizarAutor();
    }
  });
  $("#btnCancelarAutor").on("click", function(){
    NuevoAutor();
  });
  // Filtro por tabla
  /*$('.table-search').on('input', function () {
    const q = $(this).val().toLowerCase();
    const tbl = $('#' + $(this).data('table'));
    if (!tbl.length) return;
    tbl.find('tbody tr').each(function () {
      $(this).toggle($(this).text().toLowerCase().includes(q));
    });
  });

  // Buscador global (vista activa)
  $('#globalSearch').on('input', function () {
    const active = $('.tab-pane.active');
    if (!active.length) return;
    const table = active.find('table');
    if (!table.length) return;
    const q = $(this).val().toLowerCase();
    table.find('tbody tr').each(function () {
      $(this).toggle($(this).text().toLowerCase().includes(q));
    });
  });

  // Validación Bootstrap
  $('.needs-validation').on('submit', function (event) {
    const form = this;
    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      event.preventDefault();
      // Aquí se integrará la llamada a backend / stored procedures
      const toastEl = $('#toastOK')[0];
      const toast = new bootstrap.Toast(toastEl, { delay: 1500 });
      toast.show();
      const modalEl = $(form).closest('.modal')[0];
      if (modalEl) bootstrap.Modal.getInstance(modalEl).hide();
    }
    $(form).addClass('was-validated');
  });

  // Botón NUEVO (abre el modal de la pestaña activa si existe)
  $('#btnNew').on('click', function () {
    const active = $('.tab-pane.active');
    const modal = active.find('.modal')[0];
    if (modal) new bootstrap.Modal(modal).show();
  });

  // Eliminar (UI)
  let deleteTarget = null;
  $(document).on('click', '[data-action="delete"]', function () {
    deleteTarget = $(this).closest('tr');
    new bootstrap.Modal($('#modalConfirmDelete')[0]).show();
  });

  $('#btnConfirmDelete').on('click', function () {
    if (deleteTarget) deleteTarget.remove();
    bootstrap.Modal.getInstance($('#modalConfirmDelete')[0]).hide();
  });*/
});
