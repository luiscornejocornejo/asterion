<div class="card widget-flat">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="fw-normal text-dark" title="Number of Customers">Información del Ticket #<?php echo $resultados[0]->ticketid; ?></h4>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-note-text widget-icon bg-secondary-lighten text-secondary"></i>
                                    </div>
                                </div>
                                <hr style="margin-top: 10px;" />
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="mb-1">
                                            <i class="mdi mdi-list-status"></i> <strong>Estado: </strong><?php echo $resultados[0]->estadoname; ?>
                                        </div>
                                        <div class="mb-1">
                                            <i class="mdi mdi-office-building"></i> <strong>Departamento: </strong><?php echo $resultados[0]->depto; ?>
                                        </div>
                                        <div class="mb-1">
                                            <i class="mdi mdi-account-voice"></i> <strong>Asignado a: </strong><?php echo $resultados[0]->nombreagente; ?>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="mb-1">
                                            <i class="mdi mdi-calendar"></i> <strong>Creado: </strong><?php echo $resultados[0]->creacion; ?>
                                        </div>
                                        <div>
                                        <i class="mdi mdi-priority-high"></i> <strong>Prioridad: </strong>
                                        <span onclick="prioridad(`<?php echo $subdomain_tmp; ?>`,`<?php echo $resultados[0]->ticketid; ?>`,`<?php echo $resultados[0]->conversation_id; ?>`,`<?php echo $resultados[0]->iddepto; ?>`,`<?php echo $resultados[0]->cliente; ?>`)" role="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smprioridad">
                                        <span class="badge <?php echo $resultados[0]->colorprioridad; ?> line-h" style="font-size: 13px;">
                                                <?php echo $resultados[0]->nombreprioridad; ?>
                                            </span>
                                     </span>
                         
                                         
                                        </div>
                                        <div class="mb-1">
                                            <i class="mdi mdi-information"></i> <strong>Tema de ayuda: </strong><?php echo $resultados[0]->topicname; ?>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>