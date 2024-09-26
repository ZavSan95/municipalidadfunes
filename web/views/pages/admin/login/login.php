<body class="hold-transition login-page">
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="login-box">
    <div class="login-logo">
      <b>Administración</b> Funes
    </div>

    <!-- Card Container -->
    <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="max-width: 400px;">
      <div class="card-body login-card-body">
        <p class="login-box-msg"></p>

        <!-- Login Form -->
        <form action="" method="post">
          <!-- Email Field -->
          <div class="input-group mb-3">
            <input type="email" name="loginAdminEmail" class="form-control required" placeholder="Correo Electrónico" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <!-- Password Field -->
          <div class="input-group mb-3">
            <input type="password" name="passwordAdmin" class="form-control required" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <!-- Remember me and Log In Button -->
          <div class="row mb-3 align-items-center">
            <div class="col-6 d-flex align-items-center ">
              <input type="checkbox" id="remember" name="remember" onchange="rememberEmail(event)" style="margin-right: 10px;">
              <label for="remember" class="mb-0" style="width: 23rem;">Recordarme</label>
            </div>
            <div class="col-6 text-end">
              <button type="submit" class="btn btn-primary">Log In</button>
            </div>
          </div>

          <!-- PHP Login Controller -->
          <?php
            require_once 'controllers/controller.admin.php';
            $login = new AdminsController();
            $login->login();
          ?>
        </form>

        <!-- Forgot Password -->
        <p class="mb-1">
          <a href="#resetPassword" data-bs-toggle="modal">¿Olvidaste tu clave?</a>
        </p>
      </div>
    </div>
  </div>
</div>






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
