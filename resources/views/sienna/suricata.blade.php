

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
    height: 100vh;        /* Viewport-relative units */
    width: 100vw;
    top: 20px;
}
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
