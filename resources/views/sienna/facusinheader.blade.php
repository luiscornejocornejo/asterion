<html lang="en" data-bs-theme="light" data-layout-mode="fluid" data-menu-color="dark" data-topbar-color="light" data-layout-position="fixed" data-sidenav-size="condensed" class="menuitem-active"><head>
  <meta charset="utf-8">
  <title>Dashboard | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
  <meta content="Coderthemes" name="author">

  <!-- App favicon -->
  <link rel="shortcut icon" href="assetsfacu/images/favicon.ico">

  <!-- Daterangepicker css -->
  <link rel="stylesheet" href="assetsfacu/vendor/daterangepicker/daterangepicker.css">

  <!-- Vector Map css -->
  <link rel="stylesheet" href="assetsfacu/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

  <!-- Theme Config Js -->
  <script src="assetsfacu/js/hyper-config.js"></script>

  <!-- App css -->
  <link href="assetsfacu/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style">

  <!-- Icons css -->
  <link href="assetsfacu/css/icons.min.css" rel="stylesheet" type="text/css">
<style id="apexcharts-css">@keyframes opaque {
0% {
opacity: 0
}

to {
opacity: 1
}
}

@keyframes resizeanim {
0%,to {
opacity: 0
}
}

.apexcharts-canvas {
position: relative;
user-select: none
}

.apexcharts-canvas ::-webkit-scrollbar {
-webkit-appearance: none;
width: 6px
}

.apexcharts-canvas ::-webkit-scrollbar-thumb {
border-radius: 4px;
background-color: rgba(0,0,0,.5);
box-shadow: 0 0 1px rgba(255,255,255,.5);
-webkit-box-shadow: 0 0 1px rgba(255,255,255,.5)
}

.apexcharts-inner {
position: relative
}

.apexcharts-text tspan {
font-family: inherit
}

.legend-mouseover-inactive {
transition: .15s ease all;
opacity: .2
}

.apexcharts-legend-text {
padding-left: 15px;
margin-left: -15px;
}

.apexcharts-series-collapsed {
opacity: 0
}

.apexcharts-tooltip {
border-radius: 5px;
box-shadow: 2px 2px 6px -4px #999;
cursor: default;
font-size: 14px;
left: 62px;
opacity: 0;
pointer-events: none;
position: absolute;
top: 20px;
display: flex;
flex-direction: column;
overflow: hidden;
white-space: nowrap;
z-index: 12;
transition: .15s ease all
}

.apexcharts-tooltip.apexcharts-active {
opacity: 1;
transition: .15s ease all
}

.apexcharts-tooltip.apexcharts-theme-light {
border: 1px solid #e3e3e3;
background: rgba(255,255,255,.96)
}

.apexcharts-tooltip.apexcharts-theme-dark {
color: #fff;
background: rgba(30,30,30,.8)
}

.apexcharts-tooltip * {
font-family: inherit
}

.apexcharts-tooltip-title {
padding: 6px;
font-size: 15px;
margin-bottom: 4px
}

.apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
background: #eceff1;
border-bottom: 1px solid #ddd
}

.apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
background: rgba(0,0,0,.7);
border-bottom: 1px solid #333
}

.apexcharts-tooltip-text-goals-value,.apexcharts-tooltip-text-y-value,.apexcharts-tooltip-text-z-value {
display: inline-block;
margin-left: 5px;
font-weight: 600
}

.apexcharts-tooltip-text-goals-label:empty,.apexcharts-tooltip-text-goals-value:empty,.apexcharts-tooltip-text-y-label:empty,.apexcharts-tooltip-text-y-value:empty,.apexcharts-tooltip-text-z-value:empty,.apexcharts-tooltip-title:empty {
display: none
}

.apexcharts-tooltip-text-goals-label,.apexcharts-tooltip-text-goals-value {
padding: 6px 0 5px
}

.apexcharts-tooltip-goals-group,.apexcharts-tooltip-text-goals-label,.apexcharts-tooltip-text-goals-value {
display: flex
}

.apexcharts-tooltip-text-goals-label:not(:empty),.apexcharts-tooltip-text-goals-value:not(:empty) {
margin-top: -6px
}

.apexcharts-tooltip-marker {
width: 12px;
height: 12px;
position: relative;
top: 0;
margin-right: 10px;
border-radius: 50%
}

.apexcharts-tooltip-series-group {
padding: 0 10px;
display: none;
text-align: left;
justify-content: left;
align-items: center
}

.apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
opacity: 1
}

