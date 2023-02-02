

  <link rel="stylesheet" href="https://siennasystem.com/assets/css/preloader.min.css" type="text/css" />

<!-- Bootstrap Css -->
<link href="https://siennasystem.com/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="https://siennasystem.com/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="https://siennasystem.com/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

<!-- Custom Css -->
<link href="https://siennasystem.com/assets/css/custom.css" rel="stylesheet" type="text/css" />

<link href="https://siennasystem.com/assets/css/main.css" rel="stylesheet" type="text/css" />


<div class="table-responsive">

    <table role="table" id="datatable" class="table table-bordered dt-responsive nowrap w-100">
        <thead role="rowgroup" class="table-dark">
            <tr role="row">

                @foreach($cabezeras as $cabeza)
                <?php if ($cabeza <> "id") { ?>

                    <th role="columnheader">{{ $cabeza }}</th>
                <?php  } ?>

                @endforeach

            </tr>
        </thead>
        <tbody role="rowgroup">
            @foreach($fields2 as $resultado)


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