<div class="modal fade" id="bs-example-modal-sm-assign" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h4 class="modal-title" id="mySmallModalLabel">Asignar Ticket</h4>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/asignara" method="POST">
                                    @csrf

                                        <input value="<?php echo $resultados[0]->ticketid; ?>" type="hidden" name="idticketpedir" id="idticketpedir2">
                                        <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">

                                            <div class="mt-3">

                                                <div v-for="department in departments ">
                                                    <?php foreach ($usersmerchant as $dep) {?>
                                                        <input value="<?php echo $dep->id; ?>" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo $dep->nombre . " " . $dep->last_name; ?></span>
                                                        <br><br>

                                                    <?php }?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success">Asignar</button>
                                                </form>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
</div>