<?php
require_once('../bd/bd.php');
    
$conn = new bd();
$conn ->conectar();
$json = file_get_contents('php://input');
$data = json_decode($json);
$vehiculoArray = $data;
$today = date('Y-m-d');

foreach($vehiculoArray as $persona){

    $queryDelete = 'update vehiculo set IsDelete = 1, deleteAt = "'.$today.'" where id = '.$persona->id;
    
    if($conn->mysqli->query($queryDelete)){
        echo json_encode(array("status"=> 1,"message"=>"Se ha eliminado exitosamente "));
    }else{
        echo json_encode(array("status"=> 0,"message"=>"Error al eliminar"));
    }
}
?>