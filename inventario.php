<!DOCTYPE html>
<html lang="en">
  
<?php 
require_once('./includes/head.php');
$active = 'inventario';

$arregloProductos = [[0,1,2,3,4,5,6,7,8],[1,2,3,4,5,6,7,8,9],[2,3,4,5,6,7,8,9,10],[3,4,5,6,7,8,9,10,11],[4,5,6,7,8,9,10,11,12],[5,6,7,8,9,10,11,12,13],[6,7,8,9,10,11,12,13,14],[7,8,9,10,11,12,13,14,15],[8,9,10,11,12,13,14,15,16],[9,10,11,12,13,14,15,16,17],[10,11,12,13,14,15,16,17,18],[11,12,13,14,15,16,17,18,19],[12,13,14,15,16,17,18,19,20],[13,14,15,16,17,18,19,20,21],[14,15,16,17,18,19,20,21,22],[15,16,17,18,19,20,21,22,23],[16,17,18,19,20,21,22,23,24],[17,18,19,20,21,22,23,24,25],[18,19,20,21,22,23,24,25,26],[19,20,21,22,23,24,25,26,27],[20,21,22,23,24,25,26,27,28],[21,22,23,24,25,26,27,28,29],[22,23,24,25,26,27,28,29,30],[23,24,25,26,27,28,29,30,31],[24,25,26,27,28,29,30,31,32],[25,26,27,28,29,30,31,32,33],[26,27,28,29,30,31,32,33,34],[27,28,29,30,31,32,33,34,35],[28,29,30,31,32,33,34,35,36],[29,30,31,32,33,34,35,36,37],[30,31,32,33,34,35,36,37,38],[31,32,33,34,35,36,37,38,39],[32,33,34,35,36,37,38,39,40],[33,34,35,36,37,38,39,40,41],[34,35,36,37,38,39,40,41,42],[35,36,37,38,39,40,41,42,43],[36,37,38,39,40,41,42,43,44],[37,38,39,40,41,42,43,44,45],[38,39,40,41,42,43,44,45,46],[39,40,41,42,43,44,45,46,47],[40,41,42,43,44,45,46,47,48],[41,42,43,44,45,46,47,48,49],[42,43,44,45,46,47,48,49,50],[43,44,45,46,47,48,49,50,51],[44,45,46,47,48,49,50,51,52],[45,46,47,48,49,50,51,52,53],[46,47,48,49,50,51,52,53,54],[47,48,49,50,51,52,53,54,55],[48,49,50,51,52,53,54,55,56],[49,50,51,52,53,54,55,56,57],[50,51,52,53,54,55,56,57,58],[51,52,53,54,55,56,57,58,59],[52,53,54,55,56,57,58,59,60],[53,54,55,56,57,58,59,60,61],[54,55,56,57,58,59,60,61,62],[55,56,57,58,59,60,61,62,63],[56,57,58,59,60,61,62,63,64],[57,58,59,60,61,62,63,64,65],[58,59,60,61,62,63,64,65,66],[59,60,61,62,63,64,65,66,67],[60,61,62,63,64,65,66,67,68],[61,62,63,64,65,66,67,68,69],[62,63,64,65,66,67,68,69,70],[63,64,65,66,67,68,69,70,71],[64,65,66,67,68,69,70,71,72],[65,66,67,68,69,70,71,72,73],[66,67,68,69,70,71,72,73,74],[67,68,69,70,71,72,73,74,75],[68,69,70,71,72,73,74,75,76],[69,70,71,72,73,74,75,76,77],[70,71,72,73,74,75,76,77,78],[71,72,73,74,75,76,77,78,79],[72,73,74,75,76,77,78,79,80],[73,74,75,76,77,78,79,80,81],[74,75,76,77,78,79,80,81,82],[75,76,77,78,79,80,81,82,83],[76,77,78,79,80,81,82,83,84],[77,78,79,80,81,82,83,84,85],[78,79,80,81,82,83,84,85,86],[79,80,81,82,83,84,85,86,87],[80,81,82,83,84,85,86,87,88],[81,82,83,84,85,86,87,88,89],[82,83,84,85,86,87,88,89,90],[83,84,85,86,87,88,89,90,91],[84,85,86,87,88,89,90,91,92],[85,86,87,88,89,90,91,92,93],[86,87,88,89,90,91,92,93,94],[87,88,89,90,91,92,93,94,95],[88,89,90,91,92,93,94,95,96],[89,90,91,92,93,94,95,96,97],[90,91,92,93,94,95,96,97,98],[91,92,93,94,95,96,97,98,99],[92,93,94,95,96,97,98,99,100],[93,94,95,96,97,98,99,100,101],[94,95,96,97,98,99,100,101,102],[95,96,97,98,99,100,101,102,103],[96,97,98,99,100,101,102,103,104],[97,98,99,100,101,102,103,104,105],[98,99,100,101,102,103,104,105,106],[99,100,101,102,103,104,105,106,107],[100,101,102,103,104,105,106,107,108],[101,102,103,104,105,106,107,108,109],[102,103,104,105,106,107,108,109,110],[103,104,105,106,107,108,109,110,111],[104,105,106,107,108,109,110,111,112],[105,106,107,108,109,110,111,112,113],[106,107,108,109,110,111,112,113,114],[107,108,109,110,111,112,113,114,115],[108,109,110,111,112,113,114,115,116],[109,110,111,112,113,114,115,116,117],[110,111,112,113,114,115,116,117,118],[111,112,113,114,115,116,117,118,119],[112,113,114,115,116,117,118,119,120],[113,114,115,116,117,118,119,120,121],[114,115,116,117,118,119,120,121,122],[115,116,117,118,119,120,121,122,123],[116,117,118,119,120,121,122,123,124],[117,118,119,120,121,122,123,124,125],[118,119,120,121,122,123,124,125,126],[119,120,121,122,123,124,125,126,127],[120,121,122,123,124,125,126,127,128],[121,122,123,124,125,126,127,128,129],[122,123,124,125,126,127,128,129,130],[123,124,125,126,127,128,129,130,131],[124,125,126,127,128,129,130,131,132],[125,126,127,128,129,130,131,132,133],[126,127,128,129,130,131,132,133,134],[127,128,129,130,131,132,133,134,135],[128,129,130,131,132,133,134,135,136],[129,130,131,132,133,134,135,136,137],[130,131,132,133,134,135,136,137,138],[131,132,133,134,135,136,137,138,139],[132,133,134,135,136,137,138,139,140],[133,134,135,136,137,138,139,140,141],[134,135,136,137,138,139,140,141,142],[135,136,137,138,139,140,141,142,143],[136,137,138,139,140,141,142,143,144],[137,138,139,140,141,142,143,144,145],[138,139,140,141,142,143,144,145,146],[139,140,141,142,143,144,145,146,147],[140,141,142,143,144,145,146,147,148],[141,142,143,144,145,146,147,148,149],[142,143,144,145,146,147,148,149,150],[143,144,145,146,147,148,149,150,151],[144,145,146,147,148,149,150,151,152],[145,146,147,148,149,150,151,152,153],[146,147,148,149,150,151,152,153,154],[147,148,149,150,151,152,153,154,155],[148,149,150,151,152,153,154,155,156],[149,150,151,152,153,154,155,156,157],[150,151,152,153,154,155,156,157,158],[151,152,153,154,155,156,157,158,159]];
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
          <h3>Inventario</h3>
            <div class="col-8 col-lg-3 col-sm-4">
                <div class="card">
                    <button
                        type="button"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#xlarge"
                    >
                        Agregar
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
                                            <input
                                            name="rut"
                                            type="text"
                                            placeholder="Nombre Producto"
                                            class="form-control"
                                        />
                                        </div>
                                    </td>
                                    <td>
                                        <label>Modelo</label>
                                        <div class="form-group">
                                            <input
                                            name="mail"
                                            type="text"
                                            placeholder="Modelo"
                                            class="form-control"
                                        />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Cantidad Inicial</label>
                                        <div class="form-group">
                                            <input
                                            name="telefono"
                                            type="text"
                                            placeholder="cantidad"
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
                                    <?php foreach($arregloProductos as $producto){
                                        echo '<tr>';
                                        foreach($producto as $dato){
                                            echo '<td align="center">'.$dato.'</td>';
                                        }
                                        echo '</tr>';
                                    } ?>
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
