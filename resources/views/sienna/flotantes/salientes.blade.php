<div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#3c4655">
                <h5 class="modal-title text-white" id="exampleModalLabel"><i class="mdi mdi-whatsapp text-success"></i> Enviar plantilla de Whatsapp</h5>

            </div>
            <form id="frmAgregarBienCapitalizable" action="/" method="post">
                @csrf

                <div class="modal-body p-2">
                    <div id="resul"></div>

                    <div class="mb-3 mx-2">
                        <label for="telefono" class="form-label">Whatsapp</label>
                        <input name="telefono" type="cel" id="telefono" placeholder="5491133258450" class="form-control" required>
                    </div>

                    <div class="mb-3 mx-2">
                        <label for="template" class="form-label">Plantilla</label>
                        <select class="form-select" id="template">
                        <?php

                        $query22 = "SELECT id, nombre, url, descripcion FROM template";

                        $resultados22 = DB::select($query22);
                        foreach ($resultados22 as $val22) {
                            $url = $val22->url;
                            $nombre = $val22->nombre;
                            $descripcion = $val22->descripcion;
                            echo "<option value='" . $url . "'>" . $nombre . "</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <div class="alert alert-warning mx-2" role="alert">
                        <i class="ri-alert-line me-1 align-middle font-16"></i> Atención - Este proceso puede demorar unos minutos y el usuario debe responder el mensaje enviado.
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">Close</button>
                    <button type="button" style="background-color: #ffc95c;" class="btn  mb-0 " onclick="mensaje('<?php echo $saliente = session('saliente'); ?>')" class="  "><span style="color: #495057;">Iniciar</span></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    function mensaje(saliente) {

        var tel = document.getElementById("telefono");
        var telvalor = document.getElementById("telefono").value;
        if (telvalor == "") {
            var men = document.getElementById("resul");
            men.innerHTML = '<div data-mdb-delay="3000" class="alert alert-danger" role="alert">   ' +
                '<strong>Error - </strong> El campo Whatsapp es obligatorio.</div>';

            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 4000);
        } else {



            var url = document.getElementById("template").value;
            //  var url= "https://publicapi.xenioo.com/broadcasts/uD7SL7UMkUeF878WQ5Jat5vE0KqKjY1sUjVi84xKAI781x0x0yy1EVFpHtS0H9dB/rn5HSrzi9xrvW8ZtVw8yVdiJdqoLdsc7kjybZSRbJpax6TEWL0RyWn8E5meb2e4H/direct";///document.getElementById("template").value;
            var tel2 = tel.value;
            if (tel2 == "") {
                tel2 = "5491133258450"
            }
            console.log(tel2);
            console.log(url);

            const xhr = new XMLHttpRequest();
            urlprincipal2 = "https://suricata4.com.ar/api/broadcast?url=" + url + "&tel2=" + tel2 + "&token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM";
            console.log(urlprincipal2.trim());

            xhr.open("GET", urlprincipal2.trim());
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(JSON.parse(xhr.responseText));
                } else {
                    console.log(`Error: ${xhr.status}`);
                }
            };
            xhr.send();

            var men = document.getElementById("resul");
            men.innerHTML = '<div data-mdb-delay="3000" class="alert alert-success" role="alert">   ' +
                '<strong>Felicitaciones - </strong>   El mensaje fue enviado correctamente</div>';

            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 4000);
        }
    }
</script>