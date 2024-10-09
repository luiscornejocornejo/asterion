@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">
        <form method="post" action="/nodes">
                @csrf

                    <div class="row">
                       
                        <div class="col-4 mb-2">
                            <label for="example-select" class="form-label">Estado del nodo</label>
                            <select class="form-select" name="estado" id="example-select">
                                <?php foreach($listnodos as $ll){?>
                                <option value="<?php echo $ll->id;?>"><?php echo $ll->nombre;?></option>
                            <?php }?>
                            </select>
                        </div>
                        <div class="col-4 mb-2">
                            <label for="simpleinput" class="form-label">Mensaje</label>
                            <input type="text" name="message" id="simpleinput" class="form-control">
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="mb-2 position-relative">
                                <label class="form-label">&nbsp;</label>
                                <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Cambiar">
                            </div>
                        </div>

                    </div>
            

           
                <table id="nodes" class="table table-striped dt-responsive nowrap w-100 mt-2">

                    <thead class=" bg-dark">
                        <tr class="text-center">
                            <th class="text-light">ID</th>
                            <th class="text-light">Nodo</th>
                            <th class="text-light">Ciudad</th>
                            <th class="text-light">ID  ERP</th>
                            <th class="text-light">Estado del Nodo</th>
                            <th class="text-light">Mensaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($nodes as $value){?>
                        <tr class="text-center">
                            <td>
                                <div class="form-check">
                                    <input value="<?php echo $value->idnodo;?>" type="checkbox" class="form-check-input" name="lista[]">
                                    <label class="form-check-label" for="customCheck1"><?php echo $value->idnodo;?></label>
                                </div>
                            </td>
                            <td><?php echo $value->nombredelnodo;?></td>

                            <td><?php echo $value->ciudad;?></td>
                            <td><?php echo $value->iddelerp;?></td>
                            <td><?php echo $value->nombredelestadonodo;?></td>
                            <td><?php echo $value->mensaje;?></td>

                        </tr>

                        <?php }?>

                    </tbody>
                    <tfoot>
                        <tr class="bg-secondary">
                            <th>ID</th>
                            <th>Nodo</th>
                            <th>Ciudad</th>
                            <th>ID ERP</th>
                            <th>Estado del Nodo</th>
                            <th>Mensaje</th>
                        </tr>
                    </tfoot>
                </table>
        </form>

    </div> 
</div> 
</div>
    <br><br><br>

    
    @include('facu.footer')

    <script>
        $('#nodes').dataTable({
            "order": [
                [0, 'desc']
            ],
            "pageLength": 25,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            initComplete: function() {
                this.api()
                    .columns()
                    .every(function() {
                        let column = this;
                        let title = column.footer().textContent;

                        // Create input element
                        let input = document.createElement("input");
                        input.placeholder = title;
                        input.className = "form-control";
                        column.footer().replaceChildren(input);

                        // Event listener for user input
                        input.addEventListener("keyup", () => {
                            if (column.search() !== this.value) {
                                column.search(input.value).draw();
                            }
                        });
                    });
            }
        });
    </script>