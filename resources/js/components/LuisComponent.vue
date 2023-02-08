<template>

    <div class="col-xxl-3 col-xl-6 order-xl-1  ">
        <div class="card">
            <div class="card-body p-0">
                <div class="flex-grow-1">
                    <p class="text-muted mb-0">Bandeja de Tickets( {{ sise }})</p>
                </div>
                <select onchange="location = this.value;">
                    <option>estados</option>
                    <option value="/chat?id=75">
                        <h5 class="font-size-14 mb-3"><a href="/chat?id=75">Open</a></h5>
                    </option>
                    <option value="/chat?id=80">
                        <h5 class="font-size-14 mb-3"><a href="/chat?id=80">cerrados (hoy)</a></h5>
                    </option>
                    <option value="/chat?id=81">
                        <h5 class="font-size-14 mb-3"><a href="/chat?id=81">cerrados (ayer)</a></h5>
                    </option>


                </select>

                <ul class="nav nav-tabs nav-bordered">
                    <li class="nav-item">
                        <a href="#allUsers" data-bs-toggle="tab" aria-expanded="false" class="nav-link active py-2">
                            Todos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#favUsers" data-bs-toggle="tab" aria-expanded="true" class="nav-link py-2">
                            Mios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#friendUsers" data-bs-toggle="tab" aria-expanded="true" class="nav-link py-2">
                            Departamento
                        </a>
                    </li>
                </ul> <!-- end nav-->
                <div class="tab-content">
                    <div class="tab-pane show active card-body pb-0" id="newpost">

                        <!-- start search box -->
                        <div class="app-search">
                            <form>
                                <div class="mb-2 position-relative">
                                    <input type="text" class="form-control"
                                        placeholder="People, groups & messages..." />
                                    <span class="mdi mdi-magnify search-icon"></span>
                                </div>
                            </form>
                        </div>
                        <!-- end search box -->
                    </div>

                    <!-- users -->
                    <div class="row">
                        <div class="col">
                            <div class="card-body py-0 mb-3" data-simplebar style="max-height: 600px">


                                <section v-if="errored">
                                    <p>Lo sentimos, no es posible obtener la información en este momento, por favor
                                        intente nuevamente mas tarde</p>
                                </section>

                                <section v-else>
                                    <div v-if="loading">Cargando...</div>

                                    <div v-else v-for="currency in info " v-bind:style="bgc"
                                    v-on:click="pasar(currency.depto, currency.nombreusuario, currency.lastupdate, currency.ticket_id, currency.source, currency.creacion,currency.topic,currency.status_id,currency.priority_desc,currency.priority_color,currency.asignado)"
                                        class="currency shadow-sm p-2 mb-3 bg-white rounded "
                                        >

                                       
                                            <a href="javascript:void(0);" class="text-body">
                                                {{ currency.chat_status }}

                                                <div :style="{ 'background-color': currency.priority_color }" style="float: left;width: 10px;height: 80px;"
                                                  class="p-1"  ></div> 
                                                   
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-6 align-self-start"
                                                            style="display:inline-block;">
                                                            <h5 class="mt-0 mb-0 small" style="color:#727CF5;">
                                                                {{ currency.topic }}</h5>
                                                        </div>
                                                        <div class="col-6 align-self-end" style="display:inline-block;">
                                                            <span class="float-end text-muted small">{{
                                                                fecha(currency.creacion)
                                                            }} </span>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-6 align-self-start"
                                                            style="display:inline-block;">
                                                            <h5 class="mt-0 mb-0 small">{{ currency.nombreusuario }}
                                                            </h5>
                                                        </div>
                                                        <div class="col-6 align-self-end" style="display:inline-block;">
                                                            <span class="float-end text-muted small">Asignado</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 align-self-start"
                                                            style="display:inline-block;">


                                                            <h5 v-if="currency.source == 'Whatsapp'"> <svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-whatsapp" color="#25D366"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                                                </svg>{{ currency.number }}</h5>
                                                            <h5 v-if="currency.source == 'API'"> <svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                                                </svg>{{ currency.number }}</h5>

                                                        </div>
                                                        <div class="col-6 align-self-end" style="display:inline-block;">
                                                            <span class="float-end text-muted font-12">{{
                                                                currency.asignado
                                                            }}</span>
                                                        </div>
                                                    </div>
                                                </div>


                                            </a>
                                        
                                    </div>

                                </section>



                            </div> <!-- end slimscroll-->
                        </div> <!-- End col -->
                    </div> <!-- end users -->
                </div> <!-- end tab content-->
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>


    <div class="col-xxl-6 col-xl-12 order-xl-2 ">
        <div class="card">
            <div class="card-body">
                <div class="row bg-primary text-white m-0 p-2">
                    <div class="col-6 align-self-start" style="display:inline-block;">
                        <span class="float-start text-white small">{{ nombreusuario }}   </span>
                    </div>
                  
                    <div class="col-6 align-self-end" style="display:inline-block;">
                        <span class="float-end text-white small">{{ prioridad }}   Ticket:{{ ticket_id }}</span>
                    </div>
                </div>

                <div class="row  m-0 p-2">
                    <div class="col-6 align-self-start" style="display:inline-block;">
                        <button type="button" class="btn btn-info btn-block w-100" data-bs-toggle="modal"
                            data-bs-target="#standard-modal3">{{ topic }}</button>
                    </div>
                    <div class="col-6 align-self-end" style="display:inline-block;">
                        <button type="button" class="btn btn-success w-100" data-bs-toggle="modal"
                            data-bs-target="#standard-modal">
                            <spam id="estado">{{ ticketestatus }}</spam>
                        </button>

                    </div>
                </div>

                <div class="row  p-2">
                    <div class="col-6 align-self-start small" style="display:inline-block;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Fuente {{ source }}</li>
                            <li class="list-group-item">Fecha de creacion: {{ creacion }} </li>
                            <li class="list-group-item">Fecha de ultima Modificacion: {{ lastupdate }}</li>
                        </ul>
                    </div>
                    <div class="col-6 align-self-end" style="display:inline-block;">
                        <button type="button" class="btn btn-success w-100 p-2 btn-block" data-bs-toggle="modal"
                            data-bs-target="#standard-modal2">{{ depto }}</button>
                        <spam id="departamento"></spam>
                        <br><br><br>
                        <button type="button" class="btn btn-success w-100 p-2 btn-block" data-bs-toggle="modal"
                            data-bs-target="#standard-modal4">{{ asignado }}</button>
                        
                    </div>
                  
                </div>

                <div class="p-2">
                    <div v-if="source == 'API'">API</div>
                    <div v-if="source == 'Email'">
                        <div v-for="ext in extra" class="currency">
                            <span v-html="ext.body"></span>
                        </div>
                    </div>
                    <div v-if="source == 'Google Business '">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Teams'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>

                    <div v-if="source == 'Slack'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Discord'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Web'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'RCS'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'SMS'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Instagram'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Facebook'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>

                    <div v-if="source == 'Telegram'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>
                    <div v-if="source == 'Whatsapp'">
                        <div v-for="ext in whapp" style="max-height: 446px">
                            <iframe class="w-100" max-height="200px" width="600 px" height="400 px" frameborder='0' allowfullscreen
                                v-bind:src="ext.chat_link"></iframe>
                        </div>
                    </div>

                    <div v-else v-for="ext in extra" class="currency">

                        <span v-html="ext.body"></span>
                    </div>


                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card-->


    </div>


    <div class="col-xxl-3 col-xl-6 order-xl-1 order-xxl-2">

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header bg-primary text-white" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Bitacora
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="card-body py-0 mb-3" data-simplebar="init" style="max-height: 403px;">
                        <div class="simplebar-wrapper" style="margin: 0px -24px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                        aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                        <div class="simplebar-content" style="padding: 0px 24px;">
                                            <div class="timeline-alt py-0">
                                      
                                                <div v-for="extrah in historial" class="timeline-item extrahistorial2">
                                                    <i
                                                        class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>{{
                                                            extrah.name
                                                        }}
                                                    <div class="timeline-item-info">
                                                        <a href="javascript:void(0);"
                                                            class="text-info fw-bold mb-1 d-block">{{
                                                                extrah.username
                                                            }}</a>
                                                        <small>{{ extrah.data }}</small>
                                                        <p class="mb-0 pb-2">
                                                            <small class="text-muted">{{ extrah.timestamp }}</small>
                                                        </p>
                                                    </div>
                                                </div>


                                            </div>
                                            <!-- end timeline -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: auto; height: 579px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                            <div class="simplebar-scrollbar"
                                style="height: 280px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                        </div>
                    </div>
                    <form action="/chatcreate" method="post" class="needs-validation" novalidate="" name="chat-form"
                        id="chat-form">


                        <div class="row">
                            <div class="col mb-2 mb-sm-0">
                                <input type="hidden" name="idtickethistorial" id="idtickethistorial" value="">
                                <input name="notainterna" type="text" class="form-control border-0"
                                    placeholder="Enter your text" required="">
                                <div class="invalid-feedback">
                                    Please enter your messsage
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="btn-group">

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success chat-send"><i
                                                class='uil uil-message'></i></button>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </form>
                </div>

            </div>
            <div class="accordion-item">
                <h2 class="accordion-header  bg-primary text-white" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Cliente
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">

                        <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                            data-bs-target="#compose-modal">
                            <spam id="estado">Enviar Email</spam>:
                        </button><br>
                        <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                            data-bs-target="#standard-modal">
                            <spam id="estado">Llamar</spam>:
                        </button><br>
                        <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                            data-bs-target="#standard-modal">
                            <spam id="estado">Enviar Whatsapp</spam>:
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <div class="card">





        </div> <!-- end card -->
    </div>


    <div id="standard-modal3" class="modal fade bs-example-modal-center3" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cambiar Topics</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/chatcambiartopic" method="post">
                                    <input type="hidden" name="_token" v-bind:value="csrf">
                                    <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic" >
                                    <div  v-for="topic in topics " >
                                    
                                         <input :value="topic.topic_id" v-model="topic.topic_id" class="form-radio" type="radio" name="statos" >{{ topic.topic }}
                                    </div>
                                    
                                        
                                                          
                                    <button type="submit" class="btn btn-success
                                waves-effect waves-light">Cambiar</button>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>


                <div id="standard-modal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cambiar status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/chatcambiarestado" method="post">
                                    <input type="hidden" name="_token" v-bind:value="csrf">
                                    <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic" >
                                    <div  v-for="department in departments " >
                                    
                                         <input :value="department.id" v-model="department.id" class="form-radio" type="radio" name="statos" >{{ department.name }}
                                    </div>
                                                                    <button type="submit" class="btn btn-success
                                waves-effect waves-light">Cambiar</button>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                <div id="standard-modal2" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cambiar Depto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/chatcambiarestado" method="post">
                                    <input type="hidden" name="_token" v-bind:value="csrf">
                                    <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic" >
                                    <div  v-for="department in departments " >
                                    
                                         <input :value="department.id" v-model="department.id" class="form-radio" type="radio" name="statos" >{{ department.name }}
                                    </div>
                                                                    <button type="submit" class="btn btn-success
                                waves-effect waves-light">Cambiar</button>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>

                <div id="standard-modal4" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Asignar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/chatcambiarestado" method="post">
                                    <input type="hidden" name="_token" v-bind:value="csrf">
                                    <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic" >
                                    <div  v-for="department in departments " >
                                    
                                         <input :value="department.id" v-model="department.id" class="form-radio" type="radio" name="statos" >{{ department.name }}
                                    </div>
                                                                    <button type="submit" class="btn btn-success
                                waves-effect waves-light">Cambiar</button>

                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
