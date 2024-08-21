<main class="main__content_wrapper">

  <div class="login__section section--padding">
    <div class="container">

      <!-- Start login section -->
      <div class="login__section d-flex justify-content-center align-items-center">
        <div class="login__section--inner col-md-6 col-lg-12">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-auto">


              <?php
              if (isset($routesArray[1]) && $routesArray[1] == "register") {
                include "modules/formRegister.php";
              } else {
                include "modules/formLogin.php";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <!-- End login section -->


    </div>
  </div>
</main>