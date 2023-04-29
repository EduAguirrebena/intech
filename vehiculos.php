<!DOCTYPE html>
<html lang="en">
  
<?php 
require_once('./includes/head.php');
$active = 'vehiculos';

$arregloPersonal = [[0,1,2,3,4],[1,2,3,4,5],[2,3,4,5,6],[3,4,5,6,7],[4,5,6,7,8],[5,6,7,8,9],[6,7,8,9,10],[7,8,9,10,11],[8,9,10,11,12],[9,10,11,12,13],[10,11,12,13,14],[11,12,13,14,15]];
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
          <h3>Vehiculos</h3>
            <div class="col-8 col-lg-3 col-sm-4">
                <div class="card">
                    <button
                        type="button"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#xlarge"
                    >
                        Agregar vehiculo
                    </button>
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
                        Agregar Vehiculo
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
                    <form action="#">
                        <div class="modal-body">
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                        <label>Patente:</label>
                                        <div class="form-group">
                                            <input
                                            name="nombres"
                                            type="text"
                                            placeholder="Patente"
                                            class="form-control"
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <label>Dueño:</label>
                                        <div class="form-group">
                                            <input
                                            name="apellidos"
                                            type="text"
                                            placeholder="dueño"
                                            class="form-control"
                                            />
                                        </div>
                                    </td>
                                    <td>
                                        <label>Kilometraje:</label>
                                        <div class="form-group">
                                            <input
                                            name="rut"
                                            type="text"
                                            placeholder="numero"
                                            class="form-control"
                                        />
                                        </div>
                                    </td>
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
            <!-- aca va la info de la pagina -->

            <div class="col-12">
            <!-- primer  -->
              <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body px-4 py-4">
                            <table class="table" id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Patente</th>
                                        <th style="text-align: center;">Dueño</th>
                                        <th style="text-align: center;">Documentos</th>
                                        <th style="text-align: center;">Kilmetraje</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($arregloPersonal as $personal){
                                        echo '<tr>';
                                        foreach($personal as $dato){
                                            echo '<td align="center">'.$dato.'</td>';
                                        }
                                        echo '</tr>';
                                    } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center;">Patente</th>
                                        <th style="text-align: center;">Dueño</th>
                                        <th style="text-align: center;">Documentos</th>
                                        <th style="text-align: center;">Kilmetraje</th>
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
        
        <?php require_once('./includes/footer.php') ?>

      </div>
    </div>

    <?php require_once('./includes/footerScriptsJs.php') ?>
    

    <script>
      $(document).ready(function() {
          $('#example').DataTable( {
              fixedHeader: true
          } );
      } );
    </script>

  </body>
</html>
