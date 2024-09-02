@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">
        <form method="post" action="/nodes">
                @csrf

                    <div class="row">
                       
                        <div class="col-4 mb-2">
                            <label for="example-select" class="form-label">Estado del nodo</label>
                          
                            </select>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="simpleinput" class="form-label">Mensaje</label>
                            <input type="text" name="message" id="simpleinput" class="form-control">
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="mb-2 position-relative">
                                <label class="form-label">&nbsp;</label>
                                <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Cambiar">
                            </div>
                        </div>

                    </div>
            
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
                            <td><?php echo $value->real;?></td>
                            <td><?php echo $value->ws;?></td>
                            <td><?php echo $value->token;?></td>
                            <td role="cell">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary
                                    dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="mdi
                                    mdi-chevron-down"></i></button>
                                    <div class="dropdown-menu">
                                            <a class="btn btn-warning" href="/abminternosmodificar?registro={{$value->$id}}&idreport={{$value->$id}}&pk={{$value->$id}}" role="button"> <i data-feather="edit"></i></a>

                                            <button type="button" onclick="borrar(<?php echo $resultado->$registro; ?>)" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i data-feather="delete"></i></button>

                                    </div>
                                </div><!-- /btn-group -->
                            </td>

                        </tr>

                        <?php }?>

                    </tbody>
                </table>
        </form>

    </div> 
</div> 
</div>
    <br><br><br>
    @include('facu.footer')