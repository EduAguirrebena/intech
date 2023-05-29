<?php

require_once('./ws/pais_region_comuna/Comuna.php');
require_once('./ws/vehiculo/Vehiculo.php');
require_once('./ws/personal/Personal.php');
require_once('./ws/productos/Producto.php');
require_once('./ws/pais_region_comuna/Region.php');

$empresaId = 1;

// $obj = (object) array('idRegion' => 1);
// // $comunas = getComunasByRegion($obj);
// $vehiculos = getVehiculos($empresaId);
$vehiculos = [];
$personal =  getPersonal($empresaId);
// $personal = [];
// $productos = getProductos($empresaId);
$productos = [];
$regiones = getRegiones();
// $regiones = [];


?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once('./includes/head.php');
$active = 'proximosEventos';
?>

<body>
  <p style="display: none;" id="empresaId"><?= $empresaId ?></p>
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
        <h3>Proximos Eventos</h3>
      </div>

      <div class="page-content">

        <div class="card box">
          <div class="card-body">
            <div class="form-group">
              <div class="mt-2">
                <form id="projectForm">
                  <div class="row">
                    <div class="col-md-4 col-12">
                      <label for="inputProjectName">Nombre del proyecto</label>
                      <input type="text" class="form-control" name="txtProjectName" id="inputProjectName" placeholder="Nombre">
                    </div>
                    <div class="col-md-3 col-12">
                      <label for="fechaInicio">Fecha del Proyecto</label>
                      <input type="date" class="form-control" name="dpInicio" id="fechaInicio">
                    </div>
                    <div class="col-md-3 col-12">
                      <label for="fechaTermino">Fecha del Proyecto</label>
                      <input type="date" class="form-control" name="dpTermino" id="fechaTermino">
                    </div>
                  </div>
                  <div class="mt-2 row">
                    <div class="col-lg-6 col-md-12">
                      <label for="direccionInput">Direccion del proyecto</label>
                      <input autocomplete="off" type="text" class="form-control" name="txtDir" id="direccionInput" placeholder="Dirección">
                    </div>
                    <div class="col-lg-3 col-md-12">
                      <label for="inputNombreCliente">Nombre Cliente</label>
                      <input autocomplete="off" type="text" class="form-control" name="txtCliente" id="inputNombreCliente" placeholder="Cliente">
                    </div>
                  </div>

                  <div class="form-floating mt-3">
                    <textarea class="form-control" style="min-height: 150px;" placeholder="" id="commentProjectArea" name="txtAreaComments"></textarea>
                    <label for="commentProjectArea">Comentarios</label>
                  </div>

                  <button type="submit" style="display: none;" id="hiddenAddProject" class="btn btn-success ml-1 col-4">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Guardar</span>
                  </button>
                </form>

              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="card col-12 box box-productos">
            <div class="row">
              <div class="col-md-4 col-12 mt-4 mb-4">
                <h4 data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" id="showProducts" aria-expanded="false" aria-controls="multiCollapseExample1">
                  Asignar Equipamiento
                </h4>
              </div>
            </div>

            <div class="collapse multi-collapse" id="multiCollapseExample1">
              <div class="card-body dragableItems">
                <div class="row">
                  <div class="col-8 notSelectedProd moveProd">
                    <div id="itemList">
                      <table id="tableProducts">
                        <thead>                          
                          <th style="display:none;">Id</th>
                          <th>Nombre</th>
                          <th>Cateogria</th>
                          <th>Item</th>
                          <th>Precio arriendo</th>
                          <th>Stock</th>
                          <th>Agregar</th>
                        </thead>
                        <tbody id="tableDrop">
                        </tbody>
                      </table>
                    </div>
                  </div>


                  <div class="col-4 selectedProd moveProd" id="tbodyReceive">
                    <div id="receiveProducto" class="">
                      <h3>Productos Asignados</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" data-bs-toggle="collapse" href="#multiCollapseExample2" role="button" id="showProducts" aria-expanded="false" aria-controls="multiCollapseExample2">
          <div class="card col-12 box" style="max-height: 350px; overflow-x: hidden;">
            <div class="row">
              <div class="col-md-4 col-12 mt-4 mb-4">
                <h4>
                  Asignar Vehiculos
                </h4>
              </div>
            </div>

            <div class="collapse multi-collapse" id="multiCollapseExample2">
              <?php require_once('./includes/dragAndDrop/dragVehiculos.php'); ?>
            </div>

          </div>
        </div>


        <div class="row" data-bs-toggle="collapse" href="#multiCollapseExample3" role="button" id="showProducts" aria-expanded="false" aria-controls="multiCollapseExample3">
          <div class="card col-12 box" style="max-height: 350px; overflow-x: hidden;">
            <div class="row">
              <div class="col-md-4 col-12 mt-4 mb-4">
                <h4>
                  Asignar Vehiculos
                </h4>
              </div>
            </div>

            <div class="collapse multi-collapse" id="multiCollapseExample3">
              <?php require_once('./includes/dragAndDrop/dragPersonal.php');?>
            </div>

          </div>
        </div>
        <div class="row" data-bs-toggle="collapse" href="#multiCollapseExample4" role="button" id="showProducts" aria-expanded="false" aria-controls="multiCollapseExample4">
          <div class="card box">
            <div class="row">
              <div class="card-header col-12">
                <h4>Resumen</h4>
              </div>
            </div>
            <div class="row">
            </div>
          </div>
        </div>
          <div class="collapse multi-collapse card" id="multiCollapseExample4">
            <div class="card-body">
              <table id="tableResume">
                <thead>
                  <th class="" style="display: none;">Id</th>
                  <th class="categoriaResume">Categoria</th>
                  <th class="precioResume">Precio</th>
                  <th class="cantidadResume">Cantidad</th>
                </thead>
                <tbody id="resumeBody">

                </tbody>
              </table>
            </div>
            </div>
        </div>

        <div class="card box">
          <div class="row" style="justify-content: end;">
            <div class="col-3 mt-2 mb-2">
              <button class="btn btn-success" id="submitProject">Crear Proyecto</button>
            </div>
            <div class="col-3 mt-2 mb-2">
              <button class="btn btn-success" id="verarray">Ver array</button>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php require_once('./includes/footer.php') ?>
  </div>
  </div>
  <!-- require Modal -->
  <?php require_once('./includes/Modal/direccion.php') ?>
  <?php require_once('./includes/Modal/cliente.php') ?>
  <!-- FIN require Modal -->
  <?php require_once('./includes/footerScriptsJs.php') ?>

