
let identificadorIntervaloDeTiempo;


let variableGlobal = 0;


function logo(id){
    console.log(departamentoslista);

    im="mdi-whatsapp";
    return im;
}

function maxid(url,idusuario,area) {


    url = "https://"+url+".suricata.cloud/api/maxid?idusuario=" + idusuario + "&area=" + area + "";
    
    axios.get(url)
        .then(function (response) {
            // función que se ejecutará al recibir una respuesta
            console.log(response.data.length);
            console.log(response.data);
            console.log("aca");
            console.log(departamentoslista);

            
            document.getElementById("tb").innerHTML = null;
            tt = "";
          
            for (i = 0; i < response.data.length; i++) {
                console.log(response.data[i].id);

           

            im=logo(response.data[i].siennasource);
                tt += '<tr class="text-center">' +
                    ' <td><i class="mdi '+im+' me-1 "></i>' + response.data[i].ticketid + '</td>' +
                    ' <td>' + response.data[i].nya + '</td>' +
                    ' <td><button onclick="area(' + response.data[i].ticketid + ',' + response.data[i].conversation_id + ',' + response.data[i].user_id + ')"  class="btn s" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2">' + response.data[i].depto + ' </button> </td>' +
                    ' <td>' + response.data[i].cel + '</td>' +
                    ' <td>' + response.data[i].created_at + '</td>' +
                    ' <td><button onclick="estado2(' + response.data[i].ticketid + ',' + response.data[i].conversation_id + ',' + response.data[i].iddepto + ')"  class="btn s" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm">' + response.data[i].estadoname + ' </button> </td>' +
                    '<td><button  class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-link"></i></button>' +
                    '<button  onclick="vista(' + response.data[i].conversation_url + ')" class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-wechat"></i> </button></td </tr>';



            }
            document.getElementById("tb").innerHTML = html;


        })
        .catch(function (error) {
            // función para capturar el error
            console.log(error);
        })
        .then(function () {
            // función que siempre se ejecuta
        });
    console.log("Ha pasado 1 segundo.");

}
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

