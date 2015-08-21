<?php namespace App\Http\Controllers\Tesoreria;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

use App\User;
use Illuminate\Http\Request;
use mPDF;

use App\sw_empleado;
use App\sw_factura;
use App\sw_historico_factura;
use App\sw_registro_lavado;
use App\sw_usuario;
use App\sw_ctl_lavado;
use App\sw_det_lavado;

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

class Tes1Controller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $id = Auth::user()->usr_id;
        $j = 10;//Estado Enviado a Tesoreria
        $k = 11;// Estado Aprobado por tesorería
        $l = 12;// Rechazado por tesorería

        $g = 't';
        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)', array($id));
        $pendientes=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->join('sw_archivos_facturas AS arcf', 'arcf.arc_fac_id', '=', 'sw_facturas.fac_id')
            ->join('sw_proveedor AS pves', 'pves.pvd_an8', '=', 'sw_facturas.fac_pvd_an8')
            ->leftjoin('sw_documento_equivalente AS de', 'de.doc_equi_fac_id', '=', 'sw_facturas.fac_id')
            ->join('sw_asignacion_facturas AS asf', 'asf.asg_fac_id', '=', 'sw_facturas.fac_id')
            ->select('sw_facturas.*','dett.tip_nombre','comp.comp_nombre','arcf.arc_fac_nombre','pves.pvd_nombre','de.doc_equi_nombre_archivo')
            ->where ('htc.htc_dtl_id', $j)
            ->where ('htc.htc_bandera', $g)
            ->orderBY('fac_id', 'DESC')
            ->get();
        if (empty($pendientes[0])){
            $envi = 1;
            //dd($envio,$envi,'no tiene');
        }else
            $envi = 2;

        $cuenta4=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_orden_pago AS op','op.op_fac_id','=','sw_facturas.fac_id')
            ->select('sw_facturas.fac_id','sw_facturas.fac_consecutivo','op.op_consecutivo','op.op_nombre_adjunto')
            ->where ('htc.htc_dtl_id', $j)
            ->where ('htc.htc_bandera', $g)
            ->orderBY('fac_id', 'DESC')
            ->get();

        $revision=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->join('sw_archivos_facturas AS arcf', 'arcf.arc_fac_id', '=', 'sw_facturas.fac_id')
            ->join('sw_proveedor AS pves', 'pves.pvd_an8', '=', 'sw_facturas.fac_pvd_an8')
            ->leftjoin('sw_documento_equivalente AS de', 'de.doc_equi_fac_id', '=', 'sw_facturas.fac_id')
            ->join('sw_asignacion_facturas AS asf', 'asf.asg_fac_id', '=', 'sw_facturas.fac_id')
            ->select('sw_facturas.*','dett.tip_nombre','comp.comp_nombre','arcf.arc_fac_nombre','pves.pvd_nombre','de.doc_equi_nombre_archivo','htc.htc_dtl_id')
            ->wherein ('htc.htc_dtl_id', array($k,$l))
            ->where ('htc.htc_bandera', $g)
            ->orderBY('fac_id', 'DESC')
            ->get();

         $cuenta5=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_orden_pago AS op','op.op_fac_id','=','sw_facturas.fac_id')
            ->select('sw_facturas.fac_id','sw_facturas.fac_consecutivo','op.op_consecutivo','op.op_nombre_adjunto')
            ->wherein ('htc.htc_dtl_id', array($k,$l))
            ->where ('htc.htc_bandera', $g)
            ->orderBY('fac_id', 'DESC')
            ->get();

       // dd($revision);
        return view('tesoreria.revision.index', compact('menus', 'cuenta4','pendientes','revision','cuenta5','envi'));
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
        //dd($request->all());
        $d = $request->items;
        $e = $request->submit;
        if (is_null($d)){
            //dd($request->all(),':(');
            Session::flash('message2', 'Debes seleccionar la(s) factura(s) para su respectiva aprobaci&oacute;n o no.' );
            return redirect()->back();
        }

        //dd($d);

        if ($e == 1) {
            $observ_apro = $request->observaciones_1;
            foreach ($d as $r) {
                $user = Auth::user()->usr_name;
                $a= \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' .'FALSE'. '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = '.$r.'
             AND  htc_dtl_id = 10 ');

                $historico= new sw_historico_factura();
                $historico->htc_fac_id=$r;
                $historico->htc_dtl_id= 11;
                $historico->htc_bandera= 't';
                $historico->htc_descripcion=$observ_apro.' (APROBADO POR TESORERÍA)';
                $historico->htc_creado_en=new DateTime();
                $historico->htc_creado_por=Auth::user()->usr_name;
                $historico->htc_modificado_en=new DateTime();
                $historico->htc_modificado_por=Auth::user()->usr_name;

                $historico->save();

            }
            Session::flash('message', 'Se han aprobado la(s) factura(s)');
            return redirect()->route('tesoreria.revision.index');
        } elseif ($e == 2) {
            $g = $request->observaciones_2;
            foreach ($d as $r) {
                $user = Auth::user()->usr_name;
                $a= \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' .'FALSE'. '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = '.$r.'
             AND  htc_dtl_id = 10 ');

                $historico= new sw_historico_factura();
                $historico->htc_fac_id=$r;
                $historico->htc_dtl_id= 12;
                $historico->htc_bandera= 't';
                $historico->htc_descripcion=$g.' (RECHAZADO POR TESORERÍA)';
                $historico->htc_creado_en=new DateTime();
                $historico->htc_creado_por=Auth::user()->usr_name;
                $historico->htc_modificado_en=new DateTime();
                $historico->htc_modificado_por=Auth::user()->usr_name;

                $historico->save();

            }
            Session::flash('message3', 'No se han aprobado la(s) factura(s)');
            return redirect()->route('tesoreria.revision.index');
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
