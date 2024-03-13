@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">
     

    <?php
    
   
    dd($resultados);?>
 <iframe allow="camera;microphone"  src="<?php  echo $resultados[0]->conversation_url;?> " width="100%" height="800px" class="border rounded-3" style="height:400px !important"></iframe>
  
    </div> 
</div> 
</div>
    <br><br><br>
    @include('facu.footer')