<!-- sidebar @s -->
<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
  <!-- title -->
  <div class="nk-sidebar-element nk-sidebar-head">
    <div class="nk-sidebar-brand">
      <a href="html/index.html" class="logo-link nk-sidebar-logo">
        <img class="logo-light logo-img" src="<?= BASE_URL ?>public/assets/ecommerce/logoHoriz.png" srcset="<?= BASE_URL ?>public/assets/admin/images/logo2x.png 2x" alt="logo">
        <img class="logo-dark logo-img" src="<?= BASE_URL ?>public/assets/ecommerce/logoHoriz.png" srcset="<?= BASE_URL ?>public/assets/admin/images/logo-dark2x.png 2x" alt="logo-dark">
        <img class="logo-small logo-img logo-img-small" src="<?= BASE_URL ?>public/assets/ecommerce/iconCrisWhitee.png" srcset="<?= BASE_URL ?>public/assets/admin/images/logo-small2x.png 2x" alt="logo-small">
      </a>
    </div>
    <div class="nk-menu-trigger me-n2">
      <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
      <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
    </div>
  </div><!-- .nk-sidebar-element -->

  <div class="nk-sidebar-element">
    <div class="nk-sidebar-content">
      <div class="nk-sidebar-menu" data-simplebar>
        <ul class="nk-menu">


          <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Panel Administrtivo</h6>
          </li><!-- .nk-menu-item -->
          <li class="nk-menu-item">
            <a href="html/index.html" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-bag"></em></em></span>
              <span class="nk-menu-text">Ecommerce</span>
            </a>
          </li><!-- .nk-menu-item -->
          <li class="nk-menu-item">
            <a href="html/index-sales.html" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-cart-fill"></em></span>
              <span class="nk-menu-text">Tienda</span>
            </a>
          </li><!-- .nk-menu-item -->

          <li class="nk-menu-item">
            <a href="/admin/user" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
              <span class="nk-menu-text">Usuarios</span>
            </a>
          </li>

          <li class="nk-menu-item has-sub">
            <a href="#" class="nk-menu-link nk-menu-toggle">
              <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
              <span class="nk-menu-text">Inventario</span>
            </a>
            <ul class="nk-menu-sub">
              <li class="nk-menu-item">
                <a href="html/product-list.html" class="nk-menu-link"><span class="nk-menu-text">Product List</span></a>
              </li>
              <li class="nk-menu-item">
                <a href="html/product-card.html" class="nk-menu-link"><span class="nk-menu-text">Product Card</span></a>
              </li>
              <li class="nk-menu-item">
                <a href="html/product-details.html" class="nk-menu-link"><span class="nk-menu-text">Product Details</span></a>
              </li>
            </ul><!-- .nk-menu-sub -->
          </li><!-- .nk-menu-item -->

          <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Ecommerce</h6>
          </li><!-- .nk-menu-heading -->

          <li class="nk-menu-item">
            <a href="#" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-bag-fill"></em></span>
              <span class="nk-menu-text">Ordenes</span>
            </a>
          </li><!-- .nk-menu-item -->
          <li class="nk-menu-item">
            <a href="#" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-package-fill"></em></span>
              <span class="nk-menu-text">Repuestos</span>
            </a>
          </li><!-- .nk-menu-item -->
          <li class="nk-menu-item">
            <a href="#" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
              <span class="nk-menu-text">Clientes</span>
            </a>
          </li><!-- .nk-menu-item -->
          <li class="nk-menu-item">
            <a href="#" class="nk-menu-link">
              <span class="nk-menu-icon"><em class="icon ni ni-chat-fill"></em></span>
              <span class="nk-menu-text">Soporte</span>
            </a>
          </li><!-- .nk-menu-item -->

          
          <li class="nk-menu-item has-sub">
            <a href="#" class="nk-menu-link nk-menu-toggle">
              <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
              <span class="nk-menu-text">Recibos de Orden</span>
            </a>
            <ul class="nk-menu-sub">
              <li class="nk-menu-item">
                <a href="html/invoice-list.html" class="nk-menu-link"><span class="nk-menu-text">Invoice List</span></a>
              </li>
              <li class="nk-menu-item">
                <a href="html/invoice-details.html" class="nk-menu-link"><span class="nk-menu-text">Invoice Details</span></a>
              </li>
            </ul><!-- .nk-menu-sub -->
          </li><!-- .nk-menu-item -->





          <li class="nk-menu-heading">
            <h6 class="overline-title text-primary-alt">Tienda</h6>
          </li><!-- .nk-menu-heading -->



          
        </ul><!-- .nk-menu -->
      </div><!-- .nk-sidebar-menu -->
    </div><!-- .nk-sidebar-content -->
  </div><!-- .nk-sidebar-element -->
</div>
<!-- sidebar @e -->