
let identificadorIntervaloDeTiempo;


let variableGlobal = 0;


function colorlogo(id){
    im2="";
    for (var listado2 in sourcelista){
        if(sourcelista[listado2]["id"]==id){
            im2=sourcelista[listado2]["colore"];
        }
    }
    return im2;
}
function logo(id){
    im="";
    for (var listado2 in sourcelista){
        if(sourcelista[listado2]["id"]==id){
            im=sourcelista[listado2]["svg"];
        }
    }
    return im;
}
function colordeptof(id){
    colordepto="";
    for (var listado2 in departamentoslista){
        if(departamentoslista[listado2]["id"]==id){
            colordepto=departamentoslista[listado2]["colore"];
        }
    }
    return colordepto;
}
function colorestadof(id){
    colorestado="";
    for (var listado2 in estadoslista){
        if(estadoslista[listado2]["id"]==id){
            colorestado=estadoslista[listado2]["clasecolor"];
        }
    }
    return colorestado;
}


function estado2(result,dd, ee, ff) {

    document.getElementById("idticketestado2").value = dd;
    document.getElementById("conversation_id2").value = ee;




    url = "https://"+result+".suricata.cloud/api/statussiennaxdepto?depto=" + ff;
    axios.get(url)
    .then(function (response) {
        // función que se ejecutará al recibir una respuesta
        console.log(response.data);

        dato = "";
        for (i = 0; i < response.data.length; i++) {
            console.log(response.data[i].id);
            console.log(response.data[i].nombre);


            if(response.data[i].id !=4){
            dato += ' <div class="mt-3">' +

                '<div class="form-check mb-2">' +
                ' <input type="radio" id="customRadio' + response.data[i].id + '" name="estado" value="' + response.data[i].id + '"  class="form-check-input">' +

                '<label class="form-check-label" for="customRadio' + response.data[i].id + '">' + response.data[i].nombre + '</label>' +
                '</div>' +

                ' </div>';

            }


        }
        document.getElementById("estunico").innerHTML = dato;



    })
    .catch(function (error) {
        // función para capturar el error
        console.log(error);
    })
    .then(function () {
        // función que siempre se ejecuta
    });


}





function area(dd, ee, ff) {

    document.getElementById("idticketdepto").value = dd;
    document.getElementById("idconv").value = ee;
    document.getElementById("user_id").value = ff;


}
function pedir(dd) {

    document.getElementById("idticketpedir").value = dd;



}



