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
                            <div class="card-body py-0 mb-3" data-simplebar style="max-height: 346px">


                                <section v-if="errored">
                                    <p>Lo sentimos, no es posible obtener la información en este momento, por favor
                                        intente nuevamente mas tarde</p>
                                </section>

                                <section v-else>
                                    <div v-if="loading">Cargando...</div>
 
                                    <div v-else v-for="currency in info" class="currency shadow-sm p-3 mb-3 bg-white rounded"  v-on:click="pasar(currency.depto, currency.nombreusuario, currency.lastupdate, currency.ticket_id, currency.source)">

                                     
                                        <a href="javascript:void(0);" class="text-body">
                                            {{currency.chat_status}}
                                            
                                                <div style="float: left;width: 5px;height: 100px;background: white;"
                                                    id="{{ currency.ticket_id  }}"></div>

                                                    <div class="container" >
                                                        <div class="row">
                                                            <div class="col-6 align-self-start" style="display:inline-block;"><h5 class="mt-0 mb-0 small" style="color:#727CF5;">{{ currency.topic }}</h5></div>
                                                            <div class="col-6 align-self-end" style="display:inline-block;"><span class="float-end text-muted small" v-if="hora(currency.lastupdate)">{{ tiempo2 }}</span></div>
                                                        </div>
                                                    
                                                    
                                                        <div class="row">
                                                            <div class="col-6 align-self-start" style="display:inline-block;"> <h5 class="mt-0 mb-0 small">{{ currency.nombreusuario }}</h5></div>
                                                            <div class="col-6 align-self-end" style="display:inline-block;"><span class="float-end text-muted small">Asignado</span></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6 align-self-start" style="display:inline-block;"> 
                                                                
                                                                
                                                                <h5 v-if="currency.source=='Whatsapp'"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" color="#25D366" viewBox="0 0 16 16">
                                                                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                                                          </svg>{{ currency.number }}</h5>
                                                                <h5 v-if="currency.source=='API'">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                                                          </svg>{{ currency.number }}</h5>       
                                                                        
                                                                        </div>
                                                            <div class="col-6 align-self-end" style="display:inline-block;"><span class="float-end text-muted font-12">{{currency.number }}</span></div>
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
                    <div class="p-3 mb-2 bg-primary text-white">{{ nombreusuario }}       Tikect: {{ticket_id}}</div>

                </div>

                <div class="mt-3 text-center">
                    <h4 id="nombre">  </h4>
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

                    <div v-if="tipo" v-for="ext2 in whapp" style="max-height: 346px">
                        {{ ext2.chat_link }}
                       
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
<style>

.row {
width: auto;
}
</style>
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
            logo: null,
            datowhatapp:null,
            tiempo2: null,
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
        hora(tiempo){
            this.tiempo2 = tiempo.substring(0, 10);
            console.log(tiempo)
            console.log(this.tiempo2)
            return true;
        },
        extrasmail(id) {
            axios
                .get('/api/extrasmail/' + id)
                .then(response => (this.extra = response.data))
                .catch(error => console.log(error))
            console.log('extrasmail.')

        },
        extraswhatapp(id) {
            console.log(id) ;
            this.whapp=null;
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
        pasar: function (a, b, c, d, e) {
            this.ans = a;
            this.lastupdate = c;
            this.nombreusuario = b;
            this.ticket_id = d;
            this.source=e;
           
            if (e == "Email") {
                this.datoooo = this.extrasmail(d);
                this.tipo = false;
                this.logo = '<i class="ri-whatsapp-fill"></i> ';
            } 
            if(e == "Whatsapp") {
                this.datowhatapp= null;
                this.datowhatapp= this.extraswhatapp(d);
                console.log(this.datowhatapp);

                if(this.datowhatapp === null){
              
                    console.log(this.datowhatapp);
                }else{
                    console.log("not null")

                    console.log(this.datowhatapp);

                    this.tipo = true;
                this.logo = '<i class="ri-whatsapp-fill"></i> ';
                this.whapp='<iframe width="600 px" height="346px" frameborder="0" allowfullscreen src='+this.datowhatapp.chat_link +'></iframe>';

                }

              
          
            }
            this.historialllll=this.extrahistorial(d);
        }

    },



}

</script>

