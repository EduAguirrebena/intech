<?php

if ($_POST) {
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;
    
    if(isset($data->vehicleData)){
        $datav = $data->vehicleData;
    }



    // Realiza la acción correspondiente según el valor de 'action'
    switch ($action) {
        case 'getVehiculos':
            // Recibe el parámetro empresaId
            $empresaId = $data->empresaId;
            
            // Llama a la función getVehiculos y devuelve el resultado
            $vehiculos = getVehiculos($empresaId);
            echo json_encode($vehiculos);
            break;
        
        case 'addVehicleToProject':
            // Recibe el parámetro request
            $request = $data->request;
            
            // Llama a la función addtoProject y devuelve el resultado
            $response = addVehicleToProject($request);
            echo json_encode($response);
            break;
        
        case 'getAssigned':
            // Recibe el parámetro empresaId
            $empresaId = $_POST['empresaId'];
            
            // Llama a la función getAssigned y devuelve el resultado
            $assigned = getAssigned($empresaId);
            echo json_encode($assigned);
            break;
        
        case 'deleteVehicle':
            // Recibe el parámetro arrayIdVehicles
            $arrayIdVehicles = $data->arrayIdVehicles;
            
            // Llama a la función deleteVehicle y devuelve el resultado
            $response = deleteVehicle($arrayIdVehicles);
            echo $response;
            break;
        
        case 'addVehicle':
            // Recibe el parámetro vehicleData
            $vehicleData = $data->vehicleData;
            
            // Llama a la función addVehicle y devuelve el resultado
            $response = addVehicle($vehicleData);
            echo $response;
            break;
        
        default:
            echo 'Invalid action.';
            break;
    }
}else{
    require_once('./ws/bd/bd.php');
}



function getVehiculos($empresaId)
{
    $conn = new bd();
    $conn->conectar();
    $vehiculos = [];
    $queryVehiculos = "select v.id, v.patente from vehiculo v 
                        LEFT JOIN persona p on p.id = v.persona_id 
                        inner join empresa e on e.id = v.empresa_id 
                        where e.id = $empresaId and v.IsDelete = 0";

    if ($responseBdVehiculos = $conn->mysqli->query($queryVehiculos)) {
        while ($dataVehiculos = $responseBdVehiculos->fetch_object()) {
            $vehiculos[] = $dataVehiculos;
        }
    }
    $conn->desconectar();
    return $vehiculos;
}

function addVehicleToProject($request)
{
    $conn = new bd();
    $conn->conectar();
    $arrayResponse = [];
    foreach ($request as $req) {

        $idProject = $req->idProject;
        $idVehicle = $req->idVehicle;
        $query = "INSERT INTO intec.proyecto_has_vehiculo
                (proyecto_id, vehiculo_id)
                VALUES($idProject, $idVehicle)";
        if ($conn->mysqli->query($query)) {
            array_push($arrayResponse, array("Asignado" => array("id" => $idVehicle)));
        } else {
            array_push($arrayResponse, array("NoAsignado" => array("id" => $idVehicle)));
        }
    }
    $conn->desconectar();
    return $arrayResponse;
}

function getAssigned($empresaId)
{
    $conn = new bd();
    $conn->conectar();
    $vehiculos = [];
    $queryVehiculos = "SELECT v.id ,v.patente ,v.personal_id  FROM vehiculo v
                                INNER JOIN personal p on p.id = v.personal_id 
                                INNER JOIN empresa e on e.id = p.empresa_id 
                                WHERE e.id = $empresaId";

    if ($responseBdVehiculos = $conn->mysqli->query($queryVehiculos)) {
        while ($dataVehiculos = $responseBdVehiculos->fetch_object()) {
            $vehiculos[] = $dataVehiculos;
        }
    }
    $conn->desconectar();
    return $vehiculos;
}


function deleteVehicle($arrayIdVehicles)
{
    $conn = new bd();
    $conn->conectar();

    $today = date('Y-m-d');
    $arrayResponse = [];

    foreach ($arrayIdVehicles as $persona) {

        $queryDelete = 'update vehiculo set IsDelete = 1, deleteAt = "' . $today . '" where id = ' . $persona->id;

        if ($conn->mysqli->query($queryDelete)) {
            $arrayResponse = json_encode(array("status" => 1, "message" => "Se ha eliminado exitosamente "));
        } else {
            $arrayResponse = json_encode(array("status" => 0, "message" => "Error al eliminar"));
        }
    }

    $conn->desconectar();
    return $arrayResponse;
}

function addVehicle($vehicleData)
{
    $conn = new bd();
    $conn->conectar();
     
    // return json_encode($vehicleArray); 
    $returnErrArray = [];
    foreach ($vehicleData as $key => $value) {
        
        $patente = $key['patente'];
        $nombre = $key['nombre'];
        $empresaId = $key['empresaId'];
        $query = 'select p.id from personal p 
                where CONCAT(LOWER(p.nombre)," ",LOWER(p.apellido))="' . trim(strtolower(($nombre))) . '" LIMIT 1';
        $queryNombre = $conn->mysqli->query($query);

        if ($queryNombre->num_rows > 0) {

            $value = $queryNombre->fetch_object();
            $idPersonal = $value->id;
            $query = "INSERT INTO intec.vehiculo
                        (patente, IsDelete, empresa_id)
                        VALUES('".$patente."', 0, $empresaId)";
            $conn->mysqli->query($query);
        } else {
            array_push($returnErrArray, array("nombre" => $nombre, "patente" => $patente));
        }
    }

    if (count($returnErrArray) > 0) {
        return json_encode(array("status" => 0, "array" => $returnErrArray));
    } else {
        return json_encode(array("status" => 1, "array" => $returnErrArray));
    }
}
?>