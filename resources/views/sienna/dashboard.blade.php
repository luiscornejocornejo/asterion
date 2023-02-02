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
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>

                <form method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                <label>Reporte</label>

                                        <select class="form-select" aria-label="Default select example" name="reporte">
                                            <?php
                                  
                                            foreach ($reporte as $resultoption) {

                                                $idoption = $resultoption->id;
                                                $nombreoption = $resultoption->nombre." (".$resultoption->servicio.")";
                                                
                                                echo "<option  value='" . $idoption . "' >" . $nombreoption . "</option>";
                                            } ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Cateroria</label>
                                        <select class="form-select" aria-label="Default select example" name="categoria">
                                            <?php
                                  
                                            foreach ($categorias as $resultoption2) {

                                                $idoption2 = $resultoption2->id;
                                                $nombreoption2 = $resultoption2->nombre;//." (".$resultoption.")";
                                                
                                                echo "<option  value='" . $idoption2 . "' >" . $nombreoption2 . "</option>";
                                            } ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-select" aria-label="Default select example" name="tipo">
                                           <option value="0">Reporte</option>
                                           <?php
                                  
                                            foreach ($servicio as $resultoption3) {

                                                $idoption3 = $resultoption3->id;
                                                $nombreoption3 = $resultoption3->nombre;//." (".$resultoption.")";
                                                
                                                echo "<option  value='" . $idoption3 . "' >" . $nombreoption3 . "</option>";
                                            } ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Titulo</label>
                                        <input class="form-control"  type="text" name="titulo">
                                    </div>
                                    <div class="form-group">
                                        <label>SubTitulo</label>
                                        <input  class="form-control" type="text" name="subtitulo">
                                    </div>
                                    <br><br><br>
                                    <button type="submit" class="btn btn-primary">Agregar</button>

                </form>

                


            </div>
        </div>
    </div>
</div>
<br><br><br>
    @include('pp.footer')