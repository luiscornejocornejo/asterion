<script>
    function redondeo(numero) {
        return numero.substr(0, 2);
    }

    function getFormatNumber(number) {
        let numberInt = number.toString().split('.');
        if (numberInt[1]) {
            if (numberInt[0].length == 4) {
                return numberInt[0].substr(0, 1) + "." + numberInt[0].substr(-3) + "," + redondeo(numberInt[1]);
            } else if (numberInt[0].length == 5) {
                return numberInt[0].substr(0, 2) + "." + numberInt[0].substr(-3) + "," + redondeo(numberInt[1]);
            } else if (numberInt[0].length == 6) {
                return numberInt[0].substr(0, 3) + "." + numberInt[0].substr(-3) + "," + redondeo(numberInt[1]);
            } else {

                if (numberInt[1] == null) {
                    return numberInt[0] + ",00";
                } else {
                    return numberInt[0] + "," + redondeo(numberInt[1]);
                }

            }
        } else {
            if (numberInt[0].length == 4) {
                return numberInt[0].substr(0, 1) + "." + numberInt[0].substr(-3) + ",00";
            } else if (numberInt[0].length == 5) {
                return numberInt[0].substr(0, 2) + "." + numberInt[0].substr(-3) + ",00";
            } else if (numberInt[0].length == 6) {
                return numberInt[0].substr(0, 3) + "." + numberInt[0].substr(-3) + ",00";
            } else {

                if (numberInt[1] == null) {
                    return numberInt[0] + ",00";
                } else {
                    return numberInt[0] + "," + redondeo(numberInt[1]);
                }

            }
        }
    }

    function calcular() {

        var salary_workdays_html = document.getElementById('salary_workdays');
        var count_workdays_crew_html = document.getElementById('dias');
        var salary_daily_html = document.getElementById('salary_daily');


        salary_workdays = salary_workdays_html.value;
        count_workdays_crew = count_workdays_crew_html.value;
        salary_daily = salary_daily_html.value;
        let total_workdays = (parseFloat(salary_workdays.replace(".", "").replace(",", ".")) * parseFloat(count_workdays_crew));
        let crew_sueldo_diferencia = getFormatNumber(total_workdays - (salary_daily * parseFloat(count_workdays_crew)));


        let days = $('input[name=days_crew]').val();
        $('input[name=salary_liquidate]').val(getFormatNumber(parseFloat(days) * salary_daily));
        $('input[name=crew_sueldo_diferencia]').val(crew_sueldo_diferencia);

        // Si crew_sueldo_diferencia es negativo or positivo backgroundColor
        $('input[name=crew_sueldo_diferencia]').removeAttr('style');

        if (parseFloat($('input[name=crew_sueldo_diferencia]').val()) > 0) {
            $('input[name=crew_sueldo_diferencia]').css({
                backgroundColor: "green",
                color: "white"
            });
        } else {
            $('input[name=crew_sueldo_diferencia]').css({
                backgroundColor: "red",
                color: "white"
            });
        }

    }

    function getContractProject(valor) {

        salariobrutoglobal2 = salariobrutoglobal.replace("$", "").replace(".", "").replace(",", ".");

        if (valor == 3) {
            salary_daily = parseFloat((salariobrutoglobal2 / 22) * 1.5);
        } else {
            salary_daily = parseFloat(salariobrutoglobal2 / 30);
        }


        $('input[name=salary_daily]').val(salary_daily);



    }
