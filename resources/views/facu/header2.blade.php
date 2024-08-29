<!doctype html>
<html  lang="en" data-bs-theme="light" data-layout-mode="fluid" data-menu-color="dark" data-topbar-color="light" data-layout-position="fixed" data-sidenav-size="condensed" class="menuitem-active"><head>
  <meta charset="utf-8">
  <title id='titulo'>Suricata Cx</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
  <meta content="Coderthemes" name="author">

  <!-- App favicon -->
  <link id="favicon"  rel="shortcut icon" href="assetsfacu/images/favicom_suricata.png">

  <!-- Daterangepicker css -->
  <link rel="stylesheet" href="assetsfacu/vendor/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="tt.css">

  <!-- Vector Map css -->
  <link rel="stylesheet" href="assetsfacu/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

  <link href="assetsfacu/vendor/quill/quill.core.css" rel="stylesheet" type="text/css" />
   <link href="assetsfacu/vendor/quill/quill.snow.css" rel="stylesheet" type="text/css" />

   <link href="assetsfacu/vendor/quill/quill.core.css" rel="stylesheet" type="text/css">
   <link href="assetsfacu/vendor/quill/quill.bubble.css" rel="stylesheet" type="text/css">
   <link href="assetsfacu/vendor/quill/quill.snow.css" rel="stylesheet" type="text/css">
  <!-- Theme Config Js -->
  <script src="assetsfacu/js/hyper-config.js"></script>
  <script src="js/utils.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
  <script src="assetsfacu/js/showfiles.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
  <!-- App css -->
  <link href="assetsfacu/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style">
  <link href="agents.css" rel="stylesheet" type="text/css" id="app-style">
  <link href="flotante.css" rel="stylesheet" type="text/css">
  <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            if (menu.classList.contains("hidden")) {
            menu.classList.remove("hidden");
            menu.classList.add("visible");
            } else {
            menu.classList.remove("visible");
            menu.classList.add("hidden");
            }
        }
  
        function toggleRotation() {
            var button = document.getElementById('main-button');
            button.classList.toggle('rotated'); // Agrega o quita la clase 'rotated' al hacer clic
        }

        function  notifyMe()  {  
              if  (!("Notification"  in  window))  {   
                  alert("Este navegador no soporta notificaciones de escritorio");  
              }  
              else  if  (Notification.permission  ===  "granted")  {
                  var  options  =   {
                      body:   "Descripción o cuerpo de la notificación",
                      icon:   "url_del_icono.jpg",
                      dir :   "ltr"
                  };
                  var  notification  =  new  Notification("Hola :D", options);
              }  
              else  if  (Notification.permission  !==  'denied')  {
                  Notification.requestPermission(function (permission)  {
                      if  (!('permission'  in  Notification))  {
                          Notification.permission  =  permission;
                      }
                      if  (permission  ===  "granted")  {
                          var  options  =   {
                              body:   "Descripción o cuerpo de la notificación",
                          icon:   "url_del_icono.jpg",
                          dir :   "ltr"
                          };     
                          var  notification  =  new  Notification("Hola :)", options);
                      }   
                  });  
              }
            }
</script>
  <!-- Icons css -->
  <link href="assetsfacu/css/icons.min.css" rel="stylesheet" type="text/css">
<style id="apexcharts-css">
.background-buttons :hover{
  background-color: #FFD193!important;
  color: #3C4665!important;
}



  .whatsapp {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    cursor: pointer;
    color: #fff;
    background-color: #25d366;
    border-radius: 50%;
    text-align: center;
    width: 50px;
    height: 50px;
    line-height: 50px;
    font-size: 16px;
    box-shadow: 2px 2px 3px #999;

  }


</style>

<style>
body {
    margin: 0;            /* Reset default margin */
}
iframe {
           /* Reset default border */
    height: 100%;        /* Viewport-relative units */
   /* width: 80vw;*/
    width: 100%;
  

z-index: 999;}
    </style>

<script src="sienna/js/7tickets.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

</head>
<body class="show" >
