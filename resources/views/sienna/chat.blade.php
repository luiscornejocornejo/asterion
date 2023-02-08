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

}?>
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

}?>
                                    <button type="submit" class="btn btn-success
                                waves-effect waves-light">Asignar</button>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>


                      <!-- Compose Modal -->
            <div id="compose-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="compose-header-modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-colored-header bg-primary">
                                <h4 class="modal-title" id="compose-header-modalLabel">New Message</h4>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="p-1">
                                <div class="modal-body px-3 pt-3 pb-0">
                                    <form>
                                        <div class="mb-2">
                                            <label for="msgto" class="form-label">To</label>
                                            <input type="text" id="msgto" class="form-control" placeholder="Example@email.com">
                                        </div>
                                        <div class="mb-2">
                                            <label for="mailsubject" class="form-label">Subject</label>
                                            <input type="text" id="mailsubject" class="form-control" placeholder="Your subject">
                                        </div>
                                        <div class="write-mdg-box mb-3">
                                            <label class="form-label">Message</label>
                                            <textarea id="simplemde1"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="px-3 pb-3">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="mdi mdi-send me-1"></i> Send Message</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>





        @include('creative.footer')