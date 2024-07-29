@include('facu.header2')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


      <div class="content-page" style="padding: 0!important;">
          <div class="content"> @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


              <!-- Start Content-->
                <div class="container pt-5">
                 <?php
                 foreach($empresa as $val){
                  $fre=$val->frecuencia;
                  $mail=$val->mail;
                  $zona=$val->zona;
                  $reabrir=$val->reabrir;
                  $user=$val->user;
                  $token=$val->token;
                  $password=$val->password;
                  $botfrontdesk=$val->botfrontdesk;
                  $local=$val->local;
                  $urlmetabase=$val->urlmetabase;
                  $urlchatticketmanual=$val->urlchatticketmanual;
                  
                }?>
                 <form action="/empresadatos" method="post">
                 @csrf
                 <div class="form-group">
                      <label for="exampleFormControlInput1">Token</label>
                      <input readonly value="<?php echo $token;?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="token">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Frecuencia</label>
                      <input value="<?php echo $fre;?>" type="number" name="frecuencia" class="form-control" id="exampleFormControlInput1" placeholder="60000">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Email de envio</label>
                      <input value="<?php echo $mail;?>" type="email" name="mail" class="form-control" id="exampleFormControlInput1" placeholder="60000">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">User server mail</label>
                      <input value="<?php echo $user;?>" type="text" name="mail" class="form-control" id="exampleFormControlInput1" placeholder="60000">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Password server mail</label>
                      <input value="<?php echo $password;?>" type="text" name="mail" class="form-control" id="exampleFormControlInput1" placeholder="60000">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Zona Horaria </label>
                      <select  name="zonahoraria" class="form-control" id="exampleFormControlSelect1">
                      <?php $selected=""; 
                      foreach ($zonahoraria as $val){
                        if($val->nombre==$zona){
                          $selected="selected";
                        }else{
                          $selected=""; 
                        }

                          echo "<option ".$selected." value='".$val->nombre."'>".$val->nombre."</option>";
                          }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Diff hora local GMT</label>
                      <input value="<?php echo $local;?>" type="text" name="local" class="form-control" id="exampleFormControlInput1" placeholder="5">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Integracion </label>
                      <select  name="integracion" class="form-control" id="exampleFormControlSelect1">
                        <option>sin</option>
                      <?php $selected=""; 
                      foreach ($integraciones as $val){
                        if($val->nombre==$inte){
                          $selected="selected";
                        }else{
                          $selected=""; 
                        }

                          echo "<option ".$selected." value='".$val->nombre."'>".$val->nombre."</option>";
                          }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Reabrir url broadcast</label>
                      <input value="<?php echo $reabrir;?>" type="text" name="reabrir" class="form-control" id="exampleFormControlInput1" placeholder="http://">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">bot web</label>
                      <input value="<?php echo $botfrontdesk;?>" type="text" name="botfrontdesk" class="form-control" id="exampleFormControlInput1" placeholder="http://">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">urlmetabase</label>
                      <input value="<?php echo $urlmetabase;?>" type="text" name="urlmetabase" class="form-control" id="exampleFormControlInput1" placeholder="http://">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">urlchatticketmanual</label>
                      <input value="<?php echo $urlchatticketmanual;?>" type="text" name="urlchatticketmanual" class="form-control" id="exampleFormControlInput1" placeholder="http://">
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