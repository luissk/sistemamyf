<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL?>/admin" class="brand-link">
        <img src="<?php echo BASE_URL?>/public/img/logo/logo-m-y-f-200.jpg" alt="logo" class="brand-image elevation-3"
           style="opacity: .8">
        <span class="brand-text font-weight-light">M y F</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo BASE_URL?>/public/img/users/default.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo BASE_URL?>/admin" class="d-block"><?php echo $_SESSION['nombres']?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="<?php echo BASE_URL?>/admin/categorias" class="nav-link <?php echo $datos['active_categorias']?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Categorías
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?php echo BASE_URL?>/admin/productos" class="nav-link <?php echo $datos['active_productos']?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?php echo BASE_URL?>/admin/slider" class="nav-link <?php echo $datos['active_sliders']?>">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>
                            Sliders
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?php echo BASE_URL?>/admin/usuarios" class="nav-link <?php echo $datos['active_usuarios']?>">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Usuarios
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL?>/admin/salir" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
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