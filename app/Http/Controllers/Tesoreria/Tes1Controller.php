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
        $pen = 9;
        $rev = 10;
        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)', array($id));
        $facs = sw_factura::join('sw_historico_facturas AS htc', 'sw_facturas.fac_id', '=', 'htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_proveedor AS pvd', 'pvd.pvd_an8', '=', 'sw_facturas.fac_pvd_an8')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->join('sw_archivos_facturas AS arcf', 'arcf.arc_fac_id', '=', 'sw_facturas.fac_id')
            ->leftjoin('sw_orden_pago AS odp', 'odp.op_fac_id', '=', 'sw_facturas.fac_id')
            ->leftjoin('sw_documento_equivalente AS doce', 'doce.doc_equi_fac_id', '=', 'sw_facturas.fac_id')
            //->join('sw_asignacion_facturas AS asf', 'asf.asg_fac_id', '=', 'sw_facturas.fac_id')
            ->select('sw_facturas.*', 'dett.tip_nombre', 'odp.op_consecutivo', 'odp.op_ruta_archivo_adjunto',
                'odp.op_nombre_adjunto', 'pvd.pvd_nombre', 'comp.comp_nombre', 'arcf.arc_fac_nombre',
                'doce.doc_equi_id', 'doce.doc_equi_ruta_archivo_adj', 'doc_equi_nombre_archivo')
            ->where('htc.htc_dtl_id', $pen)
            ->orderBY('fac_id', 'DESC')
            ->paginate();

        $facsi = sw_factura::join('sw_historico_facturas AS htc', 'sw_facturas.fac_id', '=', 'htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_proveedor AS pvd', 'pvd.pvd_an8', '=', 'sw_facturas.fac_pvd_an8')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->join('sw_archivos_facturas AS arcf', 'arcf.arc_fac_id', '=', 'sw_facturas.fac_id')
            ->leftjoin('sw_orden_pago AS odp', 'odp.op_fac_id', '=', 'sw_facturas.fac_id')
            ->leftjoin('sw_documento_equivalente AS doce', 'doce.doc_equi_fac_id', '=', 'sw_facturas.fac_id')
            //->join('sw_asignacion_facturas AS asf', 'asf.asg_fac_id', '=', 'sw_facturas.fac_id')
            ->select('sw_facturas.*', 'dett.tip_nombre', 'odp.op_consecutivo', 'odp.op_ruta_archivo_adjunto',
                'odp.op_nombre_adjunto', 'pvd.pvd_nombre', 'comp.comp_nombre', 'arcf.arc_fac_nombre',
                'doce.doc_equi_id', 'doce.doc_equi_ruta_archivo_adj', 'doc_equi_nombre_archivo')
            ->where('htc.htc_dtl_id', $rev)
            ->orderBY('fac_id', 'DESC')
            ->paginate();

        //dd($facs);
        return view('tesoreria.revision.index', compact('menus', 'facs','facsi'));
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


        //dd($d);
        if (is_null($d)) {
            //dd($request->all(),':(');
            Session::flash('message2', 'Debes seleccionar la(s) factura(s) para su respectiva aprobación o no.');
            return redirect()->back();
        }
        if ($e == 1) {
            $observ_apro = $request->observaciones_1;
            foreach ($d as $r) {
                $user = Auth::user()->usr_name;
                $x = \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_dtl_id = 10,
             htc_descripcion =  \'' . $observ_apro . '\',
             htc_modificado_por =  \'' . $user . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = ' . $r);

            }
            Session::flash('message', 'Se ha aprobado la(s) factura(s)');
            return redirect()->route('tesoreria.revision.index');
        } elseif ($e == 2) {
            $g = $request->observaciones_2;
            foreach ($d as $r) {
                $user = Auth::user()->usr_name;
                $x = \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_dtl_id = 11,
             htc_descripcion =  \'' . $g . '\',
             htc_modificado_por =  \'' . $user . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = ' . $r);

            }
            Session::flash('message3', 'No se ha aprobado la(s) factura(s)');
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
