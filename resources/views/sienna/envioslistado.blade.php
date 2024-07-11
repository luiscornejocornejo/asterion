


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

                <h1>Envios Lista</h1>

                <table id="example" class="table dt-responsive nowrap w-100">
                    <thead class="bg-dark">
                        <tr class="text-center">
                            <th class="text-light">Cel</th>
                            <th class="text-light">Estado</th>
                            <th class="text-light">F creado</th>
                            <th class="text-light">F. Enviado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tsoporte as $val3) {

                        ?>
                            <tr class="text-center">
                                <td>{{$val3->cel}}</td>
                                <td>{{$val3->estado}}</td>
                                <td>{{$val3->created_at}}</td>
                                <td>{{$val3->updated_at}}</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

        </div>


    </div>
</div>
<br><br><br>
@include('facu.footer')