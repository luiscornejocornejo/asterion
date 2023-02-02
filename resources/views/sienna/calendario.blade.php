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
             
                <div class="row">
                    <div class="col-12">

                        <div class="row">
                            <div class="col-xl-2 col-lg-2">
                                <div class="card">
                                    <div class="card-body">
                                        

                                        <div id="external-events" class="mt-2">
                                        
                                           
                                        </div>

                                
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-xl-9 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                        </div>

                        <div style='clear:both'></div>


                        <!-- Add New Event MODAL -->
                        <div class="modal fade" id="event-modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header py-3 px-4 border-bottom-0">
                                        <h5 class="modal-title" id="modal-title">Event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form class="needs-validation" name="event-form" id="form-event" novalidate>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Datos
                                                            Name</label>
                                                        <input class="form-control" placeholder="Insert Event
                                                    Name" type="text" name="title" id="event-title" required value="" />
                                                        <div class="invalid-feedback">Please
                                                            provide a valid event name</div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                          
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- end modal-content-->
                            </div> <!-- end modal dialog-->
                        </div>
                        <!-- end modal-->

                    </div>
                </div>
                


            </div>
        </div>
    </div>
</div>
@include('pp.footer')
<script type="text/javascript">

  </script>

            <script src="https://siennasystem.com/assets/js/main.js"></script>
            <script src="https://siennasystem.com/assets/js/pages/calendar.init.js"></script>

<br><br><br>
