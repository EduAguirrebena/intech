<?php
if ($_POST) {
    require_once('../bd/bd.php');

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $action = $data->action;
    // Realiza la acción correspondiente según el valor de 'action'
    switch ($action) {
        case 'sortProducts':
            // Recibe el parámetro requestJson
            $requestJson = $data->requestJson;
            
            // Llama a la función sortProducts y devuelve el resultado
            $sortedProducts = sortProducts($requestJson);
            echo $sortedProducts;
            break;
        
        case 'getProductos':
            // Recibe el parámetro empresaId
            $empresaId = $_POST['empresaId'];
            
            // Llama a la función getProductos y devuelve el resultado
            $productos = getProductos($empresaId);
            echo json_encode($productos);
            break;
        
        case 'addProd':
            // Recibe el parámetro jsonCreateProd
            $jsonCreateProd = $data->jsonCreateProd;
            
            // Llama a la función addProd y devuelve el resultado
            $addProdResponse = addProd($jsonCreateProd);
            echo $addProdResponse;
            break;
        default:
            echo 'Invalid action.';
            break;
    }
} else {
    require_once('./ws/bd/bd.php');
}

    function sortProducts($requestJson){
        $conn = new bd();
        $conn ->conectar();
        $data = $requestJson;
        $item = $data->item;
        $categoria = $data->categoria;
        $tipo = $data->tipo;
        $queryProd = "";
    
        if($tipo === "categoria"){
            $queryProd = "SELECT i.item as Item ,c.nombre as categoria, p.nombre as nombre, p.precio_arriendo as arriendo, p.precio_compra as compra ,
                          mo.modelo as modelo ,m.marca as marca 
            from producto p 
            INNER JOIN categoria_has_item chi on chi.id = p.categoria_has_item_id 
            INNER JOIN categoria c on c.id = chi.categoria_id 
            INNER JOIN marca m on m.id = p.marca_id 
            INNER JOIN modelo mo on mo.marca_id = m.id
            INNER JOIN item i on i.id  = chi.item_id 
            WHERE LOWER(c.nombre) = '".strtolower($categoria)."' and p.empresa_id = 1
            GROUP BY p.nombre";
        }
    
        if($tipo === "item"){
            $queryProd ="SELECT i.item as Item ,c.nombre as categoria, p.nombre as nombre, p.precio_arriendo as arriendo, p.precio_compra as compra, 
                         mo.modelo as modelo ,m.marca as marca 
            from producto p 
            INNER JOIN categoria_has_item chi on chi.id =p.categoria_has_item_id 
            INNER JOIN categoria c on c.id = chi.categoria_id 
            INNER JOIN marca m on m.id = p.marca_id 
            INNER JOIN modelo mo on mo.marca_id = m.id
            INNER JOIN item i on i.id  = chi.item_id 
            WHERE LOWER(i.item) = '".strtolower($item)."' and LOWER(c.nombre)= '".strtolower($categoria)."' and p.empresa_id = 1
            GROUP BY p.nombre";
        }
    
        $responseBdProd = $conn->mysqli->query($queryProd);
        while($dataItems =$responseBdProd->fetch_object()){
            $productos [] = $dataItems;
        }

        $conn->desconectar();
        return json_encode($productos);
    }


    function getProductos($empresaId){
        $conn = new bd();
        $conn->conectar();

        $productos = [];
        $queryRegiones = "SELECT p.id, p.nombre, c.nombre as categoria, i.item, p.precio_arriendo FROM producto p 
                            INNER JOIN empresa e on e.id = p.empresa_id 
                            INNER JOIN categoria_has_item chi on chi.id = p.categoria_has_item_id 
                            INNER JOIN categoria c on c.id = chi.categoria_id 
                            INNER JOIN item i on i.id  = chi.item_id 
                            WHERE e.id = $empresaId";

        if($responseProductos = $conn->mysqli->query($queryRegiones)){
            while($dataProductos = $responseProductos->fetch_object()){
                $productos[] = $dataProductos;
            }
        }
        $conn->desconectar();
        return $productos;
    }



    function addProd($jsonCreateProd){
        $conn = new bd();
        $conn ->conectar();

        $data = json_decode($jsonCreateProd);
        $productoArr = $data;
        $today = date('Y-m-d');
        $jsonErrMarca = [];
        $jsonErrItemHasClass = [];
        $err = false ; 

        foreach ($productoArr as $key => $value){

            $err = false ; 
            $nombre = $value->nombre;
            $marca = $value->marca;
            $modelo = $value->modelo;
            $categoria = $value->categoria;
            $item = $value->item;
            $stock = $value->stock;
            $precioCompra = $value->precioCompra;
            $precioArriendo = $value->precioArriendo;

            $queryIdMarca =$conn->mysqli->query("Select m.id  from marca m where LOWER(m.marca) ='".strtolower($marca)."'");
        
            if($queryIdMarca->num_rows === 0){
                array_push($jsonErrMarca,array(
                    "nombre"=>$nombre,
                    "marca"=>$marca,
                    "modelo"=>$modelo,
                    "categoria"=>$categoria,
                    "item"=>$item,
                    "stock"=>$stock,
                    "precioCompra"=>$precioCompra,
                    "precioArriendo"=>$precioArriendo));
                $err = true;
            }else{
                $dataBdResponse = $queryIdMarca->fetch_object();
                $idMarca = $dataBdResponse->id;
            }

            if(!$err){

                $queryItemHasId = $conn->mysqli->query("SELECT chi.id FROM categoria_has_item chi 
                INNER JOIN categoria c on c.id =chi.categoria_id 
                INNER JOIN item i on i.id = chi.item_id 
                where LOWER(c.nombre)='".strtolower($categoria) ."' AND LOWER(i.item) ='". strtolower($item) ."'");

                if($queryItemHasId->num_rows === 0){
                    array_push($jsonErrItemHasClass,array(
                        "nombre"=>$nombre,
                        "marca"=>$marca,
                        "modelo"=>$modelo,
                        "categoria"=>$categoria,
                        "item"=>$item,
                        "stock"=>$stock,
                        "precioCompra"=>$precioCompra,
                        "precioArriendo"=>$precioArriendo));
                    $err = true;
                }else{
                    $dataBdResponse = $queryItemHasId->fetch_object();
                    $cathasitemId = $dataBdResponse->id;
                }
                
                if(!$err){

                    $queryProducto = "INSERT INTO intec.producto
                    (nombre, marca_id, categoria_has_item_id, codigo_barra, precio_compra, precio_arriendo, createAt, IsDelete, empresa_id)
                    VALUES('".$nombre."',".$idMarca.",".$cathasitemId.", '11011001',".$precioCompra.",".$precioArriendo.", '".$today."', 0,1)";

                    if($conn->mysqli->query($queryProducto)){
                    }
                }
            }
        }

        return json_encode(array("total"=>count($productoArr),"errMarca"=>$jsonErrMarca,"errHasItem"=>$jsonErrItemHasClass));
    }


?>