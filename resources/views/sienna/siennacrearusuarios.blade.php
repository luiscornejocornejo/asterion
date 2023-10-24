@include('facu.header')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')

      <!-- ========== Left Sidebar End ========== -->

      <!-- ============================================================== -->
      <!-- Start Page Content here -->
      <!-- ============================================================== -->

      <div class="content-page" style="padding:0 !important;">
          <div class="content">

              <!-- Start Content-->
              <div class="container-fluid">
                 <div>
                 <form method="post" action="">

                            @csrf
                            <br>


                            <label for="exampleInputEmail1">Nombre de Uusario </label>
                            <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre" required>
                            <br>
                            <label for="exampleInputEmail1">Apellido </label>
                            <input type="text" name="apellido" class="form-control" id="" aria-describedby="" placeholder="Apellido" required>
                            <br> <label for="exampleInputEmail1">Mail logeo </label>
                            <input type="mail" name="maill" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mail logeo" required>
                            <br> <label for="exampleInputEmail1">Grupos sso</label>
                            <select name="grupossso[]" class="form-control" multiple>

                            <option>Administracion</option>
                            <option>Soporte</option>
                            <option>Ventas</option>

                            </select>
                            <br>

                            <br> <label for="exampleInputEmail1">Servicios </label>
                            <select name="servicios[]" class="form-control" multiple>

                            <option value="1">Sienna</option>
                            <option value="2">osticket</option>
                            <option value="3">xennio</option>

                            </select>
                            <br>
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="pass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" required>
                            <br>
                            <select   class="form-select" aria-label="Default select example" name="tipo" >
                            <option >supervisor</option>
                            <option >agente</option>
                            <option >super</option>

                                            </select>

                            <br>
                            <button type="submit" style="background-color:#18D777" class="btn  form-control">Crear</button>



                </form>




                </div>
              </div>
              <!-- container -->
          </div>
          <!-- content -->
      </div>

      <!-- ============================================================== -->
      <!-- End Page content -->
      <!-- ============================================================== -->

  </div>
  <!-- END wrapper -->

  @include('facu.footer')
