<div class="card widget-flat">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <?php foreach ($datos2 as $val) { ?>
                <div>
                    <h4 class="fw-normal text-dark" title="Number of Customers">Información de tarea #<?php echo $val->id; ?></h4>
                </div>
                <div>
                    <i class="mdi mdi-note-text widget-icon bg-secondary-lighten text-secondary"></i>
                </div>
        </div>
        <hr style="margin-top: 10px;" />
        <div class="d-flex justify-content-between">
            <div>
                <div class="mb-1">
                    <i class="mdi mdi-list-status"></i> <strong>Nombre: </strong><?php echo $val->nombre; ?>
                </div>
                <div class="mb-1">
                    <i class="mdi mdi-format-list-numbered"></i> <strong>Descripción: </strong><?php echo $val->descripcion; ?>
                </div>
                <div class="mb-1">
                    <i class="mdi mdi-account-voice"></i> <strong>Agente asignado: </strong><?php echo $val->users; ?>
                </div>

            </div>

            <div>
                <div class="mb-1">
                    <i class="mdi mdi-ticket-confirmation"></i> <strong>Ticket de referencia: </strong><?php echo $val->siennatickets; ?>
                </div>
                <div class="mb-1">
                    <i class="mdi mdi-calendar-clock-outline"></i> <strong>Expira el: </strong><?php echo $val->fechalimite; ?>
                </div>
                <div class="mb-1">
                    <i class="mdi mdi-calendar"></i> <strong>Creado el </strong><?php echo $val->created_at; ?>
                </div>
                <div class="mb-1">
                    <i class="mdi-format-list-checks"></i> <strong>Estado: </strong>
                    <select name='estado' class='form-control'>
                        <?php
                        foreach ($datos3 as $val3) {
                            if ($val3->id == $val->estadotarea) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option " . $selected . "  value='" . $val3->id . "'>" . $val3->nombre . "</option>";
                        }
                        ?>
                    </select>
                </div>

            </div>
        </div>
    <?php } ?>
    </div>

</div>