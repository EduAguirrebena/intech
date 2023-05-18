<?php
    require_once('../bd/bd.php');
    


    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $request = $data->request;
    $tipo = $data->tipo;

   

    if($tipo === "add"){
        echo addDireccion($request);
    }

    function addDireccion($request){

        $conn = new bd();
        $conn ->conectar();

        $direccion = "";
        $numero = "";
        //$extra = "";
        $dpto = "";
        $postal_code = "";
        $comuna_id = "";

        
        foreach($request as $req){
            $direccion= $req->direccion;
            $numero = $req->numero;
            // $extra = $req->extra;
            $dpto = $req->depto;
            $postal_code = $req->codigo_postal;
            $comuna_id = $req->comuna;
        }
       

        $query = "INSERT INTO intec.direccion
        (direccion, numero,  dpto, postal_code, comuna_id, empresa_id)
        VALUES('".$direccion."', '".$numero."','".$dpto."', '".$postal_code."', $comuna_id, 1)";


        if($responseBd = $conn->mysqli->query($query)){
            $insert_id = $conn->mysqli->insert_id;
            return json_encode(array("id_direccion"=> $insert_id)) ;
        }else{
            return false;
        }

    }
?>
