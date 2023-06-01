<?php 
require_once('./ws/bd/bd.php');
require_once('./ws/vehiculo/Vehiculo.php');
require_once('./ws/pais_region_comuna/Region.php');
require_once('./ws/proyecto/Proyecto.php');
require_once('./ws/personal/Personal.php');
$conn = new bd();
$conn ->conectar();

//Variables que manipulan condiciones if en Form proyecto
$detalle = true;

//FALTA SETTEAR POR SESSION
$empresaId = 1;

//GET ARRAYS
$vehiculos = getVehiculos($empresaId);
$regiones = getRegiones();
$proyectos = getMyProjects($empresaId);
$personal = getPersonal($empresaId);

// var_dump($vehiculos); echo "<br>";
// var_dump($regiones); echo "<br>";
// var_dump($proyectos); echo "<br>";
// var_dump($personal); echo "<br>";

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
        <?php  require_once('./includes/Constantes/empresaId.php')?>

      <div id="main">
        <header class="mb-3">
          <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
          </a>
        </header>

        <div class="page-header">
          <h3>Proyectos </h3>
        </div>

        <div class="page-content">
            <!-- aca va la info de la pagina -->

            <div class="col-12">
            <!-- primer  -->
              <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body px-4 py-4">
                            <table class="table" id="tableProjects" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Id</th>
                                        <th style="text-align: center;">Nombre Proyecto</th>
                                        <th style="text-align: center;">Nombre Cliente</th>
                                        <th style="text-align: center;">Dirección</th>
                                        <th style="text-align: center;">Fecha Inicio</th>
                                        <th style="text-align: center;">Fecha Termino</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($proyectos as $proyecto){
                                            // print_r($proyecto); echo "<br>";
                                            echo '<tr>';
                                                echo '<td class="idProject" align=center>'.$proyecto->id.'</td>';
                                                echo '<td align=center>'.$proyecto->nombre_proyecto.'</td>';
                                                echo '<td align=center></td>';
                                                echo '<td align=center></td>';
                                                echo '<td align=center></td>';
                                                echo '<td align=center></td>';
                                                echo '<td data-tooltip="Detalles" align=center><i style="cursor:pointer;" class="fa-solid fa-eye openDetalleModal"></i></td>';
                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="text-align: center;">Id</td>
                                        <td style="text-align: center;">Nombre Proyecto</td>
                                        <td style="text-align: center;">Nombre Cliente</td>
                                        <td style="text-align: center;">Dirección</td>
                                        <td style="text-align: center;">Fecha Inicio</td>
                                        <td style="text-align: center;">Fecha Termino</td>
                                        <td style="text-align: center;">Acciones</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>

        <?php 
            require_once('./includes/footer.php');
            require_once('./includes/Modal/detallesProyecto.php');
        ?>
      </div>
    </div>

    <?php require_once('./includes/footerScriptsJs.php') ?>

<script>
$(document).ready(function() {

    $('#tableProjects').DataTable( {
        fixedHeader: true
    } )

    $( "#sortable1, #sortable2" ).sortable({
          connectWith: ".connectedSortable"
    }).disableSelection();

    $( "#sortablePersonal1, #sortablePersonal2" ).sortable({
          connectWith: ".connectedSortablePersonal"
        }).disableSelection();
})

$('.openDetalleModal').on('click',function(){

    let projectId = $(this).closest('tr').find('.idProject').text()
    console.log("idproject",projectId);

    $('#proyectosModal').modal('show');

    let projectRequest={
        idProject : projectId,
        asignados : true
    }


    $.ajax({
        type: "POST",
        url: 'ws/proyecto/Proyecto.php',
        data: JSON.stringify({request:{projectRequest},
                                action: "getProjectResume"}),
        dataType: 'json',
        success: function(response){
            console.log(response);
            response.dataProject.forEach(data => {
                console.log(data);

                $('#inputProjectName').val(data.nombre_proyecto)
                $('#fechaInicio').val(data.fecha_inicio)
                $('#fechaTermino').val(data.fecha_termino)
                $('#direccionInput').val('')
                // $('#direccionInput').val(data.direccion+' '+data.numero+' '+data.dpto+', '+data.comuna+', '+data.region)
                $('#inputNombreCliente').val(data.nombre_cliente)
                $('#commentProjectArea').val(data.comentarios)

                
            });
            if(response.asignados.vehiculos.length > 0){
                response.asignados.vehiculos.forEach(asignado => {
                    $('#sortable2').append(`<li class="${asignado.id}">${asignado.patente}</li>`)
                });
            }
            if(response.asignados.personal.length > 0){
                response.asignados.personal.forEach(asignado => {
                    $('#sortablePersonal2').append(`<li class="${asignado.id}">${asignado.nombre} ${asignado.cargo} ${asignado.especialidad}</li>`)
                });
            }

            console.log(response.asignados.vehiculos);
            console.log(response.asignados.personal);
            
        },error: function(err){
        }
    })
})
</script>
</body>

</html>
