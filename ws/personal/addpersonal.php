<?php
    require_once('../bd/bd.php');
    
    $conn = new bd();

    $conn ->conectar();

    $json = file_get_contents('php://input');
    $data = json_decode($json);


    $personalArr = $data;
    $today = date('Y-m-d');

    foreach ($personalArr as $key => $value){

        $nombre = $value ->nombre;
        $apellido = $value ->apellido;
        $rut = $value ->rut;
        $cargo = $value ->cargo;
        $especialidad = $value ->especialidad;
        $contrato = $value ->contrato;

        
        $queryCargo = $conn->mysqli->query('select id from cargo where cargo = "'.$cargo.'"'); 
        $value = $queryCargo->fetch_object();
        $idCargo = $value->id;

        $especialidadq = $conn->mysqli->query('select id from especialidad where especialidad ="' .$especialidad.'"'); 
        $value = $especialidadq->fetch_object();
        $idEspecialidad = $value->id;

        $contratoq = $conn->mysqli->query('select id from tipo_contrato where contrato = "'.$contrato.'"'); 
        $value = $contratoq->fetch_object();
        $idContrato = $value->id;

        $query = 'INSERT INTO intec.personal
                (nombre, apellido,rut,cargo_id, especialidad_id, tipo_contrato_id, createAt,IsDelete, empresa_id)
                VALUES("'.$nombre.'","'.$apellido.'","'.$rut.'",'.$idCargo.','.$idEspecialidad.','.$idContrato.','.$today.',0,1)';

        echo $idCargo;
        
        if($conn->mysqli->query($query)){

        }else{

        }

    }
?>