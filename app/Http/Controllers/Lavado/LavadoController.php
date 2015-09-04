<?php namespace App\Http\Controllers\Lavado;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\sw_empleado;
use App\sw_registro_lavado;
use App\sw_usuario;
use App\sw_ctl_lavado;
use App\sw_det_lavado;
use App\sw_adjunto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


use App\User;
use Illuminate\Http\Request;

use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DateTime;

use DateInterval;
use Carbon\Carbon;
use Faker\Factory as Faker;

class LavadoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct()
    {
        $this->middleware('auth');

    }
	public function index(Request $request)
	{
        //dd($request->all);
        $id =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($id));



        $ctls = sw_ctl_lavado::join('sw_usuarios AS su','sw_ctl_lavado.ctl_usr_id','=','su.usr_id')
                                ->join('sw_patio AS spatio', 'sw_ctl_lavado.ctl_pto_id', '=', 'spatio.pto_id')
                                 ->join('sw_proveedor AS sprovee', 'sw_ctl_lavado.ctl_pve_an8', '=', 'sprovee.pvd_an8')
                                ->select('sw_ctl_lavado.ctl_id','su.usr_id','su.usr_name','spatio.pto_nombre',
                                         'sw_ctl_lavado.ctl_fecha_inicio','sw_ctl_lavado.ctl_fecha_fin','sprovee.pvd_nombre')

            ->where ('ctl_usr_id',$id)
            ->orderBY('ctl_id', 'DESC')
            ->control($request->get('control'))
            ->paginate(5);




