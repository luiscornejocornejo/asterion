
<html>
    <head></head>


<body>

<?php 


$res=json_decode($response, true);

var_dump($res);
$url=$res['Home'];
echo $url;
?>



</body>





</html>