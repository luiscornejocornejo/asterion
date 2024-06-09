@include('facu.header2')



<div class="wrapper menuitem-active">
@include('facu.menu')


    <div class="content-page" style="padding: 0!important;">

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
                    <h1 class="h3 mb-0 text-gray-800"><?php echo $nombrereporte;?> </h1>
                    <?php 
                    if($idreport==118){
                        if(sizeof($resultados)>0){
?>
<a href="/crontab">procesar</a>
<?php
                    }}
                    ?>
                </div>

                <div class="table-responsive">


                    <table role="table" id="example" class="table table-bordered dt-responsive nowrap w-100 ">
                        <thead role="rowgroup" class="text-center bg-dark">
                            <tr role="row">

                                @foreach($cabezeras as $cabeza)
                                <?php if ($cabeza <> "id") { ?>

                                    <th role="columnheader">{{ $cabeza }}</th>
                                <?php  } ?>

                                @endforeach
                               

                            </tr>
                        </thead>
                        <tbody role="rowgroup">
                            @foreach($resultados as $resultado)


                            <tr role="row">
                                @foreach($cabezeras as $cabeza)
                                <?php if ($cabeza <> "id") { ?>
                                    <td role="cell">
                                        {!! $resultado->$cabeza !!}
                                    </td>

                                <?php  } ?>
                                @endforeach
                             

                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
            <tr>

                    @foreach($cabezeras as $cabeza)
                    <?php if ($cabeza <> "id") { ?>

                        <th role="columnheader">{{ $cabeza }}</th>
                    <?php  } ?>

                    @endforeach


            </tr>
        </tfoot>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
<br><br><br>

@include('facu.footer2')