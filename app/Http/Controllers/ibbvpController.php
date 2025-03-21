<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use Illuminate\Support\Facades\DB;
use Redirect;
use Flash;
use App\Models\users;
use App\Models\graficos;
use App\Models\equipos;
use App\Models\siennaloginxenioo;
use Mail; 
use App\Models\logs;

use phpDocumentor\Reflection\PseudoTypes\False_;
use App\Http\Controllers\LogsController;


use App\Models\ibbvp\canciones;
use App\Models\ibbvp\videos;
use App\Models\ibbvp\estudios;
use App\Models\ibbvp\estudio;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ibbvpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function canciones(Request $request)
    {
        $canciones = canciones::all();
        return view("sienna/canciones")->with('canciones', $canciones);

    }

    public function videos(Request $request)
    {
        $videos = videos::all();
        return view("sienna/videos")->with('videos', $videos);

    }
    public function estudios(Request $request)
    {
        $estudios = estudios::all();
        return view("sienna/estudios")->with('estudios', $estudios);

    }

    public function estudio(Request $request)
    {
        $id=$request->id;
        $estudio = estudio::where('padre', '=', $id)->get();

        return view("sienna/estudio")->with('estudio', $estudio);

    }


    //////asterion
    function ejecutarComandoSSH($equipo,$comando)
     {
        
         $usuario = $equipo->usuario;//"root";  // Usuario SSH
         $host = $equipo->ip;//"146.190.138.96"; // IP o dominio del servidor
         $puerto = $equipo->puerto;//22;        // Puerto SSH (por defecto es 22)
         $password =$equipo->pass;// "YmsZy2P7SeQetG"; // Tu contraseña SSH
     
         // Construir el comando SSH usando sshpass
         $sshComando = [
             'sshpass', '-p', $password,   // Pasar la contraseña
             'ssh', '-p', $puerto,         // Especificar puerto SSH
             '-o', 'StrictHostKeyChecking=no', // Omitir confirmación de clave del host
             "{$usuario}@{$host}",         // Usuario y servidor remoto
             $comando                      // Comando a ejecutar
         ];
     
         // Ejecutar el proceso
         $process = new Process($sshComando);
         $process->setTimeout(120); // Tiempo límite en segundos
     
         try {
             $process->run();
     
             if (!$process->isSuccessful()) {
                 throw new ProcessFailedException($process);
             }
     
             return $process->getOutput(); // Devuelve el resultado del comando
     
         } catch (ProcessFailedException $exception) {
             return "Error al ejecutar el comando: " . $exception->getMessage();
         }
     }
     function ejecutarComandoSSH2($equipo, $comandos) {
        $conexion = ssh2_connect($equipo->ip, $equipo->puerto);
    
        if (!$conexion) {
            return "Error: No se pudo conectar al servidor.";
        }
    
        if (!ssh2_auth_password($conexion, $equipo->usuario, $equipo->pass)) {
            return "Error: Autenticación fallida.";
        }
    
        // Ejecutar comandos en una sola sesión SSH
        $stream = ssh2_exec($conexion, implode(" && ", $comandos));
        stream_set_blocking($stream, true);
        $output = stream_get_contents($stream);
    
        fclose($stream);
        return $output;
    }
    public function prueba(Request $request)
    {
        // Ruta al script de Python
        $scriptPath = base_path('scripts/main.py');

        // Argumentos para el script (opcional)
        $nombre = '45.182.127.135 2922 root "#Demon51"';//$request->input('nombre', 'Mundo'); // Valor por defecto: "Mundo"

        // Comando para ejecutar el script
        $comando = "python3 {$scriptPath} {$nombre}";

        // Ejecutar el comando y capturar la salida
        exec($comando, $output, $return_var);

        // Verificar si la ejecución fue exitosa
        if ($return_var === 0) {
            $lines = explode("\n", $fileContent);

            $port = null;
            $onts_status = [];
            $onts_details = [];
            $insertData = [];
            foreach ($lines as $line) {
                $line = trim($line);
        
                // Detectar el puerto GPON
                if (preg_match('/In port (\d+/\d+/\d+)/', $line, $matches)) {
                    $port = $matches[1];
                }
                
                // Capturar información de estado de la ONT
                elseif (preg_match('/^(\d+)\s+(\w+)\s+(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\s+(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\s+(.+)/', $line, $matches)) {
                    $onts_status[$matches[1]] = [
                        'port' => $port,
                        'ont_id' => (int) $matches[1],
                        'run_state' => $matches[2],
                        'uptime' => $matches[3],
                        'downtime' => $matches[4],
                        'downcause' => trim($matches[5])
                    ];
                }
                
                // Capturar detalles técnicos de la ONT
                elseif (preg_match('/^(\d+)\s+([A-Z0-9]+)\s+([A-Z0-9-.]+)\s+(\d+)\s+([-\d.]+)/([-\d.]+)\s+(.+)/', $line, $matches)) {
                    $onts_details[$matches[1]] = [
                        'sn' => $matches[2],
                        'type' => $matches[3],
                        'distance' => (int) $matches[4],
                        'rx_power' => (float) $matches[5],
                        'tx_power' => (float) $matches[6],
                        'description' => trim($matches[7])
                    ];
                }
            }
            
            // Unir los datos por ONT ID
            foreach ($onts_status as $id => $status) {
                if (isset($onts_details[$id])) {
                    $insertData[] = array_merge($status, $onts_details[$id]);
                }
            }
            
            // Insertar en la base de datos
            DB::table('onts')->insert($insertData);
            
            echo "Datos insertados correctamente.";
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Error al ejecutar el script de Python.',
            ], 500);
        }
    }
   

}