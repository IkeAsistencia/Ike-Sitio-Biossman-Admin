<?php
header('Content-type:application/json;charset=utf-8');
require_once "conexion/conexion.php";
$conexion = new conexion;
$action = $_POST['action'];


# Módulo de Usuarios

function consultaUsuarios($conexion)
{
    $query = "SELECT * FROM usuarios_biu;";
    $resultado =  $conexion->getData($query);

    $results = array("data" => $resultado);

    echo json_encode($results);
}

function crearUsuario($conexion, $name, $email, $pass)
{
    $validacion = validarUsuario($conexion, $email, 'nuevo');
    if (!$validacion) {
        die(json_encode(array("codigo" => 418, "mensaje" => "El correo ya esta en uso.")));
    }
    $conexion->beginTransaction();
    $pass_sha512 = hash('sha512', $pass);
    $query = "INSERT INTO usuarios_biu (nombre, correo, password, estatus, fecha_alta) VALUES (:name, :email, :password, 1, NOW())";
    $queryArray = [
        'name' => $name,
        'email' => $email,
        'password' => $pass_sha512
    ];

    if (!$conexion->insertData($query, $queryArray)) {
        $conexion->rollback();
        $result = array("codigo" => 400, "mensaje" => "Ha ocurrido un error!");
    } else {
        $conexion->commit();
        $result = array("codigo" => 200, "mensaje" => "Se creó el usuario, con éxito!");
    }

    echo json_encode($result);
}

function modificarUsuario($conexion, $id_usuario, $name, $email, $pass)
{
    $validacion = validarUsuario($conexion, $email, 'modificar', $id_usuario);
    if (!$validacion) {
        die(json_encode(array("codigo" => 418, "mensaje" => "El correo ya esta en uso.")));
    }
    $conexion->beginTransaction();
    $pass_sha512 = hash('sha512', $pass);
    $query = "UPDATE usuarios_biu SET nombre = :name, correo = :email, password = :password WHERE id_usuario = :id_usuario";
    $queryArray = [
        'name' => $name,
        'email' => $email,
        'password' => $pass_sha512,
        'id_usuario' => $id_usuario
    ];

    if (!$conexion->insertData($query, $queryArray)) {
        $conexion->rollback();
        $result = array("codigo" => 400, "mensaje" => "Ha ocurrido un error!");
    } else {
        $conexion->commit();
        $result = array("codigo" => 200, "mensaje" => "Se modifico el usuario, con éxito!");
    }

    echo json_encode($result);
}

function cambiarEstatusUsuario($conexion, $id_usuario, $estatus)
{
    $conexion->beginTransaction();
    $estatus = ($estatus == 1 ? 0 : 1);
    $query = "UPDATE usuarios_biu SET estatus = :estatus WHERE id_usuario = :id_usuario";
    $queryArray = [
        'estatus' => $estatus,
        'id_usuario' => $id_usuario
    ];
    if (!$conexion->insertData($query, $queryArray)) {
        $conexion->rollback();
        $result = array("codigo" => 400, "mensaje" => "Ha ocurrido un error!");
    } else {
        $conexion->commit();
        $result = array("codigo" => 200, "mensaje" => "Se actualizo el estatus, con éxito!");
    }

    echo json_encode($result);
}

function validarUsuario($conexion, $email, $tipo, $id_usuario = 0)
{
    if ($tipo == 'nuevo') {
        $query = "SELECT * FROM usuarios_biu WHERE correo = :email";
        $queryArray = [
            'email' => $email
        ];
    } else {
        $query = "SELECT * FROM usuarios_biu WHERE correo = :email AND id_usuario <> :id_usuario";
        $queryArray = [
            'email' => $email,
            'id_usuario' => $id_usuario
        ];
    }
    $cantidad = $conexion->getData($query, $queryArray);
    if (count($cantidad) > 0) {
        return false;
    } else {
        return true;
    }
}

# Módulo de Clientes

function consultaClientes($conexion)
{
    $query = "SELECT cl.id_cliente, concat(nombre, ' ', ape_paterno, ' ', ape_materno) as nombre, cl.rfc, cl.fecha_nacimiento, cl.correo, cl.estatus, cl.fecha_alta, pt.puntos FROM clientes_biu cl INNER JOIN puntos_biu pt ON cl.id_cliente = pt.id_cliente;";
    $resultado =  $conexion->getData($query);

    $results = array("data" => $resultado);

    echo json_encode($results);
}

