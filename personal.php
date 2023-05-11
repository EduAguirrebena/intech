<?php
require_once('./ws/bd/bd.php');
$conn = new bd();
$conn->conectar();
$arregloPersonal = [];

$queryPersonal = 'SELECT p.nombre, p.apellido ,e.especialidad ,c.cargo, tc.contrato  from personal p
                    INNER JOIN especialidad e on e.id = p.especialidad_id 
                    INNER JOIN cargo c on c.id = p.cargo_id 
                    INNER JOIN tipo_contrato tc on tc.id  = p.tipo_contrato_id 
                    INNER JOIN empresa em on em.id =p.empresa_id 
                    where empresa_id = 1';

$responseDbPersonal = $conn->mysqli->query($queryPersonal);

while($dataPersonal = $responseDbPersonal->fetch_object()){
    $arregloPersonal[] = $dataPersonal;
}

?>

<!DOCTYPE html>
<html lang="en">
  
<?php 

    require_once('./includes/head.php');
    $active = 'personal';
    //$arregloPersonal = [[0,1,2,3,4,5,6,7,8,9],[1,2,3,4,5,6,7,8,9,10],[2,3,4,5,6,7,8,9,10,11],[3,4,5,6,7,8,9,10,11,12],[4,5,6,7,8,9,10,11,12,13],[5,6,7,8,9,10,11,12,13,14],[6,7,8,9,10,11,12,13,14,15],[7,8,9,10,11,12,13,14,15,16],[8,9,10,11,12,13,14,15,16,17],[9,10,11,12,13,14,15,16,17,18],[10,11,12,13,14,15,16,17,18,19],[11,12,13,14,15,16,17,18,19,20],[12,13,14,15,16,17,18,19,20,21],[13,14,15,16,17,18,19,20,21,22],[14,15,16,17,18,19,20,21,22,23],[15,16,17,18,19,20,21,22,23,24],[16,17,18,19,20,21,22,23,24,25],[17,18,19,20,21,22,23,24,25,26],[18,19,20,21,22,23,24,25,26,27],[19,20,21,22,23,24,25,26,27,28],[20,21,22,23,24,25,26,27,28,29],[21,22,23,24,25,26,27,28,29,30],[22,23,24,25,26,27,28,29,30,31]];

