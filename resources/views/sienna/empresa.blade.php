@include('facu.header2')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


      <div class="content-page" style="padding: 0!important;">
          <div class="content">

              <!-- Start Content-->
                <div class="container pt-5">
                 <?php
                 foreach($empresa as $val){
                  $fre=$val->frecuencia;
                  $zona=$val->zona;
                  $reabrir=$val->reabrir;
                }?>
                 <form action="/empresadatos" method="post">
                 @csrf
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Frecuencia</label>
                      <input value="<?php echo $fre;?>" type="number" name="frecuencia" class="form-control" id="exampleFormControlInput1" placeholder="60000">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Zona Horaria </label>
                      <select  name="zonahoraria" class="form-control" id="exampleFormControlSelect1">
                      <?php $selected=""; 
                      foreach ($zonahoraria as $val){
                        if($val->nombre==$zona){
                          $selected="selected";
                        }

                          echo "<option ".$val->selected." value='".$val->nombre."'>".$val->nombre."</option>";
                          }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Reabrir url broadcast</label>
                      <input value="<?php echo $reabrir;?>" type="text" name="reabrir" class="form-control" id="exampleFormControlInput1" placeholder="http://">
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