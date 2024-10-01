<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="<?php echo $path ?>/views/pages/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Administrador</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo $path ?>/views/pages/admin/dist/img/user2-160x160.jpg"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['administrador']->name_admin ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Administradores -->
                <li class="nav-item">
                    <a href="/admin/administradores" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Administradores
                        </p>
                    </a>
                </li>

                <!-- Prensa -->
                <li class="nav-item">
                    <a href="/admin/prensa" class="nav-link">
                        <i class="nav-icon fa-solid fa-newspaper"></i>
                        <p>
                            Prensa
                        </p>
                    </a>
                </li>

                <!-- Slides -->
                <li class="nav-item">
                    <a href="/admin/slides" class="nav-link">
                        <i class="nav-icon fa-regular fa-image"></i>
                        <p>
                            Slides
                        </p>
                    </a>
                </li>

                <!-- Reclamos -->
                <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fa-solid fa-triangle-exclamation"></i>
                <p>
                    Reclamos
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="/admin/gestor_reclamos" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gestor Reclamos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/estadisticas_reclamos" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Estadísticas</p>
                    </a>
                </li>
                </ul>
            </li>

                <!-- Salir -->
                <li class="nav-item">
                    <a href="/salir" class="nav-link">
                        <i class="nav-icon fas fa-sign-out"></i>
                        <p>
                            Salir
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->


    </div>
    <!-- /.sidebar -->
</aside>