</body>

<script>
function AddDivProduct(productName, productPrice,productId,quantity){
  $('#tbodyReceive').append(`<div class="detailsProduct-box">
                <div class="checkitem">
                  <input type="checkbox">
                  <span class="verticalLine"></span>
                </div>
                <div class="itemProperties">
                  <p class="itemId" style="display:none">${productId}</p>
                  <div class="itemName"> 
                    <p>${productName}</p>
                    <hr/>
                  </div>
                  <div class="itemPrice">
                    <p class="getPrice" style="display:none">${productPrice}</p>
                    <p  style="font-size: 15px; font-weight: 700;">Precio arriendo: ${productPrice}</p>
                    <hr/>
                  </div>
                  <div class="itemDetails">
                      <div class="detailQuantity">
                        <p>Cantidad</p>
                        <input type="number" class="addProdInput" min="1" max="" value="${quantity}"/>
                      </div>
                      <div class="containerRemoveLogo">
                        <p style="visibility: hidden;">CANT</p>
                        <i class="fa-solid fa-trash logoRemove" style="color:red;font-size: 30px;"></i>
                      </div>
                  </div>
                </div>
              </div>`);

  
}

  async function addLugar(lugarRequest) {
    return $.ajax({
      type: "POST",
      url: 'ws/lugar/lugar.php',
      data: JSON.stringify({
        request: lugarRequest,
        action: "addLugar"
      }),
      dataType: 'json',
      success: function(data) {
        let id_lugar = data.id_lugar;
        console.log("LUGAR", data);
      },
      error: function(response) {
        console.log(response);
      }
    })
  }
  
  async function addDir(dirRequest) {
    return $.ajax({
      type: "POST",
      url: 'ws/direccion/direccion.php',
      data: JSON.stringify({
        request: dirRequest,
        action: "addDireccion"
      }),
      dataType: 'json',
      success: function(data) {

        id_direccion = data.id_direccion;
        console.log("DIRECCION", data);


      },
      error: function(response) {

      }
    })
  }
  async function addCliente(clienteRequest) {
    return $.ajax({
      type: "POST",
      url: 'ws/cliente/cliente.php',
      data: JSON.stringify({
        request: {
          clienteRequest
        },
        tipo: "addCliente"
      }),
      dataType: 'json',
      success: function(data) {
        idCliente = data.idCliente
        console.log("CLIENTE", data);
      },
      error: function(response) {
        console.log(response.responseText);
      }
    })
  }

  async function createProject(requestProject) {
    return $.ajax({
      type: "POST",
      url: 'ws/proyecto/proyecto.php',
      data: JSON.stringify({
        request: {
          requestProject
        },
        action: "addProject"
      }),
      dataType: 'json',
      success: function(data) {
        console.log("RESPONSE PROYECTO", data);
      },
      error: function(response) {
        console.log(response.responseText);
      }
    })
  }

  async function assignvehicleToProject(requestasssign) {
    return $.ajax({
      type: "POST",
      url: 'ws/vehiculo/Vehiculo.php',
      data: JSON.stringify({
        request: requestasssign,
        action: "addVehicleToProject"
      }),
      dataType: 'json',
      success: function(data) {

        console.log("RESPONSE AGIGNACION VEHICULO", data);

      },
      error: function(response) {
        console.log(response.responseText);
      }
    })
  }

  async function assignPersonal(requestasssign) {
    try {
      return $.ajax({
        type: "POST",
        url: 'ws/personal/Personal.php',
        data: JSON.stringify({
          request: requestasssign,
          action: "addPersonalToProject"
        }),
        dataType: 'json',
        success: function(data) {

          console.log("RESPONSE AGIGNACION PERSONAL", data);

        },
        error: function(response) {
          console.log(response.responseText);
        }
      })
    } catch (e) {
      console.log(e);
    }
  }


  async function assignProduct(requestAssignFunction) {
    try {
      return $.ajax({
        type: "POST",
        url: 'ws/productos/Producto.php',
        data: JSON.stringify({
          request: requestAssignFunction,
          action: "assignProductToProject"
        }),
        dataType: 'json',
        success: function(data) {

          console.log("RESPONSE AGIGNACION PRODUCTOS", data);

        },
        error: function(response) {
          console.log(response.responseText);
        }
      })
    } catch (e) {
      console.log(e);
    }
  }

  //BOTON DE TEST
  $('#verarray').on('click', function() {

    let arrayProducts = []
      $('.detailsProduct-box').each(function() {
          let idProject = $(this).find('.itemId').text();
          let productPrice = $(this).find('.getPrice').text();
          let productQuantity = $(this).find('.addProdInput').val();
          arrayProducts.push({
            idProduct: idProject,
            price: productPrice,
            quantity:productQuantity
          })
      })

      console.log(arrayProducts);

  })
  //FIN BOTON TEST

  $(document).ready(function() {
    const EMPRESA_ID = document.getElementById('empresaId').textContent


    $("#sortable1, #sortable2").sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();

    $("#sortable1, #sortable2").sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();

    $("#sortablePersonal1, #sortablePersonal2").sortable({
      connectWith: ".connectedSortablePersonal"
    }).disableSelection();

    $('#tableResume').DataTable({
            })
    //fillvehiculos

    $.ajax({
        type: "POST",
        url:"ws/vehiculo/Vehiculo.php",
        dataType:'json',
        data:JSON.stringify({"action":"getVehiculos",empresaId:EMPRESA_ID}),
        success:function(response){
          console.log("response",response);

          response.forEach(vehiculo => {
            let li = `<li class="${vehiculo.id}">${vehiculo.patente}</li>`
            $('#sortable1').append(li)
          });
         }
    })

    //FILL PRODUCTOS
    $.ajax({
        type: "POST",
        url:"ws/productos/Producto.php",
        dataType:'json',
        data:JSON.stringify({"action":"getProductos",empresaId:EMPRESA_ID}),
        success:function(response){

          console.log("response",response);
          response.forEach(producto => {
            let td = `
            <td class="productId" style="display:none">${producto.id}</td>
            <td class="productName">${producto.nombre}</td>
            <td class=""> ${producto.categoria}</td>
            <td class=""> ${producto.item}</td>
            <td class="productPrice"> ${producto.precio_arriendo} </td>
            <td class="" >${producto.cantidad}</td>
            <td><input style="margin-right:8px" class="addProdInput quantityToAdd" id="" type="number" min="1" max="${producto.cantidad}"/><i class="fa-solid fa-plus addItem"></i></td>`
            $('#tableDrop').append(`<tr id="${producto.id}">${td}</tr>`)
          });

          $('#tableProducts').DataTable({
            })
         }
    })

    //AGREGAR UN ITEM A LA TABLA DE RESUMEN A UN COSTADO DE 
    //LA TABLA, CREA RESUMEN DEPENDIENDO DE LAS CANTIDADES, NOMBRE Y PRECIO DE ARRIENDO
    $(document).on('click', '.addItem', function(){ 
      let quantityToAdd = $(this).closest("td").find('.quantityToAdd').val()
      let productId = $(this).closest("tr").find('.productId').text();
      console.log("productId",productId);
      let productName = $(this).closest("tr").find('.productName').text();
      let productPrice = $(this).closest("tr").find('.productPrice').text();
        console.log(quantityToAdd);
        if(quantityToAdd === 0 || quantityToAdd === undefined || quantityToAdd === null || quantityToAdd === ""){
          swal.fire()
        }else{
          AddDivProduct(productName,productPrice,productId,quantityToAdd)
          let totalPrice = productPrice *  quantityToAdd;
          let trResume = `<td class="idProd${productId}" style="display:none">${productId}</td>
                          <td class="categoriaResume">${productName}</td>
                          <td class="cantidadResume">${quantityToAdd}</td>
                          <td class="precioResume"><input type"number" value="${totalPrice}"/></td>`;
          $('#resumeBody').append(`<tr>${trResume}</tr>`);
        }
    }); 

    $(document).on('click', '.logoRemove', function(){
        let productId = $(this).closest('.detailsProduct-box').find('.itemId').text()
        console.log(productId);
        $(this).closest('.detailsProduct-box').remove()
        $('#resumeBody').find(`.idProd${productId}`).remove();
        console.log($('#resumeBody > tr').find(`.idProd${productId}`));
    })



    //VALIDACION DE CREACION DE CLIENTE PROYECTO
    $('#clienteAddForm').validate({
      rules: {
        txtNombreCliente: {
          required: true
        }
      },
      messages: {
        txtNombreCliente: {
          required: "true"
        }
      },
      submitHandler: function() {
        event.preventDefault()
        let nombre = $('#txtNombreCliente').val()
        $('#inputNombreCliente').val(nombre)
        $('#clienteModal').modal('hide')
        let request = {
          nombre: nombre
        }
      }
    })

    // VALIDAR FORM AGREGAR DIRECCION
    $('#direccionAddForm').validate({
      rules: {
        txtDir: {
          required: true
        },
        txtNumDir: {
          required: true
        },
        regionSelect: {
          required: true
        },
        comunaSelect: {
          required: true
        }
      },
      messages: {
        txtDir: {
          required: "Debe ingresar un valor"
        },
        txtNumDir: {
          required: "Debe ingresar un valor"
        },
        regionSelect: {
          required: "Debe ingresar un valor"
        },
        comunaSelect: {
          required: "Debe ingresar un valor"
        }
      },
      submitHandler: function() {
        event.preventDefault();

        $("#direccionModal ").modal('hide');
        //DATOS DE DIRECCION
        let dir = $('#txtDir').val()
        let numDir = $('#txtNumDir').val()
        let depto = $('#txtDepto').val()
        let region = $('#regionSelect').val()
        let comuna = $('#comunaSelect').val()
        let regionInput = $('#regionSelect option:selected').text()
        let comunaInput = $('#comunaSelect option:selected').text()
        let postal_code = $('#txtcodigo_postal').val()

        $('#direccionInput').val(`${dir} ${numDir} ${depto}, ${comunaInput}, ${regionInput}`)

      }
    })



    // VALIDAR DATOS Y CREAR PROYECTO
    $('#projectForm').validate({
      rules: {
        txtProjectName: {
          required: true
        },
        dpInicio: {
          required: true
        },
        dpTermino: {
          required: true
        },
        txtDir: {},
        txtCliente: {}
      },
      messages: {
        txtProjectName: {
          required: "Ingrese un valor"
        },
        dpInicio: {
          required: "Ingrese un valor"
        },
        dpTermino: {
          required: "Ingrese un valor"
        },
        txtDir: {
          required: "Ingrese un valor"
        },
        txtCliente: {
          required: "Ingrese un valor"
        }
      },
      submitHandler: async function() {
        event.preventDefault()

        //CREAR CLIENTE PARA PROYECTO
        let idCliente;
        let nombre = $('#txtNombreCliente').val()
        let requestCliente = {
          nombre: nombre
        }

        //DATOS DE DIRECCION
        let dir = $('#txtDir').val()
        let numDir = $('#txtNumDir').val()
        let depto = $('#txtDepto').val()
        let region = $('#regionSelect').val()
        let comuna = $('#comunaSelect').val()
        let regionInput = $('#regionSelect option:selected').text()
        let comunaInput = $('#comunaSelect option:selected').text()
        let postal_code = $('#txtcodigo_postal').val()
        let id_direccion;
        let id_lugar;

        let requestDir = [{
          direccion: dir,
          numero: numDir,
          depto: depto,
          region: region,
          codigo_postal: postal_code,
          comuna: comuna
        }]

        const resultDireccion = await Promise.all([addDir(requestDir), addCliente(requestCliente)])
        id_direccion = resultDireccion[0].id_direccion
        idCliente = resultDireccion[1].idCliente

        //REQUEST LUGAR
        let lugarRequest = [{
          lugar: dir,
          direccion_id: id_direccion
        }]

        // DATOS PARA LA CRECION BASE DE UN PROYECTO
        let projectName = $('#inputProjectName').val();
        let fechaInicio = $('#fechaInicio').val();
        let fechaTermino = $('#fechaTermino').val();
        let direccion = $('#direccionInput').val();
        let nombreCliente = $('#inputNombreCliente').val();
        let comentarios = $('#commentProjectArea').val()

        const responseLugar = await Promise.all([addLugar(lugarRequest)])
        id_lugar = responseLugar[0].id_lugar

        let requestProject = {
          nombre_proyecto: projectName,
          lugar_id: id_lugar,
          fecha_inicio: fechaInicio,
          fecha_termino: fechaTermino,
          cliente_id: idCliente,
          comentarios: comentarios
          // empresa_id:1
        }

        const responseProject = await Promise.all([createProject(requestProject)])
        idProject = responseProject[0].id_project;


        let arrayVehiclesID = []
        $('#sortable2 > li').each(function() {
          let vClass = $(this).attr('class')
          arrayVehiclesID.push({
            idVehiculo: vClass
          })
        })

        const requestVehicle = arrayVehiclesID.map(vId => {
          return {
            idProject: idProject,
            idVehicle: vId.idVehiculo
          };
        })

        let arrayPersonal = []
        $('#sortablePersonal2 > li').each(function() {
          let vClass = $(this).attr('class')
          arrayPersonal.push({
            idPersonal: vClass
          })
        })
        const requestPersonal = arrayPersonal.map(vId => {
          return {
            idProject: idProject,
            idPersonal: vId.idPersonal
          };
        })

        let arrayProducts = []
        $('.detailsProduct-box').each(function() {
            let idProduct = $(this).find('.itemId').text();
            let productPrice = $(this).find('.getPrice').text();
            let productQuantity = $(this).find('.addProdInput').val();
            arrayProducts.push({
              idProject: idProject,
              idProduct: idProduct,
              price: productPrice,
              quantity:productQuantity
            })
        })
        console.log(" 11222222222222223123123123",arrayProducts);

        

        console.log("requestPersonal", requestPersonal);
        console.log("requestVehicle", requestVehicle);

        const responseAssignPersonal = await Promise.all([assignvehicleToProject(requestVehicle), assignPersonal(requestPersonal),assignProduct(arrayProducts)])
        response = responseAssignPersonal
        console.log("responseAssign", response);
      }
    })
  })

  //OPEN MODAL DIRECCION
  $('#direccionInput').on('click', function() {
    $('#direccionModal').modal('show');
  })
  //OPEN MODAL CLIENTE
  $('#inputNombreCliente').on('click', function() {
    $('#clienteModal').modal('show');
  })


  //FIN CIERRE DE ASIGNACIONES

  //OPTIONS CHANGE DEPENDIENDO DE REGION SELECCIONADA
  $('#regionSelect').on('blur', function() {
    let idRegion = $(this).val();
    $.ajax({
      type: 'POST',
      url: 'ws/pais_region_comuna/Comuna.php',
      data: {
        action: 'getComunasByRegion',
        jsonRequest: JSON.stringify({
          idRegion: idRegion
        })
      },
      dataType: 'json',
      success: function(response) {

        var comuna = response;
        $('#comunaSelect').empty();
        $('#comunaSelect').append(new Option("", ""));
        comuna.forEach(comuna => {
          $('#comunaSelect').append(new Option(comuna.comuna, comuna.id))
        })
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error(textStatus, errorThrown);
      }
    });
  })

  //GATILLAR EVENTO CLICK EN BOTON SUBMIT DE FORM PARA CREACION DEL PROYECTO
  $('#submitProject').on('click', function() {
    $('#hiddenAddProject').trigger('click')
  })
</script>

</html>