@include('facu.header2')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


      <div class="content-page" style="padding: 0!important;">
          <div class="content">

              <!-- Start Content-->
                <div class="container pt-5">
                 <form action="/empresadatos" method="post">
                 @csrf
                 frecuencia:<input type="number" name="frecuencia">
                 zona:<select name="zonahoraria">
                    <?php foreach ($zonahoraria as $val){

                        echo "<option value='".$val->nombre."'>".$val->nombre."</option>";
                    }

?>
                 </select>
                 
                 <button type="submit" class="btn btn-primary">Modificar</button>

                 </form>
                 <form action="/empresadatos" method="post">
                 @csrf
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Frecuencia</label>
                      <input type="number" name="frecuencia" class="form-control" id="exampleFormControlInput1" placeholder="60000">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Zona Horaria </label>
                      <select  name="zonahoraria" class="form-control" id="exampleFormControlSelect1">
                      <?php foreach ($zonahoraria as $val){

                          echo "<option value='".$val->nombre."'>".$val->nombre."</option>";
                          }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Reabrir url broadcast</label>
                      <input type="text" name="reabrir" class="form-control" id="exampleFormControlInput1" placeholder="http://">
                    </div>
                    <div class="form-group">
                    <label for="exampleFormControlInput1"></label>

                      <button type="submit" class="btn btn-primary">Modificar</button>
                    </div>
                  </form>                       
                </div>
              <!-- container -->
          </div>
          <!-- content -->
      </div>
  
<!-- Modal users register -->

  <!-- END wrapper -->

  @include('facu.footer')