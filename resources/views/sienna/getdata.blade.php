@include('facu.header2')


</script>

<script>
    function noti() {
        if (!("Notification" in window)) {
            alert("Este navegador no soporta notificaciones de escritorio");
        } else if (Notification.permission === "granted") {
            var options = {
                body: "Descripción o cuerpo de la notificación",
                icon: "url_del_icono.jpg",
                dir: "ltr"
            };
            var notification = new Notification("Hola :D", options);
        } else if (Notification.permission !== 'denied') {
            Notification.requestPermission(function(permission) {
                if (!('permission' in Notification)) {
                    Notification.permission = permission;
                }
                if (permission === "granted") {
                    var options = {
                        body: "Descripción o cuerpo de la notificación",
                        icon: "url_del_icono.jpg",
                        dir: "ltr"
                    };
                    var notification = new Notification("Hola :)", options);
                }
            });
        }
    }
</script>

<!-- Begin page -->
<div class="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    @include('facu.menu')


    <div class="content-page" style="padding: 0!important;">
        <div class="content">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <!-- Start Content-->
            <div class="container-fluid pt-2">
                <div class="form-group">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header text-white" style="background-color:#3C3F50">
                                <h5 class="modal-title text-white"></h5>
                                <button onclick="noti()">noti</button>
                            </div>

                            <form method="post" action="/getdata">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12">
                                        <label for="exampleInputEmail1" class="form-label">Obtener información del usuario ERP</label>
                                        <input type="text" name="cliente" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="005215" required>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <div class="mb-2 position-relative">
                                            <label class="form-label">&nbsp;</label>
                                            <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Buscar">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div>
                    <table id="example" class="table table-striped dt-responsive nowrap w-100 text-light">
                        <thead>
                            <tr class="text-center bg-dark">
                                <th class="text-light">Nombre</th>
                                <th class="text-light">Icono</th>
                                <th class="text-light">Valor</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <?php foreach ($getdata as $valh) { ?>
                                <tr class="text-center">
                                    <td><?php echo $valh->nombre; ?></td>
                                    <td><?php echo $valh->icono; ?></td>
                                    <td><?php echo $valh->valor; ?></td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                    <div class="border" class="col-2">
                        <?php if (isset($datosonline)) { ?>

                            <pre id="json"></pre>

                            <script>
                                let data = <?php echo $datosonline; ?>;
                                document.getElementById("json").textContent = JSON.stringify(data, undefined, 2);
                            </script>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- container -->
        </div>
        <!-- content -->
    </div>


    @include('sienna.getdata.nuevovalor')

    <!-- End users register -->
    <div class="newAgent" data-bs-toggle="modal" data-bs-target="#standard-modalvalor">
        <i class="mdi mdi-account-plus" style="font-size: 25px;"></i>
    </div>

</div>
<!-- END wrapper -->

@include('facu.footer')