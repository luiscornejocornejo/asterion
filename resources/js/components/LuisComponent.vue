<template>

    <div class="col-xxl-3 col-xl-6 order-xl-1  ">
        <div class="card">
            <div class="card-body p-2">
                <div class="flex-grow-1 p-4">
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
                                        v-on:click="pasar(currency.depto, currency.nombreusuario, currency.lastupdate, currency.ticket_id, currency.source, currency.creacion, currency.topic, currency.status_id, currency.priority_desc, currency.priority_color, currency.asignado)"
                                        class="currency shadow-sm p-2 mb-3 bg-white rounded ">


                                        <a href="javascript:void(0);" class="text-body">
                                            {{ currency.chat_status }}

                                            <div :style="{ 'background-color': currency.priority_color }"
                                                style="float: left;width: 10px;height: 80px;" class="p-1"></div>

                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-6 align-self-start" style="display:inline-block;">
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
                                                    <div class="col-6 align-self-start" style="display:inline-block;">
                                                        <h5 class="mt-0 mb-0 small">{{ currency.nombreusuario }}
                                                        </h5>
                                                    </div>
                                                    <div class="col-6 align-self-end" style="display:inline-block;">
                                                        <span class="float-end text-muted small">Asignado</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 align-self-start" style="display:inline-block;">


                                                        <h5 v-if="currency.source == 'Whatsapp'"> <svg
                                                                xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-whatsapp"
                                                                color="#25D366" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                                            </svg>{{ currency.number }}</h5>
                                                        <h5 v-if="currency.source == 'API'"><svg fill="#000000"
                                                                height="16px" width="16px" version="1.1" id="Layer_1"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                viewBox="0 0 301.416 301.416" xml:space="preserve">
                                                                <g>
                                                                    <g>
                                                                        <path d="M272.013,239.992C344.29,141.941,275.356,1.036,151.905,0.059c-0.005,0-0.009-0.001-0.014-0.001
			c-0.013,0-0.027,0-0.039-0.001c-0.019,0-0.039-0.001-0.057-0.001c-0.014,0-0.029,0-0.043,0c-0.756-0.019-1.522-0.019-2.196,0
			c-0.007,0-0.013,0-0.02,0c-0.009,0-0.018,0.001-0.026,0.001c-0.007,0-0.015,0-0.022,0c-0.003,0-0.005,0-0.008,0
			C65.826,0.691,0,68.785,0,150.71c0,83.201,67.451,150.664,150.664,150.664c26.765,0,53.515-7.072,77.353-21.367l19.125,19.126
			c2.981,2.978,7.826,2.993,10.819-0.001l31.181-31.192c2.988-2.989,2.987-7.832,0-10.818L272.013,239.992z M104.596,23.536
			C92.138,37.607,81.843,57.499,74.897,81.86H34.13C50.241,54.704,75.415,34.187,104.596,23.536z M26.319,97.16h44.787
			c-3.109,14.681-4.897,30.054-5.331,45.9H15.51C16.385,127.124,20.014,111.736,26.319,97.16z M15.51,158.36h50.266
			c0.433,15.847,2.222,31.22,5.331,45.9H26.319C20.014,189.686,16.385,174.298,15.51,158.36z M34.13,219.56h40.766
			c6.946,24.359,17.239,44.25,29.69,58.32C75.411,267.229,50.242,246.713,34.13,219.56z M143.014,285.21
			c-21.34-4.782-40.88-29.327-52.151-65.65h52.151V285.21z M143.014,204.26H86.782c-3.32-14.596-5.241-29.977-5.703-45.9h61.935
			C143.014,181.499,143.014,193.693,143.014,204.26z M143.014,143.06H81.079c0.461-15.923,2.382-31.303,5.702-45.9h56.234V143.06z
			 M143.014,81.859H90.864c11.264-36.302,30.791-60.842,52.151-65.644V81.859z M275.008,204.26h-7.578l6.595-6.595
			c4.162-4.164,2.247-11.279-3.43-12.799l-36.048-9.66c0.505-5.544,0.847-11.17,1.004-16.845h50.267
			C284.943,174.295,281.315,189.682,275.008,204.26z M285.818,143.06h-50.265c-0.433-15.847-2.223-31.22-5.331-45.9h44.786
			C281.314,111.734,284.943,127.123,285.818,143.06z M267.198,81.86h-40.766c-6.946-24.359-17.239-44.25-29.69-58.32
			C225.919,34.19,251.089,54.707,267.198,81.86z M158.314,16.209c21.34,4.782,40.88,29.327,52.151,65.65h-52.151V16.209z
			 M158.314,97.16h56.233c3.32,14.595,5.242,29.976,5.703,45.9h-61.935V97.16z M220.235,158.36
			c-0.126,4.311-0.348,8.596-0.686,12.826l-47.859-12.826H220.235z M158.314,285.204V219.56h0.217l15.616,58.28
			C169.022,281.506,163.702,283.986,158.314,285.204z M196.436,278.124c3.309-3.699,6.472-7.813,9.465-12.325l3.955-3.955
			l6.979,6.979C210.286,272.501,203.462,275.602,196.436,278.124z M252.551,282.904l-37.286-37.287
			c-2.986-2.986-7.83-2.989-10.819-0.001c-10.898,10.898-8.04,8.04-18.211,18.212l-24.751-92.363
			c38.489,10.316,81.823,21.928,92.354,24.75l-18.211,18.209c-2.988,2.989-2.988,7.832,0,10.819l37.289,37.289L252.551,282.904z
			 M267.228,219.56c-1.92,3.245-3.972,6.412-6.159,9.488l-9.213-9.213l0.274-0.275H267.228z" />
                                                                    </g>
                                                                </g>
                                                            </svg>{{ currency.number }}</h5>

                                                        <h5 v-if="currency.source == 'SMS'">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 100 100" width="16px" height="16px">
                                                                <path
                                                                    d="M 30.960938 17.960938 C 23.792938 17.960938 17.960938 23.792938 17.960938 30.960938 L 17.960938 69.960938 C 17.960938 77.128938 23.792938 82.960938 30.960938 82.960938 L 69.960938 82.960938 C 77.128938 82.960938 82.960938 77.128938 82.960938 69.960938 L 82.960938 30.960938 C 82.960938 23.791938 77.128938 17.960938 69.960938 17.960938 L 30.960938 17.960938 z M 30.960938 19.960938 L 69.960938 19.960938 C 76.025937 19.960938 80.960938 24.895937 80.960938 30.960938 L 80.960938 69.960938 C 80.960938 76.025937 76.025937 80.960938 69.960938 80.960938 L 30.960938 80.960938 C 24.895937 80.960938 19.960938 76.025937 19.960938 69.960938 L 19.960938 30.960938 C 19.960938 24.895937 24.895937 19.960938 30.960938 19.960938 z M 33.798828 22.960938 C 27.822828 22.960938 22.960937 27.822828 22.960938 33.798828 L 22.960938 67.123047 C 22.960938 73.099047 27.822828 77.960938 33.798828 77.960938 L 67.123047 77.960938 C 73.099047 77.960938 77.960938 73.099047 77.960938 67.123047 L 77.960938 48.460938 C 77.960938 48.183937 77.736938 47.960938 77.460938 47.960938 C 77.184938 47.960938 76.960938 48.184937 76.960938 48.460938 L 76.960938 67.123047 C 76.960938 72.547047 72.547047 76.960938 67.123047 76.960938 L 33.798828 76.960938 C 28.374828 76.960938 23.960937 72.547047 23.960938 67.123047 L 23.960938 33.798828 C 23.960938 28.374828 28.374828 23.960937 33.798828 23.960938 L 67.460938 23.960938 C 67.736937 23.960938 67.960938 23.736937 67.960938 23.460938 C 67.960938 23.184938 67.736938 22.960937 67.460938 22.960938 L 33.798828 22.960938 z M 77.460938 36.960938 C 77.184938 36.960938 76.960938 37.183937 76.960938 37.460938 L 76.960938 39.460938 C 76.960938 39.736938 77.184937 39.960938 77.460938 39.960938 C 77.736937 39.960938 77.960938 39.736937 77.960938 39.460938 L 77.960938 37.460938 C 77.960938 37.184937 77.736938 36.960938 77.460938 36.960938 z M 49.980469 37.960938 C 41.191469 37.960938 34.044922 43.119937 34.044922 49.460938 C 34.044922 55.801938 41.193422 60.958984 49.982422 60.958984 C 52.893422 60.958984 55.741469 60.383969 58.230469 59.292969 C 58.472469 59.410969 59.273266 59.876313 61.697266 61.695312 C 61.858266 61.816313 62.050234 61.876953 62.240234 61.876953 C 62.423234 61.876953 62.606672 61.820984 62.763672 61.708984 C 63.083672 61.479984 63.216703 61.075172 63.095703 60.701172 C 62.783703 59.740172 62.365703 58.330781 62.095703 56.925781 C 64.563703 54.840781 65.919922 52.199938 65.919922 49.460938 C 65.919922 43.119937 58.769469 37.960937 49.980469 37.960938 z M 49.982422 38.960938 C 58.219422 38.960938 64.919922 43.671938 64.919922 49.460938 C 64.918922 51.976938 63.610328 54.417938 61.236328 56.335938 C 61.094328 56.450938 61.026594 56.6325 61.058594 56.8125 C 61.308594 58.2245 61.716875 59.663031 62.046875 60.707031 C 59.270875 58.633031 58.536266 58.253906 58.197266 58.253906 C 58.105266 58.253906 58.043563 58.280547 57.976562 58.310547 C 55.578562 59.389547 52.813422 59.958984 49.982422 59.958984 C 41.746422 59.958984 35.044922 55.249937 35.044922 49.460938 C 35.044922 43.671937 41.745422 38.960938 49.982422 38.960938 z M 77.460938 40.960938 C 77.184938 40.960938 76.960938 41.184938 76.960938 41.460938 L 76.960938 45.460938 C 76.960938 45.736938 77.184937 45.960937 77.460938 45.960938 C 77.736937 45.960938 77.960938 45.736938 77.960938 45.460938 L 77.960938 41.460938 C 77.960938 41.183937 77.736938 40.960938 77.460938 40.960938 z" />
                                                            </svg>
                                                            {{ currency.number }}
                                                        </h5>
                                                        <h5 v-if="currency.source == 'Telegram'">
                                                            <svg version="1.1" id="Layer_1"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                y="0px" viewBox="0 0 50 50" width="16px" height="16px"
                                                                style="enable-background:new 0 0 50 50;"
                                                                xml:space="preserve">
                                                                <path
                                                                    d="M46.137,6.552c-0.75-0.636-1.928-0.727-3.146-0.238l-0.002,0C41.708,6.828,6.728,21.832,5.304,22.445	c-0.259,0.09-2.521,0.934-2.288,2.814c0.208,1.695,2.026,2.397,2.248,2.478l8.893,3.045c0.59,1.964,2.765,9.21,3.246,10.758	c0.3,0.965,0.789,2.233,1.646,2.494c0.752,0.29,1.5,0.025,1.984-0.355l5.437-5.043l8.777,6.845l0.209,0.125	c0.596,0.264,1.167,0.396,1.712,0.396c0.421,0,0.825-0.079,1.211-0.237c1.315-0.54,1.841-1.793,1.896-1.935l6.556-34.077	C47.231,7.933,46.675,7.007,46.137,6.552z M22,32l-3,8l-3-10l23-17L22,32z" />
                                                            </svg>
                                                            {{ currency.number }}
                                                        </h5>
                                                        <h5 v-if="currency.source == 'Facebook'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                                            width="16px" height="16px">
                                                                <path fill="#3F51B5"
                                                                    d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5V37z" />
                                                                <path fill="#FFF"
                                                                    d="M34.368,25H31v13h-5V25h-3v-4h3v-2.41c0.002-3.508,1.459-5.59,5.592-5.59H35v4h-2.287C31.104,17,31,17.6,31,18.723V21h4L34.368,25z" />
                                                            </svg>
                                                            {{ currency.number }}
                                                        </h5>
                                                        <h5 v-if="currency.source == 'Discord'">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                viewBox="0 0 50 50"  width="16px" height="16px">
                                                                <path
                                                                    d="M41.626,10.768C37.644,7.567,31.347,7.025,31.08,7.003c-0.42-0.036-0.819,0.202-0.992,0.587c-0.012,0.025-0.15,0.34-0.303,0.833c2.633,0.443,5.867,1.339,8.794,3.155c0.469,0.291,0.613,0.907,0.322,1.377c-0.189,0.305-0.516,0.473-0.851,0.473c-0.18,0-0.362-0.048-0.526-0.15C32.494,10.158,26.209,10,25,10s-7.495,0.158-12.523,3.278c-0.47,0.292-1.086,0.147-1.377-0.322c-0.292-0.47-0.147-1.086,0.322-1.377c2.927-1.815,6.16-2.712,8.794-3.155c-0.154-0.493-0.292-0.808-0.303-0.833c-0.173-0.386-0.571-0.629-0.993-0.587c-0.266,0.021-6.563,0.563-10.598,3.809C6.213,12.76,2,24.152,2,34c0,0.174,0.045,0.344,0.131,0.495c2.909,5.109,10.842,6.447,12.649,6.504C14.791,41,14.801,41,14.812,41c0.319,0,0.62-0.152,0.809-0.411l1.829-2.513c-4.933-1.276-7.453-3.439-7.598-3.568c-0.414-0.365-0.453-0.997-0.087-1.411c0.365-0.414,0.995-0.453,1.41-0.089C11.236,33.062,15.875,37,25,37c9.141,0,13.782-3.953,13.828-3.993c0.414-0.359,1.045-0.323,1.409,0.094c0.364,0.414,0.325,1.043-0.088,1.407c-0.146,0.129-2.666,2.292-7.599,3.568l1.829,2.513C34.568,40.848,34.869,41,35.188,41c0.011,0,0.021,0,0.031-0.001c1.809-0.057,9.741-1.395,12.649-6.504C47.955,34.344,48,34.174,48,34C48,24.152,43.787,12.76,41.626,10.768z M18.5,30c-1.933,0-3.5-1.791-3.5-4c0-2.209,1.567-4,3.5-4s3.5,1.791,3.5,4C22,28.209,20.433,30,18.5,30z M31.5,30c-1.933,0-3.5-1.791-3.5-4c0-2.209,1.567-4,3.5-4s3.5,1.791,3.5,4C35,28.209,33.433,30,31.5,30z" />
                                                            </svg>
                                                            {{ currency.number }}
                                                        </h5>
                                                        <h5 v-if="currency.source == 'Email'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"
                                                            width="16px" height="16px">
                                                                <path
                                                                    d="M 14 4 C 8.4886661 4 4 8.4886661 4 14 L 4 36 C 4 41.511334 8.4886661 46 14 46 L 36 46 C 41.511334 46 46 41.511334 46 36 L 46 14 C 46 8.4886661 41.511334 4 36 4 L 14 4 z M 14 6 L 36 6 C 40.430666 6 44 9.5693339 44 14 L 44 36 C 44 40.430666 40.430666 44 36 44 L 14 44 C 9.5693339 44 6 40.430666 6 36 L 6 14 C 6 9.5693339 9.5693339 6 14 6 z M 13 15 C 11.35503 15 10 16.35503 10 18 L 10 32 C 10 33.64497 11.35503 35 13 35 L 37 35 C 38.64497 35 40 33.64497 40 32 L 40 18 C 40 16.35503 38.64497 15 37 15 L 13 15 z M 13.414062 17 L 36.583984 17 L 27.677734 25.892578 C 26.18494 27.382984 23.796834 27.382819 22.304688 25.890625 L 13.414062 17 z M 38 18.412109 L 38 31.587891 L 31.402344 25 L 38 18.412109 z M 12 18.414062 L 18.585938 25 L 12 31.585938 L 12 18.414062 z M 29.988281 26.412109 L 36.585938 33 L 13.414062 33 L 20 26.414062 L 20.890625 27.304688 C 23.146478 29.56054 26.832638 29.562194 29.089844 27.308594 L 29.988281 26.412109 z" />
                                                            </svg>
                                                            {{ currency.number }}
                                                        </h5>
                                                        <h5 v-if="currency.source == 'Slack'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40"
                                                                width="16px" height="16px">
                                                                <path fill="#8cd3df"
                                                                    d="M4.342,21.046c-1.208,0-2.286-0.767-2.683-1.909c-0.25-0.717-0.205-1.488,0.126-2.171 c0.33-0.683,0.907-1.196,1.624-1.446l27.305-9.496c0.303-0.105,0.616-0.159,0.934-0.159c1.207,0,2.286,0.767,2.683,1.909 c0.25,0.717,0.205,1.488-0.126,2.171c-0.33,0.683-0.907,1.196-1.624,1.446L5.275,20.888C4.973,20.993,4.659,21.046,4.342,21.046z" />
                                                                <path fill="#5f9099"
                                                                    d="M31.647,6.366L31.647,6.366c0.995,0,1.884,0.632,2.211,1.573c0.424,1.219-0.223,2.556-1.442,2.98 L5.111,20.416c-0.25,0.087-0.508,0.131-0.769,0.131c-0.995,0-1.884-0.632-2.211-1.573c-0.424-1.219,0.223-2.556,1.442-2.98 l27.305-9.496C31.127,6.41,31.386,6.366,31.647,6.366 M31.647,5.366c-0.364,0-0.734,0.06-1.098,0.186L3.245,15.048 c-1.743,0.606-2.665,2.51-2.058,4.253c0.48,1.38,1.773,2.245,3.156,2.245c0.364,0,0.734-0.06,1.098-0.186l27.305-9.496 c1.743-0.606,2.664-2.51,2.058-4.253C34.323,6.231,33.03,5.366,31.647,5.366L31.647,5.366z" />
                                                                <path fill="#dd215a"
                                                                    d="M8.353,34.134c-1.207,0-2.286-0.767-2.683-1.909c-0.25-0.717-0.205-1.488,0.126-2.171 c0.33-0.683,0.907-1.196,1.624-1.446l27.305-9.496c0.303-0.105,0.616-0.158,0.934-0.158c1.208,0,2.286,0.767,2.683,1.909 c0.25,0.717,0.205,1.488-0.126,2.171c-0.33,0.683-0.907,1.196-1.624,1.446L9.286,33.975C8.983,34.08,8.67,34.134,8.353,34.134z" />
                                                                <path fill="#a81945"
                                                                    d="M35.658,19.454L35.658,19.454c0.995,0,1.884,0.632,2.211,1.573c0.424,1.219-0.223,2.556-1.442,2.98 L9.122,33.503c-0.25,0.087-0.508,0.131-0.769,0.131c-0.995,0-1.884-0.632-2.211-1.573c-0.424-1.219,0.223-2.556,1.442-2.98 l27.305-9.496C35.138,19.498,35.397,19.454,35.658,19.454 M35.658,18.454c-0.364,0-0.734,0.06-1.098,0.186L7.256,28.136 c-1.743,0.606-2.664,2.51-2.058,4.253v0c0.48,1.38,1.773,2.245,3.156,2.245c0.364,0,0.734-0.06,1.098-0.186l27.305-9.496 c1.743-0.606,2.665-2.51,2.058-4.253C38.334,19.318,37.041,18.453,35.658,18.454L35.658,18.454z" />
                                                                <path fill="#ebb23d"
                                                                    d="M31.291,34.489c-1.208,0-2.286-0.767-2.683-1.909L19.112,5.276c-0.515-1.48,0.271-3.103,1.75-3.617 C21.165,1.554,21.479,1.5,21.796,1.5c1.208,0,2.287,0.767,2.684,1.909l9.495,27.304c0.25,0.717,0.205,1.488-0.126,2.171 c-0.33,0.683-0.907,1.196-1.624,1.446C31.922,34.436,31.608,34.489,31.291,34.489z" />
                                                                <path fill="#b58a2f"
                                                                    d="M21.796,2L21.796,2c0.995,0,1.884,0.632,2.211,1.573l9.496,27.305 c0.424,1.219-0.223,2.556-1.442,2.98c-0.25,0.087-0.508,0.131-0.769,0.131c-0.995,0-1.884-0.632-2.211-1.573L19.584,5.111 c-0.205-0.591-0.169-1.226,0.104-1.789c0.272-0.563,0.748-0.986,1.339-1.192C21.276,2.044,21.535,2,21.796,2 M21.796,1 c-0.364,0-0.734,0.06-1.098,0.186c-1.743,0.606-2.665,2.51-2.058,4.253l9.496,27.305c0.48,1.38,1.773,2.245,3.156,2.245 c0.364,0,0.734-0.06,1.098-0.186c1.743-0.606,2.665-2.51,2.058-4.253L24.952,3.245C24.472,1.865,23.179,1,21.796,1L21.796,1z" />
                                                                <path fill="#cd171d"
                                                                    d="M25.865 21.365H31.548V27.046999999999997H25.865z"
                                                                    transform="rotate(-19.178 28.706 24.206)" />
                                                                <path fill="#9c1116"
                                                                    d="M30.149,21.226l1.538,4.423l-4.423,1.538l-1.538-4.423L30.149,21.226 M30.765,19.953l-6.312,2.195 l2.195,6.312l6.312-2.195L30.765,19.953L30.765,19.953z" />
                                                                <g>
                                                                    <path fill="#7f9331"
                                                                        d="M21.372 8.446H27.054000000000002V14.128H21.372z"
                                                                        transform="rotate(-19.178 24.213 11.287)" />
                                                                    <path fill="#657527"
                                                                        d="M25.656,8.306l1.538,4.423l-4.423,1.538l-1.538-4.423L25.656,8.306 M26.272,7.033L19.96,9.228 l2.195,6.312l6.312-2.195L26.272,7.033L26.272,7.033z" />
                                                                </g>
                                                                <g>
                                                                    <path fill="#66c1a0"
                                                                        d="M18.204,38.5c-1.208,0-2.287-0.767-2.684-1.909L6.025,9.287C5.775,8.569,5.82,7.798,6.151,7.115 c0.33-0.683,0.907-1.196,1.624-1.446c0.303-0.105,0.616-0.159,0.934-0.159c1.208,0,2.286,0.767,2.683,1.909l9.496,27.305 c0.515,1.48-0.271,3.103-1.75,3.617C18.835,38.446,18.521,38.5,18.204,38.5z" />
                                                                    <path fill="#4e917a"
                                                                        d="M8.709,6.011L8.709,6.011c0.995,0,1.884,0.632,2.211,1.573l9.496,27.305 c0.424,1.219-0.223,2.556-1.442,2.98C18.724,37.956,18.465,38,18.204,38c-0.995,0-1.884-0.632-2.211-1.573L6.497,9.122 C6.292,8.531,6.329,7.896,6.601,7.333C6.873,6.77,7.349,6.347,7.94,6.142C8.189,6.055,8.448,6.011,8.709,6.011 M8.709,5.011 c-0.364,0-0.734,0.06-1.098,0.186c-1.743,0.606-2.665,2.51-2.058,4.253l9.496,27.305c0.48,1.38,1.773,2.245,3.156,2.245 c0.364,0,0.734-0.06,1.098-0.186c1.743-0.606,2.665-2.51,2.058-4.253L11.864,7.256C11.385,5.876,10.092,5.011,8.709,5.011 L8.709,5.011z" />
                                                                </g>
                                                                <g>
                                                                    <path fill="#852759"
                                                                        d="M12.945 25.865H18.627000000000002V31.546999999999997H12.945z"
                                                                        transform="rotate(-19.178 15.786 28.706)" />
                                                                    <path fill="#551537"
                                                                        d="M17.229,25.726l1.538,4.423l-4.423,1.538l-1.538-4.423L17.229,25.726 M17.845,24.453l-6.312,2.195 l2.195,6.312l6.312-2.195L17.845,24.453L17.845,24.453z" />
                                                                </g>
                                                                <g>
                                                                    <path fill="#3ba08d"
                                                                        d="M8.452 12.946H14.135V18.628H8.452z"
                                                                        transform="rotate(-19.172 11.295 15.789)" />
                                                                    <path fill="#318575"
                                                                        d="M12.736,12.806l1.538,4.423l-4.423,1.538l-1.538-4.423L12.736,12.806 M13.352,11.533L7.04,13.728 l2.195,6.312l6.312-2.195L13.352,11.533L13.352,11.533z" />
                                                                </g>
                                                            </svg>
                                                            {{ currency.number }}
                                                        </h5>
                                                        <h5 v-if="currency.source == ''">

                                                            {{ currency.number }}
                                                        </h5>

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
                        <span class="float-start text-white small">{{ nombreusuario }} </span>
                    </div>

                    <div class="col-6 align-self-end" style="display:inline-block;">
                        <span class="float-end text-white small">{{ prioridad }} Ticket:{{ ticket_id }}</span>
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
                            <iframe class="w-100" max-height="200px" width="600 px" height="400 px" frameborder='0'
                                allowfullscreen v-bind:src="ext.chat_link"></iframe>
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
                                                        class="mdi mdi-camera-marker-outline bg-info-lighten text-info timeline-icon"></i>{{
                                                            extrah.name
                                                        }}
                                                    <div class="timeline-item-info">
                                                        <a href="javascript:void(0);"
                                                            class="text-info fw-bold mb-1 d-block">{{
                                                                extrah.username
                                                            }}</a>
                                                       
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


    <div id="standard-modal3" class="modal fade bs-example-modal-center3" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Topics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/chatcambiartopic" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic">
                        <div v-for="topic in topics ">

                            <input :value="topic.topic_id" v-model="topic.topic_id" class="form-radio" type="radio"
                                name="statos">{{ topic.topic }}
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
                        <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic">
                        <div v-for="ost_ticket_statu in ost_ticket_status ">

                            <input :value="ost_ticket_statu.id" v-model="ost_ticket_statu.id" class="form-radio"
                                type="radio" name="statos">{{ ost_ticket_statu.name }}
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
                    <form action="/chatcambiardeptos" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic">
                        <div v-for="department in departments ">

                            <input :value="department.id" v-model="department.id" class="form-radio" type="radio"
                                name="statos">{{ department.name }}
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
                    <form action="/chatasignar" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input v-model="ticket_id" type="hidden" name="idticketestado" id="idtickettopic">
                        <div v-for="staff in staffs ">

                            <input :value="staff.id" v-model="staff.id" class="form-radio" type="radio" name="statos">{{
    staff.name
                            }}
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
            topics: null,
            departments: null,
            ost_ticket_status: null,
            staffs: null,

            loading: true,
            errored: false,
            timer: '',
            sise: null,
            depto: null,
            topic: null,
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
            axios
                .get('/api/ost_ticket_status')
                .then(response => (this.ost_ticket_status = response.data))
                .catch(error => console.log(error))
            ,
            axios
                .get('/api/staff')
                .then(response => (this.staffs = response.data))
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
        pasar: function (a, b, c, d, e, f, g, h, i, j, k) {
            this.active = !this.active;
            this.ticket_id = d;
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

