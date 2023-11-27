
let identificadorIntervaloDeTiempo;


let variableGlobal = 0;





function area(dd, ee, ff) {

    document.getElementById("idticketdepto").value = dd;
    document.getElementById("idconv").value = ee;
    document.getElementById("user_id").value = ff;


}
function pedir(dd) {

    document.getElementById("idticketpedir").value = dd;



}
function estado2(dd, ee, ff) {

    document.getElementById("idticketestado2").value = dd;
    document.getElementById("conversation_id2").value = ee;




    url = "https://opticom.suricata.cloud/api/statussiennaxdepto?depto=" + ff;
    axios.get(url)
        .then(function (response) {
            // función que se ejecutará al recibir una respuesta
            console.log(response.data);

            dato = "";
            for (i = 0; i < response.data.length; i++) {
                console.log(response.data[i].id);
                console.log(response.data[i].nombre);


                dato += ' <div class="mt-3">' +

                    '<div class="form-check mb-2">' +
                    ' <input type="radio" id="customRadio' + response.data[i].id + '" name="estado" value="' + response.data[i].id + '"  class="form-check-input">' +

                    '<label class="form-check-label" for="customRadio' + response.data[i].id + '">' + response.data[i].nombre + '</label>' +
                    '</div>' +

                    ' </div>';


            }
            document.getElementById("est").innerHTML = dato;



        })
        .catch(function (error) {
            // función para capturar el error
            console.log(error);
        })
        .then(function () {
            // función que siempre se ejecuta
        });


}
function vista(dd) {
    document.getElementById('vista').src = "";

    document.getElementById("vista").contentWindow.document.location.href = dd;
    document.getElementById('vista').src = dd;

}

