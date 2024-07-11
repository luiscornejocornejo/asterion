


@include('facu.header')



<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">

        <div class="container pt-5">
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

                <h1>Envios</h1>

                <table id="example" class="table dt-responsive nowrap w-100">
                    <thead class="bg-dark">
                        <tr class="text-center">
                            <th class="text-light">#</th>
                            <th class="text-light">Nombre</th>
                            <th class="text-light">Descripcion</th>
                            <th class="text-light">max</th>
                            <th class="text-light">Actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tsoporte as $val3) {

                        ?>
                            <tr class="text-center">
                                <td><a href="{{ url('enviolistado?envio=' . $val3->id) }}" target="_blank">{{$val3->id}}</a></td>
                                <td>{{$val3->nombre}}</td>
                                <td>{{$val3->parametros}}</td>
                                <td>{{$val3->cantmax}}</td>
                                <td>{{$val3->cantactual}}</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

        </div>


    </div>
</div>
<br><br><br>
@include('facu.footer')