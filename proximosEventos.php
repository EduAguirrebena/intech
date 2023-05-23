<?php 

  require_once('./ws/pais_region_comuna/Comuna.php');
  require_once('./ws/vehiculo/Vehiculo.php');
  require_once('./ws/personal/Personal.php');
  require_once('./ws/productos/Producto.php');
  require_once('./ws/pais_region_comuna/Region.php');
  
  $empresaId =1;

  // $obj = (object) array('idRegion' => 1);
  // $comunas = getComunasByRegion($obj);
  $vehiculos = getVehiculos($empresaId);
  $personal =  getPersonal($empresaId);
  $productos = getProductos($empresaId);
  $regiones =getRegiones();


?>
<!DOCTYPE html>
<html lang="en">
<?php 
  require_once('./includes/head.php');
  $active = 'proximosEventos';
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
          <h3>Proximos Eventos</h3>
        </div>
        
        <div class="page-content">

        
        <div class="card box">
          <div class="card-body">
            <div class="form-group">
              <div class="mt-2">
                <?php include_once('./includes/forms/projectForm.php')?>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="card col-12 box" style="max-height: 350px; overflow-y: scroll;overflow-x: hidden;">
            <div class="row">
              <div class="col-8 mt-3">
                <h4>Asignar Equipamiento</h4>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-8 notSelectedProd moveProd">
                  <div class="dragItemsHead">
                    <p class="">Nombre</p>
                    <p class="">Cateogria</p>
                    <p class="">Item</p>
                    <p class="">Precio arriendo</p>
                  </div>
                  <div id="itemList">
                    <table>
                      <thead style="display:none">
                        <th>Nombre</th>
                        <th>Cateogria</th>
                        <th>Item</th>
                        <th>Precio arriendo</th>
                      </thead>
                      <tbody id="tableDrop">
                        <?php foreach ($productos as $key => $producto):?>
                          <div class="dragItemsBody">
                            <tr class="dropItemtr">
                              <td class=""><?=$producto->nombre?></td>
                              <td class=""><?=$producto->categoria?></td>
                              <td class=""><?=$producto->item?></td>
                              <td class=""><?=$producto->precio_arriendo?></td>
                            </tr>
                          </div>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>

                
                <!-- <div class="col-4 selectedProd moveProd">
                  <div class="dragItemsHead">
                    <p class="">Nombre</p>
                    <p class="">Cateogria</p>
                    <p class="">Item</p>
                    <p class="">Precio arriendo</p>
                  </div> -->
                  <div class="col-4" id="tbodyReceive">
                    <table>
                      <thead >
                        <th>Nombre</th>
                        <th>Cateogria</th>
                        <th>Item</th>
                        <th>Precio arriendo</th>
                      </thead>
                      <tbody id="">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
         <?php require_once('./includes/dragAndDrop/dragVehiculos.php');
               require_once('./includes/dragAndDrop/dragPersonal.php');
          ?> 
        <div class="card box">
          <div class="row">
            <div class="card-header col-12">
              <h4>Resumen</h4>
            </div>
          </div>
          <div class="row">
          </div>
        </div>

        <div class="card box">
          <div class="row" style="justify-content: end;">
            <div class="col-3 mt-2 mb-2" >
              <button class="btn btn-success" id="submitProject">Crear Proyecto</button>
            </div>
            <div class="col-3 mt-2 mb-2" >
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
    <?php  require_once('./includes/Modal/direccion.php')?>
    <?php  require_once('./includes/Modal/cliente.php')?>
    <!-- FIN require Modal -->
    <?php require_once('./includes/footerScriptsJs.php') ?>

  </body>

  <script>

      async function addLugar(lugarRequest){
        return $.ajax({
                type: "POST",
                url: 'ws/lugar/lugar.php',
                data: JSON.stringify({request:lugarRequest,
                                      action: "addLugar"}),
                dataType: 'json',
                success: function(data){
                  let id_lugar = data.id_lugar;
                  console.log("LUGAR",data);
                },error: function(response){
                  console.log(response);
                }
            })
      }
      async function addDir(dirRequest){
        return $.ajax({
              type: "POST",
              url: 'ws/direccion/direccion.php',
              data: JSON.stringify({request:dirRequest,
                                    action: "addDireccion"}),
              dataType: 'json',
              success: function(data){

                id_direccion = data.id_direccion;
                console.log("DIRECCION",data);

                
              },error: function(response){
                
              }
            })
      }
      async function addCliente(clienteRequest){
        return $.ajax({
                type: "POST",
                url: 'ws/cliente/cliente.php',
                data: JSON.stringify({request:{clienteRequest},
                                      tipo: "addCliente"}),
                dataType: 'json',
                success: function(data){
                  idCliente = data.idCliente
                  console.log("CLIENTE",data);
                },error: function(response){
                  console.log(response.responseText);
                }
              })
      }

      async function createProject(requestProject){
        return $.ajax({
                  type: "POST",
                  url: 'ws/proyecto/proyecto.php',
                  data: JSON.stringify({request:{requestProject},
                                        action: "addProject"}),
                  dataType: 'json',
                  success: function(data){
                    console.log("RESPONSE PROYECTO",  data);
                  },error: function(response){
                    console.log(response.responseText);
                  }
                })
      }

      async function assignvehicleToProject(requestasssign){
          return $.ajax({
                    type: "POST",
                    url: 'ws/vehiculo/Vehiculo.php',
                    data: JSON.stringify({request:requestasssign,
                                          action: "addVehicleToProject"}),
                    dataType: 'json',
                    success: function(data){
  
                      console.log("RESPONSE AGIGNACION VEHICULO",  data);
  
                    },error: function(response){
                      console.log(response.responseText);
                    }
                  })
      }

      async function assignPersonal(requestasssign){
        try{
          return $.ajax({
                    type: "POST",
                    url: 'ws/personal/Personal.php',
                    data: JSON.stringify({request:requestasssign,
                                          action: "addPersonalToProject"}),
                    dataType: 'json',
                    success: function(data){
  
                      console.log("RESPONSE AGIGNACION PERSONAL",  data);
  
                    },error: function(response){
                        console.log(response.responseText);
                    }
                  })
        }catch(e){
          console.log(e);
        }
      }

      //BOTON DE TEST
      $('#verarray').on('click',function(){

        let arrayVehiclesID =[]
        $('#sortable2 > li').each(function(data){
          let vClass = $(this).attr('class')
          arrayVehiclesID.push({
            idVehiculo : vClass
          })
        })
        const requestVehicle = arrayVehiclesID.map(vId =>{
            return {idProject:1,
                    idVehicle:vId.idVehiculo};
        })

        console.log(requestVehicle);
        try{
          return $.ajax({
                    type: "POST",
                    url: 'ws/vehiculo/Vehiculo.php',
                    data: JSON.stringify({request:requestVehicle,
                                          tipo: "addtoProject"}),
                    dataType: 'json',
                    success: function(data){
  
                      console.log("RESPONSE AGIGNACION VEHICULO",  data);
  
                    },error: function(response){
  
                    }
                  })
        }catch(e){
          console.log(e);
        }

        
      })
      //FIN BOTON TEST
      $(document).ready(function() {

        $( "#sortable1, #sortable2" ).sortable({
          connectWith: ".connectedSortable"
        }).disableSelection();

        $( "#sortablePersonal1, #sortablePersonal2" ).sortable({
          connectWith: ".connectedSortablePersonal"
        }).disableSelection();

        $( "#tableDrop, #tbodyReceive" ).sortable({
          connectWith: ".dropItemtr"
        }).disableSelection();

        //VALIDACION DE CREACION DE CLIENTE PROYECTO
        $('#clienteAddForm').validate({
          rules:{
            txtNombreCliente:{
              required:true
            }
          },messages:{
            txtNombreCliente:{
                required:"true"
            }
          },submitHandler:function(){
              event.preventDefault()
              let nombre = $('#txtNombreCliente').val()
              $('#inputNombreCliente').val(nombre)
              $('#clienteModal').modal('hide')
              let request = {nombre:nombre}
          }
        })

        // VALIDAR FORM AGREGAR DIRECCION
        $('#direccionAddForm').validate({
          rules:{
            txtDir:{
              required:true
            },
            txtNumDir:{
              required:true
            },
            regionSelect:{
              required:true
            },
            comunaSelect:{
              required:true
            }
          },
          messages:{
            txtDir:{
              required:"Debe ingresar un valor"
            },
            txtNumDir:{
              required:"Debe ingresar un valor"
            },
            regionSelect:{
              required:"Debe ingresar un valor"
            },
            comunaSelect:{
              required:"Debe ingresar un valor"
            }
          },submitHandler:function(){
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
            rules:{
              txtProjectName:{
                required:true
              },
              dpInicio:{
                required:true
              },
              dpTermino:{
                required:true
              },
              txtDir:{
              },
              txtCliente:{
              }
            },messages:{
              txtProjectName:{
                required:"Ingrese un valor"
              },
              dpInicio:{
                required:"Ingrese un valor"
              },
              dpTermino:{
                required:"Ingrese un valor"
              },
              txtDir:{
                required:"Ingrese un valor"
              },
              txtCliente:{
                required:"Ingrese un valor"
              }
            },submitHandler:async function(){
              event.preventDefault()

              //CREAR CLIENTE PARA PROYECTO
              let idCliente;
              let nombre = $('#txtNombreCliente').val()
              let requestCliente = {nombre:nombre}

              //DATOS DE DIRECCION
              let dir = $('#txtDir').val()
              let numDir = $('#txtNumDir').val()
              let depto = $('#txtDepto').val()
              let region = $('#regionSelect').val()
              let comuna = $('#comunaSelect').val()
              let regionInput = $('#regionSelect option:selected').text()
              let comunaInput = $('#comunaSelect option:selected').text()
              let postal_code = $('#txtcodigo_postal').val()
              let id_direccion ;
              let id_lugar ;

              let requestDir = [{
                direccion : dir,
                numero : numDir,
                depto : depto,
                region : region,
                codigo_postal : postal_code,
                comuna : comuna
              }]

              const resultDireccion = await Promise.all([addDir(requestDir),addCliente(requestCliente)])
              id_direccion = resultDireccion[0].id_direccion
              idCliente = resultDireccion[1].idCliente

              //REQUEST LUGAR
              let lugarRequest = [{
                  lugar : dir,
                  direccion_id : id_direccion
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

              let requestProject = {nombre_proyecto:projectName,
                                      lugar_id:id_lugar,
                                      fecha_inicio:fechaInicio,
                                      fecha_termino:fechaTermino,
                                      cliente_id:idCliente,
                                      comentarios:comentarios
                                      // empresa_id:1
                                    }

                const responseProject = await Promise.all([createProject(requestProject)])
                idProject = responseProject[0].id_project;
                
                
                let arrayVehiclesID =[]
                $('#sortable2 > li').each(function(){
                  let vClass = $(this).attr('class')
                  arrayVehiclesID.push({
                    idVehiculo : vClass
                  })
                })

                const requestVehicle = arrayVehiclesID.map(vId =>{
                    return {idProject:idProject,
                            idVehicle:vId.idVehiculo};
                })

                let arrayPersonal =[]
                $('#sortablePersonal2 > li').each(function(){
                  let vClass = $(this).attr('class')
                  arrayPersonal.push({
                    idPersonal : vClass
                  })
                })
                const requestPersonal = arrayPersonal.map(vId =>{
                    return {idProject:idProject,
                            idPersonal:vId.idPersonal};
                })

                console.log("requestPersonal",requestPersonal);
                console.log("requestVehicle",requestVehicle);


                const responseAssignPersonal = await Promise.all([assignvehicleToProject(requestVehicle),assignPersonal(requestPersonal)])
                response = responseAssignPersonal
                console.log("responseAssignPersonal",response);
            }
          })
      })

      //OPEN MODAL DIRECCION
      $('#direccionInput').on('click', function(){
          $('#direccionModal').modal('show');
        })
      //OPEN MODAL CLIENTE
      $('#inputNombreCliente').on('click', function(){
          $('#clienteModal').modal('show');
        })

      //OPTIONS CHANGE DEPENDIENDO DE REGION SELECCIONADA
      $('#regionSelect').on('blur',function(){
        let idRegion = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'ws/pais_region_comuna/Comuna.php',
            data: {
              action: 'getComunasByRegion',
              jsonRequest: JSON.stringify({ idRegion: idRegion })
            },
            dataType: 'json',
            success: function(response) {

              var comuna = response ;
              $('#comunaSelect').empty();
              $('#comunaSelect').append(new Option("",""));
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
      $('#submitProject').on('click',function(){
        $('#hiddenAddProject').trigger('click')
      })
  </script>
</html>
