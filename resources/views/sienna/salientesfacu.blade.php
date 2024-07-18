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
        <div class="container pt-5">
            <div class="">
                <div class="card">
                    <h6 class="card-header bg-light">Saliente Masivo</h6>
                    <div class="card-body">
                        <!-- 
                            <p class="card-text">
                                Antes de que realices la carga del documento debes indicar las variables (nombre, teléfono, etc.), el dato que contiene y a qué columna pertenece. Las variables marcadas con <span class="text-primary">*</span> son obligatorias<br>
                                <a href="#" rel="no-referrer">En este enlace puedes consultar el siguiente artículo para completar los campos en el documento</a>.
                            </p>
                         -->
                        <h5 class="card-title">1. Seleccione la plantilla que deseas enviar.</h5>
                        <select name="template" class="form-select w-25" onchange="showFields(this.value)">
                            <option selected disabled>Seleccione plantilla</option>
                            <?php foreach ($listadopadre as $ll) { ?>
                                <option value="<?php echo $ll->id . "|" . $ll->parametros; ?>"><?php echo $ll->nombre; ?></option>
                            <?php } ?>
                        </select>
                        <script>
                            function showFields(fields) {


                                document.getElementById('dataBody').innerHTML = `
                                <tr>
                                    <td>Columna A</td>
                                    <td>Numero de teléfono (completo)</td>
                                </tr>
                                `

                                const parts = fields.split('|');

                                const values = parts[1].split(';');

                                tableBody = document.getElementById('dataBody');
                                var template = document.getElementById('template');
                                template.value = parts[0];
                                var headerInput = document.getElementById('headerInput');
                                const columnas = parts[1].replace(/;/g, ',');

                                headerInput.value = "cel," + columnas;

                                const alphabet = 'BCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');

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
                        <p class="card-text my-3">2. ¿Qué variables tiene tu documento?</p>
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
                            <form id="myform" enctype="multipart/form-data" action="/salientesb" method="post" id="" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                @csrf
                                <p class="card-text mt-3">3. Suba el documento con el listado de los usuarios a contactar.</p>
                                <label for="inputFile" class="btn btn-primary rounded-pill">
                                    <i class="fas fa-upload"></i> Documento requerido
                                    <input name="logo" id="inputFile" type="file" class="d-none" multiple />
                                </label>
                                <span id="fileName" class="ms-1"></span>
                                <span class="d-none" id="valoresview"></span>
                                <input type="hidden" name="cantvalores" value="" id="headerInput" placeholder="Nombres de las cabeceras (separados por comas)" />
                                <input type="hidden" value="" name="template" id="template" placeholder="Nombres de las cabeceras (separados por comas)" />


                                <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
                                <script>
                                    document.getElementById('inputFile').addEventListener('change', function(event) {
                                        const file = event.target.files[0];
                                        document.getElementById('fileName').textContent = file.name

                                        const reader = new FileReader();

                                        reader.onload = function(event) {
                                            const data = new Uint8Array(event.target.result);
                                            const workbook = XLSX.read(data, {
                                                type: 'array'
                                            });

                                            const firstSheetName = workbook.SheetNames[0];
                                            const worksheet = workbook.Sheets[firstSheetName];

                                            const jsonData = XLSX.utils.sheet_to_json(worksheet, {
                                                header: 1
                                            });

                                            const table = document.getElementById('excelTable');
                                            table.innerHTML = ''; // Limpiar tabla antes de agregar datos

                                            const headerInput = document.getElementById('headerInput').value;
                                            const headers = headerInput ? headerInput.split(',') : jsonData[0];

                                            const headerRow = document.createElement('tr');
                                            headers.forEach(header => {
                                                const th = document.createElement('th');
                                                th.textContent = header.trim();
                                                headerRow.appendChild(th);
                                            });
                                            table.appendChild(headerRow);

                                            console.log("JSON DATA:" + jsonData)

                                            jsonData.slice(1, 51).forEach(row => {
                                                const tr = document.createElement('tr');
                                                row.forEach(cell => {
                                                    const td = document.createElement('td');
                                                    td.textContent = cell;
                                                    tr.appendChild(td);
                                                });
                                                table.appendChild(tr);
                                            });

                                            document.getElementById('recordCount').textContent = `${jsonData.length }`;
                                        };

                                        reader.readAsArrayBuffer(file);
                                        document.getElementById('valoresview').textContent = document.getElementById('headerInput').value;
                                    });
                                </script>
                                <p class="card-text text-black mt-3"><strong>Total de usuarios en el documento: </strong> <span id="recordCount"></span></p>


                                <a role="button" data-bs-toggle="modal" data-bs-target="#preview" class="text-primary">Ver listado de usuarios cargados</a>
                                <p class="mt-3">⚠️ IMPORTANTE: verifica que todos los campos del documento se encuentren completos con las cabeceras que requiere el envío. No deben quedar espacios en blancos.</p>
                        </div>
                        <div class="container d-flex justify-content-end">
                            <button class="btn btn-light rounded me-2 d-none">Cancelar</button>
                            <button class="btn btn-primary rounded" data-bs-toggle="modal">Enviar</button>
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

                    <table class="table table-striped display responsive nowrap w-100 table-bordered" id="excelTable">
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

    </form>
    <!-- End of Modal Confirm Outbound -->



    @include('facu.footer')