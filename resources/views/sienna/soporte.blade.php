


@include('facu.header')



<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">

        <div class="container-fluid pt-5">
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

                <h1>Soporte</h1>

                <table id="example" class="table dt-responsive nowrap w-100">
                    <thead class="bg-dark">
                        <tr class="text-center">
                            <th class="text-light">#</th>
                            <th class="text-light">Motivo</th>
                            <th class="text-light">Descripcion</th>
                            <th class="text-light">Estado</th>
                            <th class="text-light">Fecha de creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        foreach ($tsoporte as $val3) {

                        ?>
                            <tr class="text-center">
                                <td><a href="{{ url('soporte?ticket=' . $val3->id) }}" target="_blank">{{$val3->id}}</a></td>
                                <td>{{$val3->nombre}}</td>
                                <td>{{$val3->cliente}}</td>
                                <td>{{$val3->siennaestado}}</td>
                                <td>{{$val3->timeoflive}}</td>
                                <td>{{$val3->merchant}}</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

        </div>
        <div class="newAgent" data-bs-toggle="modal" data-bs-target="#create-ticket">
            <i class="ri-chat-new-fill" style="font-size: 25px;"></i>
        </div>

    </div>
</div>
<br><br><br>
@include('facu.footer')