function cerrar(result,dd, ee, ff,cliente){
    document.getElementById("idticketestado20").value = dd;
    document.getElementById("conversation_id20").value = ee;
    document.getElementById("client_number").value = cliente;

    ff
    url = "https://"+result+".suricata.cloud/api/motic?depto=" + ff + "";
      console.log(url);

      axios.get(url)
      .then(function (response) {

        res="<select name='motivoc' class='form-control'>";
        console.log(response.data);
        for (i = 0; i < response.data.length; i++) {
              console.log(response.data[i].nombre);
              res+="<option value='"+response.data[i].id+"'>"+response.data[i].nombre+"</option>";

        }
        res+="</select>";
        document.getElementById("motivoc").innerHTML = null;

          document.getElementById("motivoc").innerHTML = res;

      })
      .catch(function (error) {
          // función para capturar el error
          console.log(error);
      })
      .then(function () {
          // función que siempre se ejecuta
      });
  }

  function tags(){
    var checked = document.querySelectorAll('input:checked');

    if (checked.length === 0) {
        // there are no checked checkboxes
        console.log('no checkboxes checked');
    } else {
        // there are some checked checkboxes
        console.log(checked.length + ' checkboxes checked');
    }

    let area_interes = "";
    for (let i = 0, length = checked.length; i < length; i++) {
        area_interes += checked[i].value + ",";             
    }
    document.getElementById("idtickettags").value = area_interes;

  }

  function historico(result,dd) {


    document.getElementById("historico").innerHTML = "";
    url = "https://"+result+".suricata.cloud/api/historico?cliente=" + dd;
    axios.get(url)
    .then(function (response) {
    // función que se ejecutará al recibir una respuesta
    console.log(response.data);

    dato = "";
    for (i = 0; i < response.data.length; i++) {
        console.log(response.data[i].id);
        console.log(response.data[i].nombre);


        dato += ' <div class="mt-3"> ' +

            '<div class="form-check mb-2">' +
            'estado:'+response.data[i].nombreestado +'<br> ' +
            'depto:'+response.data[i].nombredepto +'<br> ' +
            'fecha:'+response.data[i].created_at +'<br> ' +

            '<a target="_blank" href="https://ispgroup.suricata.cloud/ticketunico?tick='+ response.data[i].ticketid+'" class="form-check-label" >' + response.data[i].siennatopicnombre + '</a>' +
            '</div><hr />' +

            ' </div>';


    }
    document.getElementById("historico").innerHTML = dato;



      })
      .catch(function (error) {
          // función para capturar el error
          console.log(error);
      })
      .then(function () {
          // función que siempre se ejecuta
      });


  }

  function coloriconos(id){
      coloricono="";
      for (var listado2 in iconos){
          if(iconos[listado2]["id"]==id){
              coloricono=iconos[listado2]["descripcion"];
          }
      }
      return coloricono;
  }

  function listadoseguimientos(result,dd) {

    document.getElementById("idticketseguimiento").value = dd;




    url = "https://"+result+".suricata.cloud/api/listadoseguimientos?ticket=" + dd;
    axios.get(url)
    .then(function (response) {
      // función que se ejecutará al recibir una respuesta
      console.log(response.data);
      document.getElementById("seguimientounico").innerHTML = null;

      dato = "";
      for (i = 0; i < response.data.length; i++) {
          console.log(response.data[i].id);
          console.log(response.data[i].descripcion);
          console.log(response.data[i].autor);
          console.log(response.data[i].created_at);
          console.log(response.data[i].tipo);
          uri="";
          if(response.data[i].logo!=null){

            ht='https://sienamedia.sfo3.digitaloceanspaces.com/ispgroup/xen/enviados/'+response.data[i].logo;
            uri='<a target=_blank href="'+ht+'">'+response.data[i].logo+'</a>';
          }else{
            uri='';
          }
        coloreicono= coloriconos(response.data[i].tipo);

          dato += ' <div class="timeline-item">'+
                  coloreicono+
                  '<div class="timeline-item-info">'+
                  '<span class="text-info fw-bold mb-1 d-block">'+response.data[i].descripcion+'</span>'+
                  '<small>'+response.data[i].autor+'</small>'+
                  '<p class="mb-0 pb-2">'+
                  '<small class="text-muted">'+response.data[i].created_at+'</small>'+
                
                  '</p> '+uri+'</div> </div>';
                                              
                                              
                                  


      }
      document.getElementById("seguimientounico").innerHTML = dato;


   

    })
    .catch(function (error) {
        // función para capturar el error
        console.log(error);
    })
    .then(function () {
        // función que siempre se ejecuta
    });


  }
        
  function colorprif(idprioridad){
    //alert(id);
    console.log(idprioridad);
      if(idprioridad==3){
        return "badge bg-success";
      }
      if(idprioridad==2){
        return "badge bg-warning";
      }
      if(idprioridad==1){
        return " badge bg-danger";
      }
      return "badge bg-success";

  }
  
  function topic(result,dd, ee, ff) {

    document.getElementById("idticketestado3").value = dd;




    url = "https://"+result+".suricata.cloud/api/topicxdepto?depto=" + ff;
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
      document.getElementById("estunico2").innerHTML = dato;



    })
    .catch(function (error) {
        // función para capturar el error
        console.log(error);
    })
    .then(function () {
        // función que siempre se ejecuta
    });


  }

  function pedir2(dd) {
    document.getElementById("idticketpedir2").value = dd;
}

function obtenerFechaUTC() {
    const fechaActualUTC = new Date();

    const año = fechaActualUTC.getUTCFullYear();
    const mes = String(fechaActualUTC.getUTCMonth() + 1).padStart(2, '0'); // Los meses empiezan desde 0
    const dia = String(fechaActualUTC.getUTCDate()).padStart(2, '0');
    const hora = String(fechaActualUTC.getUTCHours()).padStart(2, '0');
    const minutos = String(fechaActualUTC.getUTCMinutes()).padStart(2, '0');
    const segundos = String(fechaActualUTC.getUTCSeconds()).padStart(2, '0');

    return `${año}-${mes}-${dia} ${hora}:${minutos}:${segundos}`;
}
















//revisar si se usa
  function displayData(data) {
    const container = document.getElementById('data-container');
    container.innerHTML = ''; // Limpia el contenido anterior

    data.forEach((item, index) => {
        const div = document.createElement('div');
        div.textContent = JSON.stringify(item);

        // Si es un nuevo registro o ha cambiado, añade una clase CSS
        if (lastData && JSON.stringify(item) !== JSON.stringify(lastData[index])) {
            div.classList.add('new-data');
        }

        container.appendChild(div);
    });
}
let lastData = null;