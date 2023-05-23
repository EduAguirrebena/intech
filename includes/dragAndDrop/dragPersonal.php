<div class="row">
    <div class="card col-12 box" style="max-height: 350px; overflow-y: scroll;overflow-x: hidden;">
        <div class="row">
            <div class="col-8 mt-3">
                <h4>Asignar Personal</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 ">
                    <ul id="sortablePersonal1" class="connectedSortablePersonal" style="min-height: 150px;">
                        <?php
                        foreach ($personal as $key => $value) {
                            echo "<li class=". $value->id." >" . $value->nombre." ".$value->cargo." ".$value->especialidad."</li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-6">
                    <ul id="sortablePersonal2" class="connectedSortablePersonal" style="min-height: 150px;">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>