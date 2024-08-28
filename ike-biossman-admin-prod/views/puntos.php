<?php
require_once "../backend/conexion/conexion.php";
$conexion = new conexion;
?>
<div class="container-fluid" style="width: 80%;">
    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-credit-card"></i> Puntos</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(195deg, #004b85, #4b90cd); color: white">
                    <h5 class="modal-title w-100 text-center">Actualizar Puntos Biossman</h5>
                </div>
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form id="formCargaPuntos" role="form" novalidate>
                        <div class="form-group mb-3">
                            <input class="form-control" type="file" id="files" name="files" accept=".xls,.xlsx">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="btnCancelarPuntos">Cancelar</button>
                            <button type="submit" class="btn btn-success" id="btnCargarPuntos">
                                <span class="icon text-white-50">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="text">Cargar Archivo</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>