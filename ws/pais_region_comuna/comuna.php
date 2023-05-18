<?php

require('../bd/bd.php');


$json = file_get_contents('php://input');
$data = json_decode($json);

$request = $data->request;
$tipo = $data->tipo;

if($tipo === "get"){
    echo json_encode(getComuna($request)) ;
} 

function getComuna($functionRequest){
    $conn = new bd();
    $conn->conectar();

    $idRegion = $functionRequest->idRegion;
    $comunas = [];

    $query = 'Select c.id, c.comuna from comuna c
              INNER JOIN region r on r.id = c.region_id
              WHERE r.id ='.$idRegion;
              
    if($responseBd = $conn->mysqli->query($query)){
        while($dataComunas = $responseBd->fetch_object()){
            $comunas [] = $dataComunas;
        }
    }
    return $comunas;
}
?>