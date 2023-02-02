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
                    <h1 class="h3 mb-0 text-gray-800">Consultar</h1>
                </div>

                <form method="post">
                    @csrf
                    <?php
                    $parametrosTipo2 = explode(",", $parametrosTipo);
                    $parametros2 = explode(",", $parametros);

                    for ($i = 0; $i < sizeof($parametrosTipo2); $i++) {

                        $pos4 = stripos($parametrosTipo2[$i], "int");
                        if ($pos4 !== false) {
                            $tipo = "number";
                        }
                        $pos = stripos($parametrosTipo2[$i], "varchar");
                        if ($pos !== false) {
                            $tipo = "text";
                        }

                        $pos2 = stripos($parametrosTipo2[$i], "text");
                        if ($pos2 !== false) {
                            $tipo = "textarea";
                        }

                        $pos3 = stripos($parametrosTipo2[$i], "tinyint(1)");
                        if ($pos3 !== false) {
                            $tipo = "boolean";
                        }

                        $pos3 = stripos($parametrosTipo2[$i], "datetime");
                        if ($pos3 !== false) {
                            $tipo = "datetime-local";
                        }




                    ?>
                        <div class="form-group">

                            <label for="<?php echo $parametros2[$i]; ?>"><?php echo $parametros2[$i]; ?></label>
                            <?php
                            if ($tipo == "textarea") {

                            ?>
                                <textarea name="<?php echo $parametros2[$i]; ?>" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                            <?php
                            } elseif ($tipo == "boolean") {

                            ?>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="<?php echo $parametros2[$i]; ?>" id="flexSwitchCheckDefault">
                                </div>

                            <?php


                            } else {

                            ?>
                                <input type="<?php echo $tipo; ?>" class="form-control" name="<?php echo $parametros2[$i]; ?>" aria-describedby="emailHelp" placeholder="<?php echo $parametros2[$i]; ?>">

                            <?php
                            } ?>

                        </div>
                    <?php }  ?>
                    <button type="submit" class="btn btn-primary">Consultar</button>
                </form>


            </div>
        </div>
    </div>
</div>
<br><br><br>
    @include('pp.footer')