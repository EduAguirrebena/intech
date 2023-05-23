<!-- MODAL DIRECCION PROYECTO-->
<div class="modal fade"  id="proyectosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" style="padding: 20px;">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Dirección del proyecto </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <?php
                require_once('./includes/forms/projectForm.php');
            ?>
            <?php if ($detalle) :?>
                <a class="m-2" data-bs-toggle="collapse" href="#collapseVehiclesDragAndDrop"  aria-expanded="false" aria-controls="collapseExample">
                    
                <div class="row justify-content-space-between" style="padding: 0px 10px;">
                    <h5 class="col-md-8 col-12 " style="font-weight: 800;">Asignar Automovil</h5>
                    <i style="text-align: end;" class="fa-solid fa-angle-down col-md-4 col-12 "></i>
                </div>

                </a>
                <hr/>
                <div class="collapse" id="collapseVehiclesDragAndDrop">
                    <?=require_once('./includes/dragAndDrop/dragVehiculos.php');?>
                </div>


                <a class="m-2" data-bs-toggle="collapse" href="#collapsePersonalAssigned"  aria-expanded="false" aria-controls="collapseExample">
                    <div class="row justify-content-space-between" style="padding: 0px 10px;">
                        <h5 class="col-md-8 col-12 " style="font-weight: 800;">Asignar Personal</h5>
                        <i style="text-align: end;" class="fa-solid fa-angle-down col-md-4 col-12 "></i>
                    </div>
                </a>
                <hr/>
                <div class="collapse" id="collapsePersonalAssigned">
                    <?=require_once('./includes/dragAndDrop/dragPersonal.php');?>
                </div>


            <?php  endif;?>
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
</div>
<!-- END MODAL PROYECTO -->