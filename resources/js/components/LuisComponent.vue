<template>

    <div class="col-xxl-3 col-xl-6 order-xl-1">
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
                            <div class="card-body py-0 mb-3" data-simplebar style="max-height: 546px">


                                <section v-if="errored">
                                    <p>Lo sentimos, no es posible obtener la información en este momento, por favor
                                        intente nuevamente mas tarde</p>
                                </section>

                                <section v-else>
                                    <div v-if="loading">Cargando...</div>

                                    <div v-else v-for="currency in info" class="currency">

                                        <a href="javascript:void(0);" class="text-body">
                                            {{currency.chat_status}}
                                            <div v-on:click="pasar(currency.depto, currency.nombreusuario, currency.lastupdate, currency.ticket_id, currency.source)"
                                                class="d-flex align-items-start mt-1 p-2">
                                                <div style="float: left;width: 10px;height: 100px;background: white;"
                                                    id="{{ currency.ticket_id  }}"></div>

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col1"><h5 class="mt-0 mb-0 font-14" style="color:#727CF5;">{{ currency.topic }}</h5></div>
                                                            <div class="col2"><span class="float-end text-muted font-12">{{currency.lastupdate }}</span></div>
                                                        </div>
                                                    </div>
                                                <div class="w-100 overflow-hidden">
                                                    
                                                <br>
                                                <br>

                                                    <h5>{{ currency.nombreusuario }}</h5>
                                                    
                                                    <p class="mt-1 mb-0 text-muted font-14">
                                                        <span class="w-25 float-end text-end">
                                                            <span class="badge badge-danger-lighten">{{ currency.number
                                                            }}</span>
                                                            <span class="w-75"></span>
                                                        </span>
                                                    </p>
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
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">View full</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Edit Contact Info</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Remove</a>
                    </div>
                </div>

                <div class="mt-3 text-center">
                    <h4 id="nombre"> {{ nombreusuario }} </h4>
                    <p class="text-muted mt-2 font-14">Last Interacted: <strong>{{ lastupdate }}</strong></p>
                </div>

                <div class="mt-3">
                    <hr class="" />
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#standard-modal3">Motivo:</button>
                    <spam id="motivo">{{ ans }}</spam><br><br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#standard-modal">Estado:</button>
                    <spam id="estado"></spam><br><br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#standard-modal2">Depto:</button>
                    <spam id="departamento"></spam><br><br>


                    <p class="mt-3 mb-1"><strong><i class='uil uil-globe'></i> Fuente:<spam id="source">{{ source }} 
                            </spam></strong></p>

                    <div v-if="tipo" v-for="ext2 in whapp">
                        <iframe width="600 px" height="800 px" frameborder='0' allowfullscreen src='{{ ext2.chat_link }}'></iframe>

                    </div>
                    <div v-else v-for="ext in extra" class="currency">
                        
                        <span v-html="ext.body"></span>
                    </div>


                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card-->

        <div id='status22'>


        </div>
    </div>


    <div class="col-xxl-3 col-xl-6 order-xl-1 order-xxl-2">
                    <div class="card">


                        
                        <div class="card-body px-0 pb-0">
                            <ul class="conversation-list px-3" data-simplebar style="max-height: 554px" id="historial">

                                <div  v-for="extrah in historial" class="extrahistorial2">


<li class="clearfix">
      <div class="chat-avatar">
         
          <p class="fs-6">{{ extrah.username}}</p>
      </div>
      <div class="conversation-text">
          <div class="ctext-wrap">
            <i>{{ extrah.name}}</i>
              <i>{{ extrah.data}}</i>
              <p>{{ extrah.timestamp}}</p>
          </div>
      </div>
  
  </li>
                                </div>
                            </ul>
                        </div> <!-- end card-body -->
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col">
                                    <div class="mt-2 bg-light p-3">
                                        <form action="/chatcreate" method="post" class="needs-validation" novalidate="" name="chat-form" id="chat-form">
                                            @csrf

                                            <div class="row">
                                                <div class="col mb-2 mb-sm-0">
                                                    <input type="hidden" name="idtickethistorial" id="idtickethistorial" value="">
                                                    <input name="notainterna" type="text" class="form-control border-0" placeholder="Enter your text" required="">
                                                    <div class="invalid-feedback">
                                                        Please enter your messsage
                                                    </div>
                                                </div>
                                                <div class="col-sm-auto">
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-light"><i class="uil uil-paperclip"></i></a>
                                                        <a href="#" class="btn btn-light"> <i class='uil uil-smile'></i> </a>
                                                        <div class="d-grid">
                                                            <button type="submit" class="btn btn-success chat-send"><i class='uil uil-message'></i></button>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row-->
                                        </form>
                                    </div>
                                </div> <!-- end col-->
                            </div>
                            <!-- end row -->
                        </div>
                    </div> <!-- end card -->
                </div>
</template>

<script>



export default {
    data() {
        return {
            info: null,
            loading: true,
            errored: false,
            timer: '',
            sise: null,
            ans: null,
            lastupdate: null,
            nombreusuario: null,
            ticket_id: null,
            extra: null,
            whapp: null,
            datoooo: null,
            source: null,
            tipo: null,
            historial:null,
            historialllll:null,
        }
    },
    mounted() {
        this.timer = setInterval(this.fetchEventsList, 60000),

            axios
                .get('/api/datostickets')
                .then(response => (this.info = response.data, this.sise = response.data.length))
                .catch(error => console.log(error))


            ,
            console.log('Component mounted.')
        this.loading = false
    },
    methods: {
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
            axios
                .get('/api/extraswhatapp/' + id)
                .then(response => (this.whapp = response.data))
                .catch(error => console.log(error))
                console.log("carga")

            console.log(this.whapp) 

        },
        extrahistorial(id) {
            axios
                .get('/api/extrahistorial/' + id)
                .then(response => (this.historial = response.data))
                .catch(error => console.log(error))
            console.log('extrahistorial.')

        },
        pasar: function (a, b, c, d, e) {
            this.ans = a;
            this.lastupdate = c;
            this.nombreusuario = b;
            this.ticket_id = d;
            this.source=e;
            if (e == "Email") {
                this.datoooo = this.extrasmail(d);
                this.tipo = false;
            } else {
                this.datoooo = this.extraswhatapp(d);
                this.tipo = true;

            }
            this.historialllll=this.extrahistorial(d);
        }

    },



}

</script>

