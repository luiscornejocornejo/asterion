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
                                        
                                        
                                        <table id="example"  class="table table-striped dt-responsive nowrap w-100 text-light">
                                            <thead>
                                                    <tr class="text-center bg-dark" >                             
                                                        <th class="text-light">Nombre</th>
                                                        <th class="text-light">Descripcion</th>
                                                        <th class="text-light">Estado</th>
                                                        <th class="text-light">Uusario</th>
                                                        <th class="text-light">Fecha Limite</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tb">
                                                    <?php foreach($resultadostareas as $valh){?>
                                                        <tr class="text-center">
                                                        <td><?php echo $valh->nombre;?></td>
                                                        <td><?php echo $valh->descripcion;?></td>
                                                        <td><?php echo $valh->estadotarea;?></td>
                                                        <td><?php echo $valh->users;?></td>
                                                        <td><?php echo $valh->fechalimite;?></td>
                                                    </tr>
                                                        <?php  }?>
                                            </tbody>
                                            </table>
                                              
                                    </div>
                                    
                                </div>                    
                            </div>


                        </div>