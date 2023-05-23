<?php
    require_once('../bd/bd.php');
    
    $conn = new bd();

    $conn ->conectar();

    $json = file_get_contents('php://input');
    $data = json_decode($json);


    $vehicleArray = $data;
    $returnErrArray = [];


    foreach ($vehicleArray as $key => $value){

        $patente = $value->patente;
        $nombre = $value->nombre;
        $query = 'select p.id from personal p 
        where CONCAT(LOWER(p.nombre)," ",LOWER(p.apellido))="'.trim(strtolower(($nombre))).'" LIMIT 1';
        $queryNombre = $conn->mysqli->query($query);
        
        if($queryNombre->num_rows > 0){
            
            $value = $queryNombre->fetch_object();
            $idPersonal = $value->id;
            $query = 'INSERT INTO intec.vehiculo (patente, personal_id)
                      VALUES("'.$patente.'",'.$idPersonal.')';
            $conn->mysqli->query($query);
        }else{
            array_push($returnErrArray,array("nombre"=>$nombre,"patente"=>$patente));
        }
    }

    if(count($returnErrArray) > 0 ){
        echo json_encode(array("status"=>0,"array"=>$returnErrArray));
    }else{
        echo json_encode(array("status"=>1,"array"=>$returnErrArray));
    }

?>