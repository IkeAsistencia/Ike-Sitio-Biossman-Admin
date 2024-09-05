<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
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

    public function readFileExcel()
    {

        $tempFile = sys_get_temp_dir() . '/puntos-clientes.xlsx';
        file_put_contents($tempFile, file_get_contents($_FILES["file"]["tmp_name"]));

        $fileType = PHPExcel_IOFactory::identify($tempFile);
        $objReader = PHPExcel_IOFactory::createReader($fileType);
        $objPHPExcel = $objReader->load($tempFile);
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        unlink($tempFile);

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

$puntos = new actualizarPuntos();

$dataExcel = $puntos->readFileExcel();
$highestColumn = $dataExcel['Column'];
$highestRow = $dataExcel['Row'];
$sheet = $dataExcel['Sheet'];

if ($highestColumn != "")
    $error = $puntos->validateFileExcel($highestColumn, $sheet);

if ($error == 0) {
    $result = $puntos->updatePuntosBiu($highestRow, $sheet);
    echo json_encode($result);
} else {
    $result = array("codigo" => 418, "mensaje" => "El archivo no cumple con la estructura correcta!");
}
