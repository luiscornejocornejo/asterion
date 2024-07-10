<?php 
                    
                    foreach ($datos2 as $val){
                        echo "<p>id: ".$val->id."</p>";
                        echo "<br>";
                        echo "<p>nombre: ".$val->nombre."</p>";
                        echo "<br>";
                        echo "<p>Descripcion: ".$val->descripcion."</p>";
                        echo "<br>";
                        echo "<p>usuario: ".$val->users."</p>";
                        echo "<br>";
                        echo "<p>ticket: ".$val->siennatickets."</p>";
                        echo "<br>";
                        echo "<p>F. limite: ".$val->fechalimite."</p>";
                        echo "<br>";
                        echo "<p>creado: ".$val->created_at."</p>";
                        echo "<br>";

                        echo "<select name='estado'>";
                        foreach($datos3 as $val3){
                            if($val3->id==$val->estadotarea){
                                $selected=" selected ";

                            }else{
                                $selected="";

                            }
                            echo "<option ".$selected."  value='".$val3->id."'>".$val3->nombre."</option>";
                        }
                        echo "</select>";
                        
                    }?>

<div class="card widget-flat">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-normal text-dark" title="Number of Customers">Información del Ticket #<?php echo "1"; ?></h4>
            </div>
            <div>
                <i class="mdi mdi-note-text widget-icon bg-secondary-lighten text-secondary"></i>
            </div>
        </div>
        <hr style="margin-top: 10px;" />
        <div class="d-flex justify-content-between">
            <div>
                <div class="mb-1">
                    <i class="mdi mdi-list-status"></i> <strong>Estado: </strong><?php echo "2"; ?>
                </div>
                <div class="mb-1">
                    <i class="mdi mdi-office-building"></i> <strong>Departamento: </strong><?php echo "3"; ?>
                </div>
                <div class="mb-1">
                    <i class="mdi mdi-account-voice"></i> <strong>Asignado a: </strong><?php echo "4"; ?>
                </div>

            </div>

            <div>
                <div class="mb-1">
                    <i class="mdi mdi-calendar"></i> <strong>Creado: </strong><?php echo "5"; ?>
                </div>
                
            </div>
        </div>


    </div>

</div>