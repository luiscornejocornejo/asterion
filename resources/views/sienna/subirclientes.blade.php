@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">
    <div class="card-header">
                        <h4 class="card-title">Datos</h4>
                        <p class="card-title-desc">
                        <a href="/linknetclientes">Descarga Template</a>

                        </p>
                    </div>
    <form action="" method="post" enctype="multipart/form-data">
           
           @csrf                                <div class="fallback">
                                    <input name="file" type="file"
                                        multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted bx
                                            bx-cloud-upload"></i>
                                    </div>
                                    <button type="submit" class="btn btn-primary
                                waves-effect waves-light">Send</button>
                                    
                                </div>

                            </form>

                            <table class="table table-centered mb-0">
                    <thead class=" bg-dark">
                        <tr class="text-center">
                            <th class="text-light">ID</th>
                            <th class="text-light">Nodo</th>
                            <th class="text-light">Ciudad</th>
                            <th class="text-light">Estado del Nodo</th>
                            <th class="text-light">Mensaje</th>
                            <th class="text-light">Mensaje</th>
                            <th class="text-light">Mensaje</th>
                            <th class="text-light">Mensaje</th>
                            <th class="text-light">Mensaje</th>
                            <th class="text-light">Mensaje</th>
                            <th class="text-light">Mensaje</th>
                            <th class="text-light">Mensaje</th>
                            <th class="text-light">Mensaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($entireTable as $value){?>
                        <tr class="text-center">
                            <td>
                                <div class="form-check">
                                    <input value="<?php echo $value->codigo;?>" type="checkbox" class="form-check-input" name="lista[]">
                                    <label class="form-check-label" for="customCheck1"><?php echo $value->codigo;?></label>
                                </div>
                            </td>
                            <td><?php echo $value->saldo_mes;?></td>

                            <td><?php echo $value->nombre;?></td>
                            <td><?php echo $value->numeros;?></td>
                            <td><?php echo $value->servicios;?></td>
                            <td><?php echo $value->domicilio;?></td>
                            <td><?php echo $value->telefono;?></td>
                            <td><?php echo $value->email;?></td>
                            <td><?php echo $value->clave;?></td>
                            <td><?php echo $value->empresa;?></td>
                            <td><?php echo $value->cuentas;?></td>
                            <td><?php echo $value->plan;?></td>
                            <td><?php echo $value->valor;?></td>
                            <td><?php echo $value->nodo;?></td>

                        </tr>

                        <?php }?>

                    </tbody>
                </table>

    </div> 

    
</div> 
</div>
    <br><br><br>
    @include('facu.footer')