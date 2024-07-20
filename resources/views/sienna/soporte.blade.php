@include('facu.header')
<div class="wrapper menuitem-active">
    @include('facu.menu')
    <style>
        .background-buttons :hover {
            background-color: #FFD193 !important;
            color: #3C4665 !important;
        }

        .newTicket {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            cursor: pointer;
            color: #7a7a7a;
            background-color: #FFD193;
            border-radius: 50%;
            text-align: center;
            width: 50px;
            height: 50px;
            line-height: 50px;
            font-size: 16px;
            box-shadow: 2px 2px 3px #999;
        }
    </style>
    <div class="content-page">

        <div class="container-fluid">
            <style>
                .conversation-list .odd .conversation-text {
                    float: right !important;
                    margin-right: 12px;
                    text-align: right;
                    width: 90% !important
                }

                .conversation-list .conversation-text {
                    float: left;
                    font-size: 13px;
                    margin-left: 12px;
                    width: 90%
                }
            </style>

            <h2>Ticket Soporte Suricata</h2>
            <table id="example" class="table dt-responsive nowrap w-100">
                <thead class="bg-dark">
                    <tr class="text-center">
                        <th class="text-light">#</th>
                        <th class="text-light">Motivo</th>
                        <th class="text-light">Descripcion</th>
                        <th class="text-light">Estado</th>
                        <th class="text-light">Fecha de creación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tsoporte as $val3) { ?>
                        <tr class="text-center">
                            <td><a href="{{ url('createticketsoportecliente?ticket=' . $val3->id) }}" target="_blank">{{$val3->id}}</a></td>
                            <td>{{$val3->nya}}</td>
                            <td>{{$val3->cliente}}</td>
                            <td>{{$val3->siennaestado}}</td>
                            <td>{{$val3->siennatopic}}</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <div class="newTicket" data-bs-toggle="modal" data-bs-target="#create-ticket">
            <i class="ri-chat-new-fill" style="font-size: 25px;"></i>
        </div>

    </div>
    @include('sienna.soporte.create-ticket-modal')
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-dark">
                <strong class="me-auto text-light">Ticket generado</strong>
                <small class="text-light">Ahora</small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Nuestro equipo recibido el caso y estaremos en contacto contigo a la brevedad.
            </div>
        </div>
    </div>
</div>
@include('facu.footer')



<script>
    const toastTrigger = document.getElementById('liveToastBtn')
    const toastLiveExample = document.getElementById('liveToast')

    if (toastTrigger) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastTrigger.addEventListener('click', () => {
            toastBootstrap.show()
            setTimeout(() => {
                toastBootstrap.hide()
                location.reload()
            }, 5000)
        })
    }
</script>