?>

  <body>
    <script src="./assets/js/initTheme.js"></script>
    <div id="app">

        <?php require_once('./includes/sidebar.php') ?>

      <div id="main">
        <header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
          </a>
        </header>

        <div class="page-header">
            <h3>Personal</h3>
            <div class="row">
                <div class="col-8 col-lg-3 col-sm-4">
                    <div class="card">
                        <button
                            type="button"
                            class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#xlarge"
                        >
                            Agregar personal
                        </button>
                        <button class="btn mt-2" onclick="ExportToExcel('xlsx')"><h4>Exportar a Excel</h4></button>
                    </div>
                </div>
                <div class="col-8 col-lg-3 col-sm-4">
                    <div class="card">
                        <button
                            type="button"
                            class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#xlarge"
                        >
                            Agregar personal masivo
                        </button>
                        <input class="form-control form-control-sm" id="excel_input" type="file" />
                    </div>
                </div>
            </div>
        </div>
        
        <!-- modal agregar personal -->
        <div
            class="modal fade text-left w-100"
            id="xlarge"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" style="align-items: center;">
                        Agregar Personal
                        </h3>
                        <button
                            type="button"
                            class="close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form id="addPersonal">
                        <div class="modal-body">
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                        <label>Nombres:</label>
                                        <div class="form-group">
                                            <input
                                            name="nombres"
                                            type="text"
                                            placeholder="Nombres"
                                            class="form-control"
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <label>Apellidos:</label>
                                        <div class="form-group">
                                            <input
                                            name="apellidos"
                                            type="text"
                                            placeholder="Apellidos"
                                            class="form-control"
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <label>Rut:</label>
                                        <div class="form-group">
                                            <input
                                            name="rut"
                                            type="text"
                                            placeholder="rut"
                                            class="form-control"
                                        />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Mail</label>
                                        <div class="form-group">
                                            <input
                                            name="mail"
                                            type="text"
                                            placeholder="mail"
                                            class="form-control"
                                        />
                                        </div>
                                    </td>
                                    <td>
                                        <label>Telefono</label>
                                        <div class="form-group">
                                            <input
                                            name="telefono"
                                            type="text"
                                            placeholder="56 9 1231 2345"
                                            class="form-control"
                                        />
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
                            <button
                                type="button"
                                class="btn btn-light-secondary"
                                data-bs-dismiss="modal"
                            >
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
            <!-- PAGE CONTENT -->

            <div class="col-12">
            <!-- primer  -->
                <div class="row" style="text-align: right;">
                    
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body px-4 py-4">

                                <table class="table" id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">nombre</th>
                                            <th style="text-align: center;">apellido</th>
                                            <th style="text-align: center;">especialidad</th>
                                            <th style="text-align: center;">cargo</th>
                                            <th style="text-align: center;">contrato</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                       
                                           
                                            foreach($arregloPersonal as $dato){
                                                echo '<tr>';
                                                echo '<td align="center">'.$dato->nombre.'</td>';
                                                echo '<td align="center">'.$dato->apellido.'</td>';
                                                echo '<td align="center">'.$dato->especialidad.'</td>';
                                                echo '<td align="center">'.$dato->cargo.'</td>';
                                                echo '<td align="center">'.$dato->contrato.'</td>';
                                                echo '</tr>';
                                            }
                                           
                                         ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="text-align: center;">nombre</th>
                                            <th style="text-align: center;">apellido</th>
                                            <th style="text-align: center;">especialidad</th>
                                            <th style="text-align: center;">cargo</th>
                                            <th style="text-align: center;">contrato</th>
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
        <div class="modal fade" id="masivaPersonalCreation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Desea ingresar esta información</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table id="excelTable">
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

        
        <?php require_once('./includes/footer.php') ?>

      </div>
    </div>

    <?php require_once('./includes/footerScriptsJs.php') ?>

    <!-- xlsx Reader -->
    <script src="js/valuesValidator/validator.js"></script>
    <script src="js/xlsxReader.js"></script>
    <script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>

    

<script>
    
$(document).ready(function() {

    $('#example').DataTable( {
        fixedHeader: true
    })

});

const dataArrayIndex=['nombres','apellidos','rut','correo','telefono','contrato']
const dataArray={
    'xlsxData' : 
    [{'name':'nombres',
    'type': 'string',
    'minlength': 3,
    'maxlength' : 50,
    'notNull' : false }
    ,
    {'name':'apellidos',
    'type': 'string',
    'minlength': 3,
    'maxlength' : 50,
    'notNull' : false },

    {'name':'rut',
    'type': 'string',
    'minlength': 3,
    'maxlength' : 50,
    'notNull' : false },

    {'name':'cargo',
    'type': 'string',
    'minlength': 3,
    'maxlength' : 50,
    'notNull' : false },

    {'name':'especialidad',
    'type': 'string',
    'minlength': 3,
    'maxlength' : 15,
    'notNull' : false },

    {'name':'contrato',
    'type': 'string',
    'minlength': 3,
    'maxlength' : 50,
    'notNull' : false }]
}


//Funcion que verifica la extension del archivo ingresado
function GetFileExtension(){
    fileName = $('#excel_input').val();
    extension = fileName.split('.').pop();
    return extension;
}

