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
                    <h1 class="h3 mb-0 text-gray-800">Formulario</h1>
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


            <?php if ($vista == "1") {
            ?>
                <br><br>
                <pre id="json"></pre>

                <script>
                    let data = <?php echo $datos2; ?>;
                    document.getElementById("json").textContent = JSON.stringify(data, undefined, 2);
                </script>
            <?php
            } ?>
        </div>
    </div>
</div>
<br><br><br>
@include('pp.footer')