<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Administración</b> Funes
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="loginAdminEmail" class="form-control required" placeholder="Correo Electrónico">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="passwordAdmin" class="form-control required" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" onchange="rememberEmail(event)">
              <label for="remember">
                Recordarme
              </label>
            </div>
          </div>
          
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
          </div>

          <?php

            require_once 'controllers/controller.admin.php';
            $login = new AdminsController();
            $login->login();

          ?>
          
        </div>
      </form>


      <p class="mb-1">
        <a href="#resetPassword" data-bs-toggle="modal">¿Olvidaste tu clave?</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->



<!-- Modal Reset Password -->

<div class="modal fade" id="resetPassword">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Recuperar Contraseña</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p class="login-box-msg">¿Olvidaste tu clave? Solicita una nueva aquí.</p>

        <form action="" method="post">

          <div class="input-group mb-3">
            <input type="email" name="resetPassword" class="form-control required" placeholder="Correo Electrónico">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-default btn block py-2">Nueva Contraseña</button>
            </div>
          </div>

          <?php 

          require_once 'controllers/controller.admin.php';
          $reset = new AdminsController();
          $reset->resetPassword();
          ?>

        </form>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
  
</body>