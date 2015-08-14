<?php namespace App\Http\Controllers\Facturacion;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\sw_archivos_facturas;
use App\sw_empleado;
use App\sw_registro_lavado;
use App\sw_usuario;
use App\sw_ctl_lavado;
use App\sw_det_lavado;
use App\sw_adjunto;
use App\sw_factura;
use App\sw_detalle_tipos;
use App\sw_companias;
use App\sw_historico_factura;
use App\sw_asignacion_facturas;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\PDF;
use mPDF;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class Fac3Controller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $id = Auth::user()->usr_id;
        $k = 0;
        $l = 12;
        $g = 't';
        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)', array($id));

        $facs=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->leftjoin('sw_archivos_facturas AS arcf', 'arcf.arc_fac_id', '=', 'sw_facturas.fac_id')
            ->join('sw_proveedor AS pves', 'pves.pvd_an8', '=', 'sw_facturas.fac_pvd_an8')
            ->join('sw_detalle_estados as dete', 'dete.dtl_id', '=', 'htc.htc_dtl_id')
            ->leftjoin('sw_documento_equivalente AS doce', 'doce.doc_equi_fac_id', '=', 'sw_facturas.fac_id')
            ->leftjoin('sw_asignacion_facturas AS asf', 'asf.asg_fac_id', '=', 'sw_facturas.fac_id')
            ->select('sw_facturas.*', 'dett.tip_nombre', 'pves.pvd_nombre','pves.pvd_identificacion', 'comp.comp_nombre', 'arcf.arc_fac_nombre',
                'doce.doc_equi_id', 'doce.doc_equi_ruta_archivo_adj', 'doc_equi_nombre_archivo','dete.dtl_nombre')
            ->whereBetween ('htc.htc_dtl_id', array($k,$l))
            ->where ('htc.htc_bandera', $g)
            ->orderBY('fac_id', 'DESC')
            ->get();

        $cuenta5=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_orden_pago AS op','op.op_fac_id','=','sw_facturas.fac_id')
            ->select('sw_facturas.fac_id','sw_facturas.fac_consecutivo','op.op_consecutivo','op.op_nombre_adjunto')
            ->whereBetween ('htc.htc_dtl_id', array($k,$l))
            ->where ('htc.htc_bandera', $g)
            ->orderBY('fac_id', 'DESC')
            ->get();


        //dd($facs);
        return view('facturacion.hfacturas.index', compact('menus', 'facs','cuenta5'));
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
	public function store()
	{
		//
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
