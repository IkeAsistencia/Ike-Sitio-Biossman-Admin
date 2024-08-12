<?php
require_once "../backend/conexion/conexion.php";
$conexion = new conexion;
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-fw fa-box-open"></i> Producto</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="formProducto" role="form" novalidate>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <input type="hidden" class="form-control" id="inputIdProducto">                        
                        <div class="form-group">
                            <label for="inputProducto">Producto</label>
                            <input type="text" class="form-control" id="inputProducto" placeholder="Ingresa el nombre del producto" onkeypress="return validateText(event)">
                        </div>
                        <div class="form-group">
                            <label for="inputPuntos">Puntos</label>
                            <input type="text" class="form-control" id="inputPuntos" placeholder="Ingresa los puntos" onkeypress="return validateNum(event)">
                        </div>
                        <div class="form-group">
                            <label for="inputDescripcionLarga">Descripción Larga</label>
                            <textarea class="form-control" id="inputDescripcionLarga" name="inputDescripcionLarga"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="inputDescripcionCorta">Descripción Corta</label>
                            <textarea class="form-control" id="inputDescripcionCorta" name="inputDescripcionCorta" placeholder="Ingresa la descripción corta del artículo" onkeypress="return validateText(event)" style="height: 200px;"></textarea>
                        </div>
                        <div class="form-group">
                            <!--Image-->
                            <div>
                                <div class="mb-4 d-flex justify-content-center" style="border: solid 1px #D1D3E2; border-radius: 15px">
                                    <img id="selectedImage" src="img/example-banner.png" alt="example placeholder" style="width: 60%; height: 250px" />
                                </div><br>
                                <div class="d-flex justify-content-center">
                                    <div class="btn btn-primary btn-rounded">
                                        <label class="form-label text-white m-1 pointer" for="file">Agregar Imagen</label>
                                        <input type="file" class="form-control d-none" id="file" name="file" onchange="displaySelectedImage(event, 'selectedImage')" accept="image/*"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div style="margin-left: 40%; margin-top: 5%;">                    
                        <button type="button" class="btn btn-secondary" id="btnCancelarProducto">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="btnCrearProducto">Crear Artículo</button>                    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>