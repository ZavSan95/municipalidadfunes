<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" id="sidebar-admin">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="<?php echo $path ?>/views/pages/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Administrador</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" >
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
                
                <!-- Verificación del rol antes de mostrar "Administradores" -->
                <?php if ($_SESSION['administrador']->rol_admin == 'admin') : ?>
                <li class="nav-item">
                    <a href="/admin/administradores" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Administradores</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Verificación del rol antes de mostrar "Áreas" -->
                <?php if (in_array($_SESSION['administrador']->rol_admin, ['admin', 'supervisor'])) : ?>
                <li class="nav-item">
                    <a href="/admin/areas" class="nav-link">
                        <i class="nav-icon fa-solid fa-circle-info"></i>
                        <p>Áreas</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Verificación del rol antes de mostrar "Prensa" -->
                <?php if (in_array($_SESSION['administrador']->rol_admin, ['admin', 'prensa'])) : ?>
                <li class="nav-item">
                    <a href="/admin/prensa" class="nav-link">
                        <i class="nav-icon fa-solid fa-newspaper"></i>
                        <p>Prensa</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Verificación del rol antes de mostrar "Slides" -->
                <?php if (in_array($_SESSION['administrador']->rol_admin, ['admin', 'prensa'])) : ?>
                <li class="nav-item">
                    <a href="/admin/slides" class="nav-link">
                        <i class="nav-icon fa-regular fa-image"></i>
                        <p>Slides</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Verificación del rol antes de mostrar "Reclamos" -->
                <?php if (in_array($_SESSION['administrador']->rol_admin, ['admin', 'moderator'])) : ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-triangle-exclamation"></i>
                        <p>
                            Reclamos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
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
                <?php endif; ?>

                <!-- Verificación del rol antes de mostrar "Servicio Técnico" -->
                <?php if ($_SESSION['administrador']->rol_admin == 'admin') : ?>
                <li class="nav-item">
                    <a href="/admin/servicio_tecnico" class="nav-link">
                        <i class="nav-icon fa-solid fa-screwdriver-wrench"></i>
                        <p>Servicio Técnico</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Verificación del rol antes de mostrar "Tickets" -->
                <?php if (in_array($_SESSION['administrador']->rol_admin, ['admin', 'prensa', 'soporte'])) : ?>
                    <li class="nav-item">
                    <a href="/admin/tickets" class="nav-link">
                        <i class="nav-icon fa-solid fa-ticket"></i>
                        <p>Tickets</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Verificación del rol antes de mostrar "Salud Animal" -->
                <?php if (in_array($_SESSION['administrador']->rol_admin, ['admin', 'veterinario'])) : ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-paw"></i>
                        <p>
                            Salud Animal
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/salud_animal" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Informes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/salud_animal/tutores" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tutores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/salud_animal/mascotas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mascotas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>


                <!-- Verificación del rol antes de mostrar "Inclusión Social" -->
                <?php if (in_array($_SESSION['administrador']->rol_admin, ['admin', 'inclusion'])) : ?>
                <li class="nav-item">
                    <a href="/admin/inclusion_social" class="nav-link">
                        <i class="nav-icon fa-solid fa-people-roof"></i>
                        <p>
                            Inclusión Social
                        </p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Verificación del rol antes de mostrar "Comercios" -->
                <?php if (in_array($_SESSION['administrador']->rol_admin, ['admin', 'comercio'])) : ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa-solid fa-shop"></i>
                    <p>
                        Comercios
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/admin/estadisticas_reclamos" class="nav-link">

                            <p>Renovación Habilitación</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/tickets/" class="nav-link">

                            <p>Preinscripción Comercios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/estadisticas_reclamos" class="nav-link">

                            <p>Preinscripción Transportistas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Verificación del rol antes de mostrar "Proveedores" -->
                <?php if (in_array($_SESSION['administrador']->rol_admin, ['admin', 'proveedores'])) : ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa-solid fa-truck-fast"></i>
                    <p>
                        Proveedores
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/admin/tickets/" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Registro Proveedores</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Salir -->
                <li class="nav-item">
                    <a href="/salir" class="nav-link">
                        <i class="nav-icon fas fa-sign-out"></i>
                        <p>Salir</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>

<style>

#sidebar-admin{
    max-height: 100vh;
    overflow-y: auto !important;
}
</style>