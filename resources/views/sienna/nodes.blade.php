@include('facu.header')

@include('facu.menu')


<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">
        <form method="get" action="/nodes">
        @csrf

            <div class="row">
                <div class="col-4 mb-2">
                    <label for="simpleinput" class="form-label">Mensaje</label>
                    <input type="text" name="message" id="simpleinput" class="form-control">
                </div>
                <div class="col-4 mb-2">
                    <label for="example-select" class="form-label">Estado del nodo</label>
                    <select class="form-select" name="estado" id="example-select">
                        <option value="1">Normal</option>
                        <option value="2">Mantenimiento</option>
                        <option value="3">Corte General</option>
                    </select>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="mb-2 position-relative">
                        <label class="form-label">&nbsp;</label>
                        <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Buscar">
                    </div>
                </div>

            </div>
       
        <table class="table table-centered mb-0">
            <thead class=" bg-dark">
                <tr class="text-center">
                    <th class="text-light">ID</th>
                    <th class="text-light">Nodo</th>
                    <th class="text-light">Ciudad</th>
                    <th class="text-light">Estado del Nodo</th>
                    <th class="text-light">Mensaje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($nodes as $value){?>
                <tr class="text-center">
                    <td>
                        <div class="form-check">
                            <input value="<?php echo $value->id;?>" type="checkbox" class="form-check-input" name="lista[]">
                            <label class="form-check-label" for="customCheck1"><?php echo $value->id;?></label>
                        </div>
                    </td>
                    <td><?php echo $value->nombredelnodo;?></td>

                    <td><?php echo $value->ciudad;?></td>
                    <td><?php echo $value->nombredelestadonodo;?></td>
                    <td><?php echo $value->mensaje;?></td>

                </tr>

                <?php }?>

            </tbody>
        </table>
        </form>

    </div 

    <br><br><br>
    @include('facu.footer')