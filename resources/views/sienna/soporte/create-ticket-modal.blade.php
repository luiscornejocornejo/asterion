<div class="modal fade" id="create-ticket" tabindex="-1" role="dialog" aria-labelledby="create-taskdby" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="create-taskdby">Nuevo ticket</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <div class="modal-body">
                <form action="/createticketsoporte" method="POST"  enctype="multipart/form-data">
                @csrf

                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="department" class="form-label">Departamento:</label>
                            <select onchange="moti(this)" class="form-control mb-3" name="department" id="department" class="form-select">
                            <option value="0">Seleccione</option>
                            <option value="1">Soporte</option>
                            <option value="2">Administracion</option> 
                            </select>
                        </div>
                        <script>
                            function moti(dep){
                                var value = dep.value;  
                                var aficiones = document.getElementById("reason");

                                aficiones.innerHTML = '';
                                if(value==1){
                                    var option = document.createElement("option");
                                    option.text = "Ticket";
                                    option.value = "21";

                                    aficiones.add(option);
                                    var option2 = document.createElement("option");
                                    option2.text = "Bot";
                                    option2.value = "22";

                                    aficiones.add(option2);
                                    var option3 = document.createElement("option");
                                    option3.text = "IVR";
                                    option3.value = "23";

                                    aficiones.add(option3);
                                    var option4 = document.createElement("option");
                                    option4.text = "Telefonia";
                                    option4.value = "24";

                                    aficiones.add(option4);
                                    var option5 = document.createElement("option");
                                    option5.text = "Otros";
                                    option5.value = "25";

                                    aficiones.add(option5);
                                }
                                if(value==2){
                                    var option = document.createElement("option");
                                    option.text = "Facturacion";
                                    option.value = "27";
                                    aficiones.add(option);
                                    var option2 = document.createElement("option");
                                    option2.text = "Otros";
                                    option2.value = "26";

                                    aficiones.add(option2);
                                }
                            }
                        </script>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="reason" class="form-label">Motivo:</label>
                            <select class="form-control mb-3" name="reason" id="reason" class="form-select">
                                <?php // foreach ($usersmerchant as $val) { ?>
                               
                                <?php // } ?>
                            </select>
                        </div>
                    </div>

                    <label for="ticket-text" class="form-label">Descripción:</label>
                    <textarea class="form-control mb-3" id="task-text" name="textticket" class="form-control mb-3" rows="4" required></textarea>
                    <input type="hidden" value="<?php // echo $resultados[0]->ticketid; 
                                                ?>" name="ticketid" />

                    <label for="evidence" class="btn btn-secondary rounded-pill">
                        <i class="mdi mdi-attachment"></i> Evidencia
                        <input name="evicence" type="file" id="evidence" class="d-none">
                    </label>
                    <span id="fileName" class="ms-1"></span>

                    <div class="modal-footer mt-3">
                        <input value="<?php // echo $subdomain_tmp; ?>" type="hidden" name="idbot" id="idbot">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="liveToastBtn" data-bs-dismiss="modal">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>