.apexcharts-tooltip-series-group.apexcharts-active,.apexcharts-tooltip-series-group:last-child {
padding-bottom: 4px
}

.apexcharts-tooltip-series-group-hidden {
opacity: 0;
height: 0;
line-height: 0;
padding: 0!important
}

.apexcharts-tooltip-y-group {
padding: 6px 0 5px
}

.apexcharts-custom-tooltip,.apexcharts-tooltip-box {
padding: 4px 8px
}

.apexcharts-tooltip-boxPlot {
display: flex;
flex-direction: column-reverse
}

.apexcharts-tooltip-box>div {
margin: 4px 0
}

.apexcharts-tooltip-box span.value {
font-weight: 700
}

.apexcharts-tooltip-rangebar {
padding: 5px 8px
}

.apexcharts-tooltip-rangebar .category {
font-weight: 600;
color: #777
}

.apexcharts-tooltip-rangebar .series-name {
font-weight: 700;
display: block;
margin-bottom: 5px
}

.apexcharts-xaxistooltip,.apexcharts-yaxistooltip {
opacity: 0;
pointer-events: none;
color: #373d3f;
font-size: 13px;
text-align: center;
border-radius: 2px;
position: absolute;
z-index: 10;
background: #eceff1;
border: 1px solid #90a4ae
}

.apexcharts-xaxistooltip {
padding: 9px 10px;
transition: .15s ease all
}

.apexcharts-xaxistooltip.apexcharts-theme-dark {
background: rgba(0,0,0,.7);
border: 1px solid rgba(0,0,0,.5);
color: #fff
}

.apexcharts-xaxistooltip:after,.apexcharts-xaxistooltip:before {
left: 50%;
border: solid transparent;
content: " ";
height: 0;
width: 0;
position: absolute;
pointer-events: none
}

.apexcharts-xaxistooltip:after {
border-color: transparent;
border-width: 6px;
margin-left: -6px
}

.apexcharts-xaxistooltip:before {
border-color: transparent;
border-width: 7px;
margin-left: -7px
}

.apexcharts-xaxistooltip-bottom:after,.apexcharts-xaxistooltip-bottom:before {
bottom: 100%
}

.apexcharts-xaxistooltip-top:after,.apexcharts-xaxistooltip-top:before {
top: 100%
}

.apexcharts-xaxistooltip-bottom:after {
border-bottom-color: #eceff1
}

.apexcharts-xaxistooltip-bottom:before {
border-bottom-color: #90a4ae
}

.apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after,.apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
border-bottom-color: rgba(0,0,0,.5)
}

.apexcharts-xaxistooltip-top:after {
border-top-color: #eceff1
}

.apexcharts-xaxistooltip-top:before {
border-top-color: #90a4ae
}

.apexcharts-xaxistooltip-top.apexcharts-theme-dark:after,.apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
border-top-color: rgba(0,0,0,.5)
}

.apexcharts-xaxistooltip.apexcharts-active {
opacity: 1;
transition: .15s ease all
}

.apexcharts-yaxistooltip {
padding: 4px 10px
}

.apexcharts-yaxistooltip.apexcharts-theme-dark {
background: rgba(0,0,0,.7);
border: 1px solid rgba(0,0,0,.5);
color: #fff
}

.apexcharts-yaxistooltip:after,.apexcharts-yaxistooltip:before {
top: 50%;
border: solid transparent;
content: " ";
height: 0;
width: 0;
position: absolute;
pointer-events: none
}

.apexcharts-yaxistooltip:after {
border-color: transparent;
border-width: 6px;
margin-top: -6px
}

.apexcharts-yaxistooltip:before {
border-color: transparent;
border-width: 7px;
margin-top: -7px
}

.apexcharts-yaxistooltip-left:after,.apexcharts-yaxistooltip-left:before {
left: 100%
}

.apexcharts-yaxistooltip-right:after,.apexcharts-yaxistooltip-right:before {
right: 100%
}

.apexcharts-yaxistooltip-left:after {
border-left-color: #eceff1
}

.apexcharts-yaxistooltip-left:before {
border-left-color: #90a4ae
}

.apexcharts-yaxistooltip-left.apexcharts-theme-dark:after,.apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
border-left-color: rgba(0,0,0,.5)
}

.apexcharts-yaxistooltip-right:after {
border-right-color: #eceff1
}

.apexcharts-yaxistooltip-right:before {
border-right-color: #90a4ae
}

.apexcharts-yaxistooltip-right.apexcharts-theme-dark:after,.apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
border-right-color: rgba(0,0,0,.5)
}

