# This is a sample Python script.

# Press Mayús+F10 to execute it or replace it with your code.
# Press Double Shift to search everywhere for classes, files, tool windows, actions, and settings.


import paramiko
import time
import sys 
def ejecutar_comando_ssh(host, puerto, usuario, password, comandos):
    try:
        # Crear una instancia de SSHClient
        cliente = paramiko.SSHClient()
        cliente.set_missing_host_key_policy(paramiko.AutoAddPolicy())

        # Conectar al equipo
        cliente.connect(host, port=puerto, username=usuario, password=password)

        # Abrir un canal SSH
        canal = cliente.invoke_shell()

        # Enviar el comando
        for comando in comandos:
            canal.send(f"{comando}\n")
            canal.send("\n")
            time.sleep(4)  # Esperar a que el equipo procese el comando
        #canal.send(f"{comando}\n")

        # Esperar a que el comando se ejecute
        #time.sleep(2)

        # Leer la salida inicial
        salida = ""
        while True:
            if canal.recv_ready():
                # Leer la salida del canal
                salida += canal.recv(1024).decode("utf-8")
                time.sleep(1)
            else:
                break

            # Manejar la paginación
            if "---- More ( Press 'Q' to break ) ----" in salida:
                canal.send("\n")  # Enviar 'Q' para continuar
                time.sleep(2)
            

        # Cerrar la conexión
        cliente.close()

        return salida

    except Exception as e:
        return f"Error: {str(e)}"

# Parámetros de conexión


# Ejecutar el comando
# ejecutar_comando_ssh(host, puerto, usuario, password, comando)
# Press the green button in the gutter to run the script.
if __name__ == '__main__':
    #host = "45.182.127.135"
    #puerto = 2922
    #usuario = "root"
    #password = "#Demon51"
    comandos = ["scroll","enable","display ont info summary 0"]   
    host = sys.argv[1]
    puerto = sys.argv[2]
    usuario = sys.argv[3]
    password = sys.argv[4]
    resultado =ejecutar_comando_ssh(host, puerto, usuario, password, comandos)
    print(resultado)
    sys.exit()

# See PyCharm help at https://www.jetbrains.com/help/pycharm/
