@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

  
     

   
 <iframe allow="camera;microphone"  src="<?php  echo $resultados[0]->conversation_url;?> " width="100%" height="800px" class="border rounded-3" style="height:600px !important"></iframe>
  
   
</div> 
</div>
<?php dd($resultados);?>
    <br><br><br>
  
    
   
   
    @include('facu.footer')