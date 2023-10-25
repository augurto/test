<!doctype html>
<html lang="es">

<head>

    <meta charset="utf-8" />
    <title>Asignaciones</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php
        include './parts/nav.php';
        include './parts/menuVertical.php'
        ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <!-- INICIO DATOS -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Asignar Documento</h4>

                                    <form action="includes/crearAsignacion.php" method="POST">

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Buscar documento:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="documento">
                                                    <!-- Agregar opciones dinámicamente desde la base de datos -->
                                                    <?php
                                                    // Incluir el archivo de conexión a la base de datos
                                                    require 'includes/conTest.php';

                                                    // Consulta SQL para obtener los nombres de la tabla "usuarios"
                                                    $sql = "SELECT nd.id,nd.codigo,nd.numero,dt.nombre FROM nuevoDocumento nd inner join documentos_tipo dt on nd.id= dt.id_documento_tipo order by  id desc";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $id  = $row["id"];
                                                            $codigo = $row["codigo"];
                                                            $tipo_documento = $row["tipo_documento"];
                                                            $numero = $row["numero"];
                                                            $nombre = $row["nombre"];
                                                            echo "<option value='$id'>$nombre / $codigo / $numero</option>";
                                                        }
                                                    }

                                                    // Cerrar la conexión a la base de datos
                                                    $conn->close();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Seleccionar Courier:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="courier">
                                                    <!-- Agregar opciones dinámicamente desde la base de datos -->
                                                    <?php
                                                    // Incluir el archivo de conexión a la base de datos
                                                    require 'includes/conTest.php';

                                                    // Consulta SQL para obtener los estados de la tabla "estadoDocumento"
                                                    $consulta = "SELECT * FROM users";
                                                    $resultado = $conn->query($consulta);

                                                    if ($resultado->num_rows > 0) {
                                                        while ($fila = $resultado->fetch_assoc()) {
                                                            $user_id = $fila["user_id"];
                                                            $nombres = $fila["nombres"];
                                                            $telefono = $fila["telefono"];
                                                            echo "<option value='$user_id'>$nombres / $telefono </option>";
                                                        }
                                                    }

                                                    // Cerrar la conexión a la base de datos
                                                    $conn->close();

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Seleccionar Dependencia:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="dependencia">
                                                    <?php
                                                    // Incluir el archivo de conexión a la base de datos
                                                    require 'includes/conTest.php';

                                                    $consulta2 = "SELECT * FROM dependencias";
                                                    $resultado2 = $conn->query($consulta2);

                                                    if ($resultado2->num_rows > 0) {
                                                        while ($fila2 = $resultado2->fetch_assoc()) {
                                                            $id_dependencia = $fila2["id_dependencia"];
                                                            $nombre = $fila2["nombre"];
                                                            $sigla = $fila2["sigla"];
                                                            echo "<option value='$id_dependencia'>$nombre / $sigla </option>";
                                                        }
                                                    }

                                                    // Cerrar la conexión a la base de datos
                                                    $conn->close();

                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                                <!-- end cardbody -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <!-- INICIO TABLA -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Ultimos 100 Documentos</h4>
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Código de Documento</th>
                                                <th>Courier</th>
                                                <th>Dependencia</th>
                                                <th>Fecha de Asignación</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Incluir el archivo con la conexión a la base de datos
                                            include 'includes/conTest.php';

                                            // Consulta SQL para obtener los datos de la tabla nuevaAsignacion
                                            $sql_asignacion = "SELECT * FROM nuevaAsignacion";

                                            $result_asignacion = $conn->query($sql_asignacion);

                                            if ($result_asignacion->num_rows > 0) {
                                                while ($row_asignacion = $result_asignacion->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row_asignacion['id_documento'] . "</td>"; // Nombre de campo a reemplazar
                                                    echo "<td>" . $row_asignacion['id_courier'] . "</td>"; // Nombre de campo a reemplazar
                                                    echo "<td>" . $row_asignacion['id_dependencia'] . "</td>"; // Nombre de campo a reemplazar
                                                    echo "<td>" . $row_asignacion['fecha_asignacion'] . "</td>"; // Nombre de campo a reemplazar
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "No se encontraron registros.";
                                            }

                                            // Cerrar la conexión a la base de datos
                                            $conn->close();

                                            ?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                    <!-- FIN TABLA -->

                    <!-- FIN DATOS -->





                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <?php include './parts/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php include './parts/sidebar.php'; ?>


    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/js/pages/form-advanced.init.js"></script>


    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>