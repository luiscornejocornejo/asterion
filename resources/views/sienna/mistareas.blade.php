@include('facu.header')



<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">

        <div class="container-fluid pt-2">
            <style>
                .conversation-list .odd .conversation-text {
                    float: right !important;
                    margin-right: 12px;
                    text-align: right;
                    width: 90% !important
                }

                .conversation-list .conversation-text {
                    float: left;
                    font-size: 13px;
                    margin-left: 12px;
                    width: 90%
                }
            </style>

            <h2>Mis Tareas</h2>

            <table id="example" class="table dt-responsive nowrap w-100">
                <thead class="bg-dark">
                    <tr class="text-center">
                        <th class="text-light">#</th>
                        <th class="text-light">Nombre</th>
                        <th class="text-light">Descripcion</th>
                        <th class="text-light">Ticket</th>
                        <th class="text-light">F. Limite</th>
                        <th class="text-light">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($mistareas as $val3) {

                    ?>
                        <tr class="text-center">
                            <td><a href="{{ url('ts?idtarea=' . $val3->id) }}" target="_blank">{{$val3->id}}</a></td>
                            <td>{{$val3->nombre}}</td>
                            <td class="ellipsis">{{$val3->descripcion}}</td>
                            <td><a href="{{ url('ticketunico?tick=' . $val3->siennatickets) }}" target="_blank">{{$val3->siennatickets}}</a></td>
                            <td>{{$val3->fechalimite}}</td>
                            <td>{{ ucfirst($val3->nomestado) }}</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>

        <div class="newAgent" data-bs-toggle="modal" data-bs-target="#create-task">
            <i class="mdi mdi-clipboard-plus" style="font-size: 25px;"></i>
        </div>
    </div>
</div>

@include('facu.footer')