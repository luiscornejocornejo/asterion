<?php

foreach($datosempresa as $val){
$tipobot=$val->tipo;
}
    $merchantId=$subdomain_tmp;
    //if($resultados[0]->ticketid==5200) {
            ?>
        <iframe allow="camera;microphone" scrolling="no"
        src="https://conversations.suricata.chat/<?php echo $merchantId;?>/t/<?php echo $resultados[0]->ticketid;?>?agentEmail=<?php echo session('emailusuario');?>" width="100%" class="border rounded-3" style="height: 650px!important;"></iframe>
        <script>
    // Función para verificar y pedir permiso de notificaciones
    async function requestNotificationPermission() {
      if ('Notification' in window) {
        let permission = Notification.permission;
        if (permission !== 'granted') {
          alert('El permiso de notificación fue denegado o no disponible.');
          permission = await Notification.requestPermission();
        }

        return permission === 'granted';
      }
      return false;
    }

    const originalTitleParent = document.title;
    function showWarning() {
      document.title = `🟡 ${originalTitleParent}`;
    }

    function restoreTitle() {
      document.title = originalTitleParent;
    }

    // Función para disparar la notificación push
    async function triggerPushNotification(title, body) {
      const hasPermission = await requestNotificationPermission();
      if (hasPermission) {
        const notification = new Notification(title, {
          body: body,
          icon: 'https://conversations.suricata.chat/assets/images/chat-254.png'
        });

        notification.onclick = () => {
            window.focus();          // Reenfocar la ventana (pestaña) principal
            notification.close();    // Cerrar la notificación
        };
      } else {
        console.log('Permiso de notificación no concedido.');
      }
    }

    // Escucha el mensaje enviado desde el iframe
    window.addEventListener('message', (event) => {
      const { title, body, action = '' } = event.data;
      if (action === 'triggerPushNotification') {
        triggerPushNotification(title, body);
      }
      if (action === 'triggerTitleWarn') {
        showWarning()
      }
      if (action === 'triggerTitleDefault') {
        restoreTitle()
      }
    });
  </script>
   

<div class="me-2">
<!-- CSS de Select2 -->
<!-- CSS de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" defer></script>

<!-- Script de Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

<!-- HTML del Select -->




</div>