function cambiarEstatusCliente($conexion, $id_cliente, $estatus)
{
    $conexion->beginTransaction();
    $estatus = ($estatus == 1 ? 0 : 1);
    $query = "UPDATE clientes_biu SET estatus = :estatus WHERE id_cliente = :id_cliente";
    $queryArray = [
        'estatus' => $estatus,
        'id_cliente' => $id_cliente
    ];
    if (!$conexion->insertData($query, $queryArray)) {
        $conexion->rollback();
        $result = array("codigo" => 400, "mensaje" => "Ha ocurrido un error!");
    } else {
        $conexion->commit();
        $result = array("codigo" => 200, "mensaje" => "Se actualizo el estatus, con éxito!");
    }

    echo json_encode($result);
}

# Módulo de Productos

function consultaProductos($conexion)
{
    $query = "SELECT * FROM productos_biu;";
    $resultado =  $conexion->getData($query);

    $results = array("data" => $resultado);

    echo json_encode($results);
}

function crearProducto($conexion, $producto, $puntos, $descripcionCorta, $descripcionLarga, $file)
{
    $conexion->beginTransaction();
    $tmp = $file['tmp_name'];
    $data = file_get_contents($tmp);
    $base64 = 'data:image/jpg;base64,' . base64_encode($data);
    $query = "INSERT INTO productos_biu (nombre, imagen, puntos, descripcion_corta, descripcion_larga, estatus, fecha_alta) VALUES(:producto, :imagen, :puntos, :descripcion_corta, :descripcion_larga, 1, NOW());";
    $queryArray = [
        'producto' => $producto,
        'imagen' => $base64,
        'puntos' => $puntos,
        'descripcion_corta' => $descripcionCorta,
        'descripcion_larga' => $descripcionLarga
    ];

    if (!$conexion->insertData($query, $queryArray)) {
        $conexion->rollback();
        $result = array("codigo" => 500);
    } else {
        $conexion->commit();
        //move_uploaded_file($tmp , $path);
        $result = array("codigo" => 200, "mensaje" => "Se creó el producto, con éxito!");
    }

    echo json_encode($result);
}

function modificarProducto($conexion, $id_producto, $producto, $puntos, $descripcionCorta, $descripcionLarga, $file)
{
    $conexion->beginTransaction();
    if ($file != '') {
        $tmp = $file['tmp_name'];
        $data = file_get_contents($tmp);
        $base64 = 'data:image/jpg;base64,' . base64_encode($data);

        $query = "UPDATE productos_biu SET nombre = :producto, puntos = :puntos, imagen = :imagen, descripcion_corta = :descripcion_corta, descripcion_larga = :descripcion_larga WHERE id_producto = :id_producto";
        $queryArray = [
            'producto' => $producto,
            'puntos' => $puntos,
            'imagen' => $base64,
            'descripcion_corta' => $descripcionCorta,
            'descripcion_larga' => $descripcionLarga,
            'id_producto' => $id_producto
        ];
    } else {
        $query = "UPDATE productos_biu SET nombre = :producto, puntos = :puntos, descripcion_corta = :descripcion_corta, descripcion_larga = :descripcion_larga WHERE id_producto = :id_producto";
        $queryArray = [
            'producto' => $producto,
            'puntos' => $puntos,
            'descripcion_corta' => $descripcionCorta,
            'descripcion_larga' => $descripcionLarga,
            'id_producto' => $id_producto
        ];
    }

    if (!$conexion->insertData($query, $queryArray)) {
        $conexion->rollback();
        $result = array("codigo" => 500);
    } else {
        $conexion->commit();
        /*if($file != ''){
            move_uploaded_file($tmp , $path);
        }*/
        $result = array("codigo" => 200, "mensaje" => "Se modifico el producto, con éxito!");
    }

    echo json_encode($result);
}

function desactivarProducto($conexion, $id_producto, $estatus)
{
    $conexion->beginTransaction();
    $estatus = ($estatus == 1 ? 0 : 1);
    $query = "UPDATE productos_biu SET estatus = :estatus WHERE id_producto = :id_producto";
    $queryArray = [
        'estatus'          => $estatus,
        'id_producto'      => $id_producto
    ];
    if (!$conexion->insertData($query, $queryArray)) {
        $conexion->rollback();
        $result = array("mensaje" => "Ha ocurrido un error!");
    } else {
        $conexion->commit();
        $result = array("mensaje" => "Se actualizo el estatus, con éxito!");
    }

    echo json_encode($result);
}

