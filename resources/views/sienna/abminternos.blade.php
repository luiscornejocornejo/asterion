@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Internos telefonía</h1>
                </div>
                <button class="btn btn-success" onclick="exportTableToExcel('datatable')">Exportar </button>
                <?php
                if ($master->crear == 1) { ?>
                    <a class="btn btn-primary" href="/abminternoscrear?report={{$master->id}}" role="button">Nuevo</a>
                <?php } ?>
            
                <table class="table table-centered mb-0">
                    <thead class=" bg-dark">
                        <tr class="text-center">
                            <th class="text-light">ID</th>
                            <th class="text-light">Usuario</th>
                            <th class="text-light">Interno</th>
                            <th class="text-light">Password/th>
                            <th class="text-light">Realm</th>
                            <th class="text-light">WS</th>
                            <th class="text-light">Token</th>
                            <th class="text-light">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($internos as $value){?>
                        <tr class="text-center">
                            <td><?php echo $value->id;?></td>
                            <td><?php echo $value->display;?></td>
                            <td><?php echo $value->interno;?></td>
                            <td><?php echo $value->pass;?></td>
                            <td><?php echo $value->realm;?></td>
                            <td><?php echo $value->ws;?></td>
                            <td><?php echo $value->token;?></td>abminternosmodificar
                            <td role="cell">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary
                                    dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="mdi
                                    mdi-chevron-down"></i></button>
                                    <div class="dropdown-menu">
                                        <?php if ($master->modificar == 1) { ?>
                                            <<a class="btn btn-warning" href="/abminternosmodificar?registro={{$value->id}}&idreport={{$value->id}}&pk={{$value->id}}" role="button"> <i data-feather="edit"></i></a>
                                        <?php } ?>
                                        <?php if ($master->eliminar == 1) { ?>

                                            <button type="button" onclick="borrar(<?php echo $value->id; ?>)" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i data-feather="delete"></i></button>

                                        <?php } ?>

                                    </div>
                                </div><!-- /btn-group -->
                            </td>

                        </tr>

                        <?php }?>

                    </tbody>
                </table>
    </div> 
</div> 
</div>
    <br><br><br>
    @include('facu.footer')