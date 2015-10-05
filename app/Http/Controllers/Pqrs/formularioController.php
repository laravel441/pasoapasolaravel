<?php namespace App\Http\Controllers\Pqrs;

use App\Http\Requests;
use App\Http\Requests\IngresoPqrsRequest;
use App\Http\Requests\EditarRespuestaRequest;
use App\Http\Controllers\Controller;
use App\sw_adjuntos_pqrs;
use App\sw_descargo;
use App\sw_vehiculo;
use App\sw_patio;
use App\sw_rutas;
use App\sw_area;
use App\sw_registro_pqrs;
use App\sw_respuesta_pqrs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Connection;
use Input;
use Illuminate\Support\Facades\Auth;
use DateTime;


class formularioController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $id =Auth::user()->usr_id;
        $menus = \DB::select('select * from
                            fn_get_modules(?)',array($id));

        $registros =  \DB::select('select * from fn_pendientes_pqrs() ');
        ///Consultas para las Listas desplegables
        $canales = \DB::select('select * from sw_canal_pqrs');
        $tipos = \DB::select('select * from sw_tipo_pqrs');
        $incidencias = \DB::select(' select * from sw_incidencia_pqrs');
        $rutas = \DB::select('select * from sw_rutas');
        $estados = \DB::select('select * from sw_estado_pqrs');
        $prioridad = \DB::select('select * from sw_prioridad_pqrs');
        $vehiculos = \DB::select('select * from sw_vehiculo');
        $patios = \DB::select('select * from sw_patio');
        $areass = \DB::select('select * from sw_areas');
        $empl = \DB::select('select * from fn_operadores()');
        $consec = \DB::select("select max(pqrs_consecutivo_mc)+1 AS numero from sw_registro_pqrs where pqrs_num_requerimiento like 'MC%'");
        $num = $consec[0]->numero;
        if($num==null){
            $num=1;
        }


        return view('pqrs.registros.indexp',compact('menus','canales','tipos','incidencias','estados','prioridad',
            'vehiculos','patios','areass','registros','rutas','empl','x','num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $id =Auth::user()->usr_id;
        $menus = \DB::select('select * from
                            fn_get_modules(?)',array($id));

        return view('pqrs.registros.registro',compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(IngresoPqrsRequest $request)
    {
        $pqrs = new sw_registro_pqrs();
        $pqrs->pqrs_num_requerimiento       = $request->pqrs_num_requerimiento;
        $pqrs->pqrs_fecha_asignacion        = $request->fecha_asignacion;
        $pqrs->pqrs_consecutivo_mc          = $request->consecutivo;
        $pqrs->pqrs_fecha_hora_suceso       = $request->hora_fecha;
        $pqrs->pqrs_lugar                   = $request->lugar;
        $pqrs->pqrs_descripcion             = $request->descrip;
        $pqrs->pqrs_typ_id                  = $request->typo_id;
        $pqrs->pqrs_stp_id                  = $request->estap_id;
        $pqrs->pqrs_inc_id                  = $request->inciden_id;
        if(!$request->ruta_id=="")          $pqrs->pqrs_rut_id   = $request->ruta_id; else $pqrs->pqrs_rut_id =0;
        if(!$request->vehic_id=="")         $pqrs->pqrs_veh_id   = $request->vehic_id; else $pqrs->pqrs_veh_id = 0;
        $pqrs->pqrs_can_id                  = $request->canal_id;
        if(!$request->patio_id=="" )        $pqrs->pqrs_pto_id   = $request->patio_id; else $pqrs->pqrs_pto_id =0;
        $pqrs->pqrs_pri_id                  = $request->priorid_id;
        if(!$pqrs->pqrs_area_id =="")       $pqrs->pqrs_area_id   = $request->area_id;  else $pqrs->pqrs_area_id =0;
        $pqrs->pqrs_fecha_vencimiento       = $request->fecha_asignacion;
        if(!$request->afectado=="")         $pqrs->pqrs_afectado = $request->afectado; else $pqrs->pqrs_afectado="";
        if(!$request->celuar_afectado=="")  $pqrs->pqrs_num_celuar_afectado  = $request->celuar_afectado; else $pqrs->pqrs_num_celuar_afectado="";
        if(!$request->correo_afectado="")   $pqrs->pqrs_num_correo_afectado     = $request->correo_afectado; else $pqrs->pqrs_num_correo_afectado="";
        $pqrs->pqrs_creado_en               = new DateTime();
        $pqrs->pqrs_creado_por              = Auth::user()->usr_name;
        $pqrs->pqrs_modificado_en           = new DateTime();
        $pqrs->pqrs_modificado_por          = Auth::user()->usr_name;
        //$pqrs->pqrs_desc_id          = 0;
        $pqrs->pqrs_emp_an8          = 0;

        $pqrs ->save();

        $pqrs_id = \DB::select('select max(pqrs_id) from sw_registro_pqrs');
        $pqrs_id = $pqrs_id[0]->max;
        $array_nombre   =$_FILES["archivos"]['name'];
        $ruta1 = 'Z:\adjuntos_swcapital\pqrs_adjuntos ';
        $rutafac        = '\ ';
        $rutafac        = rtrim($rutafac);
        $ruta11         = rtrim($ruta1).$rutafac.$pqrs_id;
        if (!file_exists($ruta11)) {
            //dd($ruta11);

            mkdir($ruta11, 0777);
        }


        for($i=0;$i<count($_FILES["archivos"]['name']);$i++){
            $tmpFilePath = $_FILES["archivos"]['tmp_name'][$i];

            if ($tmpFilePath != ""){
                $ruta2 = $_FILES['archivos']['name'][$i];
                $ruta = $ruta11.$rutafac.$ruta2;
                if(move_uploaded_file($tmpFilePath, $ruta)){
                }
            }
        }

        if($array_nombre[0]== null){

        }else {
            foreach ($array_nombre as $datos){
                $ruta1 = 'Z:\adjuntos_swcapital\pqrs_adjuntos ';
                $pqrs_id    = $pqrs_id;
                $rutafac    = '\ ';
                $rutafac    = rtrim($rutafac);
                $ruta11     = rtrim($ruta1).$rutafac;
                $route      = $datos;
                $ruta       = $ruta11.$pqrs_id.$rutafac.$route;

                $adjunto_pqrs = new sw_adjuntos_pqrs;

                $adjunto_pqrs->adj_nombre              =   $datos;
                $adjunto_pqrs->adj_ruta                =   $ruta;
                $adjunto_pqrs->adj_pqrs_id             =   $pqrs_id;
                $adjunto_pqrs->adj_creado_en           =   new DateTime();
                $adjunto_pqrs->adj_creado_por          =   Auth::user()->usr_name;
                $adjunto_pqrs->adj_modificado_en       =   new DateTime();
                $adjunto_pqrs->adj_modificado_por      =   Auth::user()->usr_name;
                $adjunto_pqrs->save();
            }
        }

        Session::flash('message', 'Se ha Guardado Exitosamente la Solicitud ');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Request $request)
    {
        $iduser =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));

        $regi = sw_registro_pqrs::find($id);
        $pqrs_id= $regi->pqrs_id;
        $adj_pqrs = \DB::select('select adj_id as id, adj_ruta as ruta, adj_nombre as nombre from sw_adjuntos_pqrs where adj_pqrs_id ='.$id);
        $formato = array();
        foreach ($adj_pqrs as $archivo) {

            $formato[] = explode('.', $archivo->nombre);
        }
        $operador = \DB::select('select * from fn_operadores()');
        return view('pqrs.registros.indexrespuesta', compact('operador','menus','regi','pqrs_id','adj_pqrs','formato'));
    }
    public function saver(EditarRespuestaRequest $request){

        $descargo = new sw_descargo;
        $descargo->desc_emp_an8         = $request->emp_an8;
        $descargo->desc_descargo        = true;
        $descargo->desc_creado_en       = new DateTime();
        $descargo->desc_creado_por      = Auth::user()->usr_name;
        $descargo->desc_modificado_en   = new DateTime();
        $descargo->desc_modificado_por  = Auth::user()->usr_name;
        $descargo->save();

        $respuesta = new sw_respuesta_pqrs;
        $respuesta->rta_descripcion     = $request->rta_descripcion;
        $respuesta->rta_fecha_ingreso   = new DateTime();
        $respuesta->rta_creado_en       = new DateTime();
        $respuesta->rta_creado_por      = Auth::user()->usr_name;
        $respuesta->rta_modificado_en   = new DateTime();
        $respuesta->rta_modificado_por  = Auth::user()->usr_name;

        $respuesta->save();

        $registro = sw_registro_pqrs::find($request['escondido']);
        $registro->pqrs_rta_id          = $respuesta->rta_id;
        $registro->pqrs_desc_id         = $descargo->desc_id;
        $registro->pqrs_emp_an8         = $request->emp_an8;
        $registro->save();


        Session::flash('message', 'Se ha Guardado Exitosamente la Solicitud ');
        return redirect()->route('registros');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));

        $regis = sw_registro_pqrs::find($id);

        if ($regis->pqrs_fecha_hora_suceso == ''){

        }else{
            $regis->pqrs_fecha_hora_suceso = $regis->pqrs_fecha_hora_suceso;
        }




        $cnal_id = $regis->pqrs_can_id;
        $typo_id = $regis->pqrs_typ_id;
        $incp_id = $regis->pqrs_inc_id;
        $stpq_id = $regis->pqrs_stp_id;
        $priop_id = $regis->pqrs_pri_id;

        $canalnombre = \DB::select('select can_nombre from sw_canal_pqrs where can_id ='.$cnal_id);
        $tiponombre = \DB::select('select typ_nombre from sw_tipo_pqrs where typ_id ='.$typo_id);
        $incidencnombre = \DB::select('select inc_nombre from sw_incidencia_pqrs where inc_id ='.$incp_id);
        $estadonombre = \DB::select('select stp_nombre from sw_estado_pqrs where stp_id ='.$stpq_id);
        $priroridanombre = \DB::select('select pri_nombre from sw_prioridad_pqrs where pri_id ='.$priop_id);
        $canal_nombre= $canalnombre[0];
        $tipo_nombre= $tiponombre[0];
        $incidenc_nombre= $incidencnombre[0];
        $estado_nombre= $estadonombre[0];
        $prioridad_nombre= $priroridanombre[0];

        $canalesp = \DB::select('select * from sw_canal_pqrs');
        $tiposp = \DB::select('select * from sw_tipo_pqrs');
        $incidenciasp = \DB::select(' select * from sw_incidencia_pqrs');
        $estadosp = \DB::select('select * from sw_estado_pqrs');
        $prioridadesp = \DB::select('select * from sw_prioridad_pqrs');
        $rutasp = \DB::select('select * from sw_rutas');
        $vehiculosp = \DB::select('select * from sw_vehiculo');
        $patiosp = \DB::select('select * from sw_patio');
        $areasp = \DB::select('select * from sw_areas');
        $adj_pqrs = \DB::select('select adj_id as id, adj_ruta as ruta, adj_nombre as nombre from sw_adjuntos_pqrs where adj_pqrs_id ='.$id);
        $ruta_r     = sw_rutas::find($regis->pqrs_rut_id);
        $placa_r    = sw_vehiculo::find($regis->pqrs_veh_id);
        $patio_r    = sw_patio::find($regis->pqrs_pto_id);
        $patio_r    = sw_patio::find($regis->pqrs_pto_id);
        $area_r     = sw_area::find($regis->pqrs_area_id);

        $formato = array();
        foreach ($adj_pqrs as $archivo) {

            $formato[] = explode('.', $archivo->nombre);
        }


        return view('pqrs.registros.edit', compact( 'menus','idpqrs','regis','cnal_id','typo_id','incp_id','stpq_id','priop_id','rutap_id','vehp_id','ptop_id','arep_id',
            'canal_nombre','tipo_nombre','incidenc_nombre','estado_nombre','prioridad_nombre','ruta_nombre','vehiculo_nombre',
            'patio_nombre','area_nombre','canalesp','tiposp','incidenciasp','estadosp','prioridadesp','rutasp','vehiculosp',
            'patiosp','areasp','pqrsregs', 'ruta_r','placa_r','patio_r','area_r', 'adj_pqrs','formato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @internal param $int
     * @return Response
     */
    public function update(Request $request)
    {
        if($request->archivos!=null){



            $array_nombre=$_FILES["archivos"]['name'];
            $ruta1 = 'Z:\adjuntos_swcapital\pqrs_adjuntos ';
            $pqrs_id    = $request->pqrs_id;
            $rutafac = '\ ';
            $rutafac= rtrim($rutafac);
            $ruta11 = rtrim($ruta1).$rutafac.$pqrs_id;
            if (!file_exists($ruta11)) {

                mkdir($ruta11, 0777);
            }


            for($i=0;$i<count($_FILES["archivos"]['name']);$i++){
                $tmpFilePath = $_FILES["archivos"]['tmp_name'][$i];

                if ($tmpFilePath != ""){
                    $ruta2 = $_FILES['archivos']['name'][$i];
                    $ruta = $ruta11.$rutafac.$ruta2;
                    if(move_uploaded_file($tmpFilePath, $ruta)){
                    }
                }
            }

            if($array_nombre[0]== null){

            }else {
                foreach ($array_nombre as $datos){
                    $ruta1 = 'Z:\adjuntos_swcapital\pqrs_adjuntos ';
                    $pqrs_id    = $request->pqrs_id;
                    $rutafac    = '\ ';
                    $rutafac    = rtrim($rutafac);
                    $ruta11     = rtrim($ruta1).$rutafac;
                    $route      = $datos;
                    $ruta       = $ruta11.$pqrs_id.$rutafac.$route;

                    $adjunto_pqrs = new sw_adjuntos_pqrs;

                    $adjunto_pqrs->adj_nombre              =   $datos;
                    $adjunto_pqrs->adj_ruta                =   $ruta;
                    $adjunto_pqrs->adj_pqrs_id             =   $pqrs_id;
                    $adjunto_pqrs->adj_creado_en           =   new DateTime();
                    $adjunto_pqrs->adj_creado_por          =   Auth::user()->usr_name;
                    $adjunto_pqrs->adj_modificado_en       =   new DateTime();
                    $adjunto_pqrs->adj_modificado_por      =   Auth::user()->usr_name;
                    $adjunto_pqrs->save();
                }
            }
        }

        $regis = sw_registro_pqrs::find($request->pqrs_id);

        $regis->pqrs_fecha_asignacion = $request->pqrs_fecha_asignacion;

        $regis->pqrs_fecha_hora_suceso = $request->pqrs_fecha_hora_suceso;
        $regis->pqrs_lugar = $request->pqrs_lugar;
        $regis->pqrs_descripcion = $request->pqrs_descripcion;
        $regis->pqrs_typ_id = $request->pqrs_typ_id;
        $regis->pqrs_stp_id = $request->pqrs_stp_id;
        $regis->pqrs_inc_id = $request->pqrs_inc_id;
        $regis->pqrs_rut_id = $request->pqrs_rut_id;
        $regis->pqrs_veh_id = $request->pqrs_veh_id;
        $regis->pqrs_pto_id = $request->pqrs_pto_id;
        $regis->pqrs_area_id = $request->pqrs_area_id;
        $regis->pqrs_can_id = $request->pqrs_can;
        $regis->pqrs_pri_id = $request->pqrs_pri_id;
        $regis->pqrs_fecha_vencimiento = $request->pqrs_fecha_vencimiento;
        $regis->pqrs_afectado = $request->pqrs_afectado;
        $regis->pqrs_num_celuar_afectado = $request->pqrs_num_celuar_afectado;
        $regis->pqrs_num_correo_afectado = $request->pqrs_num_correo_afectado;
        $regis->pqrs_modificado_en = new DateTime();
        $regis->pqrs_modificado_por = Auth::user()->usr_name;

        $regis->save();
        $request->session()->flash('status', 'El registro se actualizo Exitosamente');
        return redirect()->route('registros');


    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}