<?php
if ($_POST) {
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->tipo;

    // Realiza la acción correspondiente según el valor de 'action'
    switch($action) {
        case 'addCliente':
            $request = $data->request;
            $result = addCliente($request);
            break;
        default:
            $result = false;
            break;
    }

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo $result;
} else {
    require_once('./ws/bd/bd.php');
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