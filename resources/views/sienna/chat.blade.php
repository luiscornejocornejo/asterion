@include('creative.header')
@vite(['resources/js/app.js'])

<body>
    <!-- Begin page -->
    <div class="wrapper">

        @include('creative.menuarriba')



        <div id="alert"></div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="content-page" style="height: auto; ">
            

                <!-- Start Content-->
                <div class="container " style="height: auto; ">

                    <!-- start page title -->
                   
                    <!-- end page title -->


                    <!-- start chat users-->
                    <div id="App">
                        <div class="row">
                            <luis-component></luis-component>
                            <centro-component></centro-component>
                            <final-component></final-component>
                        </div> <!-- end row-->

                        <!-- end chat users-->

                        <!-- chat area -->




                        <!-- end chat area-->

                        <!-- start user detail -->

                        <!-- end user detail -->


                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->

                <!-- end Footer -->


                <div id="standard-modal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cambiar estado</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/chatcambiarestado" method="post">
                                    @csrf
                                    <input type="hidden" name="idticketestado" id="idticketestado" value="">
                                    <?php
                                    foreach ($estados as $value) {
                                    ?>

                                        <input class="form-radio" type="radio" name="statos" value="<?php echo $value->id; ?>"><?php echo $value->name; ?><br>

                                    <?php

                                    } ?>
                                    <button type="submit" class="btn btn-success
                                waves-effect waves-light">Cambiar</button>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>



                <div id="standard-modal2" class="modal fade bs-example-modal-center2" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cambiar Departamento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/chatcambiardeptos" method="post">
                                    @csrf
                                    <input type="hidden" name="idticketestado" id="idticketdepto" value="">
                                    <?php
                                    foreach ($deptos as $value) {
                                    ?>

                                        <input class="form-radio" type="radio" name="statos" value="<?php echo $value->id; ?>"><?php echo $value->name; ?><br>

                                    <?php

                                    } ?>
                                    <button type="submit" class="btn btn-success
                                waves-effect waves-light">Cambiar</button>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                <div id="standard-modal3" class="modal fade bs-example-modal-center3" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cambiar Topics</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/chatcambiartopic" method="post">
                                    @csrf
                                    <input type="hidden" name="idticketestado" id="idtickettopic" value="">
                                    <?php
                                    foreach ($topics as $value) {
                                    ?>

                                        <input class="form-radio" type="radio" name="statos" value="<?php echo $value->topic_id; ?>"><?php echo $value->topic; ?><br>

                                    <?php

                                    } ?>
                                    <button type="submit" class="btn btn-success
                                waves-effect waves-light">Cambiar</button>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <div id="standard-modal4" class="modal fade bs-example-modal-center3" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Asignar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/chatcambiarasignado" method="post">
                                    @csrf
                                    <input type="hidden" name="idticketestado" id="idtickettopic" value="">
                                    <?php
                                    foreach ($topics as $value) {
                                    ?>

                                        <input class="form-radio" type="radio" name="statos" value="<?php echo $value->topic_id; ?>"><?php echo $value->topic; ?><br>

                                    <?php

                                    } ?>
                                    <button type="submit" class="btn btn-success
                                waves-effect waves-light">Asignar</button>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            </div>



       
  
        @include('creative.footer')