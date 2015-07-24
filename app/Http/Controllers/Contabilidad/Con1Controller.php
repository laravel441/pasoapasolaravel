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
            ->where('asf.asg_usr_asignado', $id)
            ->orderBY('fac_id', 'DESC')
            ->factus($request->get('factus'))
            ->paginate();

        //dd($facs);
        return view('contabilidad.revision.index',compact('menus','facs'));
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
                $user = Auth::user()->usr_name;
                $x = \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_dtl_id = 4,
             htc_descripcion =  \'APROBADO CONTABILIDAD\',
             htc_modificado_por =  \'' . $user . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = ' . $r);

            }
            Session::flash('message3', 'Se ha aprobado la(s) factura(s)');
            return redirect()->route('contabilidad.revision.index');
        }elseif($e == 2){
            if ($f == 1){
            $g = $request->observaciones.' (NO APROBADO REVISION->RADICACIÓN)';
            foreach ($d as $r) {
                $user = Auth::user()->usr_name;
                $x = \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_dtl_id = 5,
             htc_descripcion =  \'' . $g. '\',
             htc_modificado_por =  \'' . $user . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = ' . $r);

                 }
                Session::flash('message', 'No se ha aprobado la(s) factura(s). Se han enviado a RADICACIÓN');
                return redirect()->route('contabilidad.revision.index');
            }elseif($f == 2){
                $g = $request->observaciones.' (NO APROBADO REVISION->ABASTECIMIENTO)';
                foreach ($d as $r) {
                    $user = Auth::user()->usr_name;
                    $x = \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_dtl_id = 6,
             htc_descripcion =  \'' . $g. '\',
             htc_modificado_por =  \'' . $user . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = ' . $r);

                }
                Session::flash('message', 'No se ha aprobado la(s) factura(s). Se han enviado a ABASTECIMIENTO');
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
