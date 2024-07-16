<div class="card widget-flat">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-normal text-dark" title="Number of Customers">Tareas del tickets</h4>
            </div>
            <div>
                <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#create-task">
                    <i class="mdi mdi-clipboard-list me-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Crear Tarea."></i>
                    Crear tarea
                </button>
            </div>
        </div>
        <hr style="margin-top: 10px;" />
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12">
                <table id="example" class="table table-striped dt-responsive nowrap w-100 text-light">
                    <thead>
                        <tr class="text-center bg-dark">
                            <th class="text-light">#</th>
                            <th class="text-light">Nombre</th>
                            <th class="text-light">Descripcion</th>
                            <th class="text-light">Estado</th>
                            <th class="text-light">Usuario</th>
                            <th class="text-light">Fecha Limite</th>
                        </tr>
                    </thead>
                    <tbody id="tb">
                        <?php foreach ($resultadostareas as $valh) { ?>
                            <tr class="text-center">
                                <td><a href="ts?idtarea=<?php echo $valh->id ?>" target="_blank""></a><?php echo $valh->id; ?></td>
                                <td><?php echo $valh->nombre; ?></td>
                                <td><?php echo $valh->descripcion; ?></td>
                                <td><?php echo $valh->estadoname; ?></td>
                                <td><?php echo $valh->usuario; ?></td>
                                <td><?php echo $valh->fechalimite; ?></td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    @include('sienna.tu.creartareaticket')

</div>