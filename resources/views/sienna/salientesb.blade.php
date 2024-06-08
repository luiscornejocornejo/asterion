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
                                    <option value="<?php echo $ll->id;?>"><?php echo $ll->nombre;?></option>
                                <?php }?>
                                </select>
                                <script>
                                    function campos(id){
                                        alert(id.value);
                                        
                                        var element = document.getElementById('carga');
                                        element.classList.remove('d-none');
                                    }

                                </script>
                            </div>
                        
                            

                        </div>
                        <div id="carga" class="row d-none">

                                <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                                    data-upload-preview-template="#uploadPreviewTemplate">
                                    @csrf

                                    <div class="fallback">
                                        <input name="file" id="inputFile" type="file" multiple />
                                    </div>
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

                jsonData.forEach((row) => {
                    const tr = document.createElement('tr');
                    row.forEach((cell) => {
                        const td = document.createElement('td');
                        td.textContent = cell;
                        tr.appendChild(td);
                    });
                    table.appendChild(tr);
                });
            };

            reader.readAsArrayBuffer(file);
        });
    </script>
@include('facu.footer')