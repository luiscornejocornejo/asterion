<div class="card widget-flat">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="fw-normal text-dark" title="Number of Customers">Tareas del tickets</h4>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-history widget-icon bg-secondary-lighten text-secondary"></i>
                                    </div>
                                </div>
                                <hr style="margin-top: 10px;" />
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12">
                                        
                                    <button  class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#create-task">
                            <i class="mdi mdi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Crear Tarea."></i>
                        </button>
                                        <table id="example"  class="table table-striped dt-responsive nowrap w-100 text-light">
                                            <thead>
                                                    <tr class="text-center bg-dark" >                             
                                                        <th class="text-light">Nombre</th>
                                                        <th class="text-light">Descripcion</th>
                                                        <th class="text-light">Estado</th>
                                                        <th class="text-light">Usuario</th>
                                                        <th class="text-light">Fecha Limite</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tb">
                                                    <?php foreach($resultadostareas as $valh){?>
                                                        <tr class="text-center">
                                                        <td><?php echo $valh->nombre;?></td>
                                                        <td><?php echo $valh->descripcion;?></td>
                                                        <td><?php echo $valh->estadoname;?></td>
                                                        <td><?php echo $valh->usuario;?></td>
                                                        <td><?php echo $valh->fechalimite;?></td>
                                                    </tr>
                                                        <?php  }?>
                                            </tbody>
                                            </table>
                                              
                                    </div>
                                    
                                </div>                    
                            </div>

                            @include('sienna.tu.creartareaticket')

                        </div>