@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">
     

    <?php
    
    echo $resultados[0]->conversation_url;
    dd($resultados);?>

    </div> 
</div> 
</div>
    <br><br><br>
    @include('facu.footer')