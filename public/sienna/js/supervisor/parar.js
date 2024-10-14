function parar(){
    console.log(identificadorIntervaloDeTiempo);
    clearInterval(identificadorIntervaloDeTiempo);

  }
  function star(){
    identificadorIntervaloDeTiempo = setInterval(maxid, frecuencia);
  }