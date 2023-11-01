<?php

$categoria = session('categoria');
$urlfinalunico = session('urlxennio');


$urlfinalunico=str_replace("conversation","logout",$urlfinalunico);
    var_dump($urlfinalunico);
    var_dump($categoria);
    ?>