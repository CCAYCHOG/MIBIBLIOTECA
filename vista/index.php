<!doctype html>
<html lang="es" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Nombre del Autor">
  <title>Sistema MiBiblioteca</title>
  <!-- Bootstrap 5.3 -->
  <link href="vista/assets/css/bootstrap5.3/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="vista/assets/css/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vista/assets/css/estilos.css?v=<?php echo filemtime('vista/assets/css/estilos.css'); ?>" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="vista/assets/image/favicon.ico">
</head>
<body>
  <div id="loader">
    <div class="logo-container">
      <img src="vista/assets/image/mibiblioteca.png" alt="Mi Biblioteca" class="logo-loader">
      <div class="circle"></div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
      <button class="btn btn-outline-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav" aria-controls="offcanvasNav">
        <img src="vista/assets/image/mibiblioteca.png" alt="Menu" class="img-fluid" style="width: 24px; height: 24px;">
      </button>
      <a class="navbar-brand ms-lg-2" href="#">
        <img src="vista/assets/image/mibiblioteca.png" alt="Biblioteca" class="img-fluid" style="width: 30px; height: 30px;">
        MiBiblioteca
      </a>
    </div>
  </nav>

  <div class="app-shell">
    <!-- Sidebar desktop / Offcanvas mobile -->
    <aside class="sidebar p-3 d-none d-lg-block">
      <h6 class="text-uppercase text-secondary mb-3">Módulos</h6>
      <div class="list-group" id="entityList" role="tablist">
        <button class="list-group-item list-group-item-action active" data-bs-toggle="list" data-bs-target="#tab-libro" role="tab"><i class="bi bi-book"></i> Libros</button>
        <button onclick="BIB_ObtenerAutoresActivos();" class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-autor" role="tab"><i class="bi bi-person"></i> Autores</button>
        <button class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-editorial" role="tab"><i class="bi bi-buildings"></i> Editoriales</button>
        <button class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-categoria" role="tab"><i class="bi bi-tags"></i> Categorías</button>
        <button class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-tipocubierta" role="tab"><i class="bi bi-layers"></i> Tipos de cubierta</button>
        <button class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-estante" role="tab"><i class="bi bi-grid-3x3-gap"></i> Estantes</button>
        <button class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-libroautor" role="tab"><i class="bi bi-link-45deg"></i> Libro ↔ Autor</button>
      </div>
    </aside>

    <!-- Offcanvas for mobile -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNav">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title"><i class="bi bi-journal-bookmark"></i> Biblioteca</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body sidebar">
        <div class="list-group" role="tablist">
          <button class="list-group-item list-group-item-action active" data-bs-toggle="list" data-bs-target="#tab-libro" data-bs-dismiss="offcanvas" role="tab"><i class="bi bi-book"></i> Libros</button>
          <button onclick="BIB_ObtenerAutoresActivos();" class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-autor" data-bs-dismiss="offcanvas" role="tab"><i class="bi bi-person"></i> Autores</button>
          <button class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-editorial" data-bs-dismiss="offcanvas" role="tab"><i class="bi bi-buildings"></i> Editoriales</button>
          <button class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-categoria" data-bs-dismiss="offcanvas" role="tab"><i class="bi bi-tags"></i> Categorías</button>
          <button class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-tipocubierta" data-bs-dismiss="offcanvas" role="tab"><i class="bi bi-layers"></i> Tipos de cubierta</button>
          <button class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-estante" data-bs-dismiss="offcanvas" role="tab"><i class="bi bi-grid-3x3-gap"></i> Estantes</button>
          <button class="list-group-item list-group-item-action" data-bs-toggle="list" data-bs-target="#tab-libroautor" data-bs-dismiss="offcanvas" role="tab"><i class="bi bi-link-45deg"></i> Libro ↔ Autor</button>
        </div>
      </div>
    </div>

    <!-- Content -->
    <main class="content">
      <div class="tab-content" id="tabContent">
        <!-- ===================== LIBRO ===================== -->
        <section class="tab-pane fade show active" id="tab-libro" role="tabpanel">
          <div class="card mb-3">
            <div class="card-body d-flex flex-wrap gap-2 align-items-center">
              <div class="input-group flex-grow-1" style="max-width:560px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input class="form-control table-search" data-table="table-libro" placeholder="Buscar por título, ISBN, editorial, categoría...">
              </div>
              <div class="ms-auto d-flex gap-2">
                <button class="btn btn-outline-light" data-entity="libro" data-action="export"><i class="bi bi-download"></i> Exportar</button>
                <button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#modal-libro"><i class="bi bi-plus-lg"></i> Nuevo libro</button>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="table-responsive">
              <table class="table table-dark table-hover align-middle" id="table-libro">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>ISBN</th>
                    <th>Editorial</th>
                    <th>Categoría</th>
                    <th>Cubierta</th>
                    <th>Estante/Nivel</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>El nombre del viento</td>
                    <td>978-84-...</td>
                    <td>Plaza & Janés</td>
                    <td>Fantasía</td>
                    <td>Tapa dura</td>
                    <td>A1 / 2</td>
                    <td>5</td>
                    <td><span class="badge text-bg-success badge-pill">Activo</span></td>
                    <td class="text-end">
                      <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#modal-libro"><i class="bi bi-pencil"></i></button>
                      <button class="btn btn-sm btn-outline-danger" data-action="delete"><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Modal Libro -->
          <div class="modal fade" id="modal-libro" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
              <form class="modal-content needs-validation" novalidate>
                <div class="modal-header">
                  <h5 class="modal-title"><i class="bi bi-book"></i> Libro</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="row g-3">
                    <div class="col-md-8">
                      <label class="form-label">Título</label>
                      <input type="text" class="form-control" required>
                      <div class="invalid-feedback">Ingrese el título.</div>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">ISBN</label>
                      <input type="text" class="form-control" required>
                      <div class="invalid-feedback">Ingrese el ISBN.</div>
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Año publicación</label>
                      <input type="number" class="form-control" min="0" max="2100">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">N° páginas</label>
                      <input type="number" class="form-control" min="1">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Cantidad</label>
                      <input type="number" class="form-control" min="0" value="1">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Estado</label>
                      <select class="form-select">
                        <option value="1" selected>Activo</option>
                        <option value="0">Inactivo</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Editorial</label>
                      <select class="form-select" required>
                        <option selected disabled value="">Seleccione...</option>
                      </select>
                      <div class="invalid-feedback">Seleccione una editorial.</div>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Categoría</label>
                      <select class="form-select" required>
                        <option selected disabled value="">Seleccione...</option>
                      </select>
                      <div class="invalid-feedback">Seleccione una categoría.</div>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Tipo de cubierta</label>
                      <select class="form-select" required>
                        <option selected disabled value="">Seleccione...</option>
                      </select>
                      <div class="invalid-feedback">Seleccione un tipo de cubierta.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Estante</label>
                      <select class="form-select">
                        <option selected disabled value="">Seleccione...</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Nivel</label>
                      <input type="number" class="form-control" min="1">
                    </div>
                  </div>

                  <div class="form-section-title">Autores (N:N)</div>
                  <div class="row g-2 align-items-end">
                    <div class="col-md-10">
                      <select class="form-select" multiple size="4" aria-label="Seleccionar autores (Ctrl/Cmd para multi)">
                        <!-- options dinámicas -->
                      </select>
                    </div>
                    <div class="col-md-2 d-grid">
                      <button class="btn btn-outline-light" type="button"><i class="bi bi-plus"></i> Añadir autor</button>
                    </div>
                  </div>

                  <div class="accordion mt-3" id="accAuditLibro">
                    <div class="accordion-item bg-transparent">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#aud-libro">
                          <i class="bi bi-shield-lock me-2"></i> Auditoría
                        </button>
                      </h2>
                      <div id="aud-libro" class="accordion-collapse collapse" data-bs-parent="#accAuditLibro">
                        <div class="accordion-body">
                          <div class="row g-3">
                            <div class="col-md-3"><label class="form-label">Usuario registra</label><input class="form-control" type="text"></div>
                            <div class="col-md-3"><label class="form-label">Fecha registra</label><input class="form-control" type="datetime-local"></div>
                            <div class="col-md-3"><label class="form-label">IP registra</label><input class="form-control" type="text"></div>
                            <div class="col-md-3"><label class="form-label">Usuario edita</label><input class="form-control" type="text"></div>
                            <div class="col-md-3"><label class="form-label">Fecha edita</label><input class="form-control" type="datetime-local"></div>
                            <div class="col-md-3"><label class="form-label">IP edita</label><input class="form-control" type="text"></div>
                            <div class="col-md-3"><label class="form-label">Usuario elimina</label><input class="form-control" type="text"></div>
                            <div class="col-md-3"><label class="form-label">Fecha elimina</label><input class="form-control" type="datetime-local"></div>
                            <div class="col-md-3"><label class="form-label">IP elimina</label><input class="form-control" type="text"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-brand">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </section>

        <!-- ===================== AUTOR ===================== -->
        <section class="tab-pane fade" id="tab-autor" role="tabpanel">
          <div class="card mb-3">
            <div class="card-body d-flex flex-wrap gap-2 align-items-center">
              <div class="input-group flex-grow-1" style="max-width:560px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input class="form-control table-search" data-table="table-autor" id="FiltroAutor" placeholder="Buscar por nombre o apellido...">
              </div>
              <div class="ms-auto d-flex gap-2">
                <button onclick="NuevoAutor()" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#modal-autor"><i class="bi bi-plus-lg"></i> Nuevo autor</button>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="table-responsive">
              <table class="table table-dark table-hover align-middle" id="table-autor">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Nacionalidad</th>
                    <th>F. Nacimiento</th>
                    <th class="text-end">Acciones</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
              <div id="pagination-container" class="d-flex justify-content-end pe-2 pb-2"></div>
            </div>
          </div>

          <!-- Modal Autor -->
          <div class="modal fade" id="modal-autor" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content needs-validation" novalidate>
                <div class="modal-header">
                  <h5 class="modal-title"><i class="bi bi-person"></i> Autor</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="row g-3">
                    <input hidden id="IdAutor">
                    <input hidden id="pais_id">
                    <div class="col-md-6"><label class="form-label">Nombre</label><input id="nombre_autor" type="text" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">Apellido</label><input id="apellido_autor" type="text" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">Nacionalidad</label><input id="nacionalidad_autor" type="text" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Fecha nacimiento</label><input id="fnacimiento_autor" type="date" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Estado</label>
                      <select id="estado_autor" class="form-select"><option value="1" selected>Activo</option><option value="0">Inactivo</option></select>
                    </div>
                  </div>
                  <details class="mt-3">
                    <summary class="text-secondary">Campos de auditoría</summary>
                    <div class="row g-2 mt-1 small">
                      <div class="col-6"><label class="form-label">Usuario registra</label><input id="autor_usuarioregistra" class="form-control" type="text" disabled></div>
                      <div class="col-6"><label class="form-label">Fecha registra</label><input id="autor_fecharegistra" class="form-control" type="datetime-local" disabled></div>
                      <div class="col-6"><label class="form-label">IP registra</label><input id="autor_ipregistra" class="form-control" type="text" disabled></div>
                      <div class="col-6"><label class="form-label">Usuario edita</label><input id="autor_usuarioedita" class="form-control" type="text" disabled></div>
                      <div class="col-6"><label class="form-label">Fecha edita</label><input id="autor_fechaedita" class="form-control" type="datetime-local" disabled></div>
                      <div class="col-6"><label class="form-label">IP edita</label><input id="autor_ipedita" class="form-control" type="text" disabled></div>
                    </div>
                  </details>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" id="btnCancelarAutor">Cancelar</button>
                  <button type="submit" class="btn btn-brand" id="btnGuardarAutor">Guardar</button>
                </div>
              <div>
            </div>
          </div>
        </section>

        <!-- ===================== EDITORIAL ===================== -->
        <section class="tab-pane fade" id="tab-editorial" role="tabpanel">
          <div class="card mb-3">
            <div class="card-body d-flex flex-wrap gap-2 align-items-center">
              <div class="input-group flex-grow-1" style="max-width:560px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input class="form-control table-search" data-table="table-editorial" placeholder="Buscar por nombre o correo...">
              </div>
              <div class="ms-auto d-flex gap-2">
                <button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#modal-editorial"><i class="bi bi-plus-lg"></i> Nueva editorial</button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="table-responsive">
              <table class="table table-dark table-hover align-middle" id="table-editorial">
                <thead>
                  <tr>
                    <th>ID</th><th>Nombre</th><th>Dirección</th><th>Teléfono</th><th>Correo</th><th>Estado</th><th class="text-end">Acciones</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
          <!-- Modal Editorial -->
          <div class="modal fade" id="modal-editorial" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <form class="modal-content needs-validation" novalidate>
                <div class="modal-header"><h5 class="modal-title"><i class="bi bi-buildings"></i> Editorial</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                  <div class="row g-3">
                    <div class="col-12"><label class="form-label">Nombre</label><input type="text" class="form-control" required></div>
                    <div class="col-12"><label class="form-label">Dirección</label><input type="text" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Teléfono</label><input type="text" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Correo</label><input type="email" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Estado</label><select class="form-select"><option value="1" selected>Activo</option><option value="0">Inactivo</option></select></div>
                  </div>
                  <details class="mt-3"><summary class="text-secondary">Campos de auditoría</summary>
                    <div class="row g-2 mt-1 small">
                      <div class="col-6"><label class="form-label">Usuario registra</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha registra</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP registra</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Usuario edita</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha edita</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP edita</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Usuario elimina</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha elimina</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP elimina</label><input class="form-control" type="text"></div>
                    </div>
                  </details>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-brand">Guardar</button></div>
              </form>
            </div>
          </div>
        </section>

        <!-- ===================== CATEGORIA ===================== -->
        <section class="tab-pane fade" id="tab-categoria" role="tabpanel">
          <div class="card mb-3">
            <div class="card-body d-flex flex-wrap gap-2 align-items-center">
              <div class="input-group flex-grow-1" style="max-width:560px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input class="form-control table-search" data-table="table-categoria" placeholder="Buscar por nombre...">
              </div>
              <div class="ms-auto d-flex gap-2">
                <button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#modal-categoria"><i class="bi bi-plus-lg"></i> Nueva categoría</button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="table-responsive">
              <table class="table table-dark table-hover align-middle" id="table-categoria">
                <thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Estado</th><th class="text-end">Acciones</th></tr></thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
          <!-- Modal Categoria -->
          <div class="modal fade" id="modal-categoria" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <form class="modal-content needs-validation" novalidate>
                <div class="modal-header"><h5 class="modal-title"><i class="bi bi-tags"></i> Categoría</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                  <div class="row g-3">
                    <div class="col-12"><label class="form-label">Nombre</label><input type="text" class="form-control" required></div>
                    <div class="col-12"><label class="form-label">Descripción</label><input type="text" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Estado</label><select class="form-select"><option value="1" selected>Activo</option><option value="0">Inactivo</option></select></div>
                  </div>
                  <details class="mt-3"><summary class="text-secondary">Campos de auditoría</summary>
                    <div class="row g-2 mt-1 small">
                      <div class="col-6"><label class="form-label">Usuario registra</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha registra</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP registra</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Usuario edita</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha edita</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP edita</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Usuario elimina</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha elimina</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP elimina</label><input class="form-control" type="text"></div>
                    </div>
                  </details>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-brand">Guardar</button></div>
              </form>
            </div>
          </div>
        </section>

        <!-- ===================== TIPO CUBIERTA ===================== -->
        <section class="tab-pane fade" id="tab-tipocubierta" role="tabpanel">
          <div class="card mb-3">
            <div class="card-body d-flex flex-wrap gap-2 align-items-center">
              <div class="input-group flex-grow-1" style="max-width:560px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input class="form-control table-search" data-table="table-tipocubierta" placeholder="Buscar por nombre...">
              </div>
              <div class="ms-auto d-flex gap-2">
                <button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#modal-tipocubierta"><i class="bi bi-plus-lg"></i> Nuevo tipo</button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="table-responsive">
              <table class="table table-dark table-hover align-middle" id="table-tipocubierta">
                <thead><tr><th>ID</th><th>Nombre</th><th>Estado</th><th class="text-end">Acciones</th></tr></thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
          <!-- Modal Tipo Cubierta -->
          <div class="modal fade" id="modal-tipocubierta" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <form class="modal-content needs-validation" novalidate>
                <div class="modal-header"><h5 class="modal-title"><i class="bi bi-layers"></i> Tipo de cubierta</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                  <div class="row g-3">
                    <div class="col-12"><label class="form-label">Nombre</label><input type="text" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">Estado</label><select class="form-select"><option value="1" selected>Activo</option><option value="0">Inactivo</option></select></div>
                  </div>
                  <details class="mt-3"><summary class="text-secondary">Campos de auditoría</summary>
                    <div class="row g-2 mt-1 small">
                      <div class="col-6"><label class="form-label">Usuario registra</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha registra</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP registra</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Usuario edita</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha edita</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP edita</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Usuario elimina</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha elimina</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP elimina</label><input class="form-control" type="text"></div>
                    </div>
                  </details>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-brand">Guardar</button></div>
              </form>
            </div>
          </div>
        </section>

        <!-- ===================== ESTANTE ===================== -->
        <section class="tab-pane fade" id="tab-estante" role="tabpanel">
          <div class="card mb-3">
            <div class="card-body d-flex flex-wrap gap-2 align-items-center">
              <div class="input-group flex-grow-1" style="max-width:560px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input class="form-control table-search" data-table="table-estante" placeholder="Buscar por código o ubicación...">
              </div>
              <div class="ms-auto d-flex gap-2">
                <button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#modal-estante"><i class="bi bi-plus-lg"></i> Nuevo estante</button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="table-responsive">
              <table class="table table-dark table-hover align-middle" id="table-estante">
                <thead><tr><th>ID</th><th>Código</th><th>Ubicación</th><th>Niveles</th><th>Estado</th><th class="text-end">Acciones</th></tr></thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
          <!-- Modal Estante -->
          <div class="modal fade" id="modal-estante" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <form class="modal-content needs-validation" novalidate>
                <div class="modal-header"><h5 class="modal-title"><i class="bi bi-grid-3x3-gap"></i> Estante</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                  <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Código</label><input type="text" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">Ubicación</label><input type="text" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">N° niveles</label><input type="number" class="form-control" min="1" value="1"></div>
                    <div class="col-md-6"><label class="form-label">Estado</label><select class="form-select"><option value="1" selected>Activo</option><option value="0">Inactivo</option></select></div>
                  </div>
                  <details class="mt-3"><summary class="text-secondary">Campos de auditoría</summary>
                    <div class="row g-2 mt-1 small">
                      <div class="col-6"><label class="form-label">Usuario registra</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha registra</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP registra</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Usuario edita</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha edita</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP edita</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Usuario elimina</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha elimina</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP elimina</label><input class="form-control" type="text"></div>
                    </div>
                  </details>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-brand">Guardar</button></div>
              </form>
            </div>
          </div>
        </section>

        <!-- ===================== LIBRO ↔ AUTOR ===================== -->
        <section class="tab-pane fade" id="tab-libroautor" role="tabpanel">
          <div class="card mb-3">
            <div class="card-body d-flex flex-wrap gap-2 align-items-center">
              <div class="input-group flex-grow-1" style="max-width:560px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input class="form-control table-search" data-table="table-libroautor" placeholder="Buscar por título o autor...">
              </div>
              <div class="ms-auto d-flex gap-2">
                <button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#modal-libroautor"><i class="bi bi-plus-lg"></i> Nuevo vínculo</button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="table-responsive">
              <table class="table table-dark table-hover align-middle" id="table-libroautor">
                <thead><tr><th>ID</th><th>Libro</th><th>Autor</th><th>Estado</th><th class="text-end">Acciones</th></tr></thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
          <!-- Modal LibroAutor -->
          <div class="modal fade" id="modal-libroautor" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <form class="modal-content needs-validation" novalidate>
                <div class="modal-header"><h5 class="modal-title"><i class="bi bi-link-45deg"></i> Vínculo Libro ↔ Autor</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                  <div class="row g-3">
                    <div class="col-12"><label class="form-label">Libro</label><select class="form-select" required><option selected disabled value="">Seleccione...</option></select></div>
                    <div class="col-12"><label class="form-label">Autor</label><select class="form-select" required><option selected disabled value="">Seleccione...</option></select></div>
                    <div class="col-md-6"><label class="form-label">Estado</label><select class="form-select"><option value="1" selected>Activo</option><option value="0">Inactivo</option></select></div>
                  </div>
                  <details class="mt-3"><summary class="text-secondary">Campos de auditoría</summary>
                    <div class="row g-2 mt-1 small">
                      <div class="col-6"><label class="form-label">Usuario registra</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha registra</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP registra</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Usuario edita</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha edita</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP edita</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Usuario elimina</label><input class="form-control" type="text"></div>
                      <div class="col-6"><label class="form-label">Fecha elimina</label><input class="form-control" type="datetime-local"></div>
                      <div class="col-6"><label class="form-label">IP elimina</label><input class="form-control" type="text"></div>
                    </div>
                  </details>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-brand">Guardar</button></div>
              </form>
            </div>
          </div>
        </section>

      </div>
    </main>
  </div>

  <script src="vista/assets/js/jquery-3.7.1.min.js"></script> 
  <script src="vista/assets/js/bootstrap5.3/bootstrap.bundle.min.js"></script>   
  <script src="vista/assets/js/sweetalert2.js"></script>
  <script src="vista/assets/js/autocomplete/jquery-ui.js"></script>
  <script src="vista/assets/js/configuracion.js?v=<?php echo filemtime('vista/assets/js/configuracion.js'); ?>"></script>
  <script src="vista/assets/js/funciones.js?v=<?php echo filemtime('vista/assets/js/funciones.js'); ?>"></script>
  <script src="vista/assets/js/index.js?v=<?php echo filemtime('vista/assets/js/index.js'); ?>"></script>
</body>
</html>
