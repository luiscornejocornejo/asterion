<!-- Modal for Create Ticket -->
<?php
$querygenerico="select * from empresa";
$siennadeptosgenericos = DB::select($querygenerico);
$uri="";
foreach($siennadeptosgenericos as $val){
    $uri=$val->botfrontdesk;
}
?>

<script>

    function topics(id){
        var URLactual = window.location.href;
        var porciones = URLactual.split('.');
        let result = porciones[0].replace("https://", "");
        let opt="";
        url = "https://"+result+".suricata.cloud/api/topicxdepto?depto=" + id + "";
        console.log(url);
        axios.get(url)
            .then(function (response) {
                console.log(response);
               
                tt = "";
                for (i = 0; i < response.data.length; i++) {
                        console.log(response.data[i].nombre);
                        tt+='<option  value='+response.data[i].id+'>'+response.data[i].nombre+'</option>';

                } 
                document.getElementById("top").innerHTML = null;
                document.getElementById("top").innerHTML = tt;
            })
            .catch(function (error) {
                // función para capturar el error
                console.log(error);
            })
            .then(function () {
                // función que siempre se ejecuta
            });
    }
</script>
    
<div class="modal fade" id="warning-alert-modal2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalToggleLabel">Ticket  Manual</h5>
               
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           
           <?php echo $uri;?>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
            