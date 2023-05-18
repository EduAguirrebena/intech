<?php
require_once('./ws/bd/bd.php');
$conn = new bd();
$conn->conectar();

$categorias = [];

$queryProductos = 'Select c.nombre , i.item, p.nombre, mo.modelo, p.precio_arriendo from producto p 
                    INNER JOIN categoria_has_item chi on chi.id = p.categoria_has_item_id 
                    INNER JOIN categoria c on c.id =p.categoria_has_item_id 
                    INNER JOIN item i on i.id  = p.categoria_has_item_id 
                    INNER JOIN marca m on m.id = p.marca_id
                    INNER JOIN modelo mo on mo.marca_id = m.id 
                    WHERE p.empresa_id = 1';



$queryCategorias = 'select c.nombre ,c.id  from categoria c
                    inner join categoria_has_item chi on chi.categoria_id = c.id 
                    INNER JOIN producto p on p.categoria_has_item_id  = chi.id 
                    where p.empresa_id = 1
                    group by c.nombre ';

if($categoriasBdResponse = $conn->mysqli->query($queryCategorias)){
    while($dataCategorias = $categoriasBdResponse->fetch_object()){
        $categorias []=  $dataCategorias;
    }
}else{
    
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
require_once('./includes/head.php');
$active = 'inventario';

?>

<body>
    <script src="./assets/js/initTheme.js"></script>
    <div id="app">

        <?php
        require_once('./includes/sidebar.php');
        ?>


        <div id="main">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="">Categorías</a>
                            <ul class="dropdown-menu">
                                <?php
                                    if(count($categorias) === 0){
                                        echo '<li><a href="">Haz click aquí para poder Crear tus categorías</a></li>';
                                    }else{
                                        foreach ($categorias as $key => $value){
                                            $catNombre = $value->nombre;

                                            echo '<li> <a class="'.strtolower($catNombre).' categoria dropdown-item">'.ucfirst($catNombre).' &raquo</a>';
                                            
                                            $queryItems = "SELECT i.item , c.nombre  from item i 
                                                            INNER JOIN categoria_has_item chi on chi.item_id = i.id 
                                                            INNER JOIN categoria c on c.id =chi.categoria_id 
                                                            INNER JOIN producto p on p.categoria_has_item_id = chi.id
                                                            WHERE LOWER(c.nombre) = '".$catNombre."'
                                                            GROUP BY chi.id ";

                                            $items = [];
                                            $responseBdItems = $conn->mysqli->query($queryItems);
                                            while($dataItems =$responseBdItems->fetch_object()){
                                                $items [] = $dataItems;
                                            }
                                            
                                            if(count($items) > 0){
                                                echo '<ul class="dropdown-menu submenu">';
                                                foreach ($items as $key => $item) {

                                                    echo '<li><a class="'.$item->item.' '.$catNombre.' item dropdown-item">'.$item->item.' </a></li>';
                                                
                                                }
                                                echo '</ul>';
                                            }
                                            echo '</li>';
                                        }
                                    }
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="">Items</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#">Item 1 &raquo;</a>
                                    <ul class="dropdown-menu submenu">
                                        <li><a href="" class="dropdown-item">SubItem</a></li>
                                        <li><a href="" class="dropdown-item">SubItem 2</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="">Item 2</a></li>
                                <li><a class="dropdown-item" href="">Item 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-header">
                <h3>Inventario</h3>
                <div class="row">
                    <div class="col-8 col-lg-3 col-sm-4">
                        <div class="card">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                                Agregar
                            </button>
                        </div>
                    </div>

                    <div class="col-8 col-lg-3 col-sm-4">
                        <div class="card">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#xlarge">
                                Agregar Producots masivo
                            </button>
                            <input class="form-control form-control-sm" id="excel_input" type="file" />
                        </div>
                    </div>

                </div>
            </div>


            <!-- modal agregar personal -->
            <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" style="align-items: center;">
                                Agregar Personal
                            </h3>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="#">
                            <div class="modal-body">
                                <table style="width: 100%;">
                                    <tr>
                                        <td>
                                            <label>Categoria</label>
                                            <div class="form-group">
                                                <select class="form-select">
                                                    <option>opcion 1</option>
                                                    <option>opcion 2</option>
                                                    <option>opcion 3</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <label>Item</label>
                                            <div class="form-group">
                                                <select class="form-select">
                                                    <option>opcion 1</option>
                                                    <option>opcion 2</option>
                                                    <option>opcion 3</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <label>Producto</label>
                                            <div class="form-group">
                                                <input name="rut" type="text" placeholder="Nombre Producto" class="form-control" />
                                            </div>
                                        </td>
                                        <td>
                                            <label>Modelo</label>
                                            <div class="form-group">
                                                <input name="mail" type="text" placeholder="Modelo" class="form-control" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Cantidad Inicial</label>
                                            <div class="form-group">
                                                <input name="telefono" type="text" placeholder="cantidad" class="form-control" />
                                            </div>
                                        </td>
                                        <td>
                                            <label>Especialidad</label>
                                            <div class="form-group">
                                                <select class="form-select">
                                                    <option>opcion 1</option>
                                                    <option>opcion 2</option>
                                                    <option>opcion 3</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <label>Tipo de contrato</label>
                                            <div class="form-group">
                                                <select class="form-select">
                                                    <option>opcion 1</option>
                                                    <option>opcion 2</option>
                                                    <option>opcion 3</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <input type="submit" value="Agregar" class="btn btn-info">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal -->


            <div class="page-content">
                <!-- aca va la info de la pagina -->

                <div class="col-12">
                    <!-- primer  -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body px-4 py-4">
                                    <table class="table" id="tableProductos" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Categoria</th>
                                                <th style="text-align: center;">Item</th>
                                                <th style="text-align: center;">Producto</th>
                                                <th style="text-align: center;">Modelo</th>
                                                <th style="text-align: center;">Cantidad total</th>
                                                <th style="text-align: center;">Cantidad disponible</th>
                                                <th style="text-align: center;">Precio Arriendo</th>
                                                <th style="text-align: center;">Estado</th>
                                                <th style="text-align: center;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align: center;">Categoria</th>
                                                <th style="text-align: center;">Item</th>
                                                <th style="text-align: center;">Producto</th>
                                                <th style="text-align: center;">Modelo</th>
                                                <th style="text-align: center;">Cantidad total</th>
                                                <th style="text-align: center;">Cantidad disponible</th>
                                                <th style="text-align: center;">Precio Arriendo</th>
                                                <th style="text-align: center;">Estado</th>
                                                <th style="text-align: center;">Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal agregar personal masiva -->
            <div class="modal fade modal-xl" id="masivaProductoCreation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Desea ingresar esta información</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div style="margin:0px 30px" class="modal-body">
                            <table class="table" id="excelTable">
                                <thead>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="modalClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-success" id="saveExcelData">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN modal masiva -->



            <!-- Modal errores post agregar Masiva -->
            <div class="modal fade modal-xl" id="modalErrMasiva" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Desea ingresar esta información</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div style="margin:0px 30px" class="modal-body">
                            <table class="table" id="errTable">
                                <thead>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="modalClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-success" id="saveExcelData">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN modal -->

            <?php require_once('./includes/footer.php') ?>

        </div>
    </div>

    <?php require_once('./includes/footerScriptsJs.php') ?>

    <!-- xlsx Reader -->
    <script src="js/xlsxReader.js"></script>
    <script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>

    <!-- Validador intec -->
    <script src="./js/valuesValidator/validator.js"></script>

    <!-- Validate.js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>

</body>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                fixedHeader: true
            });
        })

        $('.categoria').on('click',function(){
            let categoria = $(this).text().split(' ')[0];
            let item = $(this).attr('class').split(' ')[1];
            
            $.ajax({
                    type: "POST",
                    url: "ws/productos/getProductos.php",
                    data: JSON.stringify({categoria : categoria,
                                          item : item,
                                          tipo : "categoria"}),
                    dataType: 'json',
                    success: async function(data) {
                        console.log(data);
                        let tr = ''
                        data.forEach(value => {
                            tr = `<tr>
                                <td>${value.categoria}</td>
                                <td>${value.Item}</td>
                                <td>${value.nombre}</td>
                                <td>${value.modelo}</td>
                                <td>stock</td>
                                <td>Disponibles</td>
                                <td>${value.arriendo}</td>
                                <td>${value.compra}</td>
                                <td>estado</td>
                                <td><i class="fa-solid fa-trash"></i></td>
                            </tr>`
                            $('#tableProductos>tbody').append(tr);
                        });
                        
                        
                    },
                    error: function(data) {
                        console.log(data.responseText);
                    }
                })
        })

        $('.item').on('click',function(){
            let categoria = $(this).attr('class').split(' ')[1];
            let item = $(this).attr('class').split(' ')[0];

            console.log(categoria);

            $.ajax({
                    type: "POST",
                    url: "ws/productos/getProductos.php",
                    data: JSON.stringify({categoria : categoria,
                                          item : item,
                                          tipo : "item"}),
                    dataType: 'json',
                    success: async function(data){
                        console.log(data);
                        let tr = ''
                        $('#tableProductos>tbody').empty()
                        data.forEach(value => {
                            tr = `<tr>
                                <td>${value.categoria}</td>
                                <td>${value.Item}</td>
                                <td>${value.nombre}</td>
                                <td>${value.modelo}</td>
                                <td>stock</td>
                                <td>Disponibles</td>
                                <td>${value.arriendo}</td>
                                <td>${value.compra}</td>
                                <td>estado</td>
                                <td><i class="fa-solid fa-trash"></i></td>
                            </tr>`
                            $('#tableProductos>tbody').append(tr);
                        });
                        
                    },
                    error: function(data) {
                        console.log(data.responseText);
                    }
                })
        })

        const dataArrayIndex = ['Nombre producto', 'marca', 'modelo', 'categoria asociada', 'item asociado', 'cantidad', 'precio compra', 'precio estimado arriendo']
        const dataArray = {
            'xlsxData': [{
                    'name': 'Nombre producto',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                },
                {
                    'name': 'marca',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                },

                {
                    'name': 'modelo',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': true
                },

                {
                    'name': 'categoria asociada',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                },

                {
                    'name': 'item asociado',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 15,
                    'notNull': false
                },

                {
                    'name': 'cantidad',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                },

                {
                    'name': 'precio compra',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                },

                {
                    'name': 'precio estimado arriendo',
                    'type': 'string',
                    'minlength': 3,
                    'maxlength': 50,
                    'notNull': false
                }
            ]
        }

        //Funcion que verifica la extension del archivo ingresado
        function GetFileExtension() {
            fileName = $('#excel_input').val();
            extension = fileName.split('.').pop();
            return extension;
        }

        $('#excel_input').on('change', async function() {
            const extension = GetFileExtension()
            if (extension == "xlsx") {

                const tableContent = await xlsxReadandWrite(dataArray);
                let tableHead = $('#excelTable>thead')
                let tableBody = $('#excelTable>tbody')
                $('#masivaProductoCreation').modal('show')

                //LIMPIAR TABLA
                tableBody.empty()
                tableHead.empty()
                //LLENAR TABLA
                tableHead.append(tableContent[0])
                tableBody.append(tableContent[1])

            } else(
                Swal.fire({
                    icon: 'error',
                    title: 'Ups',
                    text: 'Debes cargar un Excel',
                })
            )
        })


        $('#excelTable>tbody').on('blur', 'td', function() {

            let value = $(this).text()

            //obtencion de las propiedades del TD
            let tdListClass = $(this).attr("class").split(/\s+/);
            let tdClass = tdListClass[0]
            let tdPropertiesIndex = dataArrayIndex.indexOf(tdClass)
            let tdProperties = dataArray.xlsxData[tdPropertiesIndex]

            // SETEO DE PROPIEDADES
            let type = tdProperties.type
            let minlength = tdProperties.minlength
            let maxlength = tdProperties.maxlength
            let notNull = tdProperties.notNull

            //OBTENCION DE PROPIEDADES DE VALOR DE CELDA

            let tdType = isNumeric(value)
            let tdMinlength = minLength(value, minlength)
            let tdMaxlength = maxLength(value, maxlength)

            let tdNull = isNull(value);

            let errorCheck = false
            let tdTitle = ""



            //atributos return a td
            if (!notNull && tdNull) {
                errorCheck = false
                tdTitle = "Ingrese un valor"

            } else {

                if (type === "string" && tdType) {
                    errorCheck = true
                } else if (type === "int" && !tdType) {
                    errorCheck = false
                    tdTitle = "Ingrese un número"
                } else {
                    errorCheck = true
                }
                if (!notNull) {
                    if (!tdMinlength) {
                        tdTitle = `Debe tener un mínimo de ${minlength} caracteres`
                        errorCheck = false
                    }
                    if (!tdMaxlength) {
                        tdTitle = `Debe tener un máximo de ${maxlength} caracteres`
                        errorCheck = false
                    }
                } else {}
            }
            if (!errorCheck) {
                $(this).prop('title', tdTitle)
                $(this).addClass('err')
            } else {
                $(this).prop('title', "")
                $(this).removeClass('err')
            }
        })

        //Cerrar Modal
        $('#modalClose').on('click', function() {
            $('#masivaProductoCreation').modal('hide')
        })



        //GUARDAR REGISTROS MASIVA DENTRO DE MODAL
        $('#saveExcelData').on('click', function() {
            let counterErr = 0;

            $('#excelTable>tbody td').each(function() {

                var cellText = $(this).hasClass('err')
                if (cellText) {
                    counterErr++
                }

            });

            if (counterErr == 0) {

                let arrTd = []
                let preRequest = []

                $('#excelTable>tbody tr').each(function() {

                    arrTd = []
                    let td = $(this).find('td')

                    td.each(function() {
                        let tdTextValue = $(this).text()
                        arrTd.push(tdTextValue)
                    })
                    preRequest.push(arrTd)
                });

                const arrayRequest = preRequest.map(function(value) {
                    let returnArray = {
                        "nombre": value[0],
                        "marca": value[1],
                        "modelo": value[2],
                        "categoria": value[3],
                        "item": value[4],
                        "stock": value[5],
                        "precioCompra": value[6],
                        "precioArriendo": value[7]
                    }
                    return returnArray
                })
                $.ajax({
                    type: "POST",
                    url: "ws/productos/addProductos.php",
                    data: JSON.stringify(arrayRequest),
                    dataType: 'json',
                    success: async function(data) {
                        $('#masivaProductoCreation').modal('hide')
                        $('#excelTable>tbody').empty()

                        let errMarcalLength = data.errMarca.length
                        let errItemCatLength = data.errHasItem.length
                        let sumErr = errMarcalLength + errItemCatLength
                        let total = data.total

                        if (sumErr === 0) {
                            Swal.fire({
                                icon: 'Success',
                                title: 'Excelente',
                                text: `Se han cargado todos los productos (${total})`
                            })
                        } else {
                            let thead = $('#errTable>thead')
                            let tbody = $('#errTable>tbody')

                            let theadTh = `<tr>
                            <th>Nombre producto</th>
                        	<th>marca</th>
                            <th>modelo</th>
                            <th>categoria asociada</th>
                            <th>item asociado</th>
                            <th>cantidad</th>
                            <th>precio compra</th>
                            <th>precio estimado arriendo</th>
                            <th>Causa de error</th></tr>`

                            thead.append(theadTh);

                            let tbodyMarca;
                            if (errMarcalLength > 0) {

                                data.errMarca.forEach(value => {
                                    tbody.append(
                                        `<tr>
                                    <td>${value.nombre}</td>
                                    <td>${value.marca}</td>
                                    <td>${value.modelo}</td>
                                    <td>${value.categoria}</td>
                                    <td>${value.item}</td>
                                    <td>${value.stock}</td>
                                    <td>${value.precioCompra}</td>
                                    <td>${value.precioArriendo}</td>
                                    <td>La marca no existe</td>
                                </tr>`
                                    )
                                });


                            }
                            let tbodyItem;
                            if (errItemCatLength > 0) {

                                data.errHasItem.forEach(value => {
                                    tbody.append(
                                        `<tr>
                                        <td>${value.nombre}</td>
                                        <td>${value.marca}</td>
                                        <td>${value.modelo}</td>
                                        <td>${value.categoria}</td>
                                        <td>${value.item}</td>
                                        <td>${value.stock}</td>
                                        <td>${value.precioCompra}</td>
                                        <td>${value.precioArriendo}</td>
                                        <td>Categoria / Item</td>
                                    </tr>`
                                    )
                                })

                            }
                            $('#modalErrMasiva').modal('show')
                        }
                    },
                    error: function(data) {
                        console.log(data.responseText);
                    }
                })

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ups',
                    text: 'Debe corregir los datos mal ingresado para continuar'
                })
            }
        })
    </script>

</html>