<?php

$categoria = session('categoria');
$urlfinalunico = session('urlxennio');


$urlfinalunico=str_replace("conversation","logout",$urlfinalunico);
//$url = file_get_contents($urlfinalunico); 

   echo $urlfinalunico;
    //echo $url;
 
    use Illuminate\Support\Facades\Redirect;

 Redirect::to($urlfinalunico);
    ?>