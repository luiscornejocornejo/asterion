

@include('pp.header')
<style type="text/css">
    .pick-a-color-markup .color-menu.color-menu--inline {
        left: 242px !important;
    }

    .container {
        width: 20%;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        if ($(".pick-a-color").pickAColor !== undefined) {
            $(".pick-a-color").pickAColor({
                showSpectrum: true,
                showSavedColors: true,
                saveColorsPerElement: true,
                fadeMenuToggle: true,
                showAdvanced: true,
                showBasicColors: true,
                showHexInput: true,
                allowBlank: true,
                inlineDropdown: true
            });
        }
    });
</script>
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
                    <h1 class="h3 mb-0 text-gray-800">Modificar</h1>
                </div>

                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <?php for ($i = 0; $i < sizeof($Nullarray); $i++) {
                        $arrayno = array('created_at', $pk, 'updated_at',  'email_verified_at', 'remember_token');
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


                            $pos3 = stripos($Typearray[$i], "date");
                            if ($pos3 !== false) {
                                $tipo = "date";
                            }

                            $pos3 = stripos($Typearray[$i], "time");
                            if ($pos3 !== false) {
                                $tipo = "time";
                            }

                    ?>
                            <div class="form-group">
                                <?php 
                                $pre = $Fieldarray[$i];
                            
                                ?>
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
                                                echo $Fieldarray[$i];
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

<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

<textarea name="<?php echo $Fieldarray[$i]; ?>"><?php echo $data[0]->$pre; ?></textarea>
                <script>
                        CKEDITOR.replace( '<?php echo $Fieldarray[$i]; ?>' );
                </script>

                    
                                <?php
                                } elseif ($tipo == "boolean") {

                                ?>

                                    <div class="form-check form-switch">
                                        <?php if ($data[0]->$pre) {
                                            $on = "Checked";
                                        } else {
                                            $on = "";
                                        }; ?>
                                        <input class="form-check-input" <?php echo $on; ?> type="checkbox" name="<?php echo $Fieldarray[$i]; ?>" id="flexSwitchCheckDefault">
                                    </div>

                                <?php


                                } elseif ($tipo == "select") {

                                ?>

                                    <div class="form-check form-switch">
                                        <select class="form-select" aria-label="Default select example" name="<?php echo $Fieldarray[$i]; ?>">
                                            <?php
                                            $querysoption = "select * from " . $Fieldarray[$i] . " ";
                                            //$resultadosoption = DB::select($querysoption);

                                            if ($base == 1) {

                                                $resultadosoption = DB::select($querysoption);
                                                }else{
    
                                                     {{ App\Http\Controllers\siennaController::conectar2($base); }}
                                                   // $prueba = conectar($dbexterna);
                                                    $resultadosoption = DB::connection('mysql2')->select($querysoption);
                                                }

                                            foreach ($resultadosoption as $resultoption) {

                                                $idoption = $resultoption->id;
                                                $nombreoption = $resultoption->nombre;
                                                $selected = "";
                                                if ($data[0]->$pre == $idoption) {
                                                    $selected = " selected ";
                                                }
                                                echo "<option " . $selected . " value='" . $idoption . "' >" . $nombreoption . "</option>";
                                            } ?>

                                        </select>
                                    </div>

                                <?php


                                } else {

                                    if ($Fieldarray[$i] == "password") {

                                        $elvalor = "";
                                    } else {
                                        $elvalor = $data[0]->$pre;
                                    }
                                    $class = "";
                                    $arraycolor = array('color', 'color2', 'color3');
                                    if ((in_array($Fieldarray[$i], $arraycolor))) {
                                        $tipo = "color";
                                        $class = "pick-a-color ";
                                    }
                                    if ($Fieldarray[$i] == "logo") {
                                        echo $tipo = "file";
                                    }

                                ?>
                                    <input <?php if ($Nullarray[$i] == "YES") {
                                                echo "required";
                                            } ?> type="<?php echo $tipo; ?>" class="<?php echo $class; ?>form-control" name="<?php echo $Fieldarray[$i]; ?>" aria-describedby="emailHelp" placeholder="<?php echo $Typearray[$i]; ?>" value="<?php echo $elvalor ?>">

                                <?php
                                } ?>

                            </div>
                    <?php }
                    }  ?>
                    <button type="submit" class="btn btn-primary">Modificar2</button>
                </form>


            </div>
        </div>
    </div>
</div>
<br><br><br>
    @include('pp.footer')