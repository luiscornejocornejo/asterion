<html  lang="en" data-bs-theme="light" data-layout-mode="fluid" data-menu-color="dark" data-topbar-color="light" data-layout-position="fixed" data-sidenav-size="condensed" class="menuitem-active"><head>
  <meta charset="utf-8">
  <title>Suricata Cx</title>

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
  <!-- App css -->
  <link href="assetsfacu/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style">
        <link href="assetsfacu/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assetsfacu/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assetsfacu/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assetsfacu/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assetsfacu/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assetsfacu/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />

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
</head>
<body class="show">
