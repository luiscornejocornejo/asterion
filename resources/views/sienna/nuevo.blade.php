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
                    <h1 class="h3 mb-0 text-gray-800">Alta</h1>
                </div>
                <form action="create" method="post" enctype="multipart/form-data">
                    <input class="form-check-input" type="hidden" name="table" value="<?php echo $table; ?>" />
                    <?php
                    if ($link <> "") {


                        $sea = explode("=", $link);
                        $variable = $sea[0];
                        $valorget = $sea[1];
                    }


                    ?>
                    @csrf
                    <?php for ($i = 0; $i < sizeof($Nullarray); $i++) {
                        $arrayno = array('created_at', 'id', 'updated_at', 'empresa', 'email_verified_at', 'remember_token');
                        if (!(in_array($Fieldarray[$i], $arrayno))) {
                            $pos4 = stripos($Typearray[$i], "int");
                            if ($pos4 !== false) {
                                $tipo = "number";
                            }

                            $pos4 = stripos($Typearray[$i], "smallint");
                            if ($pos4 !== false) {
                                $tipo = "select";
                            }

                            $pos = stripos($Typearray[$i], "varchar");
                            if ($pos !== false) {
                                $tipo = "text";
                            }

                            $pos2 = stripos($Typearray[$i], "text");
                            if ($pos2 !== false) {
                                $tipo = "textarea";
                            }

                            $pos3 = stripos($Typearray[$i], "tinyint(1)");
                            if ($pos3 !== false) {
                                $tipo = "boolean";
                            }

                            $pos3 = stripos($Typearray[$i], "datetime");
                            if ($pos3 !== false) {
                                $tipo = "datetime-local";
                            }
                            $pos3 = stripos($Typearray[$i], "timestamp");
                            if ($pos3 !== false) {
                                $tipo = "datetime-local";
                            }

                            $pos3 = stripos($Typearray[$i], "date");
                            if ($pos3 !== false) {
                                $tipo = "date";
                            }



                    ?>
                            <div class="form-group">
                                <?php
                                $querytraductor = "SELECT formulario FROM `conversion` where original='" . $Fieldarray[$i] . "' and tabla='" . $tablaa . "'";
                                $traductor = DB::select($querytraductor);
                                $covertido = "";
                                foreach ($traductor as $traductorvalue) {
                                    $covertido = $traductorvalue->formulario;
                                }
                                ?>
                                <label for="<?php
                                            if ($covertido == "") {
                                                echo strtoupper($Fieldarray[$i]);
                                            } else {
                                                echo $covertido;
                                            } ?>"><?php
                                            if ($covertido == "") {
                                                echo strtoupper($Fieldarray[$i]);
                                            } else {
                                                echo strtoupper($covertido);
                                            } ?></label>
                                <?php
                                if ($tipo == "textarea") {

                                ?>
                                    <textarea name="<?php echo $Fieldarray[$i]; ?>" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                                <?php
                                } elseif ($tipo == "boolean") {

                                ?>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="<?php echo $Fieldarray[$i]; ?>" id="flexSwitchCheckDefault">
                                    </div>

                                <?php


                                } elseif ($tipo == "select") {

                                ?>

                                    <div class="form-check form-switch">
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $Fieldarray[$i]; ?>">
                                            <?php
                                            $querysoption = "select * from " . $Fieldarray[$i] . " ";
                                            $resultadosoption = DB::select($querysoption);
                                            foreach ($resultadosoption as $resultoption) {

                                                $idoption = $resultoption->id;
                                                $nombreoption = $resultoption->nombre;
                                                echo "<option value='" . $idoption . "' >" . $nombreoption . "</option>";
                                            } ?>

                                        </select>
                                    </div>

                                <?php


                                } else {
                                    $class = "";

                                    $arraycolor = array('color', 'color2', 'color3');
                                    if ((in_array($Fieldarray[$i], $arraycolor))) {

                                        $class = "pick-a-color ";
                                    }
                                    if ($Fieldarray[$i] == "logo") {
                                        echo $tipo = "file";
                                    }
                                    $value = "";
                                    if ($link <> "") {
                                        if ($Fieldarray[$i] == $variable) {

                                            $value = "value='" . $valorget . "'  readonly ";
                                        }
                                    }

                                    $int = (int) filter_var($Typearray[$i], FILTER_SANITIZE_NUMBER_INT);

                                ?>
                                    <input maxlength=<?php echo $int; ?> <?php echo $value; ?> <?php if ($Nullarray[$i] == "YES") {
                                                                                                    echo "required";
                                                                                                } ?> type="<?php echo $tipo; ?>" class="<?php echo $class; ?>form-control" name="<?php echo $Fieldarray[$i]; ?>" aria-describedby="emailHelp" placeholder="<?php echo $Typearray[$i]; ?>">

                                <?php
                                } ?>

                            </div>
                    <?php }
                    }  ?>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>


            </div>
        </div>
    </div>
</div>
<br><br><br>
@include('pp.footer')