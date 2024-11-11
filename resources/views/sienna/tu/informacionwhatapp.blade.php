
<?php 
    
    $tipobot=0;
  

   
    $merchantId=$subdomain_tmp;
    if($resultados[0]->ticketid==5109){
   // if($tipobot==1){
            ?>
        <iframe allow="camera;microphone" 
        src="https://conversations.suricata.chat/?ticketId=<?php echo $resultados[0]->ticketid;?>&agentName=<?php echo session('nombreusuario');?>&merchant=<?php echo $merchantId;?>" width="100%" class="border rounded-3" style="height: 650px!important;"></iframe>
        <script>
    // Función para verificar y pedir permiso de notificaciones
    async function requestNotificationPermission() {
      if ('Notification' in window) {
        let permission = Notification.permission;
        if (permission !== 'granted') {
          permission = await Notification.requestPermission();
        }
        return permission === 'granted';
      }
      return false;
    }

    // Función para disparar la notificación push
    async function triggerPushNotification(title, body) {
      const hasPermission = await requestNotificationPermission();
      if (hasPermission) {
        const notification = new Notification(title, {
          body: body,
          icon: 'https://via.placeholder.com/150' // Puedes cambiar el icono
        });
        
        notification.onclick = () => {
            window.focus();          // Reenfocar la ventana (pestaña) principal
            notification.close();    // Cerrar la notificación
        };
      } else {
        console.log('Permiso de notificación no concedido.');
      }
    }

    // Escucha el mensaje enviado desde el iframe
    window.addEventListener('message', (event) => {
      if (event.data.action === 'triggerPushNotification') {
        const { title, body } = event.data;
        triggerPushNotification(title, body);
      }
    });
  </script>
    <?php }
    else{?>
    <iframe allow="camera;microphone" src="<?php echo $resultados[0]->conversation_url; ?>" width="100%" class="border rounded-3" style="height: 650px!important;"></iframe>
    <?php }?>
<div class="<?php echo $vero; ?> d-flex justify-content-between mt-2 mb-2">
    <div></div>
   

    <div class="me-2">
        <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#open-conversation">
            <i class="mdi mdi-whatsapp me-1"></i>Reabrir conversación
        </button>
    </div>


</div>
<div class="me-2">
    
    <select onChange="mos(this.options[this.selectedIndex].value)" class="form-select" aria-label="Default select example">
   <option>Seleccionar</option>
            <?php foreach($datosatajos as $val){?>
            <option value="<?php echo htmlspecialchars($val->contenido);?>" ><?php echo $val->nombre;?></option>
        <?php }?>
        </select>
    <script>
        function mos(dd){
            document.getElementById("cop").innerHTML =null;
            document.getElementById("cop").innerHTML =dd;
        }
    </script>


</div>
<div class="me-2">
<textarea class="form-control" id="cop"></textarea>
</div>