@include('pp.header')

<div id="principal">
    <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">ticketsienna</h1>
                </div>

                <form action="" method="post" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="idreport" value="<?php echo $id; ?>">

                    <?php

foreach ($resultados as $valu2) {
    foreach ($valu2 as $key => $value) {

        $$key = $value;
        ?>
                            <div class="form-group">
                                <label><?php echo $key; ?></label>
                                <?php if ($$key == "tabla") {

            ?>

                                    <div class="form-check form-switch">
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $key; ?>">
                                            <?php
$querysoption = "select * from " . $key . " ";
            $resultadosoption = DB::select($querysoption);
            foreach ($resultadosoption as $resultoption) {

                $idoption = $resultoption->id;
                $nombreoption = $resultoption->nombre;

                echo "<option  value='" . $idoption . "' >" . $nombreoption . "</option>";
            }?>

                                        </select>
                                    </div>
                                <?php
} else {
            ?>
                                    <input class="form-control" require type="<?php echo $$key; ?>" name="<?php echo $key; ?>">

                                <?php
}?>
                            </div>
                            <br><br>
                    <?php
}
}
?>


                    <button type="submit" class="btn btn-primary">Consultar</button>

                </form>

            </div>

<?php if ($vista == "1") {
    ?>
@foreach($datos as $resultado)


<?php $ticket_id = $resultado->ticket_id;?>

<div class="container-fluid">
  <div class="row text-white text-center">
    <div class=" " style="max-height: 900px;min-height: 600px; width:70%">
            <div class="card ">
                <div class="bg-primary text-white">
                    <div class="row  m-0 p-2">
                        <div class="col-6 align-self-start" style="display:inline-block;">
                            <span class="float-start text-white fw-bold ">{{ $resultado->nombredelcliente }} </span>
                        </div>

                        <div class="col-6 align-self-end" style="display:inline-block;">
                            <span class="float-end text-white fw-bold  "><span :style="{ 'color': laprio }">{{ $resultado->priority_desc}}</span> TICKET #{{ $resultado->ticket_id }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body ">


                    <div class="row  m-0 p-1">
                        <div class="col-6 align-self-start" style="display:inline-block; ">
                            <button type="button" class="btn btn-info btn-block w-100" data-bs-toggle="modal"
                                data-bs-target="#standard-modal3">{{ $resultado->topic }}</button>
                        </div>
                        <div class="col-6 align-self-end" style="display:inline-block; ">
                            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal"
                                data-bs-target="#standard-modal">
                                <spam id="estado">{{ $resultado->estado }}</spam>
                            </button>

                        </div>
                    </div>

                    <div class="row m-0 p-1">
                        <div class="col-6 align-self-start small" style="display:inline-block;">
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">Fecha de creacion: {{ $resultado->creacion }} </li>
                            </ul>
                        </div>
                        <div  class="col-6 align-self-end" style="display:inline-block;">
                            <button type="button" class="btn btn-success w-100  btn-block" data-bs-toggle="modal"
                                data-bs-target="#standard-modal2">
                                <?php if ($resultado->depto == "") {echo "sin asignar depto";} else {
        echo $resultado->depto;
    }
    ?>  </button>
                            <spam id="departamento"></spam>


                        </div>


                    </div>



                    <div class="row  m-0 p-1">
                        <div class="col-6 align-self-start" style="display:inline-block; ">
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item">Fecha de ultima Modificacion: {{ $resultado->lastupdate }}</li>
                            </ul>
                        </div>
                        <div  class="col-6 align-self-end" style="display:inline-block; ">
                            <button type="button" class="btn btn-success w-100  btn-block" data-bs-toggle="modal"
                                data-bs-target="#standard-modal4">
                                <?php if ($resultado->asignado == "") {echo "sin asignar ";} else {
        echo $resultado->asignado;
    }
    ?>
                               </button>

                        </div>

                    </div>

                    <div class="p-2">
                     
                        <div >
                            <div style="max-height: 446px">
                                <iframe class="w-100" max-height="200px" width="460 px" height="400 px" frameborder='0'
                                    allowfullscreen src="{{ $resultado->chat_link }}"></iframe>
                            </div>
                        </div>

                  

                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->


    </div>
    <div class="" style="max-height: 900px;min-height: 600px;width:30%">

        <div  class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header bg-primary text-white" id="flush-headingOne">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Bitacora
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse text-white bg-white"
                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="card-body py-0 mb-3" data-simplebar="init" style="max-height: 403px;">
                        <div class="simplebar-wrapper" style="margin: 2px -24px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                        aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                        <div class="simplebar-content" style="padding: 0px 24px;">
                                            <div class="timeline-alt py-0">

                                            <?php foreach ($t_bitacora as $value3) {?>
                                                <div >

                                                <?php
if ($value3->name == 'open') {
        ?>
 <i class="mdi mdi-progress-check bg-info-lighten text-info timeline-icon"></i>

                                                <?php
}?>
                                                <?php
if ($value3->name == 'reopened') {
        ?>

<i  class="mdi mdi-openid bg-info-lighten text-info timeline-icon "></i>
                                                <?php
}?>
                                                <?php
if ($value3->name == "edited") {
        ?>
<i class="mdi mdi-account-edit bg-info-lighten text-info timeline-icon"></i>

                                                <?php
}?>
                                                <?php
if ($value3->name == "overdue") {
        ?>

<i   class="mdi mdi-timer-sand-complete bg-info-lighten text-info timeline-icon"></i>
                                                <?php
}?>
                                                <?php
if ($value3->name == "closed") {
        ?>

<i class="mdi mdi-progress-close bg-info-lighten text-info timeline-icon"></i>
                                                <?php
}?>




                                                        <p class="mb-1" style="color: #727CF5;font-size: 14px;">

                                                        <?php echo $value3->name; ?></p>


                                                        <div class="timeline-item-info">
                                                        <a href="javascript:void(0);" class="fw-light  mb-0 d-block"
                                                            style="color: #262626;font-size: 12px;"><?php echo $value3->timestamp; ?></a>

                                                        <p class="mb-0 pb-2" style="color: #262626;font-size: 14px;"><?php echo $value3->username; ?></p>
                                                        </div>

                                                </div>

                                                <?php }?>
                                            </div>
                                            <!-- end timeline -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: auto; height: 579px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                            <div class="simplebar-scrollbar"
                                style="height: 280px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="accordion-item">
                <h2 class="accordion-header  bg-primary text-white" id="flush-headingTwo">
                    <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Cliente
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body bg-white">


                        <div class="row  p-2">
                            <div class="col-6 align-self-start small" style="display:inline-block;">
                                <ul  class="list-group list-group-flush">
                                    <li class="list-group-item">clientid: {{ $resultado->client_id }}</li>
                                    <li class="list-group-item">email: {{ $resultado->mail }}
                                        <span v-if="mail!= null"> <button type="button"
                                                class="btn btn-success btn-sm  " data-bs-toggle="modal"
                                                data-bs-target="#compose-modal">

                                            </button></span>
                                    </li>
                                    <li class="list-group-item">phone: {{ $resultado->telefono }} <span
                                            v-if="telefono != null">
                                            <button type="button" class="btn btn-success btn-sm  " data-bs-toggle="modal"
                                                data-bs-target="#standard-modal">

                                            </button></span></li>
                                    <li class="list-group-item">whatsapp_nro: {{ $resultado->whatsapp_nro }}<span
                                            >
                                            <button type="button" class="btn btn-success btn-sm  " data-bs-toggle="modal"
                                                data-bs-target="#standard-modal">

                                            </button></span></li>
                                    <li class="list-group-item">plan_name: {{ $resultado->plan_name }}</li>


                                </ul>
                            </div>


                        </div>

                        <div class="card">
                            <div class="card-body">

                                <GoogleMap api-key="AIzaSyCpW_qQg8n6GJZ5o22J9MdQqXrzVdx-UHY"
                                    style="width:360px;height:242px;" :center="center" :zoom="15">
                                    <Marker :options="{ position: center }" />
                                </GoogleMap>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>





  </div>
</div>







    @endforeach

    <div id="standard-modal4" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Asignar</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/chatasignar2" method="post">
                    @csrf
                        <input type="hidden" name="idticketestado" value="<?php echo $ticket_id; ?>">
                        <?php foreach ($t_staff as $value2) {?>
                        <div >
                            <input value="<?php echo $value2->id; ?>"  class="form-radio" type="radio" name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo $value2->nombre; ?></span>
                            <br><br>
                        </div>

                        <?php }?>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div id="standard-modal3" class="modal fade bs-example-modal-center3 " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Cambiar Topics</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/chatcambiartopic2" method="post">
                    @csrf
                        <input type="hidden" name="idticketestado" value="<?php echo $ticket_id; ?>">

                        <?php foreach ($t_topic as $value2) {?>
                        <div>

                            <input value="<?php echo $value2->id; ?>"  class="form-radio" type="radio" name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo $value2->nombre; ?></span>
                            <br><br>
                        </div>


                        <?php }?>

                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <div id="standard-modal" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Cambiar status</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/chatcambiarestado2" method="post">
                    @csrf
                        <input type="hidden" name="idticketestado" value="<?php echo $ticket_id; ?>">

                        <?php foreach ($t_estado as $value2) {?>
                        <div >

                            <input value="<?php echo $value2->id; ?>" v-model="ost_ticket_statu.id" class="form-radio"
                                type="radio" name="statos">&nbsp; <span class=" fw-bold"
                                style="color: #98a6ad;font-size: 12px;"><?php echo $value2->nombre; ?></span>
                            <br><br>
                        </div>
                        <?php }?>

                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="standard-modal2" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Cambiar Depto</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/chatcambiardeptos2" method="post">
                    @csrf
                        <input type="hidden" name="idticketestado" value="<?php echo $ticket_id; ?>">

                        <?php foreach ($t_departamentos as $value2) {?>
                        <div>

                            <input value="<?php echo $value2->id; ?>" v-model="department.id" class="form-radio" type="radio"
                                name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo $value2->nombre; ?></span>
                            <br><br>
                        </div>
                        <?php }?>

                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



</div>
    <?php
}?>


    </div>
</div>

    <br><br><br>

@include('pp.footer')