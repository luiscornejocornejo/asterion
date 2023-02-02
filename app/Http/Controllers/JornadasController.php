<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use Illuminate\Support\Facades\DB;
use Redirect;
use Flash;
use phpDocumentor\Reflection\PseudoTypes\False_;
use App\Project;
use App\ProjectProvider;
use App\Holiday;
use App\Provider;
use App\Helpers;
use App\FrameFunction;
use App\Librerias\Fpdf as LibreriasFPDF;
use App\Librerias\kkk as LibreriasFPDF2;



class JornadasController extends Controller
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

  public function vacaciones(Request $request)
  {
    $VACACIONESDESDE = $request->VACACIONESDESDE;
    $VACACIONESHASTA = $request->VACACIONESHASTA;
    $dateDifference = abs(strtotime($VACACIONESHASTA) - strtotime($VACACIONESDESDE));
    $daystotal   = floor($dateDifference  / (60 * 60 * 24));
    $usuarios = $request->VACACIONESUSUARIOS;
    $tipo = 1;
    $cambiarfecha = explode("-", $VACACIONESDESDE);
    $fechavolteada = $cambiarfecha[2] . "-" . $cambiarfecha[1] . "-" . $cambiarfecha[0];
    $timestamp = strtotime($fechavolteada);
    $idempresa = session('idempresa');
    for ($i = 1; $i < $daystotal + 1; $i++) {
      $diasmas = "+" . $i . " day";
      $manana = strtotime($diasmas, $timestamp);
      $mananaLegible = date("Y-m-d", $manana);
      for ($j = 0; $j < count($usuarios); $j++) {
        $query = "INSERT INTO `eventos`(`usuario`, `fechadesde`, `fechahasta`, `horainicio`, `horafinal`, `idproyecto`, `nota`, `motivo`, `francocompensatorio`, `tipo`) 
      VALUES ('" . $usuarios[$j] . "','" . $mananaLegible . "','" . $VACACIONESHASTA . "','0','0','" . $request->idproject . "','','',0,1)";
        $resultados = DB::select($query);
      }
    }
    return redirect()
      ->back()
      ->with('success', 'Se cargo las vacaciones  correctamente!');
  }
  public function feriados(Request $request)
  {

    $usuarios = $request->FERIADOSUSU;
    $FERIADOSFECHA = $request->FERIADOSFECHA;


    $tipo = 4;
    $idempresa = session('idempresa');

    for ($j = 0; $j < count($usuarios); $j++) {
      $query = "INSERT INTO `eventos`(`usuario`, `fechadesde`, `fechahasta`, `horainicio`, `horafinal`, `idproyecto`, `nota`, `motivo`, `francocompensatorio`, `tipo`) 
      VALUES ('" . $usuarios[$j] . "',now(),now(),'0','0','" . $request->idproject . "','" . $FERIADOSFECHA . "','',0,4)";
      $resultados = DB::select($query);
    }

    return redirect()
      ->back()
      ->with('success', 'Se cargo los feriados  correctamente!');
  }
  public function ausencias(Request $request)
  {
    $VACACIONESDESDE = $request->AUSENCIADESDE;
    $VACACIONESHASTA = $request->AUSENCIAHASTA;
    $AUSENCIAMOTIVO = $request->AUSENCIAMOTIVO;
    $AUSENCIANOTA = $request->AUSENCIANOTA;

    $AUSENCIANCOMPENSATORIO = $request->AUSENCIANCOMPENSATORIO;


    $dateDifference = abs(strtotime($VACACIONESHASTA) - strtotime($VACACIONESDESDE));
    $daystotal   = floor($dateDifference  / (60 * 60 * 24));
    $usuarios = $request->AUSENCIAUSUARIOS;
    $tipo = 2;
    $cambiarfecha = explode("-", $VACACIONESDESDE);
    $fechavolteada = $cambiarfecha[2] . "-" . $cambiarfecha[1] . "-" . $cambiarfecha[0];
    $timestamp = strtotime($fechavolteada);
    $idempresa = session('idempresa');
    for ($i = 0; $i <= $daystotal; $i++) {
      $diasmas = "+" . $i . " day";
      $manana = strtotime($diasmas, $timestamp);
      $mananaLegible = date("Y-m-d", $manana);
      for ($j = 0; $j < count($usuarios); $j++) {
        $query = "INSERT INTO `eventos`(`usuario`, `fechadesde`, `fechahasta`, `horainicio`, `horafinal`, `idproyecto`, `nota`, `motivo`, `francocompensatorio`, `tipo`) 
      VALUES ('" . $usuarios[$j] . "','" . $mananaLegible . "','" . $VACACIONESHASTA . "','','','" . $request->idproject . "','" . $AUSENCIANOTA . "','" . $AUSENCIAMOTIVO . "','" . $AUSENCIANCOMPENSATORIO . "',3)";
        $resultados = DB::select($query);
      }
    }
    return redirect()
      ->back()
      ->with('success', 'Se cargo las ausencias  correctamente!');
  }
  public function horas(Request $request)
  {
    $VACACIONESDESDE = $request->HORASDESDE;
    $VACACIONESHASTA = $request->HORASHASTA;
    $HORASINICIO = $request->HORASINICIO;
    $HORASFINAL = $request->HORASFINAL;
    $dateDifference = abs(strtotime($VACACIONESHASTA) - strtotime($VACACIONESDESDE));
    $daystotal   = floor($dateDifference  / (60 * 60 * 24));
    $usuarios = $request->HORASUSUARIOS;
    $tipo = 2;
    $cambiarfecha = explode("-", $VACACIONESDESDE);
    $fechavolteada = $cambiarfecha[2] . "-" . $cambiarfecha[1] . "-" . $cambiarfecha[0];
    $timestamp = strtotime($fechavolteada);
    $idempresa = session('idempresa');
    for ($i = 0; $i <= $daystotal; $i++) {
      $diasmas = "+" . $i . " day";
      $manana = strtotime($diasmas, $timestamp);
      $mananaLegible = date("Y-m-d", $manana);
      for ($j = 0; $j < count($usuarios); $j++) {
        $query = "INSERT INTO `eventos`(`usuario`, `fechadesde`, `fechahasta`, `horainicio`, `horafinal`, `idproyecto`, `nota`, `motivo`, `francocompensatorio`, `tipo`) 
      VALUES ('" . $usuarios[$j] . "','" . $mananaLegible . "','" . $VACACIONESHASTA . "','" . $HORASINICIO . "','" . $HORASFINAL . "','" . $request->idproject . "','','',0,2)";
        $resultados = DB::select($query);
      }
    }
    return redirect()
      ->back()
      ->with('success', 'Se cargo las horas extras  correctamente!');
  }

  public function view(Request $request)
  {
    //  $query = "select u.id as idusuario,u.name as nombreusuario,u.last_name as apellido,ff.name as funcionframe,ff.id_workers_category as categorias from users u join providers p ON u.id=p.id_user join provider_function_frame f ON f.id_provider=p.id join frame_functions ff on ff.id=f.id_frame;";
    $query = " ";
    $lista = DB::select($query);
    $idproyect = $request->id_project;
    return view('sienna/jornadas')
      ->with('idproyect', $idproyect)
      ->with('lista', $lista);
  }

  public function contrato($idcontrato)
  {
    $query = "select descripcion from framecontracts where id='" . $idcontrato . "'";
    $resultados = DB::select($query);
    foreach ($resultados as $value) {
      $descripcion = $value->descripcion;
    }
    return $descripcion;
 
  }
  public function pdfcontratos(Request $request)
  {
    $query = "SELECT c.id,c.name as nombreusuario,c.last_name,
    b.address,b.address_number,b.piso_depto,b.cp,b.location,
    d.name as funcionframe,
    c.birthdate,c.dni,
    e.name as nombredelproyecto,
    f.name as servicio,a.start_date_contract,a.id_contract
     FROM `frameproject_providers` a join frameproviders b on a.id_provider=b.id
      join users c on c.id=b.id_user join frame_functions d on a.id_function_frame=d.id
       join frameprojects e on e.id=a.id_project join framecontracts f on f.id=a.id_contract 
    where a.id_project='" . $request->idproyect . "' and c.id='" . $request->idusuario . "';";
    $resultados = DB::select($query);
    foreach ($resultados as $value) {

      $nombreusuario = $value->nombreusuario . " " . $value->last_name;
      $cumple = $value->birthdate;
      $funcionframe = $value->funcionframe;
      $servicio = $value->servicio;
      $serff = $servicio . " (" . $funcionframe . ")";
      $nombredelproyecto = $value->nombredelproyecto;
      $inicio = $value->start_date_contract;
      $id_contract = $value->id_contract;
      $dni = $value->dni;
      $address=$value->address;
      $address_number=$value->address_number;
      $piso_depto=$value->piso_depto;
      $cp=$value->cp;
      $location=$value->location;

      
    }
    $texto = $this->contrato($id_contract);
    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
    $subdomain_tmp =  array_shift($domainParts);

    $variableNOMBRE=$subdomain_tmp."NOMBRE";
    $variableDNI=$subdomain_tmp."DNI";
    $variableDIRECCION=$subdomain_tmp."DIRECCION";
    $variableALTURA=$subdomain_tmp."ALTURA";
    $variablePISO=$subdomain_tmp."PISO";
    $variableCP=$subdomain_tmp."CP";
    $variableLOCALIDAD=$subdomain_tmp."LOCALIDAD";
    
    $texto=str_replace($variableNOMBRE,$nombreusuario,$texto);
    $texto=str_replace($variableDNI,$dni,$texto);
    $texto=str_replace($variableDIRECCION,$address,$texto);
    $texto=str_replace($variableALTURA,$address_number,$texto);
    $texto=str_replace($variablePISO,$piso_depto,$texto);
    $texto=str_replace($variableCP,$cp,$texto);
    $texto=str_replace($variableLOCALIDAD,$location,$texto);


    $pdf = new LibreriasFPDF2();
    $pdf->AddPage();
    $pdf->SetFont('Arial');
    $pdf->WriteHTML(utf8_decode($texto));
    $nombrepdf=$nombreusuario.".pdf";
    $pdf->Output("D", $nombrepdf);
    /*
ut8_encode
    $pdf = new LibreriasFPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    //$pdf->Cell(40, 10, utf8_decode($texto));
    $pdf->Write(8, utf8_decode($texto));

    $pdf->Output("D", "pdfcontratos.pdf");*/
  }

  public function pdfrelease(Request $request)
  {

    $pdf = new LibreriasFPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    $texto = "En consideración de la contraprestación, cuya suficiencia y recepción se reconocen en el presente, con relación a mi designación por parte de FZERO S.R.L. (el 'CONTRATISTA') para prestar Servicios en beneficio de FZERO S.R.L.('FZERO'), por el presente acepto y reconozco que FZERO S.R.L. y sus subsidiarias, sucesores, cesionarios y licenciatarios (conjuntamente denominados 'FZERO') tendrán el derecho y la propiedad exclusiva de todos los resultados y los productos de mis Servicios en cualquier etapa de desarrollo (el 'Trabajo') y que los derechos exclusivos de FZERO S.R.L. incluyen, sin limitación, el derecho de autor y derechos conexos, el derecho de reproducción, el derecho de adaptación, el derecho de traducción, el derecho de doblaje y subtitulado, el derecho de exhibición, el derecho de promoción, el derecho de comunicación pública, el derecho de distribución, el derecho de crear obras derivadas y el derecho de alquilar y/o licenciar el Trabajo, libre de todo gravamen, reclamo y/o cargo (los 'Derechos').
      
    El Trabajo se considerará un 'trabajo por encargo' solicitado especialmente por FZERO S.R.L. y FZERO S.R.L. será considerado el autor exclusivo del Trabajo y el titular exclusivo de los Derechos sobre éste.
          
    Sin que ello signifique limitar lo antedicho, acepto que los Derechos incluyen, pero no se limitan a: el derecho de explotar (o no explotar) el Trabajo y todos los resultados de los Servicios, a perpetuidad, o durante el máximo período permitido por las leyes aplicables, en todo el universo, en cualquier idioma, en todos los medios, formas y tecnologías existentes o que puedan existir el futuro, en cualquier etapa de desarrollo (en adelante los 'Métodos de Explotación'), incluyendo, sin limitación: cines; teatros; televisión, incluyendo, sin limitarse a, analógica y digital, terrestre, por cable, satelital, de alta definición, televisión por protocolo de Internet ('IPTV'), y la retransmisión de cualquiera de los citados formatos televisivos mediante dispositivos inalámbricos (location free) o de acceso remoto, interactivos, pagos, gratuitos, pay per view, videos a la carta (video on demand), videos a la carta gratuitos (free video on demand), símiles videos a la carta (near video on demand), videos a la carta por suscripción (subscription video on demand);      todas las formas de explotación de video lineales e interactivas, incluyendo, sin limitación, cintas de video (por ejemplo VHS, DAT), discos ópticos (por ejemplo DVD, Blu-Ray, HD-DVD, DVD de alta densidad y cualquier otro tipo de discos de alta densidad, discos compactos de video y discos láser), decodificadores, DVR, PVR y otros dispositivos o sistemas que soporten servicios de menús desplegables (push down) y 'plegables' (pull down); contenidos adicionales y menús de navegación; productos, medios y servicios de computación e interactivos (incluso juegos) incluyendo, pero sin limitarse a, CD-ROM, DVD-ROM, Internet (y otros formatos de entrega y transmisión de paquetes de datos), ethernet, banda ancha, dispositivos inalámbricos y/o celulares (incluyendo, sin limitarse a, teléfonos, computadores, asistentes de datos personales y dispositivos personales y portátiles); bases de datos de servidores de medios; consolas de video juegos incluyendo, pero sin limitarse a, sistemas de almacenamiento ópticos, sistemas a cartucho, sistemas de videojuegos de mano;      todas las formas de explotación fonográfica o de audio, incluyendo, pero sin limitarse a, CD, CD-Plus, CD-Extra, mini-Disc, DVD Audio, DAT, casetes; todas las formas de audio digital y archivos computarizados, servicios de música por cable, satelital y por Internet, reproducción en tiempo real (streaming) y descarga (downloading), en cualquier formato (por ejemplo bandas sonoras, simples, compilaciones); ringtones (tonos de llamada monofónicos y/o polifónicos), tonos reales (realtones), ringbacktones, ringtones de video; productos, chips y software de redes de computadoras; sonido y audio digital y transferencias de video incluyendo, pero sin limitarse a, reproducción en tiempo real (streaming) y descargas (downloading) en cualquier formato o codificación (codec); otros servicios multimedia, interactivos, a la carta u online, independientemente de su tipo de plataforma o método de almacenamiento o transmisión; no teatrales, incluyendo, sin limitarse a, entretenimiento a bordo, en cruceros y hoteles; todas las formas de radio;      actuaciones en vivo y presentaciones en público o privadas (por ejemplo, shows en escenarios, shows sobre hielo, parques temáticos, centros comerciales); todas las formas de productos de consumo y publicaciones (incluyendo, envases) para los cuales se usen contenidos impresos o grabados, incluyendo, sin limitarse a, libros, revistas, libros y juguetes que hablen/canten, karaoke, productos educativos, video juegos; y publicidades y promociones, incluyendo, sin limitarse a, clips de audio y video, 'pop ups', avances, publicidad gráfica, comerciales, infomerciales, y promociones conjuntas de productos o servicios relacionados o no, independientemente del método o modo de entrega o transmisión.
          
    Acepto y reconozco que en el futuro pueden surgir o reconocerse nuevos derechos sobre el Trabajo conforme a las leyes aplicables y/o bajo cualquier sistema jurídico (en adelante, los 'Nuevos Derechos de Explotación') y tengo la voluntad y por el presente le otorgo y cedo a FZERO S.R.L. todos y cada uno de tales Nuevos Derechos de Explotación en y sobre el Trabajo.
          
    Tengo conocimiento y, por el presente, acepto que nuevos (o modificados) (1) usos, (2) tecnologías, (3) medios, (4) formatos, (5) modos de transmisión y (6) métodos de distribución, difusión, exhibición o representación (en adelante, los 'Nuevos Derechos de Explotación') se están desarrollando y continuarán, inevitablemente, desarrollándose en el futuro, los cuales brindarán nuevas oportunidades para explotar el Trabajo y tengo la voluntad y por el presente le otorgo y cedo a FZERO S.R.L. todos y cada uno de los Derechos y los Nuevos Derechos de Explotación sobre dichos Nuevos Métodos de Explotación.
          
    En caso de que el Trabajo en su totalidad o parcialmente no se considere 'trabajo por encargo' por el presente cedo y/u otorgo a FZERO S.R.L. todos los derechos de cualquier naturaleza actualmente conocidos o que en adelante pudieran surgir en relación con el Trabajo, incluyendo sin limitarse a, los Derechos y/o los Nuevos Derechos de Explotación, en todo el universo, a perpetuidad, (o por el mayor período autorizado por las leyes aplicables, si fuere más corto), en todos los idiomas y para todos los medios existentes o por crearse, incluyendo sin limitación, los Métodos de Explotación y/o los Nuevos Métodos de Explotación y sin que ello genere derecho a pago de regalía alguna.
          
    En caso de que cualquiera de los Derechos y/o Nuevos Derechos de Explotación no fuera irrevocablemente cedido o de otro modo transferido a FZERO S.R.L., por el presente otorgo una licencia a FZERO S.R.L. sobre todos los derechos, incluyendo sin limitarse a, los Derechos y/o los Nuevos Derechos de Explotación, en todo el universo, a perpetuidad, (o por el mayor período autorizado por las leyes aplicables, si fuere más corto), en todos los idiomas y para todos los medios existentes o por crearse, incluyendo sin limitación, los Métodos de Explotación y/o los Nuevos Métodos de Explotación y sin que ello genere derecho a pago de regalía alguna.
          
    Acepto y ratifico que no me opondré ni interferiré con los Derechos de FZERO, la validez de este instrumento o la transferencia de Derechos, acuerdos u otras estipulaciones de este instrumento. Acuerdo suscribir todos los documentos y realizar todos los actos que FZERO S.R.L. considere necesarios a los efectos de perfeccionar este instrumento, confirmar la existencia del mismo y de concretar mi voluntad de otorgar los Derechos a FZERO.
          
    Sin limitar la generalidad de lo antedicho, FZERO S.R.L. tendrá derecho a editar, alterar, agregar a, sustraer de, adaptar o de otra forma disponer de, el Trabajo, y bien a no hacer uso, o hacer uso total o parcial, del mismo según lo desee en cualquier momento y en base a su propio criterio y discreción.
          
    En este acto acuerdo indemnizar a FZERO S.R.L. contra todos los reclamos, acciones, pérdidas, daños y perjuicios, sentencias, responsabilidades y costos (inclusive los honorarios razonables de los abogados) que se originen en cualquier incumplimiento o presunto incumplimiento de este acuerdo, de mi parte. Acepto y reconozco que los recursos que poseo ante un eventual incumplimiento de FZERO S.R.L.se limitan al derecho a reclamar daños y perjuicios e irrevocablemente renuncio a cualquier tipo de medida precautoria y/o cautelar y/o urgente que permita preliminarmente impedir la comercialización, reproducción, comunicación, exhibición y/o cualquier otra forma de explotación del Trabajo.
          
    Renuncio y/o cedo a FZERO S.R.L. hasta el máximo permitido por la legislación aplicable los derechos morales actualmente reconocidos o que puedan reconocerse en el futuro, por costumbres, usos o leyes. Acuerdo que (i) no presentaré a FZERO, sus afiliadas y/o sucesoras, reclamo alguno basado en mi derecho moral a oponerme a cualquier tipo de modificación, revisión, deformación o alteración del Trabajo, siempre que mi honor o reputación no se vea afectado por las mismas; (ii) FZERO, sus afiliadas y/o sucesoras, determinarán el volumen, el tipo, la colocación y otros aspectos de los créditos que se me puedan otorgar en relación con la explotación del Trabajo; y (iii) FZERO S.R.L. tiene la      facultad de decidir cuándo y cómo explotar el Trabajo. Las antedichas renuncias al derecho de presentar reclamos basados en el derecho de paternidad sobre el Trabajo y/o la integridad del mismo continuarán en vigencia durante todo el período de protección de los Derechos y los Nuevos Derechos de Explotación correspondientes. Acepto el uso de los Derechos por parte de FZERO S.R.L. o de aquellos terceros debidamente autorizados por FZERO S.R.L.
          
    Reconozco y acepto que la invalidez de algún término o alguna disposición del presente no afectará los restantes términos, los cuales continuarán en plena vigencia tal como si el término o la disposición no válida no formase parte de este instrumento.
          
    Entiendo que durante la prestación de mis Servicios, podré tener acceso a cierta información o material de propiedad de o relacionada con FZERO S.R.L. que no sea accesible o conocida por el público en general ('Información Confidencial'). Con respecto a ello convengo que: (a) no utilizaré, directa ni indirectamente, la Información Confidencial para ningún fin ajeno al cual fui contratado, y que (b) no divulgaré, directa ni indirectamente, dicha Información Confidencial a ninguna persona, empresa, sociedad, asociación u otra entidad por ninguna razón o propósito. A su vez entiendo que cualquier violación o intento de violación a las condiciones precedentes podría causar a FZERO S.R.L. un daño irreparable y en consecuencia, FZERO S.R.L. tendrá derecho a solicitar las medidas precautorias que estime pertinentes.
          
    Reconozco y acuerdo que, las marcas, logos, personajes y diseños y toda otra propiedad intelectual perteneciente a FZERO S.R.L.es extremadamente valiosa, y que un uso no autorizado o impropio de la misma podría causar un daño sustancial a FZERO S.R.L. Por lo tanto no los utilizaré ya sea en forma directa o indirecta o cualquier variación de los mismos (ya sea en forma individual, en conjunto o como parte de otra palabra o nombre) ni el nombre de cualquier compañía subsidiaria o afiliada de FZERO, como así tampoco ninguno de los personajes o diseños pertenecientes a FZERO o de alguna de sus compañías relacionadas, afiliadas o subsidiarias, en ninguna campaña de publicidad, promoción, comercio u otros comunicados o discusiones o para expresar o implicar algún tipo de endoso o prueba de mis Servicios o productos o de un tercero,      aún después de la terminación de la prestación de mis Servicios, ya sea de cualquier forma o para cualquier propósito salvo expresa autorización de FZERO S.R.L. por escrito. La presente prohibición incluye sin que ello implique una limitación, los comunicados de prensa, materiales de comercialización y lista de clientes.
          
    Sin limitar nada de lo establecido más arriba, otorgo a FZERO S.R.L. el derecho a utilizar, directa o indirectamente, mi imagen, apariencia, fotografía, comentarios, nombre, acción y/o voz en relación con el Trabajo y/o los Servicios, incluyendo sin limitarse su promoción. Acuerdo participar en cualquier actividad promocional a la que sea invitado por FZERO, incluyendo pero no limitado a, conferencias de prensa, eventos públicos, etc.
          
    Por último, acuerdo que no seré acreedor de ninguna contraprestación adicional como consecuencia del ejercicio de los derechos otorgados en el presente.
          
    Certifico y declaro que he leído el texto precedente y entiendo acabadamente el significado y efecto del mismo y con la intención de quedar obligado legalmente firmo esta autorización a los _________ días del mes de _____________________ de_______________
          
            
        * Firma:
            
        * Aclaración: 
            
        * Documento de identidad N°: 
          ";
    $pdf->Cell(80, 10, "ACUERDO DE TITULARIDAD DE LA OBRA");
    $header = array('Nombre', 'FecNac', 'Proyecto', 'Servicios', 'Fecha');
    $query = "SELECT c.id,c.name as nombreusuario,c.last_name,
    d.name as funcionframe,c.birthdate,e.name as nombredelproyecto,
    f.name as servicio,a.start_date_contract
     FROM `frameproject_providers` a join frameproviders b on a.id_provider=b.id
      join users c on c.id=b.id_user join frame_functions d on a.id_function_frame=d.id
       join frameprojects e on e.id=a.id_project join framecontracts f on f.id=a.id_contract 
    where a.id_project='" . $request->idproyect . "' and c.id='" . $request->idusuario . "';";
    $resultados = DB::select($query);
    foreach ($resultados as $value) {

      $nombreusuario = $value->nombreusuario . " " . $value->last_name;
      $cumple = $value->birthdate;
      $funcionframe = $value->funcionframe;
      $servicio = $value->servicio;
      $serff = $servicio . " (" . $funcionframe . ")";
      $nombredelproyecto = $value->nombredelproyecto;
      $inicio = $value->start_date_contract;
    }
    $data = array($nombreusuario, $cumple, $nombredelproyecto, $serff, $inicio);

    $pdf->SetY(20);

    $this->BasicTable($header, $data, $pdf);

    $pdf->SetY(70);
    $pdf->SetFont('Arial', 'I', 12);

    $pdf->Write(8, utf8_decode($texto));

    $titulo = $nombreusuario . "pdfrelease.pdf";
    $pdf->Output("D", $titulo);
  }

  public function BasicTable($header, $data, $pdf)
  {
    // Header
    $y = $pdf->GetY();
    $eje = 0;
    foreach ($header as $col) {
      $pdf->Cell(40, 7, $col, 1);
      $pdf->Cell(150, 7, utf8_decode($data[$eje]), 1);
      $pdf->Ln();
      $eje++;
    }
    // Data
    $pdf->SetFont('Arial', 'I', 6);
    /*
    foreach ($data as $row) {
      
        $pdf->Cell(40,7, $row, 1);
        $pdf->Ln();
    }*/
  }
  public function list(Request $request)
  {


    $project = Project::find($request->projects);
    $listTeam = ProjectProvider::where('id_project', $request->projects)
      ->where('active', '1')
      ->get();

    foreach ($listTeam as $crew) {
      // name crew
      // posicion frame/sat
      $crew->name_user = Provider::getNameOrderLastName($crew->id_provider) . " (" . Helpers::getDateParseFormat($crew->start_date_contract, '/') . " - " . Helpers::getDateParseFormat($crew->finish_date_contract, '/') . ")";
      $crew->function_frame_name = FrameFunction::getName($crew->id_function_frame);
      $crew->function_frame_color = FrameFunction::getColor($crew->id_function_frame);
    }

    $query = "select id,name,last_name from users where id in
     ( SELECT id_user FROM `frameproviders` where id in( SELECT id_provider FROM `frameproject_providers` 
     where id_project='" . $request->projects . "' group by id_provider ) ) ORDER BY `users`.`id` ASC";

    $usuariossinrepetir = DB::select($query);

    return view('sienna/jornadas', [
      'project' => $project,
      'list_crew' => $listTeam,
      'holidays' => Holiday::where('active', '1')->get(),
      'usuariossinrepetir' => $usuariossinrepetir,
      'idproject' => $request->projects
    ]);

    /*

        echo $request->projects;
        $query = "select * from projects where id='".$request->projects."'";
       $lista = DB::select($query);
        return view('frame/jornadas')
        ->with('project', $lista);*/
    /*
         

       //dd($lista);
       $query2="SELECT id,name FROM `workdays` where active='1'       ";
       $lista2 = DB::select($query2);
       $query3="SELECT * FROM `contracts`     ";
       $lista3 = DB::select($query3);

       

        return view('frame/jornadas')
        ->with('lista3', $lista3)
        ->with('lista', $lista)
        ->with('idproyect',$request->id_project)
        ->with('lista2', $lista2);*/
  }
}