.apexcharts-yaxistooltip.apexcharts-active {
opacity: 1
}

.apexcharts-yaxistooltip-hidden {
display: none
}

.apexcharts-xcrosshairs,.apexcharts-ycrosshairs {
pointer-events: none;
opacity: 0;
transition: .15s ease all
}

.apexcharts-xcrosshairs.apexcharts-active,.apexcharts-ycrosshairs.apexcharts-active {
opacity: 1;
transition: .15s ease all
}

.apexcharts-ycrosshairs-hidden {
opacity: 0
}

.apexcharts-selection-rect {
cursor: move
}

.svg_select_boundingRect,.svg_select_points_rot {
pointer-events: none;
opacity: 0;
visibility: hidden
}

.apexcharts-selection-rect+g .svg_select_boundingRect,.apexcharts-selection-rect+g .svg_select_points_rot {
opacity: 0;
visibility: hidden
}

.apexcharts-selection-rect+g .svg_select_points_l,.apexcharts-selection-rect+g .svg_select_points_r {
cursor: ew-resize;
opacity: 1;
visibility: visible
}

.svg_select_points {
fill: #efefef;
stroke: #333;
rx: 2
}

.apexcharts-svg.apexcharts-zoomable.hovering-zoom {
cursor: crosshair
}

.apexcharts-svg.apexcharts-zoomable.hovering-pan {
cursor: move
}

.apexcharts-menu-icon,.apexcharts-pan-icon,.apexcharts-reset-icon,.apexcharts-selection-icon,.apexcharts-toolbar-custom-icon,.apexcharts-zoom-icon,.apexcharts-zoomin-icon,.apexcharts-zoomout-icon {
cursor: pointer;
width: 20px;
height: 20px;
line-height: 24px;
color: #6e8192;
text-align: center
}

.apexcharts-menu-icon svg,.apexcharts-reset-icon svg,.apexcharts-zoom-icon svg,.apexcharts-zoomin-icon svg,.apexcharts-zoomout-icon svg {
fill: #6e8192
}

.apexcharts-selection-icon svg {
fill: #444;
transform: scale(.76)
}

.apexcharts-theme-dark .apexcharts-menu-icon svg,.apexcharts-theme-dark .apexcharts-pan-icon svg,.apexcharts-theme-dark .apexcharts-reset-icon svg,.apexcharts-theme-dark .apexcharts-selection-icon svg,.apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg,.apexcharts-theme-dark .apexcharts-zoom-icon svg,.apexcharts-theme-dark .apexcharts-zoomin-icon svg,.apexcharts-theme-dark .apexcharts-zoomout-icon svg {
fill: #f3f4f5
}

.apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg,.apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,.apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg {
fill: #008ffb
}

.apexcharts-theme-light .apexcharts-menu-icon:hover svg,.apexcharts-theme-light .apexcharts-reset-icon:hover svg,.apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,.apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,.apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,.apexcharts-theme-light .apexcharts-zoomout-icon:hover svg {
fill: #333
}

.apexcharts-menu-icon,.apexcharts-selection-icon {
position: relative
}

.apexcharts-reset-icon {
margin-left: 5px
}

.apexcharts-menu-icon,.apexcharts-reset-icon,.apexcharts-zoom-icon {
transform: scale(.85)
}

.apexcharts-zoomin-icon,.apexcharts-zoomout-icon {
transform: scale(.7)
}

.apexcharts-zoomout-icon {
margin-right: 3px
}

.apexcharts-pan-icon {
transform: scale(.62);
position: relative;
left: 1px;
top: 0
}

.apexcharts-pan-icon svg {
fill: #fff;
stroke: #6e8192;
stroke-width: 2
}

.apexcharts-pan-icon.apexcharts-selected svg {
stroke: #008ffb
}

.apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
stroke: #333
}

.apexcharts-toolbar {
position: absolute;
z-index: 11;
max-width: 176px;
text-align: right;
border-radius: 3px;
padding: 0 6px 2px;
display: flex;
justify-content: space-between;
align-items: center
}

.apexcharts-menu {
background: #fff;
position: absolute;
top: 100%;
border: 1px solid #ddd;
border-radius: 3px;
padding: 3px;
right: 10px;
opacity: 0;
min-width: 110px;
transition: .15s ease all;
pointer-events: none
}

.apexcharts-menu.apexcharts-menu-open {
opacity: 1;
pointer-events: all;
transition: .15s ease all
}

.apexcharts-menu-item {
padding: 6px 7px;
font-size: 12px;
cursor: pointer
}

