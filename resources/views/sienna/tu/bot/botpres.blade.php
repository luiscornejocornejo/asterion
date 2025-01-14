<?php

foreach($datosempresa as $val){
$tipobot=$val->tipo;
}
    $merchantId=$subdomain_tmp;
    //if($resultados[0]->ticketid==5200) {
            ?>
        <iframe allow="camera;microphone" scrolling="no"
        src="https://conversations.suricata.chat/<?php echo $merchantId;?>/t/<?php echo $resultados[0]->ticketid;?>?agentMail=<?php echo session('emailusuario');?>" width="100%" class="border rounded-3" style="height: 650px!important;"></iframe>
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
   
<div class="<?php echo $vero; ?> d-flex justify-content-between mt-2 mb-2">
    <div></div>

    <div class="me-2">
        <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#open-conversation">
            <i class="mdi mdi-whatsapp me-1"></i>Reabrir conversación
        </button>
    </div>


</div>
<div class="me-2">
<!-- CSS de Select2 -->
<!-- CSS de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" defer></script>

<!-- Script de Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

<!-- HTML del Select -->
<select onChange="mos(this.options[this.selectedIndex].value)" class="form-select js-example-basic-single" aria-label="Default select example">
    <option>Seleccionar</option>
    <?php foreach($datosatajos as $val) { ?>
        <option value="<?php echo htmlspecialchars($val->contenido); ?>"><?php echo $val->nombre; ?></option>
    <?php } ?>
</select>


<!-- JavaScript para inicialización -->
<script>
    function mos(dd) {
        document.getElementById("cop").innerHTML = null;
        document.getElementById("cop").innerHTML = dd;
    }

    // Espera a que todo el DOM esté listo y las librerías estén cargadas
    document.addEventListener("DOMContentLoaded", function() {
        if ($.fn.select2) { // Verifica si select2 está disponible
            $('.js-example-basic-single').select2();
        } else {
            console.error("Select2 no se cargó correctamente");
        }
    });
</script>





</div>
<div class="me-2">
<textarea class="form-control" id="cop"></textarea>
</div>
