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
                            <br> <label for="exampleInputEmail1">Grupos </label>
                            <select name="grupossso[]" class="form-control" multiple>

                            <?php foreach($deptos as $val){?>

                                <option ><?php echo $val->nombre;?></option>


                            <?php }?>

                            </select>
                            <br>

                           
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="pass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" required>
                            <br>
                            <select   class="form-select" aria-label="Default select example" name="tipo" >
                            <option >supervisor</option>
                            <option >agente</option>

                                            </select>

                            <br>
                            <button type="submit" style="background-color:#18D777" class="btn  form-control">Crear</button>



                </form>




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
