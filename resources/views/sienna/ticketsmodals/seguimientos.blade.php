<div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header bg-dark text-white">
                <h5 id="offcanvasRightLabel" >Seguimiento</h5>
                <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-6">
                                    <!-- assignee -->
                                    <p class="mb-1 text-muted">Asignado a:</p>
                                    <div class="d-flex">
                                        <div>
                                            <span class="mt-1 font-14">
                                                agent_sienna
                                            </span>
                                        </div>
                                    </div>
                                    <!-- end assignee -->
                                </div> <!-- end col -->                                
                            </div> <!-- end row -->

                            
                            <!-- end sub tasks/checklists -->
                            <form action="/api/crearseguimiento" method="POST">

                                <div class="mt-2 ">
                                    <div class="mb-2">
                                        <label class="form-label">Comentario</label>
                                        <div class="input-group">
                                        
                                        <input value="" type="hidden" name="idticketseguimiento" id="idticketseguimiento">

                                            <input type="text" name="comentario" class="form-control" aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="button"><i class="mdi mdi-send"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">Subir archivo</label>
                                        <input class="form-control" type="file" id="inputGroupFile04">
                                    </div>
                                </div>
                            </form>
                            
                                <div class="mt-2">
                                    <div class="card-header d-flex justify-content-between align-items-center mt-2">
                                        <h4 class="header-title">Actividad reciente</h4>
                                        <!-- Dropdown Inactivo
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                
                                                <a class="dropdown-item">Editar</a>
                                                
                                                <a href="javascript:void(0);" class="dropdown-item">Cerrar</a>
                                            </div>
                                        </div>
                                        -->
                                    </div>

                                    <div class="card-body py-0 mb-3 mt-3" data-simplebar="init"><div class="simplebar-wrapper" ><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 24px;">
                                        <div class="timeline-alt py-0" id="seguimientounico">
                                            <div class="timeline-item">
                                                <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <span class="text-info fw-bold mb-1 d-block">Carga de archivo</span>
                                                    <small>agent_sienna ha subido un elemento</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-flag bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-primary fw-bold mb-1 d-block">Cambio de estado en ticket</a>
                                                    <small>agent_sienna cambió el estado del ticket a
                                                        <span class="fw-bold">ticket_status</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-account-group bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-info fw-bold mb-1 d-block">Cambio de departamento</a>
                                                    <small>agent_sienna derivó a 
                                                        <span class="fw-bold">departament</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-account-voice bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-primary fw-bold mb-1 d-block">Reclamo de ticket</a>
                                                    <small> Por agente agent_sienna</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="timeline-item">
                                                <i class="mdi mdi-account bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-primary fw-bold mb-1 d-block">Asignación de ticket</a>
                                                    <small> Asignado a agent_sienna</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="timeline-item">
                                                <i class="mdi mdi-comment-text bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-info fw-bold mb-1 d-block">agent_sienna</a>
                                                    <small>comment</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end timeline -->
                                    </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 353px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 281px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div> <!-- end slimscroll -->
                                </div>
                            </div> <!-- end row-->
                            <!-- end comments -->
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div>
            </div>
        </div>
        
      </div>