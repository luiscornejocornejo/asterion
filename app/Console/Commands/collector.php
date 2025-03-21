<?php

namespace App\Console\Commands;

use App\Models\cronmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Models\empresa;
use App\Models\categoria;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class collector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diario:collector';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'asignacion';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        echo "entro";
/*
        Artisan::call('config:clear');
        Artisan::call('config:cache');
    
        // Verificar que la conexión se está cargando correctamente
        dump(env('DB_DATABASE')); // Verifica que el .env se carga
        dump(Config::get('database.connections.mysql.database')); // Revisa configuración activa

        */
       
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
            // Unir la salida en una cadena
           // $resultado = implode("\n", $output);
           var_dump($output);

           $sal=$this->procesar_salida($output) ;
            var_dump($sal);
            /*
            return response()->json([
                'success' => true,
                'resultado' => $resultado,
            ]);*/
        } else {
            echo "error";
        }

        return 0;
    }
  
    public function procesar_salida2($salida) {
        // Inicializar la lista de datos
        $datos = [];
    
        // Dividir la salida en líneas
        $lineas = explode("\n", $salida);
    
        // Procesar cada línea
        foreach ($lineas as $linea) {
            // Ignorar líneas vacías o de separación
            if (empty(trim($linea)) || strpos($linea, "----") !== false) {
                continue;
            }
    
            // Ignorar la línea de encabezado
            if (strpos($linea, "ONT  Run") !== false) {
                continue;
            }
    
            // Dividir la línea en columnas
            $columnas = preg_split('/\s+/', trim($linea)); // Divide por espacios en blanco
    
            // Asegurarse de que la línea tenga suficientes columnas
            if (count($columnas) >= 7) {
                $ont_id = (int)$columnas[0];
                $run_state = $columnas[1];
                $last_uptime = $columnas[2] . " " . $columnas[3];
                $last_downtime = $columnas[4] . " " . $columnas[5];
                $last_downcause = $columnas[6];
    
                // Agregar a la lista de datos
                $datos[] = [
                    'ont_id' => $ont_id,
                    'run_state' => $run_state,
                    'last_uptime' => $last_uptime,
                    'last_downtime' => $last_downtime,
                    'last_downcause' => $last_downcause,
                ];
            }
        }
    
        return $datos;
    }

    function oldprocesar_salida($salida) {
        if (is_array($salida)) {
            //$salida = implode("\n", $salida);  // Convierte array en string
        }
        $port = null;
        $onts_status = [];
        $onts_details = [];
        $insertData = [];
    
        foreach ($salida as $line) {
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

    }
    
    function procesar_salida($salida) {
        // Asegurar que la salida es un array de líneas
        if (is_string($salida)) {
            $salida = explode("\n", $salida);
        }
        
        $port = null;
        $onts_status = [];
        $onts_details = [];
        $insertData = [];
    
        foreach ($salida as $line) {
            $line = trim($line);
    
            // Detectar el puerto GPON
            if (preg_match('/In port (\d+/\d+/\d+)/', $line, $matches)) {
                $port = $matches[1];
            }
            
            // Capturar información de estado de la ONT
            elseif (preg_match('/^(\d+)\s+(\w+)\s+(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\s+(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\s+(.+)/', $line, $matches)) {
                $onts_status[$matches[1]] = [
                    'port' => $port ?? 'Desconocido',
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
        
        // Insertar en la base de datos solo si hay datos válidos
        if (!empty($insertData)) {
            DB::table('onts')->insert($insertData);
            echo "Datos insertados correctamente.";
        } else {
            echo "No se encontraron datos válidos para insertar.";
        }
    }
    public function conectar()
    {
      
        config(['database.connections.mysql2.host' => 'db-mysql-sfo3-84622-do-user-4274947-0.b.db.ondigitalocean.com']);
        config(['database.connections.mysql2.port' => '25060']);

        config(['database.connections.mysql2.database' => 'infitelecom']);
        config(['database.connections.mysql2.username' => 'doadmin']);
        config(['database.connections.mysql2.password' => 'AVNS_WH2DodUlKTBZgYotOdO']);
    }

    public function conectar2($id)
    {
        $query = "SELECT * FROM `base`    where id='" . $id . "'";
        $resultados = DB::select($query);
        foreach ($resultados as $value) {

            $host = $value->host;
            $base = $value->base;
            $usuario = $value->usuario;
            $pass = $value->pass;
            $port = $value->port;

        }
        config(['database.connections.mysql3.host' => $host]);
        config(['database.connections.mysql3.port' => $port]);

        config(['database.connections.mysql3.database' => $base]);
        config(['database.connections.mysql3.username' => $usuario]);
        config(['database.connections.mysql3.password' => $pass]);
    }
}
