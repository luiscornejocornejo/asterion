<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>


<script src="/public/js/Chart.min.js"></script>
<script src="/public/js/utils.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/locale/es.js'></script>


@include('pp.header')



<body id="page-top">

    <!-- Page Wrapper -->


    </div>
    <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

        @if ($message = Session::get('success'))

        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

       
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">


            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->


       
<?php if($project["is_closed"]<>2){?>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                    <i class="mdi mdi-plus-circle-outline"></i>Agregar Horas
                </button>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center2">
                    <i class="mdi mdi-plus-circle-outline"></i>Agregar Ausencias
                </button>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center3">
                    <i class="mdi mdi-plus-circle-outline"></i>Agregar Feriados
                </button>
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center4">
                    <i class="mdi mdi-plus-circle-outline"></i>Agregar Vacaciones
                </button>
<?php }?>
                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Horas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                           
                                                      
                                                        <form action="/jornadash" method="post">
                                                        @csrf
                                                        <input type="hidden" name="idproject" value="<?php echo $idproject;?>">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label
                                                                    class="form-label"
                                                                    for="formrow-firstname-input">Desde</label>
                                                                <input
                                                                required
                                                                name="HORASDESDE"
                                                                    type="date"
                                                                    class="form-control"
                                                                    id="formrow-hasta-input">
                                                            </div>
                                                            <div class="col-6">
                                                                <label
                                                                    class="form-label"
                                                                    for="formrow-firstname-input">Hasta</label>
                                                                <input
                                                                required
                                                                name="HORASHASTA"

                                                                    type="date"
                                                                    class="form-control"
                                                                    id="formrow-hasta-input">
                                                            </div>
                                                        </div>
                                                            <div class="row">
                                                            <div class="col-6">
                                                                <label
                                                                    class="form-label"
                                                                    for="formrow-firstname-input">inicio</label>
                                                                <input
                                                                name="HORASINICIO"
                                                                required
                                                                    type="time"
                                                                    class="form-control"
                                                                    id="formrow-hasta-input">
                                                            </div>
                                                            <div class="col-6">
                                                                <label
                                                                    class="form-label"
                                                                    for="formrow-firstname-input">final</label>
                                                                <input
                                                                name="HORASFINAL"
                                                                required
                                                                    type="time"
                                                                    class="form-control"
                                                                    id="formrow-hasta-input">
                                                            </div>
                                                            </div>


                                                           <div class="row">
                                                                <div class="col-12">
                                                                    <h4>Usuarios</h4>
                                                                        <select required  name="HORASUSUARIOS[]" class="form-select" multiple aria-label="multiple select example">
                                                                        <?php foreach($usuariossinrepetir as $valueusu){

?>
<option value='<?php echo $valueusu->id;?>'><?php echo $valueusu->name." ".$valueusu->last_name;?></option>
<?php
}?>   </select>
                                                                    </div>
                                                               </div>
                                                            <div class="mt-12">
                                                                <button
                                                                    type="submit"
                                                                    class="btn
                                                                    btn-primary
                                                                    w-md">Cargar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div class="modal fade bs-example-modal-center2" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ausencias</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                           
                                                      
                                                        <form action="jornadasa" method="post">
                                                        @csrf
                                                        <input type="hidden" name="idproject" value="<?php echo $idproject;?>">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label
                                                                    class="form-label"
                                                                    for="formrow-firstname-input">Desde</label>
                                                                <input
                                                                name="AUSENCIADESDE"
                                                                required
                                                                    type="date"
                                                                    class="form-control"
                                                                    id="formrow-hasta-input">
                                                            </div>
                                                            <div class="col-6">
                                                                <label
                                                                    class="form-label"
                                                                    for="formrow-firstname-input">Hasta</label>
                                                                <input
                                                                name="AUSENCIAHASTA"
                                                                required
                                                                    type="date"
                                                                    class="form-control"
                                                                    id="formrow-hasta-input">
                                                            </div>
                                                        </div>
                                                        

