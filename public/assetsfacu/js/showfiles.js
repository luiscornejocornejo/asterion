function init() {
   // document.getElementById('exampleInputPassword1').addEventListener('change', showName, false);
  }
  function showName (event) {
    document.getElementById('fileName').innerHTML = event.target.files[0].name
  }
  init()