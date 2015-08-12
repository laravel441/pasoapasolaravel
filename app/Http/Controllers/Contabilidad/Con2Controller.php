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

class Con2Controller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){


        $iduser =Auth::user()->usr_id;

		$menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));
        $d = 4; //Estado Aprobado por contabilidad
        $g = 't'; //Estado actual activo
        $h = 2; //tipo de factura Cuenta de Cobro

		$cuenta_cobro=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->join('sw_archivos_facturas AS arcf', 'arcf.arc_fac_id', '=', 'sw_facturas.fac_id')
            ->join('sw_proveedor AS pves', 'pves.pvd_an8', '=', 'sw_facturas.fac_pvd_an8')
            ->join('sw_asignacion_facturas AS asf', 'asf.asg_fac_id', '=', 'sw_facturas.fac_id')
            ->select('sw_facturas.*','dett.tip_nombre','comp.comp_nombre','arcf.arc_fac_nombre','pves.pvd_nombre','htc.htc_creado_en')
            ->where ('htc.htc_dtl_id', $d)
            ->where ('htc.htc_bandera', $g)
            ->where ('sw_facturas.fac_tip_fac',$h)
            ->orderBY('fac_id', 'DESC')
            ->get();
       //dd($cuenta_cobro);

		$cuenta2=\DB::select('SELECT

							fac.fac_id
							,fac.fac_creado_en
							,fac.fac_consecutivo
							,tip.tip_nombre
							,pvd.pvd_nombre
							,fac.fac_asunto
							,htc.htc_modificado_en
							,fac.fac_fecha_rad

							FROM		sw_facturas fac
							LEFT JOIN	sw_proveedor pvd
							ON			fac.fac_pvd_an8		=	pvd.pvd_an8
										,sw_detalle_tipos tip
										,sw_historico_facturas htc

							WHERE 	fac.fac_tip_fac	=	tip.tip_id
							AND		htc.htc_dtl_id	=	4
							AND		fac.fac_id		=	htc.htc_fac_id');

		$cuenta3=\DB::select('SELECT
							fac.fac_id
							,fac.fac_creado_en
							,fac.fac_consecutivo
							,tip.tip_nombre
							,pvd.pvd_nombre
							,fac.fac_asunto
							,htc.htc_modificado_en
							,fac.fac_fecha_rad
							,ord.op_op_id
							,ord.op_consecutivo

							FROM		sw_facturas fac
							LEFT JOIN	sw_proveedor pvd
							ON			fac.fac_pvd_an8		=	pvd.pvd_an8
										,sw_detalle_tipos tip
										,sw_orden_pago ord
										,sw_historico_facturas htc

							WHERE 	tip.tip_id		=	2
							AND		fac.fac_tip_fac	=	tip.tip_id
							AND		htc.htc_dtl_id	=	7
							AND		fac.fac_id		=	htc.htc_fac_id
							AND		ord.op_fac_id	=   fac.fac_id
							AND		htc.htc_fac_id	=	fac.fac_id');

		$tipo=\DB::select('select tip_nombre from sw_detalle_tipos where tip_mtp_id=3');

		return view('contabilidad.generadordoc.index',compact('menus','cuenta_cobro','cuenta2','cuenta3','tipo','orden_pago'));
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
    dd($request->all());
    $fac_id=$request->fac_id;
    $frecibido=$request->fecha_recibido;
    $consecutivo=$request->consecutivo;
    $tipo=$request->tipo;
    $empresa=$request->empresa;
    $asunto=$request->asunto;
    $fechar=$request->fechar;
    $valorf=$request->factura;
    $valoriva=$request->iva;
    $valorICA=$request->ica;
    $valorFuente=$request->fuente;

    $mpdf=new mPDF('c','A4-L','','',19,19,22,22,18,18);

    $header = '<table width="200%" style="border-bottom: 0px solid #000000; vertical-align: bottom; font-family: serif; font-size: 20pt; color: #000088;"><tr>
                   <td width="80%" align="right"><img src="/images/logo.jpg" width="250px" /></td>
                    </tr></table>';
    $footer = '<div class="text-center">Â© Copyright Masivo Capital S.A.S | <a class="text-danger" title="Masivo Capital" target="_blank" href="http://www.masivocapital.com/">www.masivocapital.com</a> | TIC | IDI | 2015</div>';

    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);

    $html1='<table class="table table-hover" border ="0"><br>
			<thead>
			<tr>
		<th class="text-danger"  align="left"> <h3>Documento Equivalente a la Factura No :'.$fac_id.'</h3></td></th>
		</tr>
			</thead>
		<br><br><br>
		<tbody>
		<tr>
		<th class="text-danger"  align="left"> <h5>Consecutivo: </h5></th>
		<td style="font-size:12px;text-align:center;font-weight:bold;border-style: solid;border-color: #666666;background-color: #dedede;" colspan="5">
		<h5>'.$consecutivo.'</h5></td>
		</tr><br>

		<tr>
		<th class="text-danger" align="left"> <h5>Tipo:</h5> </th>
		<td style="font-size:12px;text-align:center;font-weight:bold;border-style: solid;border-color: #666666;background-color: #dedede;" colspan="5">
		<h5>'.$tipo.'</h5></td>

		</tr><br>
		<tr>
		<th class="text-danger" align="left"> <h5>Empresa:</h5></th>
		<td style="font-size:12px;text-align:center;font-weight:bold;border-style: solid;border-color: #666666;background-color: #dedede;" colspan="5">
		<h5>'.$empresa.'</h5></td>
		</tr><br>

		<tr>
		<th class="text-danger"  align="left"> <h5>Asunto:</h5></th>
		<td style="font-size:12px;text-align:center;font-weight:bold;border-style: solid;border-color: #666666;background-color: #dedede;" colspan="5">
		<h5>'.$asunto.'</h5></td>
		</tr><br>

		<tr>
		<th class="text-danger"  align="left"><h5> Fecha Recibido:</h5></th>
		<td style="font-size:12px;text-align:center;font-weight:bold;border-style: solid;border-color: #666666;background-color: #dedede;" colspan="5">
		<h5>'.$frecibido.'</h5></td>
		</tr><br>

		<tr>
		<th class="text-danger"  align="left"><h5> Fecha Radicado:</h5></th>
		<td style="font-size:12px;text-align:center;font-weight:bold;border-style: solid;border-color: #666666;background-color: #dedede;" colspan="5">
				<h5>'.$fechar.'</h5></td>
		</tr><br>

		<tr>
		<th class="text-danger"  align="left"><h5> Valor Factura:</h5></th>
		<td style="font-size:12px;text-align:center;font-weight:bold;border-style: solid;border-color: #666666;background-color: #dedede;" colspan="5">
		<h5>'.$valorf.'</h5></td>
		</tr><br>

		<tr>
		<th class="text-danger"  align="left"><h5> Valor Retencion ICA:</h5></th>
		<td style="font-size:12px;text-align:center;font-weight:bold;border-style: solid;border-color: #666666;background-color: #dedede;" colspan="5">
		<h5>'.$valoriva.'</h5></td>
		</tr><br>

		<tr>
		<th class="text-danger"  align="left"><h5> Valor Retencion ICA:</h5></th>
		<td style="font-size:12px;text-align:center;font-weight:bold;border-style: solid;border-color: #666666;background-color: #dedede;" colspan="5">
		<h5>'.$valorICA.'</h5></td>
		</tr><br>

		<tr>
		<th class="text-danger"  align="left"><h5> Valor Retencion en la Fuente:</h5></th>
		<td style="font-size:12px;text-align:center;font-weight:bold;border-style: solid;border-color: #666666;background-color: #dedede;" colspan="5">
		<h5>'.$valorFuente.'</h5></td>
		</tr><br>

		</tbody>
		</table>';

    $mpdf->SetDisplayMode('fullpage');
    $stylesheet = file_get_contents('bower_components/bootstrap/dist/css/bootstrap.min.css');
    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($html1);
    $ruta= 'Z:\adjuntos_swcapital\Orden_pago\DE\ ';
    $rutareg = '\ ';
    $rutareg = rtrim($rutareg);
    $ruta11 = rtrim($ruta).$fac_id.$rutareg;
    mkdir($ruta11, 0777);
    $mpdf->Output(($ruta11).$consecutivo.'.pdf','F');

    $cuenta_cobro=new sw_documento_equivalente();
    $cuenta_cobro->doc_equi_fac_id=$request->fac_id;
    $cuenta_cobro->doc_equi_ruta_archivo_adj=$ruta11.$consecutivo.'.pdf';
    $cuenta_cobro->doc_equi_nombre_archivo=$consecutivo.'.pdf';
    $cuenta_cobro->doc_equi_iva=$request->iva;
    $cuenta_cobro->doc_equi_ica=$request->ICA;
    $cuenta_cobro->doc_equi_retefuente=$request->Fuente;
    $cuenta_cobro->doc_equi_valor=$request->factura;
    $cuenta_cobro->doc_equi_creado_en=new DateTime();
    $cuenta_cobro->doc_equi_creado_por=Auth::user()->usr_name;
    $cuenta_cobro->doc_equi_modificado_en=new DateTime();
    $cuenta_cobro->doc_equi_modificado_por=Auth::user()->usr_name;

    $cuenta_cobro->save();

    $htc=$request->htc_id;
    $historico= new sw_historico_factura();
    $historico->htc_fac_id=$request->fac_id;
    $historico->htc_dtl_id= 7;
    $historico->htc_bandera= FALSE;
    $historico->htc_descripcion='GENERADO DOCUMENTO EQUIVALENTE (C. DE COBRO)';
    $historico->htc_creado_en=new DateTime();
    $historico->htc_creado_por=Auth::user()->usr_name;
    $historico->htc_modificado_en=new DateTime();
    $historico->htc_modificado_por=Auth::user()->usr_name;

    $historico->save();

    return redirect()->back;

    Session::flash('message', 'Documento Generado Correctamente del Registro No.'  .$fac_id);

}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return Response
 */
