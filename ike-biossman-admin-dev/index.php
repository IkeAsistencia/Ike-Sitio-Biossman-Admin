<?php
  require_once "backend/conexion/conexion.php";
  $conexion = new conexion;
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
  <!-- Stylesheets-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/sb-login.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="vendor/sweetalert/sweetalert2.min.css">
  <link href="vendor/toastr/toastr.min.css" rel="stylesheet">

</head>

<body>
  <div class="page-header header-filter" style="background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="" action="">
              <div class="card-header card-header-primary text-center">
                <img src="img/logos/logo-ike.png" class="login-logo" style="width: 30%;">
                <h4 class="text-white font-weight-bolder text-center mt-4 mb-0">Administrador Biossman</h4>
              </div>
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-envelope fa-lg"></i>
                    </span>
                  </div>
                  <input type="email" class="form-control" id="lemail" name="lemail" placeholder="Correo Electrónico" maxlength="30">
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-key fa-lg"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" id="lpassword" name="lpassword" placeholder="Contraseña" maxlength="15">
                </div>
              </div>
              <div class="wow-outer text-center" style="margin-top: 8%;">
                <button class="button button-lg button-winona wow slideInDown btn bg-gradient-primary w-50" data-wow-delay=".1s" name="btnLogin" id="btnLogin">Iniciar Sesión</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer text-center"></footer>
  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/sweetalert/sweetalert2.all.min.js"></script>
  <script src="vendor/toastr/toastr.min.js"></script>
</body>

</html>
<script>
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
    "positionClass": "toast-bottom-right"
  }

  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
  }

  $(document).ready(function() {
    $(document).on("click", "#btnLogin", function(e) {
      e.preventDefault();
      var email = $.trim($("#lemail").val());
      var pass = $.trim($("#lpassword").val());

      if (email == "") {
        toastr.error("Ingresa el correo electronico");
        $("#lemail").focus();
        return false;
      } else if (!validateEmail(email)) {
        toastr.error("La dirección de correo no es valida example@ikeasistencia.com");
        $("#lemail").focus();
        return false;
      }

      if (pass == "") {
        toastr.error("Ingresa la contraseña");
        $("#lpassword").focus();
        return false;
      }

      $.ajax({
        url: 'backend/login/login.php',
        cache: false,
        type: 'POST',
        data: {
          email: email,
          pass: pass
        },
        success: function(data) {
          if (data == "Acceso Correcto")
            location.href = "administrador.php";
          else if (data == "Usuario Inactivo")
            toastr.error("El usuario que ingresaste se encuentra desactivado.");
          else
            toastr.error("La credenciales que ingresaste son incorrectas, favor de validar.");
        },
        error: function(request, status, error) {
          console.log('Ha ocurrido un error!');
        }
      });
    });
  });
</script>