# Módulo de Talleres/Cursos

function consultaCursos($conexion)
{
    $query = "SELECT * FROM cursos_biu;";
    $resultado =  $conexion->getData($query);

    $results = array("data" => $resultado);

    echo json_encode($results);
}

function crearCurso($conexion, $curso, $puntos, $descripcionCorta, $descripcionLarga, $file)
{
    $conexion->beginTransaction();
    $tmp = $file['tmp_name'];
    $data = file_get_contents($tmp);
    $base64 = 'data:image/jpg;base64,' . base64_encode($data);
    $query = "INSERT INTO cursos_biu (nombre, imagen, puntos, descripcion_corta, descripcion_larga, estatus, fecha_alta) VALUES(:curso, :imagen, :puntos, :descripcion_corta, :descripcion_larga, 1, NOW());";
    $queryArray = [
        'curso' => $curso,
        'imagen' => $base64,
        'puntos' => $puntos,
        'descripcion_corta' => $descripcionCorta,
        'descripcion_larga' => $descripcionLarga
    ];

    if (!$conexion->insertData($query, $queryArray)) {
        $conexion->rollback();
        $result = array("codigo" => 500);
    } else {
        $conexion->commit();
        //move_uploaded_file($tmp , $path);
        $result = array("codigo" => 200, "mensaje" => "Se creó el curso, con éxito!");
    }

    echo json_encode($result);
}

function modificarCurso($conexion, $id_curso, $curso, $puntos, $descripcionCorta, $descripcionLarga, $file)
{
    $conexion->beginTransaction();
    if ($file != '') {

        $tmp = $file['tmp_name'];
        $data = file_get_contents($tmp);
        $base64 = 'data:image/jpg;base64,' . base64_encode($data);

        $query = "UPDATE cursos_biu SET nombre = :curso, puntos = :puntos, imagen = :imagen, descripcion_corta = :descripcion_corta, descripcion_larga = :descripcion_larga WHERE id_curso = :id_curso";
        $queryArray = [
            'curso' => $curso,
            'puntos' => $puntos,
            'imagen' => $base64,
            'descripcion_corta' => $descripcionCorta,
            'descripcion_larga' => $descripcionLarga,
            'id_curso' => $id_curso
        ];
    } else {
        $query = "UPDATE cursos_biu SET nombre = :curso, puntos = :puntos, descripcion_corta = :descripcion_corta, descripcion_larga = :descripcion_larga WHERE id_curso = :id_curso";
        $queryArray = [
            'curso' => $curso,
            'puntos' => $puntos,
            'descripcion_corta' => $descripcionCorta,
            'descripcion_larga' => $descripcionLarga,
            'id_curso' => $id_curso
        ];
    }

    if (!$conexion->insertData($query, $queryArray)) {
        $conexion->rollback();
        $result = array("codigo" => 500);
    } else {
        $conexion->commit();
        /*if($file != ''){
            move_uploaded_file($tmp , $path);
        }*/
        $result = array("codigo" => 200, "mensaje" => "Se modifico el curso, con éxito!");
    }

    echo json_encode($result);
}

function desactivarCurso($conexion, $id_curso, $estatus)
{
    $conexion->beginTransaction();
    $estatus = ($estatus == 1 ? 0 : 1);
    $query = "UPDATE cursos_biu SET estatus = :estatus WHERE id_curso = :id_curso";
    $queryArray = [
        'estatus'          => $estatus,
        'id_curso'      => $id_curso
    ];
    if (!$conexion->insertData($query, $queryArray)) {
        $conexion->rollback();
        $result = array("mensaje" => "Ha ocurrido un error!");
    } else {
        $conexion->commit();
        $result = array("mensaje" => "Se actualizo el estatus, con éxito!");
    }

    echo json_encode($result);
}

