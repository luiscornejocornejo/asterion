
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

function vista(dd) {
    document.getElementById('vista').src = "";

    document.getElementById("vista").contentWindow.document.location.href = dd;
    document.getElementById('vista').src = dd;

}

