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
        case 'getCliente':
            $request = $data->request;
            $result = getClienteById($request);
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
    function getClientesByEmpresa($request){

        $conn = new bd();
        $conn ->conectar();
        $clientes = [];
        $empresaId = $request->empresaId;


        $query = "select c.nombre as nombre_cliente ,c.id as id_cliente, df.id as id_facturacion from cliente c 
        INNER JOIN datos_facturacion df on df.id  = c.datos_facturacion_id 
        inner join empresa e on e.datos_facturacion_id = df.id
        where e.id = $empresaId ";

        // return $query;


        if($responseBd = $conn->mysqli->query($query)){
            while($dataResponse =$responseBd->fetch_object()){
                $clientes [] = $dataResponse;
            }
        }else{
            return false;
        }
        return $clientes;
        
    }
    function getClienteById($request){

        $conn = new bd();
        $conn ->conectar();
        $clientes = [];
        $clienteId = $request->idCliente;


        $query = "select c.nombre as nombre_cliente ,c.id as id_cliente, df.id as id_facturacion from cliente c 
        INNER JOIN datos_facturacion df on df.id  = c.datos_facturacion_id 
        inner join empresa e on e.datos_facturacion_id = df.id
        where c.id = $clienteId ";

        // return $query;


        if($responseBd = $conn->mysqli->query($query)){
            while($dataResponse =$responseBd->fetch_object()){
                $clientes [] = $dataResponse;
            }
        }else{
            return false;
        }
        return json_encode(array("cliente"=>$clientes));
        
    }


?>