switch ($action):
    case 'usuarios':
        consultaUsuarios($conexion);
        break;
    case 'crearUsuario':
        $name   = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
        $email  = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
        $pass   = htmlentities($_POST['pass'], ENT_QUOTES, 'UTF-8');
        crearUsuario($conexion, $name, $email, $pass);
        break;
    case 'modificarUsuario':
        $id_usuario = htmlentities($_POST['id'], ENT_QUOTES, 'UTF-8');
        $name       = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
        $email      = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
        $pass       = htmlentities($_POST['pass'], ENT_QUOTES, 'UTF-8');
        modificarUsuario($conexion, $id_usuario, $name, $email, $pass);
        break;
    case 'cambiarEstatusUsuario':
        $id_usuario = htmlentities($_POST['id_usuario'], ENT_QUOTES, 'UTF-8');
        $estatus    = htmlentities($_POST['estatus'], ENT_QUOTES, 'UTF-8');
        cambiarEstatusUsuario($conexion, $id_usuario, $estatus);
        break;
    case 'clientes':
        consultaClientes($conexion);
        break;
    case 'cambiarEstatusCliente':
        $id_cliente = htmlentities($_POST['id_cliente'], ENT_QUOTES, 'UTF-8');
        $estatus    = htmlentities($_POST['estatus'], ENT_QUOTES, 'UTF-8');
        cambiarEstatusCliente($conexion, $id_cliente, $estatus);
        break;
    case 'productos':
        consultaProductos($conexion);
        break;
    case 'crearProducto':
        $producto         = htmlentities($_POST['producto'], ENT_QUOTES, 'UTF-8');
        $puntos           = htmlentities($_POST['puntos'], ENT_QUOTES, 'UTF-8');
        $descripcionCorta = htmlentities($_POST['descripcionCorta'], ENT_QUOTES, 'UTF-8');
        $descripcionLarga = htmlentities($_POST['descripcionLarga'], ENT_QUOTES, 'UTF-8');
        $file = isset($_FILES['file']) ? $_FILES['file'] : '';
        crearProducto($conexion, $producto, $puntos, $descripcionCorta, $descripcionLarga, $file);
        break;
    case 'modificarProducto':
        $id_producto      = htmlentities($_POST['id_producto'], ENT_QUOTES, 'UTF-8');
        $producto         = htmlentities($_POST['producto'], ENT_QUOTES, 'UTF-8');
        $puntos           = htmlentities($_POST['puntos'], ENT_QUOTES, 'UTF-8');
        $descripcionCorta = htmlentities($_POST['descripcionCorta'], ENT_QUOTES, 'UTF-8');
        $descripcionLarga = $_POST['descripcionLarga'];
        $file = isset($_FILES['file']) ? $_FILES['file'] : '';
        modificarProducto($conexion, $id_producto, $producto, $puntos, $descripcionCorta, $descripcionLarga, $file);
        break;
    case 'desactivarProducto':
        $id_producto  = htmlentities($_POST['id_producto'], ENT_QUOTES, 'UTF-8');
        $estatus      = htmlentities($_POST['estatus'], ENT_QUOTES, 'UTF-8');
        desactivarProducto($conexion, $id_producto, $estatus);
        break;
    case 'cursos':
        consultaCursos($conexion);
        break;
    case 'crearCurso':
        $curso         = htmlentities($_POST['curso'], ENT_QUOTES, 'UTF-8');
        $puntos           = htmlentities($_POST['puntos'], ENT_QUOTES, 'UTF-8');
        $descripcionCorta = htmlentities($_POST['descripcionCorta'], ENT_QUOTES, 'UTF-8');
        $descripcionLarga = htmlentities($_POST['descripcionLarga'], ENT_QUOTES, 'UTF-8');
        $file = isset($_FILES['file']) ? $_FILES['file'] : '';
        crearCurso($conexion, $curso, $puntos, $descripcionCorta, $descripcionLarga, $file);
        break;
    case 'modificarCurso':
        $id_curso      = htmlentities($_POST['id_curso'], ENT_QUOTES, 'UTF-8');
        $curso         = htmlentities($_POST['curso'], ENT_QUOTES, 'UTF-8');
        $puntos           = htmlentities($_POST['puntos'], ENT_QUOTES, 'UTF-8');
        $descripcionCorta = htmlentities($_POST['descripcionCorta'], ENT_QUOTES, 'UTF-8');
        $descripcionLarga = $_POST['descripcionLarga'];
        $file = isset($_FILES['file']) ? $_FILES['file'] : '';
        modificarCurso($conexion, $id_curso, $curso, $puntos, $descripcionCorta, $descripcionLarga, $file);
        break;
    case 'desactivarCurso':
        $id_curso  = htmlentities($_POST['id_curso'], ENT_QUOTES, 'UTF-8');
        $estatus      = htmlentities($_POST['estatus'], ENT_QUOTES, 'UTF-8');
        desactivarCurso($conexion, $id_curso, $estatus);
        break;
endswitch;
