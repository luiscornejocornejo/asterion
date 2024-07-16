@include('facu.header')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

   
<script>
        document.getElementById('inputFile').addEventListener('change', function(event) {
            console.log("entro2");
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(event) {
                const data = new Uint8Array(event.target.result);
                const workbook = XLSX.read(data, {
                    type: 'array'
                });

                // Supongamos que queremos leer la primera hoja
                const firstSheetName = workbook.SheetNames[0];
                const worksheet = workbook.Sheets[firstSheetName];

                // Convertir la hoja a JSON
                const json = XLSX.utils.sheet_to_json(worksheet, {
                    header: 1
                });

                // Crear la tabla
                createTableFromExcel(json);

                // Mostrar la cantidad de filas
                const rowCount = json.length - 1; // Restamos 1 para no contar el encabezado
                document.getElementById('rowCount').textContent = `${rowCount}`;
            };

            reader.readAsArrayBuffer(file);
        });

        function createTableFromExcel(data) {
            const tableHead = document.getElementById('tableHead');
            const tableBody = document.getElementById('tableBody');

            // Limpiar la tabla existente
            tableHead.innerHTML = '';
            tableBody.innerHTML = '';

            // Crear el encabezado de la tabla
            const headerInput = document.getElementById('headerInput').value;
                const headers = headerInput ? headerInput.split(',')
            const headerRow = document.createElement('tr');
            data[0].forEach(headerText => {
                const header = document.createElement('th');
                header.textContent = headerText;
                headerRow.appendChild(header);
            });
            tableHead.appendChild(headerRow);

            // Crear el cuerpo de la tabla
            data.slice(1).forEach(rowData => {
                const row = document.createElement('tr');
                rowData.forEach(cellData => {
                    const cell = document.createElement('td');
                    cell.textContent = cellData;
                    row.appendChild(cell);
                });
                tableBody.appendChild(row);
            });
        }

       
    </script>

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
        <div class="container pt-5">
            <div class="">
                <div class="card">
                    <h6 class="card-header bg-light">Saliente Masivo</h6>
                    <div class="card-body">
                        <h5 class="card-title">1. ¿Qué variables tiene tu documento?</h5>
                        <p class="card-text">
                            Antes de que realices la carga del documento debes indicar las variables (nombre, teléfono, etc.), el dato que contiene y a qué columna pertenece. Las variables marcadas con <span class="text-primary">*</span> son obligatorias<br>
                            <a href="#" rel="no-referrer">En este enlace puedes consultar el siguiente artículo para completar los campos en el documento</a>.
                        </p>
                        <p class="card-text mt-3">2. Seleccione la plantilla que deseas enviar.</p>
                        <select name="template" class="form-select w-25" onchange="showFields(this.value)">
                            <option selected disabled>Seleccione plantilla</option>
                            <?php foreach ($listadopadre as $ll) { ?>
                                <option value="<?php echo $ll->id . "|" . $ll->parametros; ?>"><?php echo $ll->nombre; ?></option>
                            <?php } ?>
                        </select>
                        <script>
                              function showFields(fields) {


                                        document.getElementById('dataBody').innerHTML = null

                                        const parts = fields.split('|');

                                        const values = parts[1].split(';');

                                        tableBody = document.getElementById('dataBody');

                                        const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');

                                        values.forEach((value, index) => {
                                            const row = document.createElement('tr');

                                            const columnCell = document.createElement('td');
                                            columnCell.textContent = `Columna ${alphabet[index]}`;
                                            row.appendChild(columnCell);

                                            const dataCell = document.createElement('td');
                                            dataCell.textContent = value;
                                            row.appendChild(dataCell);

                                            tableBody.appendChild(row);
                                        });
                                }
                        </script>
                        <p class="card-text mt-3">Puedes descargar el modelo de planilla de datos desde <a href="#">aquí</a>.</p>
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Columna en el documento</th>    
                                    <th>Dato</th>    
                                </tr>
                            </thead>
                            <tbody id="dataBody">

                            </tbody>
                        </table>
                        <div>
                            <p class="card-text mt-3">3. Suba el documento con el listado de los usuarios a contactar.</p>
                            <label for="inputFile" class="btn btn-primary rounded-pill">
                                <i class="fas fa-upload"></i> Documento requerido
                                <input type="file" id="inputFile" class="">
                            </label>
                            <span id="fileName" class="ms-1"></span>
                            <p class="card-text text-black mt-3"><strong>Resumen:</strong></p>
                            <p>Total de usuarios en el documento: <span id="rowCount"></span></p>
                            <a role="button" data-bs-toggle="modal" data-bs-target="#preview" class="text-primary">Ver listado de usuarios cargados</a>
                        </div>
                        <div class="container d-flex justify-content-end">
                            <button class="btn btn-light rounded me-2 d-none">Cancelar</button>
                            <button class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#confirm-outbound">Enviar</button>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>
    </div>

    <!-- Modal Preview -->
    <div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="modalTitlePreview" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title" id="modalTitlePreview">Listado de usuarios</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <table id="example" class="table table-bordered table-centered table-hover  responsive nowrap w-100">
                        <tbody id="tableBody"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cerrar</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- End Modal Preview -->

    <!-- Modal Confirm Outbound -->

    <div class="modal fade" id="confirm-outbound" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h4 class="modal-title" id="mySmallModalLabel">Confirmación de saliente</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <p>¿Confirma el envío masivo?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="send-outbound">Si, enviar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- End of Modal Confirm Outbound -->

  

    @include('facu.footer')