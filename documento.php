<!doctype html>
<html lang="es">

<head>

    <meta charset="utf-8" />
    <title>Documento</title>
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

                                    <h4 class="card-title">Crear Documento</h4>

                                    <form action="includes/crearDocumento.php" method="POST">
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Código:</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" class="form-control" name="codigo">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Tipo de documento:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="tipo_documento">
                                                    <!-- Agregar opciones dinámicamente desde la base de datos -->
                                                    <?php
                                                    // Incluir el archivo de conexión a la base de datos
                                                    require 'includes/conTest.php';

                                                    // Consulta SQL para obtener los nombres de la tabla "usuarios"
                                                    $sql = "SELECT * FROM documentos_tipo";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $id_documento_tipo  = $row["id_documento_tipo"];
                                                            $nombre = $row["nombre"];
                                                            /* $cargo = $row["cargo"]; */
                                                            echo "<option value='$id_documento_tipo'>$nombre</option>";
                                                        }
                                                    }

                                                    // Cerrar la conexión a la base de datos
                                                    $conn->close();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Número:</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="numero" required pattern="[0-9]*">
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Año:</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="anio" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Entidad Remitente:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="entidad_remitente" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Suscrito:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="suscrito" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Destinatario o Cargo:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="destinatario_o_cargo" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Entidad:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="entidad" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Carpeta Fiscal:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="carpeta_fiscal" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Dirección:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="direccion" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Observaciones:</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="observaciones" rows="4" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Estado:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="estado">
                                                    <!-- Agregar opciones dinámicamente desde la base de datos -->
                                                    <?php
                                                    // Incluir el archivo de conexión a la base de datos
                                                    require 'includes/conTest.php';

                                                    // Consulta SQL para obtener los estados de la tabla "estadoDocumento"
                                                    $consulta = "SELECT * FROM estadoDocumento";
                                                    $resultado = $conn->query($consulta);

                                                    if ($resultado->num_rows > 0) {
                                                        while ($fila = $resultado->fetch_assoc()) {
                                                            $id_estado_documento = $fila["id_estado_documento"];
                                                            $nombre_estado_documento = $fila["nombre_estado_documento"];
                                                            echo "<option value='$id_estado_documento'>$nombre_estado_documento</option>";
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
                                                <th>Código</th>
                                                <th>Tipo de Documento</th>
                                                <th>Estado</th>
                                                <th>Número</th>
                                                <th>Año</th>
                                                <th>Entidad Remitente</th>
                                                <th>Suscrito</th>
                                                <th>Destinatario o Cargo</th>
                                                <th>Entidad</th>
                                                <th>Carpeta Fiscal</th>
                                                <th>Dirección</th>
                                                <th>Fecha de Creación</th>
                                                <th>Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Incluir el archivo con la conexión a la base de datos
                                            include 'includes/conTest.php';

                                            // Consulta SQL para obtener los datos de la tabla nuevoDocumento
                                            $sql = "SELECT nd.codigo, dt.nombre,nd.estado,nd.numero, nd.anio,nd.entidad_remitente,nd.suscrito, nd.destinatario_o_cargo, nd.entidad,
                                            nd.carpeta_fiscal, nd.direccion,nd.fecha_creacion,nd.observaciones 
                                             FROM nuevoDocumento nd inner join documentos_tipo dt on dt.id_documento_tipo=nd.tipo_documento order by id desc";

                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['codigo'] . "</td>";
                                                    echo "<td>" . $row['nombre'] . "</td>";
                                                      
                                                    // Aquí se verifica el valor de $row['estado'] y se muestra la etiqueta correspondiente
                                                    echo "<td>";
                                                    if ($row['estado'] == 1) {
                                                        echo '<span class="badge rounded-pill bg-primary">Ingresado</span>';
                                                    } elseif ($row['estado'] == 2) {
                                                        echo '<span class="badge rounded-pill bg-info">Cargo</span>';
                                                    } elseif ($row['estado'] == 3) {
                                                        echo '<span class="badge rounded-pill bg-success">Aceptado</span>';
                                                    } elseif ($row['estado'] == 4) {
                                                        echo '<span class="badge rounded-pill bg-danger">Rechazado</span>';
                                                    } else {
                                                        // Manejar otros valores de $row['estado'] si es necesario
                                                        echo '<span class="badge rounded-pill bg-secondary">Desconocido</span>';
                                                    }
                                                    echo "</td>";
                                                    echo "<td>" . $row['numero'] . "</td>";
                                                    echo "<td>" . $row['anio'] . "</td>";
                                                    echo "<td>" . $row['entidad_remitente'] . "</td>";
                                                    echo "<td>" . $row['suscrito'] . "</td>";
                                                    echo "<td>" . $row['destinatario_o_cargo'] . "</td>";
                                                    echo "<td>" . $row['entidad'] . "</td>";
                                                    echo "<td>" . $row['carpeta_fiscal'] . "</td>";
                                                    echo "<td>" . $row['direccion'] . "</td>";
                                                    echo "<td>" . $row['fecha_creacion'] . "</td>";
                                                    echo "<td>" . $row['observaciones'] . "</td>";
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