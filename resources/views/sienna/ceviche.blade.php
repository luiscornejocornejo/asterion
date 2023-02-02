@include('pp.header')

<div id="principal">

    <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Reporting</h1>
            </div>
            <!-- Content Row -->
            <!-- /.container-fluid -->

            <div class="container-fluid">

                <!-- Content Row -->
                <!-- /.container-fluid -->


                <div class="card shadow mb-4">
                    <a class="btn btn-success" href="/ceviche_nuevo" role="button">Nuevo</a>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Permisos</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($resultados as $resultado)


                                    <tr>
                                        <td>{{ $resultado->id }}</td>
                                        <td><a href="ceviche_view?id={{ $resultado->id }}">{{ $resultado->nombre }}</a></td>
                                        <td><a class="btn btn-primary" href="/ceviche_permisos?id={{$resultado->id}}" role="button">Permisos</a> </td>
                                        <td><a class="btn btn-warning" href="/ceviche_modificar?id={{$resultado->id}}" role="button">Modificar</a> </td>
                                        <td><a class="btn btn-danger" href="/ceviche_eliminar?id={{$resultado->id}}" role="button">Eliminar</a> </td>


                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->


                <footer class="sticky-footer bg-white">
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->

        </div>
</div>
@include('pp.footer')






























<!-- Bootstrap core JavaScript-->
<!-- Core plugin JavaScript-->

<!-- Page level plugins -->



</body>

</html>