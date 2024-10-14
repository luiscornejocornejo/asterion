  function pedirall(){
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
    document.getElementById("idticketpedir20").value = area_interes;

  }

  function areaall(){
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
    document.getElementById("idticketdepto22").value = area_interes;

  }
  function cerrarall(){
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
    document.getElementById("tc").value = area_interes;

  }
  function prioridadall(){
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
    document.getElementById("tp").value = area_interes;

  }