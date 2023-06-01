<?php
if ($_POST) {
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;

    // Realiza la acción correspondiente según el valor de 'action'
    switch ($action) {
        case 'getPersonal':
            // Recibe el parámetro empresaId
            $empresaId = $data->empresaId;
            
            // Llama a la función getPersonal y devuelve el resultado
            $personal = getPersonal($empresaId);
            echo json_encode($personal);
            break;
        
        case 'addPersonalToProject':
            // Recibe el parámetro request
            $request = $data->request;
            
            // Llama a la función addtoProject y devuelve el resultado
            $response = addPersonalToProject($request);
            echo json_encode($response);
            break;

        default:
            echo 'Invalid action.';
            break;
    }
} else {
    require_once('./ws/bd/bd.php');
}

function getPersonal($empresaId)
{
    $conn = new bd();
    $conn->conectar();
    $personal =  [];
    $queryPersonal = "SELECT  p.id, p.cargo_id, CONCAT(per.nombre ,' ',per.apellido) as nombre,
                            c.cargo, e.especialidad  
                        FROM personal p
                        INNER JOIN  persona per on per.id = p.persona_id 
                        INNER JOIN cargo c on c.id  = p.cargo_id 
                        INNER JOIN especialidad e on e.id  = p.especialidad_id 
                        INNER JOIN empresa emp on emp.id = p.empresa_id 
                        where emp.id = $empresaId";

    if ($responseBd = $conn->mysqli->query($queryPersonal)) {
        while ($dataPersonal = $responseBd->fetch_object()) {
            $personal[] = $dataPersonal;
        }
    }
    $conn->desconectar();
    return $personal;
}

function addPersonalToProject($request)
{
    $conn = new bd();
    $conn->conectar();
    $arrayResponse = [];

    foreach ($request as $req) {
        $idProject = $req->idProject;
        $idPersonal = $req->idPersonal;
        $query = "INSERT INTO intec.personal_has_proyecto
                            (personal_id, proyecto_id)
                            VALUES($idPersonal, $idProject)";

        if ($conn->mysqli->query($query)) {

            array_push($arrayResponse, array("Asignado" => array("id" => $idPersonal)));
        } else {

            array_push($arrayResponse, array("NoAsignado" => array("id" => $idPersonal)));
        }
    }

    $conn->desconectar();
    return $arrayResponse;
}
