<?php
session_start();
if (!isset($_SESSION['correo'])) {
    echo '<script>window.location = "index.php";</script>';
    session_destroy();
    die();
}
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en" translate="no">

<head>
    <title>Administrador Biossman</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="img/favicon/favicon-ike.ico" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/buttons.dataTables.min.css">
    <link rel="stylesheet" href="vendor/sweetalert/sweetalert2.min.css">
    <link href="vendor/toastr/toastr.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

        .bg-gradient-primary {
            background: linear-gradient(195deg, #004b85, #4b90cd);
            background-size: cover;
        }

        .navbar {
            background: linear-gradient(150deg, #004b85, #4b90cd);
        }

        #pswd_info {
            position: absolute;
            bottom: -18%;
            bottom: -45%\9;
            right: 10%;
            width: 80%;
            padding: 15px;
            background: #fefefe;
            font-size: .875em;
            border-radius: 5px;
            box-shadow: 0 1px 3px #ccc;
            border: 1px solid #ddd;
        }

        #pswd_info h4 {
            margin: 0 0 10px 0;
            padding: 0;
            font-weight: normal;
        }

        #pswd_info::before {
            content: "\25B2";
            position: absolute;
            top: -12px;
            left: 45%;
            font-size: 14px;
            line-height: 14px;
            color: #ddd;
            text-shadow: none;
            display: block;
        }

        .invalid {
            color: #e74a3b;
        }

        .valid {
            color: #1cc88a;
        }

        #pswd_info {
            display: none;
        }

        .toast {
            background-color: #BD362F;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul id="listMenu" class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="administrador.php">
                <img src="img/logos/logo-ike.png" class="login-logo" style="width: 40%;">

            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menú
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="administrador.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <!-- Nav Item - Charts -->
            <li id="submenu" class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <!-- Nav Item - Charts -->
            <li id="submenu" class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-user-check"></i>
                    <span>Clientes</span>
                </a>
            </li>
            <li id="submenu" class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-box-open"></i>
                    <span>Productos</span>
                </a>
            </li>
            <li id="submenu" class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Cursos</span>
                </a>
            </li>
            <li id="submenu" class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>Puntos</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesion</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand h3 mb-0 text-gray-100 font-weight-bold" href="administrador.php" style="margin-left:30%">
                        <h4>Administrador <i class="fas fa-cog fa-lg"></i> Biossman</h4>
                    </a>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span id="nameUser" class="mr-4 d-none d-lg-inline text-gray-100"><?php echo $_SESSION['nombre']; ?></span>
                                <img class="img-profile rounded-circle" src="img/example-user.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cambiar Contraseña
                                </a> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div id="main-body">
                    <div class="container-fluid">

                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <center>
                                    <img src="img/bienvenidos.png" class="login-logo" style="width: 100%;">
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; IKÉ 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Usuario Modal-->
    <?php include "views/modal/modal_usuario.php"; ?>

    <!-- Logout Modal-->
    <?php include "views/modal/modal_cerrar_sesion.php"; ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/translations/es.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="vendor/dataTables.buttons.min.js"></script>
    <script src="vendor/buttons.flash.min.js"></script>
    <script src="vendor/jszip.min.js"></script>
    <script src="vendor/pdfmake.min.js"></script>
    <script src="vendor/vfs_fonts.js"></script>
    <script src="vendor/buttons.html5.min.js"></script>

    <script src="vendor/sweetalert/sweetalert2.all.min.js"></script>
    <script src="vendor/toastr/toastr.min.js"></script>
    <script src="vendor/charts/loader.js"></script>

    <script>
        let editor;

        function validateText(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            $('#messageName').html('');
            $('#clientName').css('border-color', '');
            $('#nationality').css('border-color', '');
            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8)
                return true;

            // Patrón de entrada, en este caso solo acepta numeros y letras
            patron = /^[ a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/;
            tecla_final = String.fromCharCode(tecla);

            return patron.test(tecla_final);
        }

        function validateTextNum(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            $('#messageName').html('');
            $('#clientName').css('border-color', '');
            $('#nationality').css('border-color', '');
            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8)
                return true;

            // Patrón de entrada, en este caso solo acepta numeros y letras
            patron = /^[ a-zA-ZñÑáéíóúÁÉÍÓÚ 0-9]+$/;
            tecla_final = String.fromCharCode(tecla);

            return patron.test(tecla_final);
        }

        function validateNum(e) {
            $('#postalCode').css('border-color', '');
            tecla = (document.all) ? e.keyCode : e.which;
            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8)
                return true;

            // Patrón de entrada, en este caso solo acepta numeros y letras
            patron = /[0-9]/;
            tecla_final = String.fromCharCode(tecla);

            return patron.test(tecla_final);
        }

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "150",
            "hideDuration": "500",
            "timeOut": "5000",
            "extendedTimeOut": "500",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "positionClass": "toast-bottom-right",
            "className": "position-fixed"
        }

        $('ul#listMenu.navbar-nav li#submenu').click(function(e) {
            var option = "";
            var url
            option = $(this).find("span").text().toLowerCase();

            url = "views/" + option + ".php";

            $.ajax({
                url: url,
                cache: false,
                type: 'POST',
                data: {},
                success: function(data) {
                    $('#main-body').html(data);
                    if (option == 'usuarios')
                        datatableUsuarios(option);
                    else if (option == 'clientes')
                        datatableClientes(option);
                    else if (option == 'productos')
                        datatableProductos(option);
                    else if (option == 'cursos')
                        datatableCursos(option);
                },
                error: function(request, status, error) {
                    console.log('Ha ocurrido un error!');
                }
            });

        });

        function datatableUsuarios(option) {
            var table = $('#t' + option).DataTable({
                "processing": true,
                "autoWidth": true,
                "responsive": true,
                "ajax": {
                    'type': 'POST',
                    'url': 'backend/querys.php',
                    'data': {
                        action: option
                    },
                },
                "columns": [{
                        "data": "id_usuario",
                        "width": "5%"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "correo",
                        "width": "10%"
                    },
                    {
                        "data": "estatus"
                    },
                    {
                        "data": "password"
                    },
                    {
                        "data": "fecha_alta",
                        "width": "20%"
                    },
                    {
                        "data": null,
                        "width": "5%",
                        "className": "text-center",
                        render: function(data, type, row) {
                            return tableModificarUsuario(data.id_usuario, data.nombre, data.correo, data.password);
                        }
                    },
                    {
                        "data": null,
                        "width": "5%",
                        "className": "text-center",
                        render: function(data, type, row) {
                            return tableDesactivarUsuario(data.id_usuario, data.estatus);
                        }
                    }
                ],

                "conditionalPaging": {
                    style: 'fade',
                    speed: 500
                },
                "lengthMenu": [
                    [5, 10, -1],
                    [5, 10, "Todos"]
                ],
                "language": {
                    url: 'vendor/datatables/Spanish.json'
                }
            });

            table.columns([3, 4]).visible(false);
        }

        function tableModificarUsuario(id_usuario, nombre, correo, password) {
            return "<button type='button' class='btn btn-primary' title='Modificar Usuario' onclick='abrirModalModificarUsuario(" + id_usuario + ",\"" + nombre + "\",\"" + correo + "\",\"" + password + "\");'><span class='fas fa-edit fa-sm' aria-hidden='true'></span></button>";
        }

        function tableDesactivarUsuario(id_usuario, estatus) {
            if (estatus == 0)
                return "<button type='button' class='btn btn-danger' title='Habilitar Usuario' onclick='cambiarEstatusUsuario(" + id_usuario + "," + estatus + ");'><span class='fas fa-user-alt-slash fa-sm' aria-hidden='true'></span></button>";
            else
                return "<button type='button' class='btn btn-success' title='Deshabilitar Usuario' onclick='cambiarEstatusUsuario(" + id_usuario + "," + estatus + ");'><span class='fas fa-user-alt-slash fa-sm' aria-hidden='true'></span></button>";
        }

        $(document).on("click", "#btnCrearUsuario", function(e) {
            e.preventDefault();
            $('#formUsuarios').trigger('reset');
            $("#btnModalCrearUsuario").html('Crear Usuario');
            $("#btnModalCrearUsuario").removeClass("btn-secondary");
            $("#btnModalCrearUsuario").addClass("btn-success");
            $('#userModal').modal('show');
            action = 'crearUsuario';
        });

        function abrirModalModificarUsuario(id_usuario, nombre, correo, password) {
            $('#inputIdUser').val(id_usuario);
            $('#inputName').val(nombre);
            $('#inputEmail').val(correo);
            $('#inputPassword').val(password);

            $("#btnModalCrearUsuario").removeClass("btn-success");
            $("#btnModalCrearUsuario").addClass("btn-primary");
            $("#btnModalCrearUsuario").html('Modificar Usuario');
            $('#userModal').modal('show');
            action = 'modificarUsuario';
        }

        function cambiarEstatusUsuario(id_usuario, estatus) {
            if (estatus == 1) {
                title = "¿Desea desactivar el usuario?";
                confirmButtonText = "Desactivar";
            } else {
                title = "¿Desea habilitar el usuario?";
                confirmButtonText = "Activar";
            }
            showWait();
            $.ajax({
                url: 'backend/querys.php',
                cache: false,
                type: 'POST',
                data: {
                    action: 'cambiarEstatusUsuario',
                    id_usuario: id_usuario,
                    estatus: estatus
                },
                success: function(data) {
                    Swal.close();
                    var tipo = "";
                    if (data.mensaje == "Se actualizo el estatus, con éxito!")
                        tipo = "success";
                    else
                        tipo = "error";

                    Swal.fire(data.mensaje, "", tipo);
                    refrescarDatatable('usuarios');
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        }

        $('#formUsuarios').submit(function(e) {
            e.preventDefault();
            var id = $.trim($('#inputIdUser').val());
            var name = $.trim($('#inputName').val());
            var email = $.trim($('#inputEmail').val());
            var pass = $.trim($('#inputPassword').val());

            if (name == "") {
                toastr.error("Ingresa el nombre.");
                $('#inputName').focus();
                return false;
            }

            if (email == "") {
                toastr.error("Ingresa el correo electrónico.");
                $('#inputEmail').focus();
                return false;
            } else if (!validateEmail(email)) {
                toastr.error("La dirección de correo no es valida example@ikeasistencia.com");
                $("#lemail").focus();
                return false;
            }

            if (pass == "") {
                toastr.error("Ingresa la contraseña.");
                $('#inputPassword').focus();
                return false;
            }

            if (action != "modificarUsuario") {
                id = "";
            }
            showWait();
            $.ajax({
                url: "backend/querys.php",
                cache: false,
                type: 'POST',
                data: {
                    action: action,
                    id: id,
                    name: name,
                    email: email,
                    pass: pass
                },
                success: function(data) {
                    Swal.close();
                    var tipo = "";
                    var mensaje = "";
                    if (data.codigo == 200) {
                        tipo = "success";
                        mensaje = data.mensaje;
                    } else if (data.codigo == 418) {
                        tipo = "error";
                        mensaje = data.mensaje;
                    } else {
                        tipo = "error";
                        mensaje = data.mensaje;
                    }

                    Swal.fire(data.mensaje, "", tipo);
                    refrescarDatatable('usuarios');
                    $('#userModal').modal('hide');
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        });

        function datatableClientes(option) {
            var table = $('#t' + option).DataTable({
                "processing": true,
                "autoWidth": true,
                "responsive": true,
                "dom": 'lBfrtip',
                "buttons": [{         
                    title: '',           
                    extend: 'excelHtml5',
                    text: '<img src="img/excel.png" alt="Exportar a Excel" title="Exportar a Excel" style="width:28px;heigth:28px;" />',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6]
                    }                    
                }],
                "ajax": {
                    'type': 'POST',
                    'url': 'backend/querys.php',
                    'data': {
                        action: option
                    },
                },
                "columns": [{
                        "data": "id_cliente",
                        "width": "5%"
                    },
                    {
                        "data": 'nombre'
                    },
                    {
                        "data": "rfc"
                    },
                    {
                        "data": "fecha_nacimiento"
                    },
                    {
                        "data": "correo"
                    },
                    {
                        "data": "puntos"
                    },
                    {
                        "data": "fecha_alta"
                    },
                    {
                        "data": "estatus",
                        "width": "5%"
                    },
                    {
                        "data": null,
                        "width": "5%",
                        "className": "text-center",
                        render: function(data, type, row) {
                            return tableDesactivarCliente(data.id_cliente, data.estatus);
                        }
                    }
                ],

                "conditionalPaging": {
                    style: 'fade',
                    speed: 500
                },
                "lengthMenu": [
                    [5, 10, -1],
                    [5, 10, "Todos"]
                ],
                "language": {
                    url: 'vendor/datatables/Spanish.json'
                }
            });

            table.columns([3, 4, 7]).visible(false);
        }

        function tableDesactivarCliente(id_cliente, estatus) {
            if (estatus == 0)
                return "<button type='button' class='btn btn-danger' title='Habilitar Cliente' onclick='cambiarEstatusCliente(" + id_cliente + "," + estatus + ");'><span class='fas fa-user-alt-slash fa-sm' aria-hidden='true'></span></button>";
            else
                return "<button type='button' class='btn btn-success' title='Deshabilitar Cliente' onclick='cambiarEstatusCliente(" + id_cliente + "," + estatus + ");'><span class='fas fa-user-alt-slash fa-sm' aria-hidden='true'></span></button>";
        }

        function cambiarEstatusCliente(id_cliente, estatus) {
            if (estatus == 1) {
                title = "¿Desea desactivar el cliente?";
                confirmButtonText = "Desactivar";
            } else {
                title = "¿Desea habilitar el cliente?";
                confirmButtonText = "Activar";
            }
            showWait();
            $.ajax({
                url: 'backend/querys.php',
                cache: false,
                type: 'POST',
                data: {
                    action: 'cambiarEstatusCliente',
                    id_cliente: id_cliente,
                    estatus: estatus
                },
                success: function(data) {
                    Swal.close();
                    var tipo = "";
                    if (data.mensaje == "Se actualizo el estatus, con éxito!")
                        tipo = "success";
                    else
                        tipo = "error";

                    Swal.fire(data.mensaje, "", tipo);
                    refrescarDatatable('clientes');
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        }

        function datatableProductos(option) {
            var table = $('#t' + option).DataTable({
                "processing": true,
                "autoWidth": true,
                "responsive": true,
                "ajax": {
                    'type': 'POST',
                    'url': 'backend/querys.php',
                    'data': {
                        action: option
                    },
                },
                "columns": [{
                        "data": "id_producto"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "imagen"
                    },
                    {
                        "data": "descripcion_corta"
                    },
                    {
                        "data": "descripcion_larga"
                    },
                    {
                        "className": "text-center",
                        "data": "puntos"
                    },
                    {
                        "data": "estatus"
                    },
                    {
                        "className": "text-center",
                        "data": "fecha_alta"
                    },
                    {
                        "data": null,
                        "width": "5%",
                        "className": "text-center",
                        render: function(data, type, row) {
                            return tableModificarProducto(data);
                        }
                    },
                    {
                        "data": null,
                        "width": "5%",
                        "className": "text-center",
                        render: function(data, type, row) {
                            return tableDesactivarProducto(data.id_producto, data.estatus);
                        }
                    }
                ],

                "conditionalPaging": {
                    style: 'fade',
                    speed: 500
                },
                "lengthMenu": [
                    [5, 10, -1],
                    [5, 10, "Todos"]
                ],
                "language": {
                    url: 'vendor/datatables/Spanish.json'
                }
            });

            table.columns([2, 4, 6, 7]).visible(false);
        }

        function tableModificarProducto(data) {
            return "<button type='button' class='btn btn-primary' title='Modificiar Producto' onclick='formModificarProducto(" + JSON.stringify(data) + ");'><span class='fas fa-edit fa-sm' aria-hidden='true'></span></button>";
        }

        function tableDesactivarProducto(id_producto, estatus) {
            if (estatus == 0)
                return "<button type='button' class='btn btn-danger' title='Habilitar Producto' onclick='desactivarProducto(" + id_producto + "," + estatus + ");'><span class='fas fa-trash fa-sm' aria-hidden='true'></span></button>";
            else
                return "<button type='button' class='btn btn-success' title='Deshabilitar Producto' onclick='desactivarProducto(" + id_producto + "," + estatus + ");'><span class='fas fa-trash fa-sm' aria-hidden='true'></span></button>";
        }

        function formModificarProducto(producto) {
            // e.preventDefault();
            showWait();
            $.ajax({
                url: 'views/form-productos.php',
                cache: false,
                type: 'POST',
                data: {},
                success: function(data) {
                    Swal.close();
                    $('#main-body').html(data);
                    $('#inputIdProducto').val(producto.id_producto);
                    $('#inputProducto').val(producto.nombre);
                    $('#inputPuntos').val(producto.puntos);
                    $('#inputDescripcionCorta').val(producto.descripcion_corta);
                    $("#selectedImage").attr("src", producto.imagen);
                    $('#btnCrearProducto').attr("id", "btnModificarProducto");
                    $('#btnModificarProducto').html("Modificar Producto");
                    $('#btnModificarProducto').removeClass('btn-success');
                    $('#btnModificarProducto').addClass('btn-primary');

                    CKEDITOR.ClassicEditor.create(document.getElementById("inputDescripcionLarga"), {
                            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                            toolbar: {
                                items: [
                                    'selectAll', '|',
                                    'heading', '|',
                                    'bold', 'italic', 'strikethrough', 'underline', '|',
                                    'bulletedList', 'numberedList', 'todoList', '|',
                                    'outdent', 'indent', '|',
                                    'undo', 'redo', '|',
                                    'fontSize', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                                    'alignment', '|',
                                    'horizontalLine'
                                ],
                                shouldNotGroupWhenFull: true
                            },
                            // Changing the language of the interface requires loading the language file using the <script> tag.
                            language: 'es',
                            list: {
                                properties: {
                                    styles: true,
                                    startIndex: true,
                                    reversed: true
                                }
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                            heading: {
                                options: [{
                                        model: 'paragraph',
                                        title: 'Paragraph',
                                        class: 'ck-heading_paragraph'
                                    },
                                    {
                                        model: 'heading1',
                                        view: 'h1',
                                        title: 'Heading 1',
                                        class: 'ck-heading_heading1'
                                    },
                                    {
                                        model: 'heading2',
                                        view: 'h2',
                                        title: 'Heading 2',
                                        class: 'ck-heading_heading2'
                                    },
                                    {
                                        model: 'heading3',
                                        view: 'h3',
                                        title: 'Heading 3',
                                        class: 'ck-heading_heading3'
                                    },
                                    {
                                        model: 'heading4',
                                        view: 'h4',
                                        title: 'Heading 4',
                                        class: 'ck-heading_heading4'
                                    },
                                    {
                                        model: 'heading5',
                                        view: 'h5',
                                        title: 'Heading 5',
                                        class: 'ck-heading_heading5'
                                    },
                                    {
                                        model: 'heading6',
                                        view: 'h6',
                                        title: 'Heading 6',
                                        class: 'ck-heading_heading6'
                                    }
                                ]
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                            fontSize: {
                                options: [10, 12, 14, 'default', 18, 20, 22],
                                supportAllValues: true
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                            link: {
                                decorators: {
                                    addTargetToExternalLinks: true,
                                    defaultProtocol: 'https://',
                                    toggleDownloadable: {
                                        mode: 'manual',
                                        label: 'Downloadable',
                                        attributes: {
                                            download: 'file'
                                        }
                                    }
                                }
                            },
                            // The "superbuild" contains more premium features that require additional configuration, disable them below.
                            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                            removePlugins: [
                                // These two are commercial, but you can try them out without registering to a trial.
                                // 'ExportPdf',
                                // 'ExportWord',
                                'AIAssistant',
                                'CKBox',
                                'CKFinder',
                                'EasyImage',
                                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                                // Storing images as Base64 is usually a very bad idea.
                                // Replace it on production website with other solutions:
                                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                                // 'Base64UploadAdapter',
                                'MultiLevelList',
                                'RealTimeCollaborativeComments',
                                'RealTimeCollaborativeTrackChanges',
                                'RealTimeCollaborativeRevisionHistory',
                                'PresenceList',
                                'Comments',
                                'TrackChanges',
                                'TrackChangesData',
                                'RevisionHistory',
                                'Pagination',
                                'WProofreader',
                                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                                'MathType',
                                // The following features are part of the Productivity Pack and require additional license.
                                'SlashCommand',
                                'Template',
                                'DocumentOutline',
                                'FormatPainter',
                                'TableOfContents',
                                'PasteFromOfficeEnhanced',
                                'CaseChange'
                            ]
                        })
                        .then(newEditor => {
                            editor = newEditor;
                            editor.setData(producto.descripcion_larga);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        };

        $(document).on("click", "#btnModificarProducto", function(e) {
            e.preventDefault();
            var id_producto = $('#inputIdProducto').val().trim();
            var producto = $('#inputProducto').val().trim();
            var puntos = $('#inputPuntos').val().trim();
            var descripcionCorta = $('#inputDescripcionCorta').val().trim();
            var descripcionLarga = editor.getData().trim();
            var file = document.getElementById('file').files[0];

            if (producto == "") {
                toastr.error("Ingrese el nombre del producto.");
                $('#inputProducto').focus();
                return false;
            }

            if (puntos == "") {
                toastr.error("Ingrese los puntos.");
                $('#inputPuntos').focus();
                return false;
            }

            if (descripcionCorta == "") {
                toastr.error("Ingresa la descripción corta.");
                $('#inputDescripcionCorta').focus();
                return false;
            }

            if (descripcionLarga == "") {
                toastr.error("Ingresa la descripción larga.");
                $('#inputDescripcionLarga').focus();
                return false;
            }

            var form_data = new FormData();
            form_data.append('id_producto', id_producto);
            form_data.append('producto', producto);
            form_data.append('puntos', puntos);
            form_data.append('descripcionCorta', descripcionCorta);
            form_data.append('descripcionLarga', descripcionLarga);
            form_data.append('action', "modificarProducto");

            if ($("#file").val() != "") {
                form_data.append('file', file);
            }

            showWait();
            $.ajax({
                url: "backend/querys.php",
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                data: form_data,
                success: function(data) {
                    var tipo = "";
                    Swal.close();
                    if (data.codigo == 200) {
                        tipo = "success";
                        mensaje = data.mensaje;
                        $.ajax({
                            url: 'views/productos.php',
                            cache: false,
                            type: 'POST',
                            data: {},
                            success: function(data) {
                                $('#main-body').html(data);
                                refrescarDatatable("productos");
                                Swal.fire(mensaje, "", tipo);
                            },
                            error: function(request, status, error) {
                                console.log('Ha ocurrido un error!');
                            }
                        });
                    } else {
                        tipo = "error";
                        mensaje = "Ha ocurrido un error!";
                    }
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });

        });

        $(document).on("click", "#btnTableCrearProducto", function(e) {
            e.preventDefault();
            $("#btnCrearProducto").attr("id", "btnCrearProducto");
            showWait();
            $.ajax({
                url: 'views/form-productos.php',
                cache: false,
                type: 'POST',
                data: {},
                success: function(data) {
                    Swal.close();
                    $('#main-body').html(data);
                    CKEDITOR.ClassicEditor.create(document.getElementById("inputDescripcionLarga"), {
                            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                            toolbar: {
                                items: [
                                    'selectAll', '|',
                                    'heading', '|',
                                    'bold', 'italic', 'strikethrough', 'underline', '|',
                                    'bulletedList', 'numberedList', 'todoList', '|',
                                    'outdent', 'indent', '|',
                                    'undo', 'redo', '|',
                                    'fontSize', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                                    'alignment', '|',
                                    'horizontalLine'
                                ],
                                shouldNotGroupWhenFull: true
                            },
                            // Changing the language of the interface requires loading the language file using the <script> tag.
                            language: 'es',
                            list: {
                                properties: {
                                    styles: true,
                                    startIndex: true,
                                    reversed: true
                                }
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                            heading: {
                                options: [{
                                        model: 'paragraph',
                                        title: 'Paragraph',
                                        class: 'ck-heading_paragraph'
                                    },
                                    {
                                        model: 'heading1',
                                        view: 'h1',
                                        title: 'Heading 1',
                                        class: 'ck-heading_heading1'
                                    },
                                    {
                                        model: 'heading2',
                                        view: 'h2',
                                        title: 'Heading 2',
                                        class: 'ck-heading_heading2'
                                    },
                                    {
                                        model: 'heading3',
                                        view: 'h3',
                                        title: 'Heading 3',
                                        class: 'ck-heading_heading3'
                                    },
                                    {
                                        model: 'heading4',
                                        view: 'h4',
                                        title: 'Heading 4',
                                        class: 'ck-heading_heading4'
                                    },
                                    {
                                        model: 'heading5',
                                        view: 'h5',
                                        title: 'Heading 5',
                                        class: 'ck-heading_heading5'
                                    },
                                    {
                                        model: 'heading6',
                                        view: 'h6',
                                        title: 'Heading 6',
                                        class: 'ck-heading_heading6'
                                    }
                                ]
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                            fontSize: {
                                options: [10, 12, 14, 'default', 18, 20, 22],
                                supportAllValues: true
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                            link: {
                                decorators: {
                                    addTargetToExternalLinks: true,
                                    defaultProtocol: 'https://',
                                    toggleDownloadable: {
                                        mode: 'manual',
                                        label: 'Downloadable',
                                        attributes: {
                                            download: 'file'
                                        }
                                    }
                                }
                            },
                            // The "superbuild" contains more premium features that require additional configuration, disable them below.
                            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                            removePlugins: [
                                // These two are commercial, but you can try them out without registering to a trial.
                                // 'ExportPdf',
                                // 'ExportWord',
                                'AIAssistant',
                                'CKBox',
                                'CKFinder',
                                'EasyImage',
                                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                                // Storing images as Base64 is usually a very bad idea.
                                // Replace it on production website with other solutions:
                                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                                // 'Base64UploadAdapter',
                                'MultiLevelList',
                                'RealTimeCollaborativeComments',
                                'RealTimeCollaborativeTrackChanges',
                                'RealTimeCollaborativeRevisionHistory',
                                'PresenceList',
                                'Comments',
                                'TrackChanges',
                                'TrackChangesData',
                                'RevisionHistory',
                                'Pagination',
                                'WProofreader',
                                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                                'MathType',
                                // The following features are part of the Productivity Pack and require additional license.
                                'SlashCommand',
                                'Template',
                                'DocumentOutline',
                                'FormatPainter',
                                'TableOfContents',
                                'PasteFromOfficeEnhanced',
                                'CaseChange'
                            ]
                        })
                        .then(newEditor => {
                            editor = newEditor;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        });

        $(document).on("click", "#btnCrearProducto", function(e) {
            e.preventDefault();
            var producto = $.trim($('#inputProducto').val());
            var puntos = $.trim($('#inputPuntos').val());
            var descripcionCorta = $.trim($('#inputDescripcionCorta').val());
            var descripcionLarga = editor.getData().trim();
            var file = document.getElementById('file').files[0];

            if (producto == "") {
                toastr.error("Ingresa el nombre del producto.");
                $('#inputProducto').focus();
                return false;
            }

            if (puntos == "") {
                toastr.error("Ingresa los puntos.");
                $('#inputPuntos').focus();
                return false;
            }

            if (descripcionCorta == "") {
                toastr.error("Ingresa la descripción corta.");
                $('#inputDescripcionCorta').focus();
                return false;
            }

            if (descripcionLarga == "") {
                toastr.error("Ingresa la descripción larga.");
                $('#inputDescripcionLarga').focus();
                return false;
            }

            if ($("#file").val() == "") {
                toastr.error("Selecciona la imagen del producto.");
                $('#file').focus();
                return false;
            }

            var form_data = new FormData();
            form_data.append('file', file);
            form_data.append('producto', producto);
            form_data.append('puntos', puntos);
            form_data.append('descripcionCorta', descripcionCorta);
            form_data.append('descripcionLarga', descripcionLarga);
            form_data.append('action', 'crearProducto');
            showWait();
            $.ajax({
                url: "backend/querys.php",
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                data: form_data,
                success: function(data) {
                    Swal.close();
                    var tipo = "";
                    if (data.codigo == 200) {
                        tipo = "success";
                        mensaje = data.mensaje;
                        $.ajax({
                            url: 'views/productos.php',
                            cache: false,
                            type: 'POST',
                            data: {},
                            success: function(data) {
                                $('#main-body').html(data);
                                refrescarDatatable("productos");
                                Swal.fire(mensaje, "", tipo);
                            },
                            error: function(request, status, error) {
                                console.log('Ha ocurrido un error!');
                            }
                        });
                    } else {
                        tipo = "error";
                        mensaje = "Ha ocurrido un error!";
                    }
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        });

        function desactivarProducto(id_producto, estatus) {
            if (estatus == 1) {
                title = "¿Desea desactivar el producto?";
                confirmButtonText = "Desactivar";
            } else {
                title = "¿Desea activar el producto?";
                confirmButtonText = "Activar";
            }
            showWait();
            $.ajax({
                url: 'backend/querys.php',
                cache: false,
                type: 'POST',
                data: {
                    action: 'desactivarProducto',
                    id_producto: id_producto,
                    estatus: estatus
                },
                success: function(data) {
                    Swal.close();
                    var tipo = "";
                    if (data.mensaje == "Se actualizo el estatus, con éxito!")
                        tipo = "success";
                    else
                        tipo = "error";

                    Swal.fire(data.mensaje, "", tipo);
                    refrescarDatatable('productos');
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        }

        $(document).on("click", "#btnCancelarProducto", function(e) {
            e.preventDefault();
            showWait();
            refrescarDatatable('productos');
            Swal.close();
        });

        function datatableCursos(option) {
            var table = $('#t' + option).DataTable({
                "processing": true,
                "autoWidth": true,
                "responsive": true,
                "ajax": {
                    'type': 'POST',
                    'url': 'backend/querys.php',
                    'data': {
                        action: option
                    },
                },
                "columns": [{
                        "data": "id_curso"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "imagen"
                    },
                    {
                        "data": "descripcion_corta"
                    },
                    {
                        "data": "descripcion_larga"
                    },
                    {
                        "className": "text-center",
                        "data": "puntos"
                    },
                    {
                        "data": "estatus"
                    },
                    {
                        "data": "fecha_alta"
                    },
                    {
                        "data": null,
                        "width": "5%",
                        "className": "text-center",
                        render: function(data, type, row) {
                            return tableModificarCurso(data);
                        }
                    },
                    {
                        "data": null,
                        "width": "5%",
                        "className": "text-center",
                        render: function(data, type, row) {
                            return tableDesactivarCurso(data.id_curso, data.estatus);
                        }
                    }
                ],

                "conditionalPaging": {
                    style: 'fade',
                    speed: 500
                },
                "lengthMenu": [
                    [5, 10, -1],
                    [5, 10, "Todos"]
                ],
                "language": {
                    url: 'vendor/datatables/Spanish.json'
                }
            });

            table.columns([2, 4, 6, 7]).visible(false);
        }

        function tableModificarCurso(data) {
            return "<button type='button' class='btn btn-primary' title='Modificiar Curso' onclick='formModificarCurso(" + JSON.stringify(data) + ");'><span class='fas fa-edit fa-sm' aria-hidden='true'></span></button>";
        }

        function tableDesactivarCurso(id_curso, estatus) {
            if (estatus == 0)
                return "<button type='button' class='btn btn-danger' title='Habilitar Curso' onclick='desactivarCurso(" + id_curso + "," + estatus + ");'><span class='fas fa-trash fa-sm' aria-hidden='true'></span></button>";
            else
                return "<button type='button' class='btn btn-success' title='Deshabilitar Curso' onclick='desactivarCurso(" + id_curso + "," + estatus + ");'><span class='fas fa-trash fa-sm' aria-hidden='true'></span></button>";
        }

        function formModificarCurso(curso) {
            // e.preventDefault();
            showWait();
            $.ajax({
                url: 'views/form-cursos.php',
                cache: false,
                type: 'POST',
                data: {},
                success: function(data) {
                    Swal.close();
                    $('#main-body').html(data);
                    $('#inputIdCurso').val(curso.id_curso);
                    $('#inputCurso').val(curso.nombre);
                    $('#inputPuntos').val(curso.puntos);
                    $('#inputDescripcionCorta').val(curso.descripcion_corta);
                    $("#selectedImage").attr("src", curso.imagen);
                    $('#btnCrearCurso').attr("id", "btnModificarCurso");
                    $('#btnModificarCurso').html("Modificar Curso");
                    $('#btnModificarCurso').removeClass('btn-success');
                    $('#btnModificarCurso').addClass('btn-primary');

                    CKEDITOR.ClassicEditor.create(document.getElementById("inputDescripcionLarga"), {
                            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                            toolbar: {
                                items: [
                                    'selectAll', '|',
                                    'heading', '|',
                                    'bold', 'italic', 'strikethrough', 'underline', '|',
                                    'bulletedList', 'numberedList', 'todoList', '|',
                                    'outdent', 'indent', '|',
                                    'undo', 'redo', '|',
                                    'fontSize', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                                    'alignment', '|',
                                    'horizontalLine'
                                ],
                                shouldNotGroupWhenFull: true
                            },
                            // Changing the language of the interface requires loading the language file using the <script> tag.
                            language: 'es',
                            list: {
                                properties: {
                                    styles: true,
                                    startIndex: true,
                                    reversed: true
                                }
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                            heading: {
                                options: [{
                                        model: 'paragraph',
                                        title: 'Paragraph',
                                        class: 'ck-heading_paragraph'
                                    },
                                    {
                                        model: 'heading1',
                                        view: 'h1',
                                        title: 'Heading 1',
                                        class: 'ck-heading_heading1'
                                    },
                                    {
                                        model: 'heading2',
                                        view: 'h2',
                                        title: 'Heading 2',
                                        class: 'ck-heading_heading2'
                                    },
                                    {
                                        model: 'heading3',
                                        view: 'h3',
                                        title: 'Heading 3',
                                        class: 'ck-heading_heading3'
                                    },
                                    {
                                        model: 'heading4',
                                        view: 'h4',
                                        title: 'Heading 4',
                                        class: 'ck-heading_heading4'
                                    },
                                    {
                                        model: 'heading5',
                                        view: 'h5',
                                        title: 'Heading 5',
                                        class: 'ck-heading_heading5'
                                    },
                                    {
                                        model: 'heading6',
                                        view: 'h6',
                                        title: 'Heading 6',
                                        class: 'ck-heading_heading6'
                                    }
                                ]
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                            fontSize: {
                                options: [10, 12, 14, 'default', 18, 20, 22],
                                supportAllValues: true
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                            link: {
                                decorators: {
                                    addTargetToExternalLinks: true,
                                    defaultProtocol: 'https://',
                                    toggleDownloadable: {
                                        mode: 'manual',
                                        label: 'Downloadable',
                                        attributes: {
                                            download: 'file'
                                        }
                                    }
                                }
                            },
                            // The "superbuild" contains more premium features that require additional configuration, disable them below.
                            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                            removePlugins: [
                                // These two are commercial, but you can try them out without registering to a trial.
                                // 'ExportPdf',
                                // 'ExportWord',
                                'AIAssistant',
                                'CKBox',
                                'CKFinder',
                                'EasyImage',
                                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                                // Storing images as Base64 is usually a very bad idea.
                                // Replace it on production website with other solutions:
                                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                                // 'Base64UploadAdapter',
                                'MultiLevelList',
                                'RealTimeCollaborativeComments',
                                'RealTimeCollaborativeTrackChanges',
                                'RealTimeCollaborativeRevisionHistory',
                                'PresenceList',
                                'Comments',
                                'TrackChanges',
                                'TrackChangesData',
                                'RevisionHistory',
                                'Pagination',
                                'WProofreader',
                                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                                'MathType',
                                // The following features are part of the Productivity Pack and require additional license.
                                'SlashCommand',
                                'Template',
                                'DocumentOutline',
                                'FormatPainter',
                                'TableOfContents',
                                'PasteFromOfficeEnhanced',
                                'CaseChange'
                            ]
                        })
                        .then(newEditor => {
                            editor = newEditor;
                            editor.setData(curso.descripcion_larga);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        };

        $(document).on("click", "#btnModificarCurso", function(e) {
            e.preventDefault();
            var id_curso = $('#inputIdCurso').val().trim();
            var curso = $('#inputCurso').val().trim();
            var puntos = $('#inputPuntos').val().trim();
            var descripcionCorta = $('#inputDescripcionCorta').val().trim();
            var descripcionLarga = editor.getData().trim();
            var file = document.getElementById('file').files[0];

            if (curso == "") {
                toastr.error("Ingrese el nombre del curso.");
                $('#inputCurso').focus();
                return false;
            }

            if (puntos == "") {
                toastr.error("Ingrese los puntos.");
                $('#inputPuntos').focus();
                return false;
            }

            if (descripcionCorta == "") {
                toastr.error("Ingresa la descripción corta.");
                $('#inputDescripcionCorta').focus();
                return false;
            }

            if (descripcionLarga == "") {
                toastr.error("Ingresa la descripción larga.");
                $('#inputDescripcionLarga').focus();
                return false;
            }

            var form_data = new FormData();
            form_data.append('id_curso', id_curso);
            form_data.append('curso', curso);
            form_data.append('puntos', puntos);
            form_data.append('descripcionCorta', descripcionCorta);
            form_data.append('descripcionLarga', descripcionLarga);
            form_data.append('action', "modificarCurso");

            if ($("#file").val() != "") {
                form_data.append('file', file);
            }
            showWait();
            $.ajax({
                url: "backend/querys.php",
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                data: form_data,
                success: function(data) {
                    var tipo = "";
                    Swal.close();
                    if (data.codigo == 200) {
                        tipo = "success";
                        mensaje = data.mensaje;
                        $.ajax({
                            url: 'views/cursos.php',
                            cache: false,
                            type: 'POST',
                            data: {},
                            success: function(data) {
                                $('#main-body').html(data);
                                refrescarDatatable("cursos");
                                Swal.fire(mensaje, "", tipo);
                            },
                            error: function(request, status, error) {
                                console.log('Ha ocurrido un error!');
                            }
                        });
                    } else {
                        tipo = "error";
                        mensaje = "Ha ocurrido un error!";
                    }
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });

        });

        $(document).on("click", "#btnTableCrearCurso", function(e) {
            e.preventDefault();
            $("#btnCrearCurso").attr("id", "btnCrearCurso");
            showWait();
            $.ajax({
                url: 'views/form-cursos.php',
                cache: false,
                type: 'POST',
                data: {},
                success: function(data) {
                    Swal.close();
                    $('#main-body').html(data);
                    CKEDITOR.ClassicEditor.create(document.getElementById("inputDescripcionLarga"), {
                            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                            toolbar: {
                                items: [
                                    'selectAll', '|',
                                    'heading', '|',
                                    'bold', 'italic', 'strikethrough', 'underline', '|',
                                    'bulletedList', 'numberedList', 'todoList', '|',
                                    'outdent', 'indent', '|',
                                    'undo', 'redo', '|',
                                    'fontSize', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                                    'alignment', '|',
                                    'horizontalLine'
                                ],
                                shouldNotGroupWhenFull: true
                            },
                            // Changing the language of the interface requires loading the language file using the <script> tag.
                            language: 'es',
                            list: {
                                properties: {
                                    styles: true,
                                    startIndex: true,
                                    reversed: true
                                }
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                            heading: {
                                options: [{
                                        model: 'paragraph',
                                        title: 'Paragraph',
                                        class: 'ck-heading_paragraph'
                                    },
                                    {
                                        model: 'heading1',
                                        view: 'h1',
                                        title: 'Heading 1',
                                        class: 'ck-heading_heading1'
                                    },
                                    {
                                        model: 'heading2',
                                        view: 'h2',
                                        title: 'Heading 2',
                                        class: 'ck-heading_heading2'
                                    },
                                    {
                                        model: 'heading3',
                                        view: 'h3',
                                        title: 'Heading 3',
                                        class: 'ck-heading_heading3'
                                    },
                                    {
                                        model: 'heading4',
                                        view: 'h4',
                                        title: 'Heading 4',
                                        class: 'ck-heading_heading4'
                                    },
                                    {
                                        model: 'heading5',
                                        view: 'h5',
                                        title: 'Heading 5',
                                        class: 'ck-heading_heading5'
                                    },
                                    {
                                        model: 'heading6',
                                        view: 'h6',
                                        title: 'Heading 6',
                                        class: 'ck-heading_heading6'
                                    }
                                ]
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                            fontSize: {
                                options: [10, 12, 14, 'default', 18, 20, 22],
                                supportAllValues: true
                            },
                            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                            link: {
                                decorators: {
                                    addTargetToExternalLinks: true,
                                    defaultProtocol: 'https://',
                                    toggleDownloadable: {
                                        mode: 'manual',
                                        label: 'Downloadable',
                                        attributes: {
                                            download: 'file'
                                        }
                                    }
                                }
                            },
                            // The "superbuild" contains more premium features that require additional configuration, disable them below.
                            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                            removePlugins: [
                                // These two are commercial, but you can try them out without registering to a trial.
                                // 'ExportPdf',
                                // 'ExportWord',
                                'AIAssistant',
                                'CKBox',
                                'CKFinder',
                                'EasyImage',
                                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                                // Storing images as Base64 is usually a very bad idea.
                                // Replace it on production website with other solutions:
                                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                                // 'Base64UploadAdapter',
                                'MultiLevelList',
                                'RealTimeCollaborativeComments',
                                'RealTimeCollaborativeTrackChanges',
                                'RealTimeCollaborativeRevisionHistory',
                                'PresenceList',
                                'Comments',
                                'TrackChanges',
                                'TrackChangesData',
                                'RevisionHistory',
                                'Pagination',
                                'WProofreader',
                                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                                'MathType',
                                // The following features are part of the Productivity Pack and require additional license.
                                'SlashCommand',
                                'Template',
                                'DocumentOutline',
                                'FormatPainter',
                                'TableOfContents',
                                'PasteFromOfficeEnhanced',
                                'CaseChange'
                            ]
                        })
                        .then(newEditor => {
                            editor = newEditor;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        });

        $(document).on("click", "#btnCrearCurso", function(e) {
            e.preventDefault();
            var curso = $.trim($('#inputCurso').val());
            var puntos = $.trim($('#inputPuntos').val());
            var descripcionCorta = $.trim($('#inputDescripcionCorta').val());
            var descripcionLarga = editor.getData().trim();
            var file = document.getElementById('file').files[0];

            if (curso == "") {
                toastr.error("Ingresa el nombre del curso.");
                $('#inputCurso').focus();
                return false;
            }

            if (puntos == "") {
                toastr.error("Ingresa los puntos.");
                $('#inputPuntos').focus();
                return false;
            }

            if (descripcionCorta == "") {
                toastr.error("Ingresa la descripción corta.");
                $('#inputDescripcionCorta').focus();
                return false;
            }

            if (descripcionLarga == "") {
                toastr.error("Ingresa la descripción larga.");
                $('#inputDescripcionLarga').focus();
                return false;
            }

            if ($("#file").val() == "") {
                toastr.error("Selecciona la imagen del producto.");
                $('#file').focus();
                return false;
            }

            var form_data = new FormData();
            form_data.append('file', file);
            form_data.append('curso', curso);
            form_data.append('puntos', puntos);
            form_data.append('descripcionCorta', descripcionCorta);
            form_data.append('descripcionLarga', descripcionLarga);
            form_data.append('action', 'crearCurso');
            showWait();
            $.ajax({
                url: "backend/querys.php",
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                data: form_data,
                success: function(data) {
                    Swal.close();
                    var tipo = "";
                    if (data.codigo == 200) {
                        tipo = "success";
                        mensaje = data.mensaje;
                        $.ajax({
                            url: 'views/cursos.php',
                            cache: false,
                            type: 'POST',
                            data: {},
                            success: function(data) {
                                $('#main-body').html(data);
                                refrescarDatatable("cursos");
                                Swal.fire(mensaje, "", tipo);
                            },
                            error: function(request, status, error) {
                                console.log('Ha ocurrido un error!');
                            }
                        });
                    } else {
                        tipo = "error";
                        mensaje = "Ha ocurrido un error!";
                    }
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        });

        function desactivarCurso(id_curso, estatus) {
            if (estatus == 1) {
                title = "¿Desea desactivar el curso?";
                confirmButtonText = "Desactivar";
            } else {
                title = "¿Desea activar el curso?";
                confirmButtonText = "Activar";
            }
            showWait();
            $.ajax({
                url: 'backend/querys.php',
                cache: false,
                type: 'POST',
                data: {
                    action: 'desactivarCurso',
                    id_curso: id_curso,
                    estatus: estatus
                },
                success: function(data) {
                    Swal.close();
                    var tipo = "";
                    if (data.mensaje == "Se actualizo el estatus, con éxito!")
                        tipo = "success";
                    else
                        tipo = "error";

                    Swal.fire(data.mensaje, "", tipo);
                    refrescarDatatable('cursos');
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        }

        $(document).on("click", "#btnCancelarCurso", function(e) {
            e.preventDefault();
            showWait();
            refrescarDatatable('cursos');
            Swal.close();
        });

        function actualizarPuntos() {
            // showWait();
            $.ajax({
                url: 'views/puntos.php',
                cache: false,
                type: 'POST',
                data: {},
                success: function(data) {
                    $('#main-body').html(data);
                },
                error: function(request, status, error) {
                    // Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        }

        $(document).on("click", "#btnCargarPuntos", function(e) {
            e.preventDefault();
            if ($('#files')[0].files.length == 0) {
                toastr.error("Selecciona un archivo");
                $("#files").focus();
                return false;
            }
            var form_data = new FormData();
            form_data.append('file', $('#files')[0].files[0]);
            form_data.append('action', "actualizarPuntos");

            var fileName = $('#files')[0].files[0].name;
            var ext = fileName.split('.').pop();

            if (ext != "xlsx") {
                toastr.error("Selecciona un archivo .xlsx");
                $("#files").focus();
                return false;
            }

            showWait();
            $.ajax({
                url: "backend/actualizarPuntos.php",
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                data: form_data,
                success: function(data) {
                    Swal.close();
                    var tipo = "";

                    if (data.codigo == 200) {
                        // console.log(data.mensaje);
                        tipo = "success";
                        mensaje = data.mensaje;
                        Swal.fire(mensaje, "", tipo);
                        $('#files').val('');
                    } else if (data.codigo == 418) {
                        tipo = "error";
                        mensaje = data.mensaje;
                    } else {
                        tipo = "error";
                        mensaje = "Ha ocurrido un error!";
                    }
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        });

        $(document).on("click", "#btnCancelarPuntos", function(e) {
            e.preventDefault();
            $('#files').val('');
        });

        function refrescarDatatable(option) {
            var url
            url = "views/" + option + ".php";
            $.ajax({
                url: url,
                cache: false,
                type: 'POST',
                data: {

                },
                success: function(data) {
                    $('#main-body').html(data);
                    if (option == 'usuarios') {
                        datatableUsuarios(option);
                    } else if (option == 'clientes') {
                        datatableClientes(option);
                    } else if (option == 'productos') {
                        datatableProductos(option);
                    } else if (option == 'cursos') {
                        datatableCursos(option);
                    }
                },
                error: function(request, status, error) {
                    console.log('Ha ocurrido un error!');
                }
            });
        }

        $(document).on("click", "#btnCerrarSesion", function(e) {
            e.preventDefault();
            showWait();
            $.ajax({
                url: 'backend/login/cerrar_sesion.php',
                cache: false,
                type: 'POST',
                data: {},
                success: function(data) {
                    Swal.close();
                    if (data == "Sesion Terminada")
                        location.href = "index.php";
                },
                error: function(request, status, error) {
                    Swal.close();
                    console.log('Ha ocurrido un error!');
                }
            });
        });

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }

        function displaySelectedImage(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }

        const showWait = (title = "Por favor espere un momento.", description = "Mientras procesamos tu información") => {
            Swal.fire({
                allowOutsideClick: false,
                title: title,
                text: description,
                icon: "info"
            });
            Swal.showLoading();
        }
    </script>
</body>

</html>