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
        <div class="container-fluid pt-2">
            <form method="post" action="">
            @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <label for="typeSearch" class="form-label">Tipo de busqueda</label>
                        <select name="typeSearch" id="typeSearch" class="form-select">
                            <option value="0">DNI | Cédula</option>
                            <option value="1">Número de cliente</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label for="userNumber" class="form-label">Numero</label>
                        <input type="text" name="cliente" class="form-control" id="userNumber" aria-describedby="emailHelp" placeholder="005215" required>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="mb-2 position-relative">
                            <label class="form-label">&nbsp;</label>
                            <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Buscar">
                        </div>
                    </div>
                </div>
            </form>
            <div class="border" class="col-2">
                        <?php if (isset($datosonline)) {
                            $datosonline2=json_decode($datosonline);

                             ?>

                           
                    </div>
                    <form action="crearticketsiennacliente" method="post">
                 @csrf

                    <div class="row">
                                                                                                                  
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="number-client" class="form-label">Número registrado en la cuenta</label>
                            <input required type="number" value="<?php echo $datosonline2->name; ?>" id="number-client" name="number_client" class="form-control" required>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="department" class="form-label">Departamento</label>
                            <select required onchange="topics(this.value)" class="form-select" name="depto">
                            <option value="0">seleccionar</option>

                                <?php foreach($siennadeptosgenericos as $val){?>

                                    <option value="<?php echo $val->id;?>"><?php echo $val->nombre ;?></option>

                                <?php
                                }?>
                               
                            </select>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="reason" class="form-label">Motivo</label>
                            <select required id="top" class="form-select" name="topicos">
                            </select>
                        </div>
                        <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">

                    </div>
                </div>
                <div class="modal-footer mt-2">
                <button class="btn btn-success" type="submit" >Crear</button>
                
                    
            </form>
                        <label class="form-label">Plantilla a enviar</label>
                        <div class="row mb-3">
                            <div class="col-lg-4 col-sm-12">
                            <select name="template" id="template" class="form-select">
                                <option value="0">1</option>
                            </select>
                            </div>
                        </div>
                    
                        <table id="example" class="table table-striped dt-responsive nowrap w-100 text-light">
                            <thead>
                                <tr class="text-center bg-dark">
                                    <th class="text-light">Nombre</th>
                                    <th class="text-light">Teléfono</th>
                                    <th class="text-light">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tb">
                                    <tr class="text-center">
                                        <td><?php echo $datosonline2->name; ?></td>
                                        <td><?php  echo $datosonline2->phone; ?></td>
                                        <td><?php // echo $valh->valor; ?></td>
                                    </tr>
                            </tbody>
                        </table>
                        <div class="border" class="col-2">
                            
                        </div>
            <?php }?>
        </div>
    </div>
</div>

@include('facu.footer')