//dd($ctls);


        $usr_name = Auth::user()->usr_name ;

        $patios = \DB::select('select * from sw_patio where pto_bandera =\'' .'TRUE'. '\'');

        $proveedores = \DB::select('select * from sw_proveedor where pvd_mpv_id = 1 '); //proveedores Lavado

        return view('lavado.index',compact('menus','ctls','patios','proveedores','usr_name'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//dd($request->all());

        $re = is_numeric($request->pto_id) && is_numeric($request->prove_id);

        if ($re == 0){
            Session::flash('message2', 'Debe Seleccionar un Patio y Proveedor');
            return redirect()->back();
        }


        $control = new sw_ctl_lavado();
        $control->fill($request->all());

        $control->ctl_usr_id = Auth::user()->usr_id;
        $control->ctl_pto_id = ($request->pto_id);
        $control->ctl_pve_an8 = ($request->prove_id);
        $control->ctl_fecha_inicio =new DateTime();
        $control->ctl_fecha_fin = new DateTime('0001-01-01 00:00:00');
        $control->ctl_creado_en = new DateTime();
        $control->ctl_creado_por =Auth::user()->usr_name;
        $control->ctl_modificado_en = new DateTime();
        $control->ctl_modificado_por =Auth::user()->usr_name;
        //dd($control);
        $control->save();

        Session::flash('message', 'Se ha creado en nuevo control. ID: '.$control->ctl_id );

        return redirect()->route('lavado.edit',compact('control'));

    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id)
	{
        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));

        //dd($menus);

        $ctl = sw_ctl_lavado::find($id);

        $pto_id = $ctl->ctl_pto_id;
        $pvd_id = $ctl->ctl_pve_an8;


        $ptonombre = \DB::select('select pto_nombre from sw_patio where pto_id ='.$pto_id);
        $pvdnombre = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pvd_id);

        $pto_nombre= $ptonombre[0];
        $pvd_nombre= $pvdnombre[0];

        //dd($ptonombre);
        $usr_name = Auth::user()->usr_name ;

        //dd($ctl_id);
        $acciones = \DB::select('select * from sw_accion_lavado
        ');

        $patios = \DB::select('select * from sw_patio where pto_bandera =\'' .'TRUE'. '\'');
        $vehiculos = \DB::select('select * from sw_vehiculo
        ');
        $proveedores = \DB::select('select * from sw_proveedor where pvd_mpv_id = 1');

        //dd($vehiculos);

        return view('lavado.updatectl',compact('menus','usr_name','acciones','vehiculos','id','pto_nombre','pvd_nombre','patios','proveedores'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request, $id)
	{
        //dd($id);
        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));

        //dd($menus);

        $ctl = sw_ctl_lavado::find($id);

        $pto_id = $ctl->ctl_pto_id;
        $pvd_id = $ctl->ctl_pve_an8;


        $ptonombre = \DB::select('select pto_nombre from sw_patio where pto_id ='.$pto_id);
        $pvdnombre = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pvd_id);

        $pto_nombre= $ptonombre[0];
        $pvd_nombre= $pvdnombre[0];

        //dd($ptonombre);
        $usr_name = Auth::user()->usr_name ;

               //dd($ctl_id);
        $acciones = \DB::select('select * from sw_accion_lavado
        ');


        $vehiculos = \DB::select('select * from sw_vehiculo
        ');

        //dd($vehiculos);

        return view('lavado.edit',compact('menus','usr_name','acciones','vehiculos','id','pto_nombre','pvd_nombre'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
    {
        //dd($request->all());

        $veh_name = strtoupper(trim($request->vehi_name));

        $veh_id= \DB::select('select veh_id from sw_vehiculo where veh_movil = \'' . $veh_name . '\'');


        if (empty($veh_id)){
            Session::flash('message3', 'El Movil '. $veh_name .' no existe o no se encuentra en nuestros registros.');
            return redirect()->back();
        }

        //dd($request->all(),$veh_name,);
        //$nombre=$request->archivos;
        $id = $request->reg_ctl_id;
        $ctlactual[] = $request->reg_ctl_id;
        //$vehmovil= \DB::select('select veh_movil from sw_vehiculo where veh_id ='.$request->vehi_id);
        $vehmov= $veh_name;

        $ctl = sw_ctl_lavado::find($id);
        //dd($ctl);
        $ctlfechainicio = $ctl->ctl_fecha_inicio;

        $datef = Carbon::createFromFormat('Y-m-d H:i:s',$ctlfechainicio);
        $datef =$datef->subHours(8);
        $datei = Carbon::createFromFormat('Y-m-d H:i:s',$ctlfechainicio);
        $datei = $datei->addHours(8);

        $fechai = date_format($datei,'Y-m-d H:i:s');
        $fechaf = date_format($datef,'Y-m-d H:i:s');

        //dd($fechai,$fechaf);

        $rangoctls= \DB::table('sw_ctl_lavado')->whereBetween('ctl_fecha_inicio', array($fechaf, $fechai))->orderBy('ctl_fecha_inicio', 'DESC')->get();

        //dd($rangoctls);
        foreach ($rangoctls as $rangoctl){
            $ctlsturnosa[] = $rangoctl->ctl_id;
        }



        $ctlsturnos = array_diff($ctlsturnosa,$ctlactual);



        //$v = 100004; //Id vehiculo quemado

        $e= 0;
        $f = 0;
        foreach($ctlsturnos as $ctlsturno) {
            $x = \DB::select('select reg_veh_id from sw_registro_lavado where reg_ctl_id = ' . $ctlsturno.' AND reg_veh_id = '.$veh_id[0]->veh_id);
            if (empty ($x)){
                $f = $f+1;
            }else {
                $g = \DB::select('select reg_creado_por from sw_registro_lavado where reg_ctl_id = ' . $ctlsturno.' AND reg_veh_id = '.$veh_id[0]->veh_id);
                $e = $e+1;
            }
        }

        //dd($f,$e,$g[0]->reg_creado_por);

        $zmovil[] = $veh_id[0]->veh_id;
        $zmoviles = \DB::select('
                            select * from
                            fn_registro(?)', array($id));

        //dd($zmoviles);
        if(empty($zmoviles)) {
            $zmovs=[];
            $zmov =array_sum($zmovs);


        }else{
            foreach ($zmoviles as $zmovile) {
                $zmovils[] = $zmovile->veh_id;
            }
            $zmovs = array_intersect($zmovils, $zmovil);
            $zmov =array_sum($zmovs);
        }



//        echo 'primer registro';
//


        if($zmov != 0 and $e != 0 ){

            Session::flash('message3', 'El Movil '. $vehmov .' se encuentra registrado en este control y en otro en el mismo turno.');
            return redirect()->back();
        }elseif ($zmov!= 0 and $e==0){

            Session::flash('message3', 'El Movil '. $vehmov .' ya se encuentra registrado en el control.');
            return redirect()->back();
        }elseif($zmov == '0'  and $e != 0){

            Session::flash('message3', 'El Movil '. $vehmov .' ya se encuentra registrado en otro control en el mismo turno. Usuario: '. strtoupper($g[0]->reg_creado_por) .'');

            return redirect()->back();
        }elseif($zmov == '0' and $e=='0'){//validar ingreso registro....

            if ($_FILES["archivos"]['name'][0] != ""){
                for($i=0;$i<count($_FILES["archivos"]['size']);$i++){
                    $x = $_FILES["archivos"]['size'][$i];
                    if ($x > 2000000 or $x == 0){
                        Session::flash('message3', 'El archivo supera el tama&ntilde;o m&aacute;ximo de subida.');
                        return redirect()->back();
                    }
                }

                for($i=0;$i<count($_FILES["archivos"]['type']);$i++){
                    $y = $_FILES["archivos"]['type'][$i];
                    if ($y == "image/gif" || $y == "image/jpeg" || $y == "image/jpg"){

                    }else{
                        Session::flash('message3', 'El archivo que quiere adjuntar no es un formato de imagen.');
                        return redirect()->back();
                    }
                }



            }




            //if (empty($zmov)and $e=='0') {//Movil repetido en el control y en otros cntroles en el turno presente

            $array_bd = ($request->acciones_bd);
            $array_true = ($request->acciones);
            $uri = count($array_bd);
            if(count ($array_true)== $uri){
                $aprobacion = 'TRUE';
            }else{
                $aprobacion = 'FALSE';
            }

            //dd($array_true);
            if (empty($array_true)) {//se debe seleccionar un elemento de la lista
                Session::flash('message2', 'Para crear el Registro debe seleccionar un item de la Revisi&oacute;n Externa y/o Interna.');
                return redirect()->back();
            } else {
                $array_false = array_diff($array_bd, $array_true);
                //dd($array_false);

                $registro = new sw_registro_lavado();
                $registro->fill($request->all());
                $registro->reg_veh_id = $veh_id[0]->veh_id;
                $registro->reg_aprobacion = $aprobacion;
                $registro->reg_observacion = $request->reg_observacion;
                $registro->reg_creado_en = new DateTime();
                $registro->reg_creado_por = Auth::user()->usr_name;
                $registro->reg_modificado_en = new DateTime();
                $registro->reg_modificado_por = Auth::user()->usr_name;

                $registro->save();


                //dd($registro);

                foreach ($array_true as $arreglotrue) {
                    $detalle = new sw_det_lavado();
                    $detalle->fill($request->all());
                    $detalle->det_reg_id = $registro->reg_id;
                    $detalle->det_acc_id = $arreglotrue;
                    $detalle->det_acc_estado = 'TRUE';
                    $detalle->det_creado_en = new DateTime();
                    $detalle->det_creado_por = Auth::user()->usr_name;
                    $detalle->det_modificado_en = new DateTime();
                    $detalle->det_modificado_por = Auth::user()->usr_name;
                    //dd($detalle);
                    $detalle->save();
                }
                foreach ($array_false as $arreglofalso) {
                    $detalle = new sw_det_lavado();
                    $detalle->fill($request->all());
                    $detalle->det_reg_id = $registro->reg_id;
                    $detalle->det_acc_id = $arreglofalso;
                    $detalle->det_acc_estado = 'FALSE';
                    $detalle->det_creado_en = new DateTime();
                    $detalle->det_creado_por = Auth::user()->usr_name;
                    $detalle->det_modificado_en = new DateTime();
                    $detalle->det_modificado_por = Auth::user()->usr_name;
                    //dd($detalle);
                    $detalle->save();
                }

//                if (empty($_FILES["archivos"]['name'][0])){
//                    Session::flash('message', 'Registro Exitoso.');
//                    return redirect()->route('lavado.edit', compact('id'));
//                }
                $idreg=$registro->reg_id;

                $array_nombre=$_FILES["archivos"]['name'];
                $ruta1 = 'Z:\adjuntos_swcapital\lavado\ ';
                $rutareg = '\ ';
                $rutareg = rtrim($rutareg);
                $ruta11 = rtrim($ruta1).$idreg.$rutareg;
                mkdir($ruta11, 0777);


           //dd(array_values($_FILES["archivos"]['size']));


                for($i=0;$i<count($_FILES["archivos"]['name']);$i++){

                    $tmpFilePath = $_FILES["archivos"]['tmp_name'][$i];


                    if ($tmpFilePath != ""){

                        //$ruta2 = $_FILES['archivos']['name'][$i];
                        $temp = explode(".", $_FILES["archivos"]["name"][$i]);

                        $newfilename = round(microtime(true)) .$i. '.' . end($temp);
                        $ruta = $ruta11.$newfilename;
                        //dd($_FILES["archivos"]["tmp_name"],$ruta);

                        //dd($ruta);
                        if(move_uploaded_file($_FILES["archivos"]["tmp_name"][$i], $ruta)){

                        }

                    }

                }
                $tmpname = $_FILES["archivos"]['tmp_name'];
                if($tmpname[0]== null){

                }else {


                    for($i=0;$i<count($_FILES["archivos"]['name']);$i++){
                        $ruta1 = 'Z:\adjuntos_swcapital\lavado\ ';
                        $rutareg = '\ ';
                        $rutareg = rtrim($rutareg);
                        $ruta11 = rtrim($ruta1).$idreg.$rutareg;
                        $temp = explode(".", $_FILES["archivos"]["name"][$i]);


                        $newfilename = round(microtime(true)) .$i. '.' . end($temp);
                        $ruta = $ruta11.$newfilename;


                        $archivo=new sw_adjunto;

                        $archivo->adj_reg_id=$idreg;
                        $archivo->adj_ruta =$ruta;
                        $archivo->adj_nombre=$newfilename;
                        $archivo->adj_creado_en= new DateTime();
                        $archivo->adj_creado_por =Auth::user()->usr_name;
                        $archivo->adj_modificado_en = new DateTime();
                        $archivo->adj_modificado_por =Auth::user()->usr_name;

                        $archivo->save();
                    }
                }







                //return Redirect::action('RegistroController@index');
                Session::flash('message', 'Registro Exitoso.');

                return redirect()->route('lavado.edit', compact('id'));

            }
        }else{
            return redirect()->back();
        }


    }

    //}

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