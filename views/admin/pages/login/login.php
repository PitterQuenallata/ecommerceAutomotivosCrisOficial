


<div class="nk-wrap nk-wrap-nosidebar">
  <!-- content @s -->
  <div class="nk-content ">
    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
      <div class="brand-logo pb-4 text-center">
        <a href="html/index.html" class="logo-link">
          <img class="logo-light logo-img logo-img-lg" src="<?= BASE_URL ?>public/assets/admin/images/logo.png" srcset="<?= BASE_URL ?>public/assets/admin/images/logo2x.png 2x" alt="logo">
          <img class="logo-dark logo-img logo-img-lg" src="<?= BASE_URL ?>public/assets/admin/images/logo-dark.png" srcset="<?= BASE_URL ?>public/assets/admin/images/logo-dark2x.png 2x" alt="logo-dark">
        </a>
      </div>
      <div class="card">
        <div class="card-inner card-inner-lg">
          <div class="nk-block-head">
            <div class="nk-block-head-content">
              <h4 class="nk-block-title">Ingrsar</h4>
              <div class="nk-block-des">
                <p>Automotivos Cris</p>
              </div>
            </div>
          </div>
          <form method="post">
            <div class="form-group">
              <div class="form-label-group">
                <label class="form-label" for="default-01">Usuario</label>
              </div>
              <div class="form-control-wrap">
                <input type="text" class="form-control form-control-lg" id="default-01" placeholder="usuario" name="ingUsuario">
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <label class="form-label" for="password">Contraseña</label>
                <a class="link link-primary link-sm" href="#">Olvidate tu contraseña?</a>
              </div>
              <div class="form-control-wrap">
                <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                  <em class="passcode-icon icon-show icon ni ni-eye"></em>
                  <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                </a>
                <input type="password" class="form-control form-control-lg" id="password" placeholder="Ingrese su contraseña" name="ingPassword">
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-lg btn-primary btn-block">Ingresar</button>
            </div>
            <?php
            $login = new ControladorUsuariosAdmin();
            $login->ctrIngresoUsuario(); 
            ?>
          </form>

          <div class="text-center pt-4 pb-3">
            <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
          </div>
          <ul class="nav justify-center gx-4">
            <li class="nav-item"><a class="link link-primary fw-normal py-2 px-3 fs-13px" href="#">Facebook</a></li>
            <li class="nav-item"><a class="link link-primary fw-normal py-2 px-3 fs-13px" href="#">Google</a></li>
          </ul>
        </div>
      </div>
    </div>

  </div>
  <!-- wrap @e -->
</div>