@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
    <div class="content-page" style="padding: 0!important;">

        <div class="container-fluid pt-2">

                        <div class="row">
                        
                            <div class="col-4 mb-2">
                                <label for="example-select" class="form-label">Template</label>
                                <select onchange="campos(this)" class="form-select" name="estado" id="example-select">
                                <option >seleccionar</option>
                                <?php foreach($listadopadre as $ll){?>
                                    <option value="<?php echo $ll->id."|".$ll->parametros;?>"><?php echo $ll->nombre;?></option>
                                <?php }?>
                                </select>
                                <script>
                                    function campos(id){
                                        alert(id.value);
                                        separar=id.value.split('|');
                                        var template = document.getElementById('template');
                                        template.value=separar[0];
                                        var element = document.getElementById('carga');
                                        element.classList.remove('d-none');
                                        var headerInput = document.getElementById('headerInput');
                                        columnas=separar[1].replace(";", ",");

                                        headerInput.value="cel,"+separar[1];

                                    }

                                </script>
                            </div>
                        
                            

                        </div>
                        <div id="carga" class="row d-none">

                                <form action="/salientesb" method="fet" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                                    data-upload-preview-template="#uploadPreviewTemplate">
                                    @csrf

                                    <div class="fallback">
                                        <input name="file" id="inputFile" type="file" multiple />
                                    </div>
                                    <input type="hidden" value="" id="headerInput" placeholder="Nombres de las cabeceras (separados por comas)" />
                                    <input type="hidden" value="" nombre="template" id="template" placeholder="Nombres de las cabeceras (separados por comas)" />
                                    <div id="recordCount"></div>
                                    <table class="table table-striped display responsive nowrap w-100 table-bordered" id="excelTable" >
                                    </table>
                                    <div class="col-lg-4 col-sm-12">
                                                            <div class="mb-2 position-relative">
                                                                <label class="form-label">&nbsp;</label>
                                                                <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Cambiar">
                                                            </div>
                                                        </div>
                                
                                </form>

                        </div> 
        </div> 
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
 
    <script>
        document.getElementById('inputFile').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(event) {
                const data = new Uint8Array(event.target.result);
                const workbook = XLSX.read(data, { type: 'array' });

                const firstSheetName = workbook.SheetNames[0];
                const worksheet = workbook.Sheets[firstSheetName];

                const jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

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

                jsonData.slice(1).forEach(row => {
                    const tr = document.createElement('tr');
                    row.forEach(cell => {
                        const td = document.createElement('td');
                        td.textContent = cell;
                        tr.appendChild(td);
                    });
                    table.appendChild(tr);
                });

                document.getElementById('recordCount').textContent = `Cantidad de registros: ${jsonData.length - 1}`;
            };

            reader.readAsArrayBuffer(file);
        });
    </script>
@include('facu.footer')