.apexcharts-theme-light .apexcharts-menu-item:hover {
background: #eee
}

.apexcharts-theme-dark .apexcharts-menu {
background: rgba(0,0,0,.7);
color: #fff
}

@media screen and (min-width:768px) {
.apexcharts-canvas:hover .apexcharts-toolbar {
opacity: 1
}
}

.apexcharts-canvas .apexcharts-element-hidden,.apexcharts-datalabel.apexcharts-element-hidden,.apexcharts-hide .apexcharts-series-points {
opacity: 0
}

.apexcharts-datalabel,.apexcharts-datalabel-label,.apexcharts-datalabel-value,.apexcharts-datalabels,.apexcharts-pie-label {
cursor: default;
pointer-events: none
}

.apexcharts-pie-label-delay {
opacity: 0;
animation-name: opaque;
animation-duration: .3s;
animation-fill-mode: forwards;
animation-timing-function: ease
}

.apexcharts-legend {	
display: flex;	
overflow: auto;	
padding: 0 10px;	
}	
.apexcharts-legend.apx-legend-position-bottom, .apexcharts-legend.apx-legend-position-top {	
flex-wrap: wrap	
}	
.apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {	
flex-direction: column;	
bottom: 0;	
}	
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left, .apexcharts-legend.apx-legend-position-top.apexcharts-align-left, .apexcharts-legend.apx-legend-position-right, .apexcharts-legend.apx-legend-position-left {	
justify-content: flex-start;	
}	
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center, .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {	
justify-content: center;  	
}	
.apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right, .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {	
justify-content: flex-end;	
}	
.apexcharts-legend-series {	
cursor: pointer;	
line-height: normal;	
}	
.apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series, .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series{	
display: flex;	
align-items: center;	
}	
.apexcharts-legend-text {	
position: relative;	
font-size: 14px;	
}	
.apexcharts-legend-text *, .apexcharts-legend-marker * {	
pointer-events: none;	
}	
.apexcharts-legend-marker {	
position: relative;	
display: inline-block;	
cursor: pointer;	
margin-right: 3px;	
border-style: solid;
}	

.apexcharts-legend.apexcharts-align-right .apexcharts-legend-series, .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series{	
display: inline-block;	
}	
.apexcharts-legend-series.apexcharts-no-click {	
cursor: auto;	
}	
.apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {	
display: none !important;	
}	
.apexcharts-inactive-legend {	
opacity: 0.45;	
}

.apexcharts-annotation-rect,.apexcharts-area-series .apexcharts-area,.apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,.apexcharts-gridline,.apexcharts-line,.apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,.apexcharts-point-annotation-label,.apexcharts-radar-series path,.apexcharts-radar-series polygon,.apexcharts-toolbar svg,.apexcharts-tooltip .apexcharts-marker,.apexcharts-xaxis-annotation-label,.apexcharts-yaxis-annotation-label,.apexcharts-zoom-rect {
pointer-events: none
}

.apexcharts-marker {
transition: .15s ease all
}

.resize-triggers {
animation: 1ms resizeanim;
visibility: hidden;
opacity: 0;
height: 100%;
width: 100%;
overflow: hidden
}

.contract-trigger:before,.resize-triggers,.resize-triggers>div {
content: " ";
display: block;
position: absolute;
top: 0;
left: 0
}

.resize-triggers>div {
height: 100%;
width: 100%;
background: #eee;
overflow: auto
}

.contract-trigger:before {
overflow: hidden;
width: 200%;
height: 200%
}

