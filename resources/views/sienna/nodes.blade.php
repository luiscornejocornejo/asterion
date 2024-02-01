@include('facu.header')

@include('facu.menu')


<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">
        <form method="post" action="/">
            <div class="row">
                <div class="col-4 mb-2">
                    <label for="simpleinput" class="form-label">Mensaje</label>
                    <input type="text" name="message" id="simpleinput" class="form-control">
                </div>
                <div class="col-4 mb-2">
                    <label for="example-select" class="form-label">Estado del nodo</label>
                    <select class="form-select" name="node" id="example-select">
                        <option>Normal</option>
                        <option>Mantenimiento</option>
                        <option>Corte General</option>
                    </select>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="mb-2 position-relative">
                        <label class="form-label">&nbsp;</label>
                        <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Buscar">
                    </div>
                </div>

            </div>
        </form>
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
                <tr class="text-center">
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customCheck1">
                            <label class="form-check-label" for="customCheck1">node_id</label>
                        </div>
                    </td>
                    <td>node_name</td>

                    <td>city</td>
                    <td>state</td>
                    <td>message</td>

                </tr>

            </tbody>
        </table>

    </div 

    <br><br><br>
    @include('facu.footer')