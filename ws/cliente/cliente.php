<?php
    require_once('../bd/bd.php');
    


    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $request = $data->request;
    $tipo = $data->tipo;

    if($tipo === "add"){
        echo addCliente($request);
    }

    function addCliente($request){

        $conn = new bd();
        $conn ->conectar();

        foreach($request as $req){
            $nombre = $req->nombre;

            $query = "INSERT INTO intec.cliente
            (datos_facturacion_id, nombre)
            VALUES(1, '".$nombre."')";

            if($conn->mysqli->query($query)){
                $idCliente = $conn->mysqli->insert_id;
                return json_encode(array("idCliente"=>$idCliente));
            }else{
                return false;
            }
            
        }
    }


?>