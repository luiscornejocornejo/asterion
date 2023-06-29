@include('pp.header')

<div id="principal">
    <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Crear Sienna front</h1>
                </div>
                <div class="container m-8">

<div class="form-group">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header  text-white" style="background-color:#3C3F50">
                <h5 class="modal-title text-white"></h5>

            </div>
            <div class="modal-body" style="text-align:center">

                <form method="post" action="/creardb">

                        @csrf
                        <br>
                    <label for="exampleInputEmail1">Nombre de la DB </label>
                    <input type="text" name="db" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="merchand" required>
                    <br>
                  
                        <button type="submit" style="background-color:#18D777" class="btn  form-control">Crear</button>

                </form>


                <?php if(isset($lista)){

                    var_dump($lista);
                }?>




            </div>

         
        </div><!-- /.modal-content -->
    </div>






</div>
                    </div>
                


            </div>
        </div>
    </div>
</div>
<br><br><br>
    @include('pp.footer')