public function show(Request $request)
{
    //dd($request->all());
    $idfac=$request->id_fac;
    $consc=$request->cons;
    $tipo=$request->tipo;
    $emp=$request->empresa;

    Session::flash('message', 'Registro Aprobado para Tesoreria No.'  .$consc);

    return redirect()->back();
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return Response
 */
public function edit($id)
{

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

    $idfac=$request->fac_id;
    $consc=$request->consecutivo;
    $tipo_fac=$request->tipo;
    $emp=$request->empresa;
    $asunto=$request->asunto;

    $fechaR=$request->fechar;
    $fecharecibido=$request->fecha_recibido;
    $tipo_orden=$request->Tip_Orden;
    $cons_OP=$request->Cons_OP;
    $tipo=$request->tipo_orden;

    if ($tipo =="PD")
        $tipo=11;

    elseif($tipo =="PZ")
        $tipo=12;
    if ($tipo=="PV")
        $tipo=13;

    /*$ruta = 'C:\Users\joan.pinilla\Desktop\prueba';
   foreach ($_FILES["archivos"]["name"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["archivos"]["tmp_name"][$key];
        $name = $_FILES["archivos"]["name"][$key];
        move_uploaded_file($tmp_name, "$ruta/$name");
    }
   }*/

    $array_nombre=$_FILES["archivos"]['name'];
    $ruta1 = 'Z:\adjuntos_swcapital\Orden_pago\OP\ ';
    $rutareg = '\ ';
    $rutareg = rtrim($rutareg);
    $ruta11 = rtrim($ruta1).$consc.$rutareg;
    mkdir($ruta11, 0777);

    for($i=0;$i<count($_FILES["archivos"]['name']);$i++){
        $tmpFilePath = $_FILES["archivos"]['tmp_name'][$i];

        if ($tmpFilePath != ""){
            $ruta2 = $_FILES['archivos']['name'][$i];
            $ruta = $ruta11.$ruta2;

            //dd($ruta);
            if(move_uploaded_file($tmpFilePath, $ruta)){

            }

        }
    }


    $orden= new sw_orden_pago();

    $orden->op_fac_id=$request->fac_id;
    $orden->op_op_id=$tipo;
    $orden->op_consecutivo=$request->Cons_OP;
    $orden->op_ruta_archivo_adjunto=$ruta11.$consc;
    $orden->op_nombre_adjunto=$ruta2;
    $orden->op_creado_en=new DateTime();
    $orden->op_creado_por=Auth::user()->usr_name;
    $orden->op_modificado_en=new DateTime();
    $orden->op_modificado_por=Auth::user()->usr_name;

    //dd($orden);

    $orden->save();

    Session::flash('message', 'Orden De Pago Creada Correctamente '  .$cons_OP);

    return redirect()->back();

}

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return Response.
 */
public function destroy($id)
{
    //
}

}
