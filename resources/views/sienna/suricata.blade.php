

<html>
    <head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<style>
body {
    margin: 0;            /* Reset default margin */
}
iframe {
    display: block;       /* iframes are inline by default */
    background: #000;
    border: none;         /* Reset default border */
    height: 90%;        /* Viewport-relative units */
    width: 100vw;
    margin-top:65px;
z-index: 999;}
    </style>

    </head>

    @include('creative.header')
    @include('creative.menuarriba')
<body>

<?php 



?>

<iframe src="<?php echo $url;?>" sandbox="allow-forms allow-scripts allow-popups allow-same-origin allow-top-navigation" ></iframe>

</body>



@include('creative.footer')


</html>
