<!-- content @s -->
<div class="nk-content ">
  <div class="container-fluid">
    <div class="nk-content-inner">
      <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
          <div class="nk-block-between">

            <div class="nk-block-head-content">
              <h3 class="nk-block-title page-title">Lista de Usuarios</h3>
              <div class="nk-block-des text-soft">
                <p>Total de usuarios</p>
              </div>
            </div><!-- .nk-block-head-content -->

            <div class="nk-block-head-content">
              <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="more-options">
                  <ul class="nk-block-tools g-3">
                    <li>
                      <div class="form-control-wrap">
                        <div class="form-icon form-icon-right">
                          <em class="icon ni ni-search"></em>
                        </div>
                        <input type="text" class="form-control" id="default-04" placeholder="Search by name">
                      </div>
                    </li>
                    <li>
                      <div class="drodown">
                        <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Status</a>
                        <div class="dropdown-menu dropdown-menu-end">
                          <ul class="link-list-opt no-bdr">
                            <li><a href="#"><span>Actived</span></a></li>
                            <li><a href="#"><span>Inactived</span></a></li>
                            <li><a href="#"><span>Blocked</span></a></li>
                          </ul>
                        </div>
                      </div>
                    </li>
                    <li class="nk-block-tools-opt">
                      <a href="#" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                      <a href="/admin/user/gestn" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div><!-- .nk-block-head-content -->

          </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->


        <div class="nk-block nk-block-lg">


          <div class="card card-preview">
            <table class="table table-tranx is-compact">
              <thead>
                <tr class="tb-tnx-head">
                  <th class="tb-tnx-id"><span class="">#</span></th>
                  <th class="tb-tnx-info">Nombre</th>
                  <th>Apellido</th>
                  <th>Usuario</th>
                  <th>Email</th>
                  <th>Telefono</th>
                  <th>Fecha</th>
                  <th>Rol</th>
                  <th>Estado</th>
                  <th class="tb-tnx-action">Accion</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $usuarios = ControladorUsuariosAdmin::ctrMostrarUsuarios(null, null);
                foreach ($usuarios as $key => $value) {
                ?>
                  <tr class="tb-tnx-item">
                    <td class="tb-tnx-id"><?php echo ($key + 1); ?></td>
                    <td class="tb-tnx-info"><?php echo $value["nombre_usuario"]; ?></td>
                    <td class="tb-tnx-info"><?php echo $value["apellido_usuario"]; ?></td>
                    <td class="tb-tnx-info"><?php echo $value["user_usuario"]; ?></td>
                    <td class="tb-tnx-info"><?php echo $value["email_usuario"]; ?></td>
                    <td class="tb-tnx-info"><?php echo $value["telefono_usuario"]; ?></td>
                    <td class="tb-tnx-info"><?php echo $value["date_updated_usuario"]; ?></td>
                    <td class="tb-tnx-info"><?php echo $value["rol_usuario"]; ?></td>
                    <?php
                    if ($value["estado_usuario"] == 1) {
                      $class = "badge badge-dot bg-success";
                      $estado = "Activo";
                    } else {
                      $class = "badge badge-dot bg-danger";
                      $estado = "Inactivo";
                    } 
                    echo '<td class="tb-tnx-info"><div class="tb-tnx-status"><span class="'.$class.'">'.$estado.'</span></div></td>'
                    ?>
                    <td class="tb-tnx-action">
                      <div class="dropdown">
                      <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                      <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                          <ul class="link-list-plain">
                            <li><a href="/admin/user/gestn?idUsuarioEdit=<?php echo $value["id_usuario"]; ?>">Editar</a></li>
                            <li><a href="/admin/user/list?idUsuarioEliminar=<?php echo $value["id_usuario"]; ?>">Eliminar</a></li>
                          </ul>
                        </div>
                      </div>
                    </td>

                  </tr>
                <?php

                }
                ?>
              </tbody>
            </table>
          </div><!-- .card -->
        </div>

      </div>
    </div>
  </div>
</div>
<!-- content @e -->

<?php
// $eliminarUsuario = new ControladorUsuariosAdmin();
// $eliminarUsuario->ctrBorrarUsuario();