</script>
<div class="modal fade" id="firstmodal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">
                    <p>Modal[<span id="pp23"></span>]</p>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/moditeam" method="POST">
                {!! csrf_field() !!}
                ...

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="text" name="idbase"  id="idbase"/>

                <div class="modal-body">





                    <div class="col-md-12">
                        <div class="form-group bg-light border m-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Tipo de Contrato<span class="required-red">*</span>
                                </span>
                                <div class="col-12">
                                    <select class="form-select" data-live-search="true" data-style="select-with-transition" name="id_contract" id="id_contract">
                                        <option value="">Seleccionar</option>
                                        <?php
                                        foreach ($lista3 as $value3) {

                                            echo "<option ";

                                            if ($value3->id == "<script> document.write(idcontrato);</script>") {
                                                echo " selected";
                                            }
                                            echo "   value='" . $value3->id . "'>" . $value3->name . "</option>";
                                        }


                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group bg-light border m-1">
                            <div class="row">

                                <div class="col-6">
                                    <span class="input-group-text"> Fecha de Alta Contrato<span class="required-red">*</span>
                                </div>
                                <div class="col-6">
                                    <span class="input-group-text">Fecha de Baja Contrato<span class="required-red">*</span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group bg-light border m-1">
                            <div class="row">

                                <div class="col-6">
                                    <input class="form-control datepicker_crew" type="date" name="start_date_contract" id="start_date_contract">
                                </div>
                                <div class="col-6">
                                    <input class="form-control datepicker_crew" type="date" name="finish_date_contract" id="finish_date_contract">
                                </div>

                            </div>
                        </div>

                        <div class="form-group bg-light border m-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Modalidad<span class="required-red">*</span>
                                </span>
                                <div class="col-12">
                                    <select class="form-select" data-live-search="true" data-style="select-with-transition" name="modalidad" id="modalidad" onchange="getContractProject(this.value)">
                                        <option value="">Seleccionar</option>

                                        <?php
                                        foreach ($lista2 as $value) {

                                            echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
                                        }


                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group bg-light border m-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Cant. Jornadas Laborables<span class="required-red">*</span>
                                </span>
                                <div class="col-12">
                                    <input type="number" class="form-control input-type-number" name="dias" id="dias" ">

                                    <input type=" hidden" name="id_project_provider" maxlength="125" readonly>
                                    <input type="hidden" name="salary_liquidate" maxlength="125" readonly>
                                </div>
                            </div>
                        </div>




                        <div class="form-group bg-light border m-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Sueldo Contrato Bruto<span class="required-red">*</span>
                                </span>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="salary_contract_bruto_category_function" maxlength="125" readonly>
                                    <input type="hidden" class="form-control" name="salary_contract_category_function" maxlength="125" readonly>
                                </div>
                            </div>
                        </div>




                        <div class=" form-group bg-light border m-1">
                            <div class="row">

                                <div class="col-6">
                                    <span class="input-group-text"> Hora de Inicio<span class="required-red">*</span>
                                </div>
                                <div class="col-6">
                                    <span class="input-group-text">Hora Final<span class="required-red">*</span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group bg-light border m-1">
                            <div class="row">

                                <div class="col-6">
                                    <input class="form-control datepicker_crew" type="time" name="horainicio" id="horainicio">
                                </div>
                                <div class="col-6">
                                    <input class="form-control datepicker_crew" type="time" name="horafinal" id="horafinal">
                                </div>

                            </div>
                        </div>


                        <div class="form-group bg-light border m-1">
                            <div class="row">

                                <div class="col-6">
                                    <span class="input-group-text"> Fecha de Alta AFIP:<span class="required-red">*</span>
                                </div>
                                <div class="col-6">
                                    <span class="input-group-text">Fecha de Baja AFIP:<span class="required-red">*</span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group bg-light border m-1">
                            <div class="row">

                                <div class="col-6">
                                    <input class="form-control datepicker_crew" type="date" name="afipalta" id="start_afip">
                                </div>
                                <div class="col-6">
                                    <input class="form-control datepicker_crew" type="date" name="afipbaja" id="finish_afip">
                                </div>

                            </div>
                        </div>


                        <div class="form-group bg-light border m-1">
                            <div class="row">

                                <div class="col-6">
                                    <span class="input-group-text"> Sueldo Jornada<span class="required-red">*</span>*
                                </div>
                                <div class="col-6">
                                    <span class="input-group-text"> Sueldo en mano Texto<span class="required-red">*</span>*

                                </div>

                            </div>
                        </div>
                        <div class="form-group bg-light border m-1">
                            <div class="row">

                                <div class="col-6">
                                    <input type="number" step="0.01" class="form-control validate-number-decimal-not-ps" name="salary_workdays" id="salary_workdays" maxlength="125">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control " name="total_workdays_text">

                                </div>

                            </div>
                        </div>

                        <div class="form-group bg-light border m-1">
                            <div class="row">

                                <div class="col-6">
                                    <span class="input-group-text">SUELDO DIARIO SAT<span class="required-red">*</span>*
                                </div>
                                <div class="col-6">
                                    <span class="input-group-text"> DIFERENCIA<span class="required-red">*</span>*

                                </div>

                            </div>
                        </div>
                        <div class="form-group bg-light border m-1">
                            <div class="row">

                                <div class="col-6">
                                    <input type="text" class="form-control" name="salary_daily" id="salary_daily" readonly>
                                </div>
                                <div class="col-6"><input onclick="calcular()" type="text" class="form-control" name="crew_sueldo_diferencia" id="crew_sueldo_diferencia" maxlength="125" placeholder="Click aquí para que actualizar los Sueldos" readonly>

                                </div>

                            </div>
                        </div>

                        <div class="form-group bg-light border m-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Es Reemplazo:<span class="required-red">*</span>
                                </span>
                                <div class="col-12">
                                    <select class="form-select" data-live-search="true" data-style="select-with-transition" name="reemplazo" id="reemplazo" onchange="getContractProject(this.value)">
                                        <option value="1" selected>No</option> <!-- 1 = Titular -->
                                        <option value="2">Si</option> <!-- 1 = Suplente -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group bg-light border m-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Estado de Invitacion al Proyecto:<span class="required-red">*</span>
                                </span>
                                <div class="col-12">
                                    <select class="form-select" data-live-search="true" data-style="select-with-transition" name="aceptado" id="aceptado" onchange="getContractProject(this.value)">
                                        <option value="1">Aceptado</option>
                                        <option value="0">Pendiente</option>
                                        <option value="2">Rechazado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-center" style="padding: 20px;">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar Team</button>

                        </div>









                    </div>
                </div>
        </div>
    </div>
    </form>
</div>