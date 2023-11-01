<?php

$categoria = session('categoria');
$urlfinalunico = session('urlxennio');


$urlfinalunico=str_replace("conversation","logout",$urlfinalunico);
$url = file_get_contents($urlfinalunico); 

    var_dump($urlfinalunico);
    var_dump($url);
    ?>