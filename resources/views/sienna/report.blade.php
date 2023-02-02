@include('pp.header')
<style>
    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        /* Force table to not be like tables anymore */
        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
            padding: 2rem 1rem !important;
        }

        tr {
            margin: 1rem 1rem 1rem 1rem !important;
        }

        tr:nth-child(odd) {
            background: #ccc;
        }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 0;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
        }


        <?php $cant = 0;
        foreach ($cabezeras as $cabeza) { ?>td:nth-of-type(<?php echo $cant; ?>):before {
            content: "<?php echo $cabeza; ?>"
        }


        <?php $cant++;
        }


        ?>
    }
</style>
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
                <button class="btn btn-success" onclick="exportTableToExcel('datatable')">Exportar </button>

                <div class="table-responsive">


                    <table role="table" id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead role="rowgroup" class="table-success">
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
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
<br><br><br>
@include('pp.footer')