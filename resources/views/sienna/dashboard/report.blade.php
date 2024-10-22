@include('facu.header2')

<div class="wrapper menuitem-active">
    @include('facu.menu')

    <div class="content-page" style="padding: 0!important;">
        <div class="content">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
                    {!! session('success') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <script>
                function sal(tick, phone) {
                    document.getElementById("ticketid").value = tick;
                    document.getElementById("phone").value = phone;

                }
            </script>

            <!-- Page Wrapper -->
            <div class="container-fluid">
                <table id="report" class="table table-striped dt-responsive nowrap w-100 mt-2">
                    <thead class="table-dark">
                        <tr>
                            <th>Ticket</th>
                            <th>Nombre</th>
                            <th>Cliente</th>
                            <th>Teléfono</th>
                            <th>Asignado a</th>
                            <th>Departamento</th>
                            <th>Fuente</th>
                            <th>Estado</th>
                            <th>Tema</th>
                            <th>Creado</th>
                            <th>Cerrado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td> {{ $ticket->ticketid }} </td>
                                <td> {{ $ticket->nombre ?? 'Sin dato'}} </td>
                                <td> {{ $ticket->cliente ?? 'Sin dato' }} </td>
                                <td> {{ $ticket->callid ?? 'Sin dato' }} </td>
                                <td> {{ $ticket->asignado ?? 'Sin dato'}} </td>
                                <td> {{ $ticket->departamento ?? 'Sin dato'}} </td>
                                <td> {{ $ticket->fuente ?? 'Sin dato'}} </td>
                                <td> {{ $ticket->estado ?? 'Sin dato'}} </td>
                                <td> {{ $ticket->tema ?? 'Sin dato'}} </td>
                                <td> {{ $ticket->creado ?? 'Sin dato'}} </td>
                                <td> {{ $ticket->cerrado ?? 'Sin dato'}} </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot class="bg-secondary">
                        <tr>
                            <th>Ticket</th>
                            <th>Nombre</th>
                            <th>Cliente</th>
                            <th>Teléfono</th>
                            <th>Asignado a</th>
                            <th>Departamento</th>
                            <th>Fuente</th>
                            <th>Estado</th>
                            <th>Tema</th>
                            <th>Creado</th>
                            <th>Cerrado</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


@include('facu.footer')

<script>
    $('#report').dataTable({
        "order": [
            [0, 'desc']
        ],
        "pageLength": 25,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        initComplete: function() {
            this.api()
                .columns()
                .every(function() {
                    let column = this;
                    let title = column.footer().textContent;

                    // Create input element
                    let input = document.createElement("input");
                    input.placeholder = title;
                    input.className = "form-control";
                    column.footer().replaceChildren(input);

                    // Event listener for user input
                    input.addEventListener("keyup", () => {
                        if (column.search() !== this.value) {
                            column.search(input.value).draw();
                        }
                    });
                });
        }
    });
</script>
