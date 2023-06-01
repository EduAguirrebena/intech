<?php

if ($_POST){
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;
    
    // Realiza la acción correspondiente según el valor de 'action'
    switch($action) {
        case 'addProject':
            $request = $data->request;
            $result = addProject($request);
            break;
        case 'getProjectResume':
            $request = $data->request;
            $result = getProjectResume($request);
            break;
        case 'getMyProjects':
            $empresaId = $data->empresaId;
            $result = getMyProjects($empresaId);
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

        function addProject($request){
            $conn = new bd();
            $conn ->conectar();
            $today = date('Y-m-d');
       
            foreach($request as $req){
       
               $nombre_proyecto = $req->nombre_proyecto;
               $lugar_id = $req->lugar_id;
               $fecha_inicio = $req->fecha_inicio;
               $fecha_termino = $req->fecha_termino;
               $cliente_id = $req->cliente_id;
               $comentarios = $req->comentarios;
               // $empresa_id = $req->empresa_id;
            }


                if($lugar_id === ""){
                   $lugar_id = "null";
                }else{
                    $lugar_id = "'".$lugar_id."'";
                }
                if($cliente_id === ""){
                    $cliente_id = "null";
                }else{
                    $cliente_id = "'".$cliente_id."'";
                }       
                if($fecha_inicio === ""){
                   $fecha_inicio = "null";
                }else{
                    $fecha_inicio = "'".$fecha_inicio."'";
                }
                if($fecha_termino === ""){
                    $fecha_termino = "null";
                }else{
                    $fecha_termino = "'".$fecha_termino."'";
                }       
            $query = "INSERT INTO intec.proyecto
            (nombre_proyecto, lugar_id, fecha_inicio, fecha_termino, createAt, IsDelete , cliente_id, empresa_id,comentarios)
            VALUES('".$nombre_proyecto."', $lugar_id,$fecha_inicio, $fecha_termino,'".$today."', 0, $cliente_id, 1,'".$comentarios."')";
       
           if($conn->mysqli->query($query)){
                $id_project = $conn->mysqli->insert_id;
                $conn->desconectar();
                return json_encode(array("id_project"=>$id_project));
           }else{
                $conn->desconectar();
                return false;
           }
        }

        function getProjectResume($request){
            $conn = new bd();
            $conn->conectar();
        
            $asignadosV = [];
            $asignadosPer = [];
            $asignadosPro = [];
            $projects = [];
            $viewasignados = false;
        
            foreach ($request as $key => $value) {
                $idProject = $value->idProject;
                
                if(isset($value->asignados)){
                    $viewasignados = true;
                }
            }

            if($viewasignados){
                $queryVehiclesAsignados = "SELECT v.id, v.patente from vehiculo v 
                    INNER JOIN proyecto_has_vehiculo phv ON phv.vehiculo_id = v.id 
                    INNER JOIN proyecto p on p.id = phv.proyecto_id 
                    WHERE p.id = $idProject";
                $queryPersonalAsignados = "SELECT p.id ,CONCAT(p.nombre,' ',p.apellido) as nombre,
                                            c.cargo , e.especialidad 
                                        from personal p 
                                        INNER JOIN personal_has_proyecto php on php.personal_id = p.id 
                                        INNER JOIN proyecto pro on pro.id  = php.proyecto_id 
                                        INNER JOIN cargo c on c.id = p.cargo_id 
                                        INNER JOIN especialidad e on e.id = p.especialidad_id 
                                        where pro.id =  $idProject";
            }
        
            $query = "SELECT p.*
                    -- p.nombre_proyecto as proyecto, p.fecha_inicio,
                    -- p.fecha_termino,d.direccion ,d.numero, d.dpto,co.comuna,
                    -- r.region,c.nombre as nombre_cliente, v.patente, p.comentarios
                    FROM proyecto p 
                    -- INNER JOIN cliente c on c.id = p.cliente_id 
                    -- INNER JOIN empresa e on e.id = p.empresa_id 
                    -- LEFT JOIN gastos g on g.id = p.gastos_id 
                    -- INNER JOIN lugar l on l.id = p.lugar_id 
                    -- INNER JOIN direccion d on d.id  = l.direccion_id 
                    -- LEFT JOIN arriendos a on a.id  = p.arriendos_id 
                    -- INNER JOIN comuna co on co.id =d.comuna_id 
                    -- INNER JOIN region r on r.id  = co.region_id 
                    -- LEFT JOIN proyecto_has_vehiculo phv ON phv.proyecto_id =p.id 
                    -- LEFT JOIN vehiculo v on v.id = phv.vehiculo_id 
                    WHERE p.id = $idProject";
        
            if($responseBd = $conn->mysqli->query($query)){
                while($dataProject = $responseBd->fetch_object()){
                    $projects [] = $dataProject;
                }
            }
            if($viewasignados){
                if($responseBd = $conn->mysqli->query($queryVehiclesAsignados)){
                    while($dataAsignadosV = $responseBd->fetch_object()){
                        $asignadosV [] = $dataAsignadosV;
                    }
                }
                if($responseBd = $conn->mysqli->query($queryPersonalAsignados)){
                    while($dataAsignadosPer = $responseBd->fetch_object()){
                        $asignadosPer [] = $dataAsignadosPer;
                    }
                }
            }
            $conn->desconectar();
            return json_encode(array("dataProject"=>$projects,"asignados"=>array("vehiculos"=>$asignadosV,"personal"=>$asignadosPer)));
        }

        function getMyProjects($empresa_id){
            $conn = new bd();
            $conn->conectar();

            $projects=[];
            // $queryProyectos = "SELECT p.id, p.nombre_proyecto,p.empresa_id,c.nombre, 
            //     CONCAT(d.direccion,' ',d.numero,', ',co.comuna,', ',r.region) AS direccion,
            //     p.fecha_inicio,
            //     p.fecha_termino,
            //     p.comentarios 
            //     FROM proyecto p 
            //     INNER JOIN lugar l ON l.id = p.lugar_id 
            //     INNER JOIN cliente c ON c.id = p.cliente_id 
            //     INNER JOIN empresa e ON e.id = p.empresa_id 
            //     INNER JOIN direccion d ON d.id  = l.direccion_id 
            //     INNER JOIN comuna co ON co.id = d.comuna_id  
            //     INNER JOIN region r ON r.id = co.region_id 
            //     Where e.id = $empresa_id";
            $queryProyectos = "SELECT p.*
                FROM proyecto p 
                INNER JOIN empresa e ON e.id = p.empresa_id 
                Where e.id = $empresa_id";
            if($responseBd = $conn->mysqli->query($queryProyectos)){
                while($dataProject = $responseBd->fetch_object()){
                    $projects [] = $dataProject;
                }
            }
            return $projects;
        }
    
?>