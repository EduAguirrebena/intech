<?php 

require_once('./ws/bd/bd.php');
$conn = new bd();
$conn ->conectar();

$queryProyectos = 'SELECT p.nombre_proyecto,p.empresa_id,c.nombre, 
CONCAT(d.direccion," ",d.numero,", ",co.comuna,", ",r.region) AS direccion,
p.fecha_inicio,
p.fecha_termino,
p.comentarios 
FROM proyecto p 
INNER JOIN lugar l ON l.id = p.lugar_id 
INNER JOIN cliente c ON c.id = p.cliente_id 
INNER JOIN empresa e ON e.id = p.empresa_id 
INNER JOIN direccion d ON d.id  = l.direccion_id 
INNER JOIN comuna co ON co.id = d.comuna_id  
INNER JOIN region r ON r.id = co.region_id 
Where e.id = 1';




//BUILD PROYECTOS
if($responseBdProjects = $conn->mysqli->query($queryProyectos)){
    while($dataProjects = $responseBdProjects->fetch_objecT()){
        $proyectos [] = $dataProjects;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php 
    require_once('./includes/head.php');
    $active = 'vehiculos';
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
                                        
                                        <th style="text-align: center;">Nombre Proyecto</th>
                                        <th style="text-align: center;">Nombre Cliente</th>
                                        <th style="text-align: center;">Dirección</th>
                                        <th style="text-align: center;">Fecha Inicio</th>
                                        <th style="text-align: center;">Fecha Termino</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($proyectos as $proyecto){
                                            echo '<tr>';
                                                echo '<td class="patente" align=center>'.$proyecto->nombre_proyecto.'</td>';
                                                echo '<td align=center>'.$proyecto->nombre.'</td>';
                                                echo '<td align=center>'.$proyecto->direccion.'</td>';
                                                echo '<td align=center>'.$proyecto->fecha_inicio.'</td>';
                                                echo '<td align=center>'.$proyecto->fecha_termino.'</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="text-align: center;">Nombre Proyecto</td>
                                        <td style="text-align: center;">Nombre Cliente</td>
                                        <td style="text-align: center;">Dirección</td>
                                        <td style="text-align: center;">Fecha Inicio</td>
                                        <td style="text-align: center;">Fecha Termino</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <?php require_once('./includes/footer.php') ?>

      </div>
    </div>

    <?php require_once('./includes/footerScriptsJs.php') ?>

<script>
$(document).ready(function() {
    $('#tableProjects').DataTable( {
        fixedHeader: true
    } );
})  
</script>

  </body>
</html>
