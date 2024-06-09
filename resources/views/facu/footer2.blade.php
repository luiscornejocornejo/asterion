


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
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css"></script>


    
    <script src="assetsfacu/vendor/dropzone/min/dropzone.min.js"></script>
<!-- init js -->
<script src="assetsfacu/js/ui/component.fileupload.js"></script>
    
    

    
    <script type="text/javascript">
   new DataTable('#example', {
    "responsive": true,

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
  <!-- Daterangepicker js -->
  <script src="assetsfacu/vendor/daterangepicker/moment.min.js"></script>
  <script src="assetsfacu/vendor/daterangepicker/daterangepicker.js"></script>


  <script src="assetsfacu/vendor/quill/quill.min.js"></script>
 <!-- quill Init js-->
 <script src="assetsfacu/js/pages/demo.quilljs.js"></script>
  <!-- Apex Charts js -->

  <!-- Vector Map js -->
 
  <!-- Dashboard App js -->

  <!-- App js -->
  <script src="assetsfacu/js/app.min.js"></script>

  <script src="flotante.js"></script>

  

<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M0 0 "></path></svg><div class="daterangepicker ltr single opensright"><div class="ranges"></div><div class="drp-calendar left single" style="display: block;"><div class="calendar-table"></div><div class="calendar-time" style="display: none;"></div></div><div class="drp-calendar right" style="display: none;"><div class="calendar-table"></div><div class="calendar-time" style="display: none;"></div></div><div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button> </div></div><div class="jvectormap-label"></div>

<script>
    $('#example').dataTable({
                    "order": [[0, 'desc']],
                    "responsive": !0,
                    "pageLength": 25,           
                    "language" : {
                                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                    },
                    dom: 'Bfrtip',
                    initComplete: function () {
                                    var api = this.api();
 
                                    api
                                        .columns()
                                        .eq(0)
                                        .each(function (colIdx) {
                                            // Set the header cell to contain the input element
                                            var cell = $('.filters th').eq(
                                                $(api.column(colIdx).header()).index()
                                            );
                                            var title = $(cell).text();
                                            $(cell).html('<input size="10" type="text" placeholder="' + title + '" />');
                        
                                            // On every keypress in this input
                                            $(
                                                'input',
                                                $('.filters th').eq($(api.column(colIdx).header()).index())
                                            )
                                                .off('keyup change')
                                                .on('change', function (e) {
                                                    // Get the search value
                                                    $(this).attr('title', $(this).val());
                                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();
                        
                                                    var cursorPosition = this.selectionStart;
                                                    // Search the column for that value
                                                    api
                                                        .column(colIdx)
                                                        .search(
                                                            this.value != ''
                                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                                : '',
                                                            this.value != '',
                                                            this.value == ''
                                                        )
                                                        .draw();
                                                })
                                                .on('keyup', function (e) {
                                                    e.stopPropagation();
                        
                                                    $(this).trigger('change');
                                                    $(this)
                                                        .focus()[0]
                                                        .setSelectionRange(cursorPosition, cursorPosition);
                                                });
                                        });
                    },

                    buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                }
            
            
            );

        $('#example thead tr')
          .clone(true)
          .addClass('filters')
          
        .appendTo('#example thead ');
        $('#example thead tr').width('800 px;');
          

</script>

</body>
</html>