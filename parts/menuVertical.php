<?php
session_start();
include 'includes/conexion.php'; // Incluir el archivo de conexión

if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redireccionar a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: login.php");
    exit();
}

// El usuario ha iniciado sesión, puedes acceder a los datos de sesión
$usuario = $_SESSION['usuario'];
$dni = $_SESSION['dni'];
$tipoUsuario = $_SESSION['tipoUsuario'];
$empresaUser =$_SESSION['empresaUser'] ;



?>
<!-- ========== Left Sidebar Start ========== -->
<?php $tipoUsuario =$_SESSION['tipoUsuario'];  ?>

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="documento.php" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                        <span>Documento</span>
                    </a>
                </li>
                <li>
                    <a href="asignacion.php" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">4</span>
                        <span>Asignaciones</span>
                    </a>
                </li>

                <li>
                <?php 
                if ($_SESSION['tipoUsuario'] == 1) {
                        echo '<a href="nuevo_usuario.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">' . $vendidos . '</span>
                            <span>Crear Usuario</span>
                        </a>';
                    }

                    ?>

                </li>
            </ul>
            <!-- end ul -->
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->