.background-buttons :hover{
  background-color: #FFD193!important;
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
</head>

<body class="show">
  <!-- Begin page -->
  <div class="wrapper">
    
      <!-- ========== Left Sidebar Start ========== -->
      <div class="leftside-menu menuitem-active">

          <!-- Brand Logo Light -->
          <a href="index.html" class="logo logo-light">
              <span class="logo-lg">
                  <img src="assetsfacu/images/logo.svg" alt="logo">
              </span>
              <span class="logo-sm mt-2 ms-1">
                  <img src="assetsfacu/images/logo.png" alt="small logo">
              </span>
          </a>

          <!-- Brand Logo Dark -->
          <a href="index.html" class="logo logo-dark">
              <span class="logo-lg">
                  <img src="assetsfacu/images/logo-dark.png" alt="dark logo">
              </span>
              <span class="logo-sm">
                  <img src="assetsfacu/images/logo-dark-sm.png" alt="small logo">
              </span>
          </a>

          <!-- Sidebar Hover Menu Toggle Button -->
          <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Show Full Sidebar" data-bs-original-title="Show Full Sidebar">
              <i class="ri-checkbox-blank-circle-line align-middle"></i>
          </div>

          <!-- Full Sidebar Menu Close Button -->
          <div class="button-close-fullsidebar">
              <i class="ri-close-fill align-middle"></i>
          </div>

          <!-- Sidebar -left -->
          <div class="h-100 show" id="leftside-menu-container" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: scroll hidden;"><div class="simplebar-content" style="padding: 0px;">
              <!-- Leftbar User -->
              <div class="leftbar-user">
                  <a href="pages-profile.html">
                      <img src="assetsfacu/images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
                      <span class="leftbar-user-name mt-2">Dominic Keller</span>
                  </a>
              </div>

              <!--- Sidemenu -->
              <ul class="side-nav">
                <li class="side-nav-item mt-2 background-buttons">
                  <a data-bs-toggle="collapse" href="#" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link hovering-pan ">
                      <i class="uil-dashboard"></i>
                      <span> Dashboards </span>
                  </a>
              </li>
              <li class="side-nav-item background-buttons">
                  <a data-bs-toggle="collapse" href="#" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link hovering-pan ">
                      <i class="uil uil-comment-message"></i>
                      <span> Conversaciones </span>
                  </a>
              </li>
              <li class="side-nav-item background-buttons">
                <a data-bs-toggle="collapse" href="#" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link hovering-pan">
                    <i class="mdi mdi-whatsapp"></i>
                    <span> Saliente masivo </span>
                </a>
            </li>
              <li class="side-nav-item background-buttons">
                  <a data-bs-toggle="collapse" href="#" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link hovering-pan">
                      <i class="uil-ticket"></i>
                      <span> Tickets </span>
                  </a>
              </li>
              <li class="side-nav-item position-absolute fixed-bottom background-buttons">
                  <a data-bs-toggle="collapse" href="#" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link background-buttons">
                      <i class="uil-exit"></i>
                      <span> Cerrar sesión </span>
                  </a>    
              </li>
              

              </ul>
              <!--- End Sidemenu -->

              <div class="clearfix"></div>
          </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1195px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: visible;"><div class="simplebar-scrollbar" style="width: 32px; display: block; transform: translate3d(0px, 0px, 0px);"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div></div></div>
      </div>
      <!-- ========== Left Sidebar End ========== -->

      <!-- ============================================================== -->
      <!-- Start Page Content here -->
      <!-- ============================================================== -->

      <div class="content-page">
          <div class="content">

              <!-- Start Content-->
              <div class="container-fluid">
                 <div>
                 <iframe src="<?php echo $url;?>" sandbox="allow-forms allow-scripts allow-popups allow-same-origin allow-top-navigation" ></iframe>
                 </div>
              </div>
              <!-- container -->
          </div>
          <!-- content -->
      </div>

      <!-- ============================================================== -->
      <!-- End Page content -->
      <!-- ============================================================== -->

  </div>
  <!-- END wrapper -->

  <a href="https://api.whatsapp.com/send?phone=TUNUMERO&text=Hola,%20quiero%20información" target="_blank" class="whatsapp">
    <i class="mdi mdi-send" style="font-size: 25px;"></i>
  </a>
  <!-- Theme Settings -->
       
  
  <!-- Vendor js -->
  <script src="assetsfacu/js/vendor.min.js"></script>

  <!-- Daterangepicker js -->
  <script src="assetsfacu/vendor/daterangepicker/moment.min.js"></script>
  <script src="assetsfacu/vendor/daterangepicker/daterangepicker.js"></script>
  
  <!-- Apex Charts js -->
  <script src="assetsfacu/vendor/apexcharts/apexcharts.min.js"></script>

  <!-- Vector Map js -->
  <script src="assetsfacu/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="assetsfacu/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

  <!-- Dashboard App js -->
  <script src="assetsfacu/js/pages/demo.dashboard.js"></script>

  <!-- App js -->
  <script src="assetsfacu/js/app.min.js"></script>


<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M0 0 "></path></svg><div class="daterangepicker ltr single opensright"><div class="ranges"></div><div class="drp-calendar left single" style="display: block;"><div class="calendar-table"></div><div class="calendar-time" style="display: none;"></div></div><div class="drp-calendar right" style="display: none;"><div class="calendar-table"></div><div class="calendar-time" style="display: none;"></div></div><div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button> </div></div><div class="jvectormap-label"></div></body></html>