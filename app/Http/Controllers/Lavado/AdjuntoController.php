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

class AdjuntoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        //dd($_FILES["archivos"]);
        $idreg = ($request->reg_id);
        $id = $request->reg_ctl_id;
        $ctlactual[] = $request->reg_ctl_id;

        //dd($request->vehi_id, $request->vehi_id_original);

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
        //dd($ctlsturnos,$ctlsturnosa);

        $veh_name = strtoupper(trim($request->vehi_name));

        $veh_id= \DB::select('select veh_id from sw_vehiculo where veh_movil = \'' . $veh_name . '\'');


        //dd($veh_name,$veh_id);
        if (empty($veh_id)){
            Session::flash('message3', 'El Movil '. $veh_name .' no existe o no se encuentra en nuestros registros.');
            return redirect()->back();
        }


        $e= 0;
        $f = 0;
        foreach($ctlsturnos as $ctlsturno) {
            $x = \DB::select('select reg_veh_id from sw_registro_lavado where reg_ctl_id =' . $ctlsturno.'AND reg_veh_id ='.$veh_id[0]->veh_id);
            if (empty ($x)){
                $f = $f+1;
            }else {
                $g = \DB::select('select reg_creado_por from sw_registro_lavado where reg_ctl_id = ' . $ctlsturno.' AND reg_veh_id = '.$veh_id[0]->veh_id);
                $e = $e+1;
            }
        }

            //dd($e,$g[0]);

        if ($veh_id[0]->veh_id != $request->vehi_id_original){
            $vehmovil= \DB::select('select veh_movil from sw_vehiculo where veh_id ='.$veh_id[0]->veh_id);
            $vehmov= $vehmovil[0];
            $zmovil[] = $veh_id[0]->veh_id;
            $zmoviles = \DB::select('
                            select * from
                            fn_registro(?)', array($id));
            foreach ($zmoviles as $zmovile) {
                $zmovils[] = $zmovile->veh_id;
            }
            $zmovs = array_diff($zmovil,$zmovils);//quital
            //$zmovs = array_intersect($zmovils, $zmovil);
            $zmov =array_sum($zmovs);
            $vehiupdate = $veh_id[0]->veh_id;





        }else{
            $vehmovil= \DB::select('select veh_movil from sw_vehiculo where veh_id ='.$request->vehi_id_original);
            $vehmov= $vehmovil[0];
            $zmovil[] = $request->vehi_id_original;
            $zmoviles = \DB::select('
                            select * from
                            fn_registro(?)', array($id));
            foreach ($zmoviles as $zmovile) {
                $zmovils[] = $zmovile->veh_id;
            }
            //$zmovis = array_diff($zmovils, $zmovil);//quital
            $zmovs = [1];
            $zmov =array_sum($zmovs);
            $vehiupdate = $request->vehi_id_original;


            // dd($request->vehi_id, $request->vehi_id_original,$zmov);
        }


        if($zmov == 0 and $e != 0 ){
            //dd($zmov,$e,$zmovil,$zmovs,'mismo y otro control');
            Session::flash('message3', 'El Movil '. $vehmov->veh_movil .' se encuentra registrado en este control y en otro en el mismo turno.');
            return redirect()->back();
        }elseif ($zmov == 0 and $e== 0){
            //dd($zmov,$e,$zmovil,$zmovs,'mismo  control');
            Session::flash('message3', 'El Movil '. $vehmov->veh_movil .' ya se encuentra registrado en el control.');
            return redirect()->back();
        }elseif($zmov != 0 and $e != 0){
            //dd($zmov,$e,$zmovil,$zmovs,'otro control');
            Session::flash('message3', 'El Movil '. $vehmov->veh_movil  .' ya se encuentra registrado en otro control en el mismo turno. Usuario: '. strtoupper($g[0]->reg_creado_por) .'');

            return redirect()->back();
        }elseif($zmov != 0 and $e== 0){
            //dd($zmov,$e,$zmovil,$zmovs,'registro valido');
            //dd($request->all());
            $array_bd = ($request->acciones_bd);
            $array_true = ($request->acciones);

            if (empty($array_true)) {
                Session::flash('message2', 'Las listas de Revisi&oacute;n Externa y/o Interna no pueden estar vacias.');
                return redirect()->back();
            } else {
                $array_false = array_diff($array_bd, $array_true);
                $uri = count($array_bd);
                if(count ($array_true)== $uri){
                    $aprobacion = 'TRUE';
                }else{
                    $aprobacion = 'FALSE';
                }
                $registro = sw_registro_lavado::find($idreg);
                $registro->fill($request->all());
                //dd($registro);
                $registro->reg_veh_id = $vehiupdate;
                $registro->reg_aprobacion = $aprobacion;
                $registro->reg_observacion = $request->reg_observacion;
                $registro->reg_creado_en = new DateTime();
                $registro->reg_creado_por = Auth::user()->usr_name;
                $registro->reg_modificado_en = new DateTime();
                $registro->reg_modificado_por = Auth::user()->usr_name;
                $registro->save();
                //dd($registro);
                $regsdelete = \DB::select('
                           delete from
                            sw_det_lavado where det_reg_id =' . $idreg . '');
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



                if (empty($_FILES["archivos"]['name'][0])){
                    Session::flash('message', 'Se ha editado el registro. ID: ' . $idreg);
                    return redirect()->back();
                }

                $idreg=$registro->reg_id;
                $files_exists= \DB::select('select * from sw_adjunto where adj_reg_id =' . $idreg);

                foreach($files_exists as $adj_name){
                    $x[]= $adj_name->adj_nombre;
                }
               if(empty ($x)){
                    $x=[0];
               }

                $files_new = $_FILES["archivos"]['name'];
                $valid_files_r = array_intersect($x,$files_new);
                $valid_files_r1 = count($valid_files_r);

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


                if ($valid_files_r1 != 0){
                    Session::flash('message2', 'Ya se encuentra un archivo con el mismo nombre en este registro. ');
                    return redirect()->back();
                }else{



                $array_nombre=$_FILES["archivos"]['name'];
                for($i=0;$i<count($_FILES["archivos"]['name']);$i++){
                    $tmpFilePath = $_FILES["archivos"]['tmp_name'][$i];


                    if ($tmpFilePath != ""){




                        $ruta1 = 'Z:\adjuntos_swcapital\lavado\ ';
                        $rutareg = '\ ';
                        $rutareg = rtrim($rutareg);
                        $ruta11 = rtrim($ruta1).$idreg.$rutareg;
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
                if($array_nombre[0]== null){

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

               }
                Session::flash('message', 'Se ha editado el registro. ID: ' . $idreg);
                return redirect()->back();
                //return Redirect::action('RegistroController@index');
                //return redirect()->route('reporte.show',compact('id'));

            }
        }else{
            return redirect()->back();
        }


    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
