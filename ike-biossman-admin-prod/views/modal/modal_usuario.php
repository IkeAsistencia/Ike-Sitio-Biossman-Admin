<?php
  require_once "backend/conexion/conexion.php";
  $conexion = new conexion;
?>
<!-- Modal -->
<div class="modal fade" id="userModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center">Información del Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form id="formUsuarios" role="form" novalidate>
                    <div class="form-group">
                        <label for="inputName">Nombre</label>
                        <input type="hidden" class="form-control" id="inputIdUser">
                        <input type="text" class="form-control" id="inputName" placeholder="Ingresa el nombre">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Correo Electrónico</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Ingresa el correo electronico">
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Contraseña</label>
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Ingresa la contraseña" maxlength="15">                        
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnModalCrearUsuario">Crear Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>