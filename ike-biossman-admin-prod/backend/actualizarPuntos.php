<?php
header('Content-type:application/json;charset=utf-8');
require_once "conexion/conexion.php";
$action = $_POST['action'];

require_once('../class/PHPExcel/PHPExcel.php');

class actualizarPuntos
{
    private $conexion = "";

    function __construct()
    {
        $this->conexion = new conexion();
    }

    public function createDirectory($anio, $mes, $meses)
    {
        $dir = "../tmp/archivosPuntos/" . $anio;

        if (!is_dir($dir)) {
            mkdir($dir);
            chmod($dir, 0777);
        }

        foreach ($meses as $value => $name) {
            if ($mes == $value) {
                $mes = $name;
                $dir2 = "../tmp/archivosPuntos/" . $anio . "/" . $mes;
                if (!is_dir($dir2)) {
                    mkdir($dir2);
                    chmod($dir2, 0777);
                }
            }
        }
        return $dir2;
    }

    public function saveFileExcel($url, $dir2, $file)
    {
        $url_remote = $dir2 . "/" . $file;
        move_uploaded_file($url, $url_remote);

        return $url_remote;
    }

    public function renameFileExcel($dir2, $url_remote)
    {
        $new_name = $dir2 . "/Actualizacion_Puntos_Biu_" . date('Ymd') . ".xlsx";
        rename($url_remote, $new_name);

        return $new_name;
    }

    public function validateFileExcel($highestColumn, $sheet)
    {
        $error = 0;
        if ($highestColumn != "G") {
            $error++;
        } else {
            $columns = array(
                "A" => "Id", "B" => "Nombre", "C" => "RFC", "D" => "Fecha Nacimiento", "E" => "Correo", "F" => "Puntos", "G" => "Fecha Alta"
            );

            foreach ($columns as $value => $name) {
                if (trim($sheet->getCell($value . "1")->getValue(), " ") != $name)
                    $error++;
            }
        }

        return $error;
    }

    public function readFileExcel($new_url_remote)
    {
        $fileType = PHPExcel_IOFactory::identify($new_url_remote);
        $objReader = PHPExcel_IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load($new_url_remote);
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        return array('Column' => $highestColumn, 'Row' => $highestRow, 'Sheet' => $sheet);
    }

    public function updatePuntosBiu($highestRow, $sheet)
    {
        for ($row = 2; $row <= $highestRow; $row++) {
            $id_cliente = $sheet->getCell("A" . $row)->getValue();
            $nombre = $sheet->getCell("B" . $row)->getValue();
            $puntos = $sheet->getCell("F" . $row)->getValue();            

            $this->conexion->beginTransaction();
            $query = "UPDATE puntos_biu SET puntos = :puntos, fecha_modificacion = NOW() WHERE id_cliente = :id_cliente";
            $queryArray = [                
                'id_cliente' => $id_cliente,
                'puntos' => $puntos
            ];

            if (!$this->conexion->insertData($query, $queryArray)) {
                $this->conexion->rollback();
                $result = array("codigo" => 500);
            } else {
                $this->conexion->commit();
                $result = array("codigo" => 200, "mensaje" => "Se actualizaron los puntos BIU, con éxito!");
            }            
        }
        return $result;
    }
}

$file = basename($_FILES['file']['name']);
$type = $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$url = $_FILES['file']['tmp_name'];
$anio = date('Y');
$mes = date('m');
$meses = array(
    "01" => "Enero", "02" => "Febrero", "03" => "Marzo", "04" => "Abril", "05" => "Mayo", "06" => "Junio",
    "07" => "Julio", "08" => "Agosto", "09" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre"
);

$puntos = new actualizarPuntos();
$dir2 = $puntos->createDirectory($anio, $mes, $meses);
if ($dir2 != "")
    $url_remote = $puntos->saveFileExcel($url, $dir2, $file);

if ($url_remote != "")
    $new_url_remote = $puntos->renameFileExcel($dir2, $url_remote);

if ($new_url_remote != "") {
    $dataExcel = $puntos->readFileExcel($new_url_remote);
    $highestColumn = $dataExcel['Column'];
    $highestRow = $dataExcel['Row'];
    $sheet = $dataExcel['Sheet'];
}

if ($highestColumn != "")
    $error = $puntos->validateFileExcel($highestColumn, $sheet);

if ($error == 0) {
    $result = $puntos->updatePuntosBiu($highestRow, $sheet);
    echo json_encode($result);
} else {    
    unlink($new_url_remote);
    $result = array("codigo" => 418, "mensaje" => "El archivo no cumple con la estructura correcta!");
}
