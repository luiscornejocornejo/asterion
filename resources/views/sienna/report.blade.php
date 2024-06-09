@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
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
 
            // For each column
          
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
          });

          $('#example thead tr')
          .clone(true)
          .addClass('filters')
          
        .appendTo('#example thead ');
        $('#example thead tr').width('800 px;');
          

</script>
    <div class="content-page" style="padding: 0!important;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"><?php echo $nombrereporte;?> </h1>
                    <?php 
                    if($idreport==118){
                        if(sizeof($resultados)>0){
?>
<a href="/crontab">procesar</a>
<?php
                    }}
                    ?>
                </div>

                <div class="table-responsive">


                    <table role="table" id="example" class="table table-bordered dt-responsive nowrap w-100">
                        <thead role="rowgroup" class="table-success">
                            <tr role="row">

                                @foreach($cabezeras as $cabeza)
                                <?php if ($cabeza <> "id") { ?>

                                    <th role="columnheader">{{ $cabeza }}</th>
                                <?php  } ?>

                                @endforeach
                               

                            </tr>
                        </thead>
                        <tbody role="rowgroup">
                            @foreach($resultados as $resultado)


                            <tr role="row">
                                @foreach($cabezeras as $cabeza)
                                <?php if ($cabeza <> "id") { ?>
                                    <td role="cell">
                                        {!! $resultado->$cabeza !!}
                                    </td>

                                <?php  } ?>
                                @endforeach
                             

                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
<br><br><br>
@include('facu.footer')