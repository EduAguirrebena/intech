<?php 
  require_once('./ws/bd/bd.php');
  $conn = new bd();
  $conn->conectar();

  $vehiculos= [];
  $queryVehiculos = "SELECT v.id ,v.patente ,v.personal_id  FROM vehiculo v
                      INNER JOIN personal p on p.id = v.personal_id 
                      INNER JOIN empresa e on e.id = p.empresa_id 
                      WHERE e.id = 1;";

  if($responseBdVehiculos = $conn->mysqli->query($queryVehiculos)){
    while($dataVehiculos = $responseBdVehiculos->fetch_object()){
      $vehiculos [] = $dataVehiculos;
    }
  }

  $regiones = [];
  $queryRegiones = 'Select id, region from region';
  if($responseRegion = $conn->mysqli->query($queryRegiones)){
    while($dataRegiones = $responseRegion->fetch_object()){
      $regiones[] = $dataRegiones;
    }
  }

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
                      <input type="text" class="form-control" name="txtDir" id="direccionInput" placeholder="Dirección">
                    </div>
                    <div class="col-lg-3 col-md-12">
                      <label for="inputNombreCliente">Nombre Cliente</label>
                      <input type="text" class="form-control" name="txtCliente" id="inputNombreCliente" placeholder="Cliente">
                    </div>
                  </div>
                  
                  <a class="btn btn-primary mt-2" data-bs-toggle="collapse" href="#commentArea" 
                     role="button" aria-expanded="false" aria-controls="collapseExample">
                    Añadir comentarios
                  </a>
                  <hr>
                  <div class="collapse" id="commentArea">
                    <div class="form-floating">
                      <textarea class="form-control" style="min-height: 150px;" placeholder=""
                          id="commentProjectArea" name="txtAreaComments"></textarea>
                      <label for="commentProjectArea">Comentarios</label>
                    </div>                  
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
          <div class="card col-12 box" style="max-height: 350px; overflow-y: scroll;overflow-x: hidden;">
            <div class="row">
              <div class="col-8 mt-3">
                <h4>Asignar Equipamiento</h4>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-8 notSelectedProd moveProd">
                  <table id="sortable3" class="sortingAddProduct">
                    <thead>
                      <th>Nombre</th>
                      <th>Categoria</th>
                      <th>Item</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Cable</td>
                        <td>Audio</td>
                        <td>Sonido</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-4 selectedProd moveProd">
                  <table id="sortable4" class="sortingAddProduct">
                    <thead>
                      <th>Nombre</th>
                      <th>Categoria</th>
                      <th>Item</th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
          
        <div class="row">
          <div class="card col-12 box" style="max-height: 350px; overflow-y: scroll;overflow-x: hidden;">
            <div class="row">
              <div class="col-8 mt-3">
                <h4>Asignar Vehículo</h4>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-6 ">
                  <ul id="sortable1" class="connectedSortable" style="min-height: 150px;">
                    <?php
                      foreach ($vehiculos as $key => $value) {
                        echo "<li class=".$value->id.">".$value->patente."</li>";
                      }
                    ?>
                    <li>Item</li>
                    <li>Item</li>
                    <li>Item</li>
                    <li>Item</li>
                    <li>Item</li>
                    <li>Item</li>
                    <li>Item</li>
                    <li>Item</li>
                    <li>Item</li>
                    <li>Item</li>
                  </ul>
                </div>
                <div class="col-6">

                  <ul id="sortable2" class="connectedSortable" style="min-height: 150px;">
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

  </body>

  <script>
      $(function() {
        
      });


      async function addLugar(lugarRequest){
        console.log(JSON.stringify({request:lugarRequest,
                                    tipo: "add"}));
        return $.ajax({
              type: "POST",
              url: 'ws/lugar/lugar.php',
              data: JSON.stringify({request:lugarRequest,
                                    tipo: "add"}),
              dataType: 'json',
              success: function(data){
                let id_lugar = data.id_lugar;
              },error: function(response){
                console.log(response);
              }
          })
      }
      async function addDir(dirRequest){
        console.log(dirRequest);
        return $.ajax({
            type: "POST",
            url: 'ws/direccion/direccion.php',
            data: JSON.stringify({request:dirRequest,
                                  tipo: "add"}),
            dataType: 'json',
            success: function(data){

              id_direccion = data.id_direccion;
              
            },error: function(response){
              
            }
          })
      }
      async function addCliente(clienteRequest){
        console.log(clienteRequest);
        return $.ajax({
                type: "POST",
                url: 'ws/cliente/cliente.php',
                data: JSON.stringify({request:{clienteRequest},
                                      tipo: "add"}),
                dataType: 'json',
                success: function(data){
                  idCliente = data.idCliente
                },error: function(response){
                  console.log(response.responseText);
                }
              })
      }

      $(document).ready(function() {

        $( "#sortable1, #sortable2" ).sortable({
          connectWith: ".connectedSortable"
        }).disableSelection();

        $( "#sortable3, #sortable4" ).sortable({
          connectWith: ".moveProd"
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
            },message:{
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
              console.log(resultDireccion);
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
              console.log("REQUEST LUGARID",responseLugar);

              id_lugar = responseLugar[0].id_lugar

              let requestProject = {nombre_proyecto:projectName,
                                      lugar_id:id_lugar,
                                      fecha_inicio:fechaInicio,
                                      fecha_termino:fechaTermino,
                                      cliente_id:idCliente,
                                      comentarios:comentarios
                                      // empresa_id:1
                                    }
              console.log(requestProject);

              $.ajax({
                  type: "POST",
                  url: 'ws/proyecto/proyecto.php',
                  data: JSON.stringify({request:{requestProject},
                                        tipo: "add"}),
                  dataType: 'json',
                  success: function(data){
                    console.log("RESPONSE PROYECTO",  data);
                  },error: function(response){
                  }
                })
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
        let request = {'request' : {"idRegion":idRegion},
                       'tipo' :'get'}
        $.ajax({
            type: "POST",
            url: 'ws/pais_region_comuna/comuna.php',
            data: JSON.stringify(request),
            dataType: 'json',
            success: function(data){
              $('#comunaSelect').empty();
              $('#comunaSelect').append(new Option("",""));
              data.forEach(comuna => {
                $('#comunaSelect').append(new Option(comuna.comuna, comuna.id));
              });
              
            },error: function(response){

            }
        })
      })

      //GATILLAR EVENTO CLICK EN BOTON SUBMIT DE FORM PARA CRACION DEL PROYECTO
      $('#submitProject').on('click',function(){
        $('#hiddenAddProject').trigger('click')
      })
  </script>
</html>