<hr><br><br>
                                                           <div class="row">
                                                                <div class="col-12">
                                                                <h4>Usuarios</h4>

                                                                        <select required name="AUSENCIAUSUARIOS[]" class="form-select" multiple aria-label="multiple select example">
                                                                          <?php foreach($usuariossinrepetir as $valueusu){

                                                                                ?>
                                                                            <option value='<?php echo $valueusu->id;?>'><?php echo $valueusu->name." ".$valueusu->last_name;?></option>
                                                                                <?php
                                                                            }?>
                                                                           
                                                                            </select>
                                                                    </div>
                                                               </div>
                                                           
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h4>Motivo</h4>
                                                                        <select required name="AUSENCIAMOTIVO" class="form-select"  aria-label="multiple select example">
                                                                            <option value="1">Razones Personales</option>
                                                                            <option value="2">Enfermedad</option>
                                                                            <option value="3">Sin aviso</option>
                                                                            </select>
                                                                    </div>
                                                               </div>
                                                               <div class="row">
                                                               <div class="col-12">
                                                                    <h4>Nota</h4>
                                                                <textarea  name="AUSENCIANOTA"></textarea>
                                                               </div>
                                                               <div class="col-12">
                                                                    <h4>Franco Compensatorio</h4>
                                                                <select required name="AUSENCIANCOMPENSATORIO">

                                                                <option value="0">NO</option>
                                                                <option value="1">SI</option>
                                                                </select>
                                                               </div>
                                                               </div>
                                                            <div class="mt-12">
                                                                <button
                                                                    type="submit"
                                                                    class="btn
                                                                    btn-primary
                                                                    w-md">Cargar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="modal fade bs-example-modal-center3" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Feriados</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                           
                                                      
                           <form action="/jornadasf" method="post">
                           @csrf
                           <input type="hidden" name="idproject" value="<?php echo $idproject;?>">
                           <div class="row">
                               <div class="col-6">
                                   <label
                                       class="form-label"
                                       for="formrow-firstname-input">Usuarios</label>
                                  
                               </div>
                               <div class="row">
                                                                <div class="col-12">
                                                                        <select required name="FERIADOSUSU[]" class="form-select" multiple aria-label="multiple select example">
                                                                        <?php foreach($usuariossinrepetir as $valueusu){

?>
<option value='<?php echo $valueusu->id;?>'><?php echo $valueusu->name." ".$valueusu->last_name;?></option>
<?php
}?>   </select>
                                                                    </div>
                                                               </div>
                            
                           </div>
                               <div class="row">
                               <div class="col-12">
                                   <label
                                       class="form-label"
                                       for="formrow-firstname-input">fecha</label>
                                       <select 
                                           name="FERIADOSFECHA"
                                           required
                                            class="form-select"  aria-label="multiple select example">
                                           <?php foreach($holidays as $valueusu){

?>
<option value='<?php echo $valueusu->id;?>'><?php echo $valueusu->name."(".$valueusu->date.")";?></option>
<?php
}?>
                                               </select>
                               </div>
                               
                               </div>


                            
                               <div class="mt-12">
                                   <button
                                       type="submit"
                                       class="btn
                                       btn-primary
                                       w-md">Cargar</button>
                               </div>
                           </form>
                       </div>
                   </div>
   
</div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div class="modal fade bs-example-modal-center4" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Vacaciones</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                           
                                                      
                           <form action="/jornadasv" method="post">
                           @csrf
                           <input type="hidden" name="idproject" value="<?php echo $idproject;?>">
                           <div class="row">
                               <div class="col-6">
                                   <label
                                       class="form-label"
                                       for="formrow-firstname-input">Desde</label>
                                   <input
                                   name="VACACIONESDESDE"
                                   required
                                       type="date"
                                       class="form-control"
                                       id="formrow-hasta-input">
                               </div>
                               <div class="col-6">
                                   <label
                                       class="form-label"
                                       for="formrow-firstname-input">Hasta</label>
                                   <input
                                   name="VACACIONESHASTA"
                                   required
                                       type="date"
                                       class="form-control"
                                       id="formrow-hasta-input">
                               </div>
                           </div>
                            


                              <div class="row">
                                   <div class="col-12">
                                       <h4>Usuarios</h4>
                                           <select 
                                           name="VACACIONESUSUARIOS[]"
                                           required
                                            class="form-select" multiple aria-label="multiple select example">
                                           <?php foreach($usuariossinrepetir as $valueusu){

?>
<option value='<?php echo $valueusu->id;?>'><?php echo $valueusu->name." ".$valueusu->last_name;?></option>
<?php
}?>
                                               </select>
                                       </div>
                                  </div>
                               <div class="mt-12">
                                   <button
                                       type="submit"
                                       class="btn
                                       btn-primary
                                       w-md">Cargar</button>
                               </div>
                           </form>
                       </div>
                   </div>
   
</div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div class="header text-center">
                    <h3 class="title">{{ $project->name }}</h3>
                    <p class="category">{{ $project->description }}</p>
                </div>



                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center
                    justify-content-between">
                            

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">

                        <div class="row">
                            <div class="col-xl-2 col-lg-2">
                                <div class="card">
                                    <div class="card-body">
                                        

                                        <div id="external-events" class="mt-2">
                                        
                                           
                                        </div>

                                
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-xl-9 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                        </div>

                        <div style='clear:both'></div>


                        <!-- Add New Event MODAL -->
                        <div class="modal fade" id="event-modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header py-3 px-4 border-bottom-0">
                                        <h5 class="modal-title" id="modal-title">Event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Datos
                                                            Name</label>
                                                        <input class="form-control" placeholder="Insert Event
                                                    Name" type="text" name="title" id="event-title" required value="" />
                                                        <div class="invalid-feedback">Please
                                                            provide a valid event name</div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                          
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- end modal-content-->
                            </div> <!-- end modal dialog-->
                        </div>
                        <!-- end modal-->

                    </div>
                </div>


                <!-- End Page-content -->



                <!-- Calendar init -->


            </div>
            <script type="text/javascript">
    let project = {!! json_encode($project,JSON_FORCE_OBJECT) !!};
    let list_crew = {!! json_encode($list_crew,JSON_FORCE_OBJECT) !!};
    let holidays = {!! json_encode($holidays,JSON_FORCE_OBJECT) !!};
  </script>

            <script src="/public/assets/js/main.js"></script>
            <script src="/public/assets/js/pages/calendar.init.js"></script>


        </div>



    </div>
    <!-- End of Main Content -->
    <br><br><br>
    @include('pp.footer')