$('#excel_input').on('change',async function(){
    const extension = GetFileExtension()
    if(extension == "xlsx"){

        const tableContent = await xlsxReadandWrite(dataArray);
        let tableHead= $('#excelTable>thead')
        let tableBody = $('#excelTable>tbody')
        $('#masivaPersonalCreation').modal('show')

        //Limpiar datos de Excel Previo
        tableBody.empty()

        // console.log(tableContent);

        tableHead.append(tableContent[0])
        tableBody.append(tableContent[1])


    }else(
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
    let notNull = tdProperties.notnull

    //OBTENCION DE PROPIEDADES DE VALOR DE CELDA

    let tdType = isNumeric(value)
    let tdMinlength = minLength(value,minlength)
    let tdMaxlength = maxLength(value,maxlength)
    let tdNull = isNull(value)

    let errorCheck = false
    let tdTitle = ""
    //atributos return a td
    if(!notNull  && tdNull){
        errorCheck = false
        tdTitle = "Ingrese un valor"
    }else if(type === "string" && tdType){
        errorCheck = true
    }else if(type === "int" && !tdType){
        errorCheck = false
        tdTitle = "Ingrese un número"
    }else{
        errorCheck = true
    }
    if(!tdMinlength){
        tdTitle = `Debe tener un mínimo de ${minlength} caracteres`
        errorCheck = false
    }
    if(!tdMaxlength){
        tdTitle = `Debe tener un máximo de ${maxlength} caracteres`
        errorCheck = false
    }
    console.log("errorCheck",errorCheck);
    if(!errorCheck){
        $(this).prop('title',tdTitle)
        $(this).addClass('err')
    }else{
        $(this).prop('title',"")
        $(this).removeClass('err')
    }
})

//Cerrar Modal

$('#modalClose').on('click',function(){
    $('#masivaPersonalCreation').modal('hide')
})

//GUARDAR REGISTROS MASIVA DENTRO DE MODAL
$('#saveExcelData').on('click',function(){
    let counterErr = 0;

    $('#excelTable>tbody td').each(function() {

        var cellText = $(this).hasClass('err')  
        if(cellText){
            counterErr ++ 
        }

    });

    if(counterErr == 0){

        let arrTd = []
        let preRequest = []

        $('#excelTable>tbody tr').each(function(){

            arrTd = []
            let td = $(this).find('td')

            td.each(function(){
                let tdTextValue= $(this).text()
                arrTd.push(tdTextValue)
            })
            preRequest.push(arrTd)
        });

        const arrayRequest = preRequest.map(function(value){
            let returnArray = {
                "nombre" : value[0],
                "apellido" : value[1],
                "rut" : value[2],
                "cargo" : value[3],
                "especialidad" : value[4],
                "contrato" : value[5]
            }
           return returnArray
        })

        console.log("arrayRequest",arrayRequest);

            $.ajax({
                type: "POST",
                url: "ws/personal/addpersonal.php",
                data:JSON.stringify(arrayRequest),
                dataType: 'json',
                success: async function(data){
                    console.log(data);
                },error: function(data) {
                    console.log(data.responseText);
                }
            })

    }else{
        Swal.fire({
            icon: 'error',
            title: 'Ups',
            text: 'Debe corregir los datos mal ingresado para continuar'
        })
    }
})




//   const arregloPersonal = <?// echo json_encode($arregloPersonal); ?>;
//   function ExportToExcel(type, fn, dl) {
//     var elt = document.getElementById('example');
//     // console.log(elt);
//     var elt = `<table class="table" id="example" class="display" style="width:100%">
//             <thead>
//                 <tr>
//                     <th style="text-align: center;">Nombre</th>
//                     <th style="text-align: center;">Apellido</th>
//                     <th style="text-align: center;">Rut</th>
//                     <th style="text-align: center;">Email</th>
//                     <th style="text-align: center;">Telefono</th>
//                     <th style="text-align: center;">Cargo</th>
//                     <th style="text-align: center;">Especialidad</th>
//                     <th style="text-align: center;">Tipo Contrato</th>
//                     <th style="text-align: center;">Disponibilidad</th>
//                     <th style="text-align: center;">Acciones</th>
//                 </tr>
//             </thead>
//             <tbody>`
//     arregloPersonal.map((data) => {
//         // console.log(data);
//         elt = elt + '<tr>'
//         data.forEach(dato => {
//             elt = elt + `<td align="center">${dato}</td>`
//         });
//         elt = elt + '</tr>'
//     })
//     elt = elt + `</tbody>
//                 </table>`;
//     console.log(elt);
//     var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
//     return dl ?
//         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64'}):
//         XLSX.writeFile(wb, fn || (`example.` + (type || 'xlsx')));
//}

</script>

  </body>


</html>
