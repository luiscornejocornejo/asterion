@include('facu.header')



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
              
                <div class="mx-auto" style="width: 200px;">
                <h1   title="<?php echo $descripcion;?>" class="h3 mb-0 text-gray-800"><?php echo ucfirst($nombrereporte);?></h1>
                

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
                                            } ?>

                                        </select>
                                    </div>
                                <?php
                                }elseif($$key == "usuario"){?>

                                        <div class="form-check form-switch">
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $key; ?>">
                                            <?php
                                            $querysoption = "select * from  users where tipousers<>'1' ";
                                            $resultadosoption = DB::select($querysoption);
                                            foreach ($resultadosoption as $resultoption) {

                                                $idoption = $resultoption->id;
                                                $nombreoption =$resultoption->nombre." ". $resultoption->last_name;

                                                echo "<option  value='" . $idoption . "' >" . $nombreoption . "</option>";
                                            } ?>

                                        </select>
                                    </div>
                                <?php


                                } else {
                                ?>
                                    <input class="form-control" require type="<?php echo $$key; ?>" name="<?php echo $key; ?>">

                                <?php
                                } ?>
                            </div>
                            <br><br>
                    <?php
                        }
                    }
                    ?>


                    <button type="submit" class="btn btn-primary">Consultar</button>

                </form>
                </div>
       


            <?php if($vista=="1"){
?>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Report</h1>
                </div>

                <div class="table-responsive">


                    <table role="table" id="example" class="table table-bordered dt-responsive nowrap w-100">
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
                            @foreach($datos as $resultado)


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

<?php
            }?>
                 </div>
        </div>
    </div>
</div>
<br><br><br>
@include('facu.footer2')