<?php namespace App\Http\Controllers\Contabilidad;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\sw_empleado;
use App\sw_factura;
use App\sw_historico_factura;
use App\sw_registro_lavado;
use App\sw_usuario;
use App\sw_ctl_lavado;
use App\sw_det_lavado;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


use App\User;
use Illuminate\Http\Request;
use mPDF;

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
use Maatwebsite\Excel\Facades\Excel;
use DateInterval;
use Carbon\Carbon;
use Faker\Factory as Faker;

class Con1Controller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $id =Auth::user()->usr_id;
        $d = 3;
        $g = 't';
        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($id));
        $facs = sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->join('sw_archivos_facturas AS arcf', 'arcf.arc_fac_id', '=', 'sw_facturas.fac_id')
            ->join('sw_asignacion_facturas AS asf', 'asf.asg_fac_id', '=', 'sw_facturas.fac_id')
                ->select('sw_facturas.*','dett.tip_nombre','comp.comp_nombre','arcf.arc_fac_nombre')
            ->where ('htc.htc_dtl_id', $d)
            ->where ('htc.htc_bandera', $g)
            ->where('asf.asg_usr_asignado', $id)
            ->orderBY('fac_id', 'DESC')
            ->get();
        if (empty($facs[0])){
            $envi = 1;
            //dd($envio,$envi,'no tiene');
        }else
            $envi = 2;

        //dd($facs);
        return view('contabilidad.revision.index',compact('menus','facs','envi'));
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
		//dd($request->all());
        $d = $request->items;
        $e = $request->submit;
        $f = $request->optradio;

        //dd($d);
        if (is_null($d)){
            //dd($request->all(),':(');
            Session::flash('message2', 'Debes seleccionar la(s) factura(s) para su respectiva aprobación o no.' );
            return redirect()->back();
        }
        if ($e == 1) {

            foreach ($d as $r) {
                $x= \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' .'FALSE'. '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = '.$r.'
             AND  htc_dtl_id = 3 ');


                $reg_hfactura = new sw_historico_factura();
                $reg_hfactura->htc_fac_id=$r;
                $reg_hfactura->htc_dtl_id=4;
                $reg_hfactura->htc_bandera='TRUE';
                $reg_hfactura->htc_descripcion='APROBADO POR CONTABILIDAD';
                $reg_hfactura->htc_creado_en= new DateTime();
                $reg_hfactura->htc_creado_por= Auth::user()->usr_name;
                $reg_hfactura->htc_modificado_en= new DateTime();
                $reg_hfactura->htc_modificado_por= Auth::user()->usr_name;
                $reg_hfactura->save();

            }
            Session::flash('message', 'Se ha aprobado la(s) factura(s)');
            return redirect()->route('contabilidad.revision.index');
        }elseif($e == 2){
            if ($f == 1){
            $g = $request->observaciones.' (NO APROBADO REVISION->RADICACIÓN)';
            foreach ($d as $r) {
                $x= \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' .'FALSE'. '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = '.$r.'
             AND  htc_dtl_id = 3 ');


                $reg_hfactura = new sw_historico_factura();
                $reg_hfactura->htc_fac_id=$r;
                $reg_hfactura->htc_dtl_id=5;
                $reg_hfactura->htc_bandera='TRUE';
                $reg_hfactura->htc_descripcion=$g;
                $reg_hfactura->htc_creado_en= new DateTime();
                $reg_hfactura->htc_creado_por= Auth::user()->usr_name;
                $reg_hfactura->htc_modificado_en= new DateTime();
                $reg_hfactura->htc_modificado_por= Auth::user()->usr_name;
                $reg_hfactura->save();

                 }
                Session::flash('message3', 'No se ha aprobado la(s) factura(s). Se han enviado a RADICACIÓN');
                return redirect()->route('contabilidad.revision.index');
            }elseif($f == 2){
                $g = $request->observaciones.' (NO APROBADO REVISION->ABASTECIMIENTO)';
                foreach ($d as $r) {
                    $x= \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' .'FALSE'. '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = '.$r.'
             AND  htc_dtl_id = 3 ');


                    $reg_hfactura = new sw_historico_factura();
                    $reg_hfactura->htc_fac_id=$r;
                    $reg_hfactura->htc_dtl_id=6;
                    $reg_hfactura->htc_bandera='TRUE';
                    $reg_hfactura->htc_descripcion=$g;
                    $reg_hfactura->htc_creado_en= new DateTime();
                    $reg_hfactura->htc_creado_por= Auth::user()->usr_name;
                    $reg_hfactura->htc_modificado_en= new DateTime();
                    $reg_hfactura->htc_modificado_por= Auth::user()->usr_name;
                    $reg_hfactura->save();

                }
                Session::flash('message3', 'No se ha aprobado la(s) factura(s). Se han enviado a ABASTECIMIENTO');
                return redirect()->route('contabilidad.revision.index');
            }


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
	public function update(Request $request,$id)
	{
        dd($request->all());
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
