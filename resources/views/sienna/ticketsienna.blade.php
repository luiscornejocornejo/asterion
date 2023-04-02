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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Report</h1>
                </div>
                <button class="btn btn-success" onclick="exportTableToExcel('datatable')">Exportar </button>

                <div class="table-responsive">


                    <table role="table" id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead role="rowgroup" class="table-success">
                            <tr role="row">

                                @foreach($cabezeras as $cabeza)
                                <?php if ($cabeza != "id") {?>

                                    <th role="columnheader">{{ $cabeza }}</th>
                                <?php }?>

                                @endforeach


                            </tr>
                        </thead>
                        <tbody role="rowgroup">
                            @foreach($datos as $resultado)


                            <tr role="row">
                                @foreach($cabezeras as $cabeza)
                                <?php if ($cabeza != "id") {?>
                                    <td role="cell">
                                        {!! $resultado->$cabeza !!}
                                    </td>

                                <?php }?>
                                @endforeach


                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

<?php
}?>
        </div>
    </div>
</div>




@foreach($datos as $resultado)

<div class="col-xxl-6 col-xl-12 order-xl-2 " style="max-height: 900px;min-height: 900px;">
        <div class="card ">
            <div class="bg-primary text-white">
                <div class="row  m-0 p-2">
                    <div class="col-6 align-self-start" style="display:inline-block;">
                        <span class="float-start text-white fw-bold ">{{ $resultado->nombreusuario }} </span>
                    </div>

                    <div class="col-6 align-self-end" style="display:inline-block;">
                        <span class="float-end text-white fw-bold  "><span :style="{ 'color': laprio }">{{ prioridad
                        }}</span> TICKET #{{ ticket_id }}</span>
                    </div>
                </div>
            </div>
            <div class="card-body ">


                <div class="row  m-0 p-1">
                    <div class="col-6 align-self-start" style="display:inline-block; ">
                        <button type="button" class="btn btn-info btn-block w-100" data-bs-toggle="modal"
                            data-bs-target="#standard-modal3">{{ topic }}</button>
                    </div>
                    <div class="col-6 align-self-end" style="display:inline-block; ">
                        <button type="button" class="btn btn-success w-100" data-bs-toggle="modal"
                            data-bs-target="#standard-modal">
                            <spam id="estado">{{ ticketestatus }}</spam>
                        </button>

                    </div>
                </div>

                <div class="row m-0 p-1">
                    <div class="col-6 align-self-start small" style="display:inline-block;">
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">Fecha de creacion: {{ creacion }} </li>
                        </ul>
                    </div>
                    <div v-if="depto === null" class="col-6 align-self-end" style="display:inline-block;">
                        <button type="button" class="btn btn-success w-100  btn-block" data-bs-toggle="modal"
                            data-bs-target="#standard-modal2">{{ depto }} sin asignar depto</button>
                        <spam id="departamento"></spam>


                    </div>
                    <div v-else class="col-6 align-self-end" style="display:inline-block;">
                        <button type="button" class="btn btn-success w-100  btn-block" data-bs-toggle="modal"
                            data-bs-target="#standard-modal2">{{ depto }}</button>
                        <spam id="departamento"></spam>


                    </div>

                </div>



                <div class="row  m-0 p-1">
                    <div class="col-6 align-self-start" style="display:inline-block; ">
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">Fecha de ultima Modificacion: {{ lastupdate }}</li>
                        </ul>
                    </div>
                    <div v-if="asignado === null" class="col-6 align-self-end" style="display:inline-block; ">
                        <button type="button" class="btn btn-success w-100  btn-block" data-bs-toggle="modal"
                            data-bs-target="#standard-modal4">{{ asignado }} sin asignar</button>

                    </div>
                    <div v-else class="col-6 align-self-end" style="display:inline-block; ">
                        <button type="button" class="btn btn-success w-100  btn-block" data-bs-toggle="modal"
                            data-bs-target="#standard-modal4">{{ asignado }}</button>

                    </div>
                </div>

                <div class="p-2">
                    <div v-if="source == 'API'">API</div>
                    <div v-if="source == 'Email'">
                        <div v-for="ext in extra" class="currency">
                            <span v-html="ext.body"></span>
                        </div>
                    </div>
                    <div v-if="source == 'Google Business '">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="860 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Teams'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="860 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>

                    <div v-if="source == 'Slack'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="860 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Discord'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="860 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Web'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="860 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'RCS'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="860 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'SMS'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="860 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Instagram'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="860 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Facebook'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="860 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>

                    <div v-if="source == 'Telegram'">

                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="860 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Whatsapp'">
                        <div style="max-height: 446px">
                            <iframe class="w-100" max-height="200px" width="860 px" height="400 px" frameborder='0'
                                allowfullscreen v-bind:src="chat_link"></iframe>
                        </div>
                    </div>

                    <div v-else v-for="ext in extra" class="currency">

                        <span v-html="ext.body"></span>
                    </div>


                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card-->


    </div>


    <div class="col-xxl-3 col-xl-6 order-xl-1 order-xxl-2" style="max-height: 900px;min-height: 900px;">

        <div v-if="clickeo" class="accordion accordion-flush" id="accordionFlushExample">
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

                                                <div v-for="extrah in historial" class="timeline-item extrahistorial2">
                                                    <i v-if="extrah.name == 'open'"
                                                        class="mdi mdi-progress-check bg-info-lighten text-info timeline-icon"></i>
                                                    <i v-if="extrah.name == 'closed'"
                                                        class="mdi mdi-progress-close bg-info-lighten text-info timeline-icon"></i>
                                                    <i v-if="extrah.name == 'overdue'"
                                                        class="mdi mdi-timer-sand-complete bg-info-lighten text-info timeline-icon"></i>
                                                    <i v-if="extrah.name == 'edited'"
                                                        class="mdi mdi-account-edit bg-info-lighten text-info timeline-icon"></i>
                                                    <i v-if="extrah.name == 'reopened'"
                                                        class="mdi mdi-openid bg-info-lighten text-info timeline-icon "></i>
                                                    <p class="mb-1" style="color: #727CF5;font-size: 14px;">

                                                        {{ extrah.name.toUpperCase() }}</p>


                                                    <div class="timeline-item-info">
                                                        <a href="javascript:void(0);" class="fw-light  mb-0 d-block"
                                                            style="color: #262626;font-size: 12px;">{{ extrah.timestamp
                                                            }}</a>

                                                        <p class="mb-0 pb-2" style="color: #262626;font-size: 14px;">{{
                                                            extrah.username }}
                                                        </p>
                                                    </div>
                                                </div>


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
                                    <li class="list-group-item">clientid: {{ client_id }}</li>
                                    <li class="list-group-item">email: {{ mail }}
                                        <span v-if="mail!= null"> <button type="button"
                                                class="btn btn-success btn-sm  " data-bs-toggle="modal"
                                                data-bs-target="#compose-modal">

                                            </button></span>
                                    </li>
                                    <li class="list-group-item">phone: {{ telefono }} <span
                                            v-if="telefono != null">
                                            <button type="button" class="btn btn-success btn-sm  " data-bs-toggle="modal"
                                                data-bs-target="#standard-modal">

                                            </button></span></li>
                                    <li class="list-group-item">whatsapp_nro: {{ whatsapp_nro }}<span
                                            v-if="whatsapp_nro != null">
                                            <button type="button" class="btn btn-success btn-sm  " data-bs-toggle="modal"
                                                data-bs-target="#standard-modal">

                                            </button></span></li>
                                    <li class="list-group-item">plan_name: {{ plan_name }}</li>


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
        <div v-else>

        </div>
        <div class="card">





        </div> <!-- end card -->
    </div>
    @endforeach

    <div id="standard-modal3" class="modal fade bs-example-modal-center3 " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Cambiar Topics</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/chatcambiartopic2" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic">
                        <div v-for="topic in topics ">

                            <input :value="topic.id" v-model="topic.id" class="form-radio" type="radio" name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">{{ topic.nombre }}</span>
                            <br><br>
                        </div>



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
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic">
                        <div v-for="ost_ticket_statu in ost_ticket_status ">

                            <input :value="ost_ticket_statu.id" v-model="ost_ticket_statu.id" class="form-radio"
                                type="radio" name="statos">&nbsp; <span class=" fw-bold"
                                style="color: #98a6ad;font-size: 12px;">{{ ost_ticket_statu.nombre }}</span>
                            <br><br>
                        </div>
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
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic">
                        <div v-for="department in departments ">

                            <input :value="department.id" v-model="department.id" class="form-radio" type="radio"
                                name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">{{ department.nombre }}</span>
                            <br><br>
                        </div>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="standard-modal4" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Asignar</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/chatasignar2" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic">
                        <div v-for="staff in staffs ">

                            <input :value="staff.id" v-model="staff.id" class="form-radio" type="radio" name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">{{ staff.nombre }}</span>
                            <br><br>
                        </div>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <br><br><br>

@include('pp.footer')