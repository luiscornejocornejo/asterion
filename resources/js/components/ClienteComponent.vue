<template>

<div>hola</div>
   


     

   
</template>
<style>
.row {
    width: auto;
}

.red {
    background-color: rgb(254,243,211)!important;
}
</style>
<script>

import { GoogleMap, Marker } from "vue3-google-map";

export default {
   
    components: { GoogleMap, Marker },
    setup() {
        const center = { lat:-34.58845756270908 , lng: -58.44093554428371 };

        return { center };
    },
    props: ['currency'],
    data() {
        return {

           
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            user: document.querySelector('meta[name="user"]').getAttribute('content'),
            colordeprueba:'#624ec6',
            active: false,
            info: null,
            topics: null,
            departments: null,
            ost_ticket_status: null,
            staffs: null,
            clickeo: false,
            loading: true,
            errored: false,
            timer: '',
            sise: null,
            depto: null,
            topic: null,
            extrauser: null,
            extrauserf: null,
            myMap: null,
            laprio:null,

            prioridad: null,
            colorestado: null,
            asignado: null,
            ticketestatus: null,
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
            url1: null,
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
        this.url1 = '/api/datostickets2/' + this.user,
            this.timer = setInterval(this.fetchEventsList, 60000),

            axios
                .get(this.url1)
                .then(response => (this.info = response.data, this.sise = response.data.length))
                .catch(error => console.log(error))
            ,

            axios
                .get('/api/topics2')
                .then(response => (this.topics = response.data))
                .catch(error => console.log(error))
            ,
            axios
                .get('/api/departments2')
                .then(response => (this.departments = response.data))
                .catch(error => console.log(error))
            ,
            axios
                .get('/api/ost_ticket_status2')
                .then(response => (this.ost_ticket_status = response.data))
                .catch(error => console.log(error))
            ,
            axios
                .get('/api/staff2')
                .then(response => (this.staffs = response.data))
                .catch(error => console.log(error))
            ,


            this.loading = false;
        console.log('Component mounted.');
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
            this.url1 = '/api/datostickets2/' + this.user,
                axios
                    .get(this.url1)
                    .then(response => (this.info = response.data, this.sise = response.data.length))
                    .catch(error => console.log(error))
            console.log('reinicio.')

        },

        extrasmail(id) {
            axios
                .get('/api/extrasmail2/' + id)
                .then(response => (this.extra = response.data))
                .catch(error => console.log(error))
            console.log('extrasmail.')

        },
        extrasuserf(userid) {

            axios
                .get('/api/extrasuser2/' + userid)
                .then(response => (this.extrauser = response.data))
                .catch(error => console.log(error))
            console.log('extrasmail.')
        },
        extraswhatapp(id) {
            console.log(id);

            axios
                .get('/api/extraswhatapp2/' + id)
                .then(response => (this.whapp = response.data))
                .catch(error => console.log(error))
            console.log("carga")

        },
        extrahistorial(id) {
            axios
                .get('/api/extrahistorial2/' + id)
                .then(response => (this.historial = response.data))
                .catch(error => console.log(error))
            console.log('extrahistorial.')

        },
        myMap: function () {
            var mapProp = {
                center: new google.maps.LatLng(51.508742, -0.120850),
                zoom: 5,
            }
        },
        pasar: function (a, b, c, d, e, f, g, h, i, j, k, l,m) {
            this.clickeo = true;
            this.active = !this.active;
            this.ticket_id = d;
            this.laprio=m,
            console.log(this.ticket_id)
            this.topic = g;
            this.depto = a;
            this.prioridad = i;
            this.ticketestatus = h;
            this.colorestado = j;
            this.asignado = k;
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

            this.datowhatapp = null;
            this.datowhatapp = this.extraswhatapp(d);
            console.log('paso1.')

            console.log(this.whapp);



            this.datoooo2 = this.extrasuserf(l);


        }

    }



}

</script>

