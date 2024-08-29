<div class="card widget-flat">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-normal text-dark" title="Number of Customers">Historial de tickets</h4>
            </div>
            <div>
                <i class="mdi mdi-history widget-icon bg-secondary-lighten text-secondary"></i>
            </div>
        </div>
        <hr style="margin-top: 10px;" />
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12">
                <table id="casadepapel" class="table table-striped dt-responsive nowrap w-100 text-light">
                    <thead>
                        <tr class="text-center bg-dark">
                            <th class="text-light">Ticket</th>
                            <th class="text-light">Departamento</th>
                            <th class="text-light">Tema</th>
                            <th class="text-light">Estado</th>
                            <th class="text-light">Inicio</th>
                        </tr>
                    </thead>
                    <tbody id="tb">
                        <?php foreach ($resultadoshistoricos as $valh) { ?>
                            <tr class="text-center">
                                <td><a href='/ticketunico?tick=<?php echo $valh->id; ?>' target="_blank"><?php echo $valh->id; ?></a></td>
                                <td><?php echo $valh->depto; ?></td>
                                <td><?php echo $valh->tema; ?></td>
                                <td><?php echo $valh->estado; ?></td>
                                <td><?php echo $valh->inicio; ?></td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>