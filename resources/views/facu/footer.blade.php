


  <!-- Theme Settings -->


  <!-- Vendor js -->
  <script src="assetsfacu/js/vendor.min.js"></script>

  <link href="assetsfacu/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="assetsfacu/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

{{--    <script src="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css"></script>--}}
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css">



    <script src="assetsfacu/vendor/dropzone/min/dropzone.min.js"></script>
<!-- init js -->
<script src="assetsfacu/js/ui/component.fileupload.js"></script>




    <script type="text/javascript">
   new DataTable('#example', {
    "responsive": true,
    "order": [[0, 'desc']],


  "language" : {
    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
  },
  dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
}
)
    </script>

<script src="assetsfacu/vendor/daterangepicker/moment.min.js"></script>
<script src="assetsfacu/vendor/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
   new DataTable('#casadepapel', {
    "responsive": true,
    "order": [[0, 'asc']],


  "language" : {
    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
  },
  dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
}
)

$('input[name="daterange"]').daterangepicker({
 "locale": {
        "format": "MM/DD/YYYY",
        "separator": " - ",
        "applyLabel": "Buscar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Personalizado",
        "daysOfWeek": [
            "Dom",
            "Lun",
            "Mar",
            "Mier",
            "Jue",
            "Vie",
            "Sáb"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agusto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    }
})
    </script>
  <!-- Daterangepicker js -->


  <script src="assetsfacu/vendor/quill/quill.min.js?v=2"></script>
 <!-- quill Init js-->
 <script src="assetsfacu/js/pages/demo.quilljs.js?v=2"></script>
  <!-- Apex Charts js -->

  <!-- Vector Map js -->

  <!-- Dashboard App js -->

  <!-- App js -->
  <script src="assetsfacu/js/app.min.js"></script>

  <script src="flotante.js"></script>



<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M0 0 "></path></svg><div class="daterangepicker ltr single opensright"><div class="ranges"></div><div class="drp-calendar left single" style="display: block;"><div class="calendar-table"></div><div class="calendar-time" style="display: none;"></div></div><div class="drp-calendar right" style="display: none;"><div class="calendar-table"></div><div class="calendar-time" style="display: none;"></div></div><div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button> </div></div><div class="jvectormap-label"></div>


<style>

html[data-sidenav-size=full]:not([data-layout=topnav]) .leftside-menu {
    margin-left: 0 !important;
    border-color: inherit !important;
    opacity: 1 !important;
}

</style>

<script>
        function toggleMenu() {
            document.querySelector(".nav-links").classList.toggle("active");
        }
        function toggleSubmenu(event) {
            event.preventDefault(); // Evita la navegación del enlace
            let parentLi = event.target.parentElement;
            parentLi.classList.toggle("show");
        }
    </script>
</body>
</html>
