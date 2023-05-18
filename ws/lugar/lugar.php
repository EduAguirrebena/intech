<?php
    require_once('../bd/bd.php');
    


    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $request = $data->request;
    $tipo = $data->tipo;

    if($tipo === "add"){
        echo addLugar($request);
    }

    function addLugar($request){

        $conn = new bd();
        $conn ->conectar();

        $today = date('Y-m-d');

        $lugar="";
        $direccion_id="";

        foreach($request as $req){
            $lugar= $req->lugar;
            $direccion_id = $req->direccion_id;
        }

        $query = "INSERT INTO intec.lugar
                (lugar, createAt, direccion_id)
                VALUES('".$lugar."', '".$today."', $direccion_id )";
        // return json_encode($request); 
        if($conn->mysqli->query($query)){
            $insert_id = $conn->mysqli->insert_id;
            return json_encode(array("id_lugar"=> $insert_id)) ;
        }else{
            return false;
        }

    }
?>