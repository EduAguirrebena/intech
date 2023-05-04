<!DOCTYPE html>
<html lang="en">
  
<?php 
require_once('./includes/head.php');
$active = 'personal';

$arregloPersonal = [[0,1,2,3,4,5,6,7,8,9],[1,2,3,4,5,6,7,8,9,10],[2,3,4,5,6,7,8,9,10,11],[3,4,5,6,7,8,9,10,11,12],[4,5,6,7,8,9,10,11,12,13],[5,6,7,8,9,10,11,12,13,14],[6,7,8,9,10,11,12,13,14,15],[7,8,9,10,11,12,13,14,15,16],[8,9,10,11,12,13,14,15,16,17],[9,10,11,12,13,14,15,16,17,18],[10,11,12,13,14,15,16,17,18,19],[11,12,13,14,15,16,17,18,19,20],[12,13,14,15,16,17,18,19,20,21],[13,14,15,16,17,18,19,20,21,22],[14,15,16,17,18,19,20,21,22,23],[15,16,17,18,19,20,21,22,23,24],[16,17,18,19,20,21,22,23,24,25],[17,18,19,20,21,22,23,24,25,26],[18,19,20,21,22,23,24,25,26,27],[19,20,21,22,23,24,25,26,27,28],[20,21,22,23,24,25,26,27,28,29],[21,22,23,24,25,26,27,28,29,30],[22,23,24,25,26,27,28,29,30,31]];
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
            <!-- aca va la info de la pagina -->

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
                                            <th style="text-align: center;">Nombre</th>
                                            <th style="text-align: center;">Apellido</th>
                                            <th style="text-align: center;">Rut</th>
                                            <th style="text-align: center;">Email</th>
                                            <th style="text-align: center;">Telefono</th>
                                            <th style="text-align: center;">Cargo</th>
                                            <th style="text-align: center;">Especialidad</th>
                                            <th style="text-align: center;">Tipo Contrato</th>
                                            <th style="text-align: center;">Disponibilidad</th>
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
                                            <th style="text-align: center;">Nombre</th>
                                            <th style="text-align: center;">Apellido</th>
                                            <th style="text-align: center;">Rut</th>
                                            <th style="text-align: center;">Email</th>
                                            <th style="text-align: center;">Telefono</th>
                                            <th style="text-align: center;">Cargo</th>
                                            <th style="text-align: center;">Especialidad</th>
                                            <th style="text-align: center;">Tipo Contrato</th>
                                            <th style="text-align: center;">Disponibilidad</th>
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

      const arregloPersonal = <?php echo json_encode($arregloPersonal); ?>;
      

      function ExportToExcel(type, fn, dl) {

        // var elt = document.getElementById('example');
        // console.log(elt);

        var elt = `<table class="table" id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th style="text-align: center;">Nombre</th>
                        <th style="text-align: center;">Apellido</th>
                        <th style="text-align: center;">Rut</th>
                        <th style="text-align: center;">Email</th>
                        <th style="text-align: center;">Telefono</th>
                        <th style="text-align: center;">Cargo</th>
                        <th style="text-align: center;">Especialidad</th>
                        <th style="text-align: center;">Tipo Contrato</th>
                        <th style="text-align: center;">Disponibilidad</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
                <tbody>`

        arregloPersonal.map((data) => {
            // console.log(data);
            elt = elt + '<tr>'
            data.forEach(dato => {
                elt = elt + `<td align="center">${dato}</td>`
            });
            elt = elt + '</tr>'
        })

        elt = elt + `</tbody>
                    </table>`;
        
        console.log(elt);
        
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64'}):
            XLSX.writeFile(wb, fn || (`example.` + (type || 'xlsx')));
        }

    </script>

  </body>
</html>
