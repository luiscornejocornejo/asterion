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
                                                     
                </div>
              <!-- container -->
          </div>
          <!-- content -->
      </div>
  
<!-- Modal users register -->

  <!-- END wrapper -->

  @include('facu.footer')