</template>
<style>
.row {
    width: auto;
}

.red {
    background-color: red !important;
}
</style>
<script>



export default {
    props: ['currency'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            active: false,
            info: null,
            topics:null,
            departments:null,

            loading: true,
            errored: false,
            timer: '',
            sise: null,
            depto: null,
            topic: null,
            prioridad:null,
            colorestado:null,
            asignado:null,
            ticketestatus:null,
            lastupdate: null,
            creacion: null,
            nombreusuario: null,
            ticket_id: null,
            extra: null,
            whapp: null,
            datoooo: null,
            source: null,
            tipo: null,
            historial: null,
            historialllll: null,
            logo: null,
            creacion: null,
            datowhatapp: null,
            tiempo2: null,
            a: null,
            loaded: false,
            iframe: {
                src: window.location.href,
                style: null,
                wrapperStyle: null,
            }

        }
    },
    computed: {
        hora(dato) {

        },
    },
    mounted() {
        this.timer = setInterval(this.fetchEventsList, 60000),

            axios
                .get('/api/datostickets')
                .then(response => (this.info = response.data, this.sise = response.data.length))
                .catch(error => console.log(error))


            ,

            axios
                .get('/api/topics')
                .then(response => (this.topics = response.data))
                .catch(error => console.log(error))


            ,
            axios
                .get('/api/departments')
                .then(response => (this.departments = response.data))
                .catch(error => console.log(error))


            ,
            
            console.log('Component mounted.')
        this.loading = false
    },

    methods: {

        fecha(dato) {
            // 
            var b = dato.split(' ');
            var date = b[0].split('-');
            var time = b[1].split(':');

            const mont = date[1];
            date[1] = parseInt(date[1]) - 1;

            let a = new Date(); // fecha actual.
            let fechactual = new Date(date[0], date[1], date[2], time[0], time[1], time[2]); // fecha input

            var diff = (a - fechactual); // Diff en ms

            const days = Math.round(diff / (1000 * 60 * 60 * 24));
            const hours = Math.round(diff / (1000 * 60 * 60));
            const minutes = Math.round(diff / (1000 * 60));
            console.log('diferencia de dias ' + days);

            var out = 'Hace un tiempo';
            if (days < 1) {
                dato = time[0] + ":" + time[1];
            }
            if (days >= 1) {
                if (days < 2) {
                    dato = "ayer";
                }
            }
            if (days > 2) {
                dato = dato.substring(0, 10);
            }
            return dato;
        },
        fetchEventsList() {
            axios
                .get('/api/datostickets')
                .then(response => (this.info = response.data, this.sise = response.data.length))
                .catch(error => console.log(error))
            console.log('reinicio.')

        },

        extrasmail(id) {
            axios
                .get('/api/extrasmail/' + id)
                .then(response => (this.extra = response.data))
                .catch(error => console.log(error))
            console.log('extrasmail.')

        },
        extraswhatapp(id) {
            console.log(id);

            axios
                .get('/api/extraswhatapp/' + id)
                .then(response => (this.whapp = response.data))
                .catch(error => console.log(error))
            console.log("carga")

        },
        extrahistorial(id) {
            axios
                .get('/api/extrahistorial/' + id)
                .then(response => (this.historial = response.data))
                .catch(error => console.log(error))
            console.log('extrahistorial.')

        },
        pasar: function (a, b, c, d, e, f,g,h,i,j,k) {
            this.active = !this.active;
            this.ticket_id = d;
            console.log(this.ticket_id)
            this.topic=g;
            this.depto = a;
            this.prioridad=i;
            this.ticketestatus=h;
            this.colorestado=j;
            this.asignado=k;
            console.log(this.ans)
            this.lastupdate = c;
            this.creacion = f;
            this.nombreusuario = b;
            
            this.source = e;
            this.historialllll = this.extrahistorial(d);
            console.log('extrahistorial.')

            console.log(this.historial)

            if (e == "Email") {
                this.datoooo = this.extrasmail(d);
                this.tipo = false;
                this.logo = '<i class="ri-whatsapp-fill"></i> ';
            }
            if (e == "Whatsapp") {
                this.datowhatapp = null;
                this.datowhatapp = this.extraswhatapp(d);
                console.log('paso1.')

                console.log(this.whapp);


            }


        }

    }



}

</script>

