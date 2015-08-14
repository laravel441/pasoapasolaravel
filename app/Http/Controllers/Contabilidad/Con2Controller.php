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
use App\sw_documento_equivalente;
use App\sw_orden_pago;

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
        $i = 7; //Estado Cuenta cobro con Documento equivalente
        $f = 8; //Estado Cuenta cobro con Orden de Pago
        $j = 9; //Estado Correcto con Anexos
        $g = 't'; //Estado actual activo
        $h = 2; //tipo de factura Cuenta de Cobro

		$cuenta_cobro=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->join('sw_archivos_facturas AS arcf', 'arcf.arc_fac_id', '=', 'sw_facturas.fac_id')
            ->join('sw_proveedor AS pves', 'pves.pvd_an8', '=', 'sw_facturas.fac_pvd_an8')
            ->join('sw_asignacion_facturas AS asf', 'asf.asg_fac_id', '=', 'sw_facturas.fac_id')
            ->select('sw_facturas.*','dett.tip_nombre','comp.comp_nombre','arcf.arc_fac_nombre','pves.pvd_nombre','htc.*')
            ->wherein ('htc.htc_dtl_id', array($d,$f))
            ->where ('htc.htc_bandera', $g)
            ->where ('sw_facturas.fac_tip_fac',$h)
            ->orderBY('fac_id', 'DESC')
            ->get();
       //dd($cuenta_cobro);

		$cuenta2=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->join('sw_archivos_facturas AS arcf', 'arcf.arc_fac_id', '=', 'sw_facturas.fac_id')
            ->join('sw_proveedor AS pves', 'pves.pvd_an8', '=', 'sw_facturas.fac_pvd_an8')
            ->join('sw_asignacion_facturas AS asf', 'asf.asg_fac_id', '=', 'sw_facturas.fac_id')
            ->select('sw_facturas.*','dett.tip_nombre','comp.comp_nombre','arcf.arc_fac_nombre','pves.pvd_nombre','htc.*')
            ->wherein ('htc.htc_dtl_id', array($d,$i))
            ->where ('htc.htc_bandera', $g)
            ->orderBY('fac_id', 'DESC')
            ->get();

		$cuenta3=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
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

        $cuenta4=sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_orden_pago AS op','op.op_fac_id','=','sw_facturas.fac_id')
            ->select('sw_facturas.fac_id','sw_facturas.fac_consecutivo','op.op_consecutivo','op.op_nombre_adjunto')
            ->where ('htc.htc_dtl_id', $j)
            ->where ('htc.htc_bandera', $g)
            ->orderBY('fac_id', 'DESC')
            ->get();
        if (empty($cuenta3[0])){
            $envi = 1;
            //dd($envio,$envi,'no tiene');
        }else
            $envi = 2;

        //dd($cuenta4);

		$tipo=\DB::select('select *from sw_detalle_tipos where tip_mtp_id=3');


		return view('contabilidad.generadordoc.index',compact('menus','cuenta_cobro','cuenta2','cuenta3','cuenta4','tipo','orden_pago','envi'));
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
    $fac_id=$request->idfac;
    $htc_id=$request->idhtc;

    $facs = sw_factura::find($fac_id);
    $htcs = sw_historico_factura::find($htc_id);



    //dd($htcs->htc_creado_en,$facs->fac_fecha_rad);

    //$frecibido=$request->fecha_recibido;
    //$consecutivo=$request->consecutivo;
    $tipo=$request->tipo;
    $empresa=$request->empresa;
    $asunto=$request->asunto;
    $fechar=$request->fechar;
    //$valorf=$request->factura;
    $valoriva=$request->iva;
    $valorICA=$request->ica;
    $valorFuente=$request->fuente;

    $mpdf=new mPDF('c','A4','','',19,19,22,22,18,18);

    $header = '<table width="200%" style="border-bottom: 0px solid #000000; vertical-align: bottom; font-family: serif; font-size: 20pt; color: #000088;"><tr>
                   <td width="80%" align="left"><img src="/images/logo.jpg" width="300px"/><br> <h2>Nit: 900.394.79</h2></td>
                    </tr></table>';
    $footer = '<div class="text-center">© Copyright Masivo Capital S.A.S | <a class="text-danger" title="Masivo Capital" target="_blank" href="http://www.masivocapital.com/">www.masivocapital.com</a> | TIC | IDI | 2015</div>';

    $mpdf->SetHTMLHeader($header);
    $mpdf->SetHTMLFooter($footer);

    $html1='<div class="table-responsive">
				<br><br><br>

		<br><br><h4>Documento Equivalente a la Factura No :'.$fac_id.'</h4>
		<h4>Persona Natural :				'.$empresa.'</h4>
		<h4>Fecha Recibido  :				'.$htcs->htc_creado_en.'</h4>
		<h4>Fecha Radicado  :				'.$facs->fac_fecha_rad.'</h4><br><br>


		<table class="table table-bordered" width=100% height:"50%">
		<thead>
		<tr>
		<th class="text-danger"  align="left"> <h5>Descripcion de la Operacion </h5></th>
		<th class="text-danger"  align="left"> <h5>Valor de la misma </h5></th>
		<th class="text-danger"  align="left"> <h5>Tarifa del IVA </h5></th>
		<th class="text-danger"  align="left"> <h5>IVA Teorico</h5></th>
		<th class="text-danger"  align="left"> <h5>Tarifa de Retencion de Iva</h5></th>
		<th class="text-danger"  align="left"> <h5>Valor del impuesto asumido</h5></th>
		<tr>
		</thead>
		<tbody>
		<tr>
		<td><h5>'.$tipo.'</h5></td>
		<td><h5>$'.$facs->fac_valor.'</h5></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td></td><br>
		<td></td>
		<td></td>
		<td></td>
		<td>'.$valoriva.' %</td>
		<td></td>
		</tr>
		<tr>
		<td>TOTAL</td>
		<td>$'.$facs->fac_valor.'</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		</tbody>
		</table><br>

		<table class="table table-bordered">
		<thead>
		<tr>
		<th class="text-danger"  align="left">Codigo</th>
		<th class="text-danger"  align="left">Nombre de Cuenta</th>
		<th class="text-danger"  align="left">DB</th>
		<th class="text-danger"  align="left">CR</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td>'.$fac_id.'</td>
		<td>'.$facs->fac_consecutivo.'</td>
		<td>$'.$facs->fac_valor.'</td>
		<td></td>
		</tr>
		<tr>
		<td></td><br>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td>'.$fac_id.'</td>
		<td>Iva Descontable</td>
		<td></td>
		<td> '.$valoriva.'%</td>
		</tr>
		<tr>
		<td></td>
		<td></td><br>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td>'.$fac_id.'</td>
		<td>Retencion en la Fuente</td>
		<td></td>
		<td>'.$valorFuente.' %</td>
		</tr>
		<tr>
		<td></td><br>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td>'.$fac_id.'</td>
		<td>Valor ICA</td>
		<td></td>
		<td> '.$valorICA.'%</td>
		</tr>
		<tr>
		<td></td><br>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		<tr><br>
		<td></td>
		<td>TOTAL</td>
		<td>$'.$facs->fac_valor.'</td>
		<td></td>
		</tr>

		</tbody>
		</table><br>

		<table class="table table-bordered">
		<thead>
		<tr class="info">
		<th class="text-danger">Parametros de Control</th><br>
		<th  class="text-danger">Responsable</th>
		</tr>
		</thead>
		<tbody>
		<tr>
		<td>Responsable : </td><br>
		<td>'.Auth::user()->usr_name.'</td>
		</tr>
		<tr>
		<td>Lugar y Tiempo :</td><br>
		<td>'.$htcs->htc_creado_en.'</td>
		</tr>
		<tr>
		<td>Medio de Conservacion :</td><br>
		<td></td>
		</tr>
		</tbody>
		</thead>
		</table>
				</div>';

    $mpdf->SetDisplayMode('fullpage');
    $stylesheet = file_get_contents('bower_components/bootstrap/dist/css/bootstrap.min.css');
    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($html1);
    $ruta= 'Z:\adjuntos_swcapital\facturas\ ';
    $rutareg = '\DE\ ';
    $rutareg = rtrim($rutareg);
    $ruta11 = rtrim($ruta).$facs->fac_consecutivo.$rutareg;
    if (!file_exists($ruta11)) {

        mkdir($ruta11, 0777);
    }
    $mpdf->Output(($ruta11).$facs->fac_consecutivo.'.pdf','F');

    $cuenta_cobro=new sw_documento_equivalente();
    $cuenta_cobro->doc_equi_fac_id=$fac_id;
    $cuenta_cobro->doc_equi_ruta_archivo_adj=$ruta11.$facs->fac_consecutivo.'.pdf';
    $cuenta_cobro->doc_equi_nombre_archivo=$facs->fac_consecutivo.'.pdf';
    $cuenta_cobro->doc_equi_iva=$request->iva;
    $cuenta_cobro->doc_equi_ica=$request->ica;
    $cuenta_cobro->doc_equi_retefuente=$request->fuente;
    $cuenta_cobro->doc_equi_valor=$facs->fac_valor;
    $cuenta_cobro->doc_equi_creado_en=new DateTime();
    $cuenta_cobro->doc_equi_creado_por=Auth::user()->usr_name;
    $cuenta_cobro->doc_equi_modificado_en=new DateTime();
    $cuenta_cobro->doc_equi_modificado_por=Auth::user()->usr_name;

    $cuenta_cobro->save();

    if ($request->htce == 8){
        $a= \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' .'FALSE'. '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = '.$fac_id.'
             AND  htc_dtl_id = 8 ');

        $historico= new sw_historico_factura();
        $historico->htc_fac_id=$fac_id;
        $historico->htc_dtl_id= 9;
        $historico->htc_bandera= 't';
        $historico->htc_descripcion='CORRECTO CON ANEXOS';
        $historico->htc_creado_en=new DateTime();
        $historico->htc_creado_por=Auth::user()->usr_name;
        $historico->htc_modificado_en=new DateTime();
        $historico->htc_modificado_por=Auth::user()->usr_name;

        $historico->save();

        Session::flash('message', 'Documento Generado Correctamente del Registro No.'  .$facs->fac_consecutivo);
        return redirect()->route('contabilidad.generadordoc.index');
    }else{
        $a= \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' .'FALSE'. '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = '.$fac_id.'
             AND  htc_dtl_id = 4 ');

        $historico= new sw_historico_factura();
        $historico->htc_fac_id=$fac_id;
        $historico->htc_dtl_id= 7;
        $historico->htc_bandera= 't';
        $historico->htc_descripcion='GENERADO DOCUMENTO EQUIVALENTE (C. DE COBRO)';
        $historico->htc_creado_en=new DateTime();
        $historico->htc_creado_por=Auth::user()->usr_name;
        $historico->htc_modificado_en=new DateTime();
        $historico->htc_modificado_por=Auth::user()->usr_name;

        $historico->save();

        Session::flash('message', 'Documento Generado Correctamente del Registro No.'  .$facs->fac_consecutivo);
        return redirect()->route('contabilidad.generadordoc.index');

    }



}

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return Response
 */
public function show(Request $request)
{

    foreach($request->items as $ids){

    $a= \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' .'FALSE'. '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = '.$ids.'
             AND  htc_dtl_id = 9 ');

    $historico= new sw_historico_factura();
    $historico->htc_fac_id=$ids;
    $historico->htc_dtl_id= 10;
    $historico->htc_bandera= 't';
    $historico->htc_descripcion='ENVIADO A TESORERÍA';
    $historico->htc_creado_en=new DateTime();
    $historico->htc_creado_por=Auth::user()->usr_name;
    $historico->htc_modificado_en=new DateTime();
    $historico->htc_modificado_por=Auth::user()->usr_name;

    $historico->save();
    }

    Session::flash('message', 'Se han enviado a Tesorería la(s) Factura(s)');
    return redirect()->route('contabilidad.generadordoc.index');
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

    $fac_id=$request->idf;
    $htc_id=$request->idh;

    $facs = sw_factura::find($fac_id);
    $htcs = sw_historico_factura::find($htc_id);


    $con_op=$request->cons_op;
    $tipo_op=$request->tipo_orden;

    $array_nombre=$_FILES["archivos"]['name'];

    $ruta= 'Z:\adjuntos_swcapital\facturas\ ';
    $rutareg = '\OP\ ';
    $rutareg = rtrim($rutareg);
    $ruta11 = rtrim($ruta).$facs->fac_consecutivo.$rutareg;
    if (!file_exists($ruta11)) {
        mkdir($ruta11, 0777);
    }
    for($i=0;$i<count($_FILES["archivos"]['name']);$i++){
        $tmpFilePath = $_FILES["archivos"]['tmp_name'][$i];

        if ($tmpFilePath != ""){
            $ruta2 = $_FILES['archivos']['name'][$i];
            $ruta = $ruta11.$ruta2;
            //dd($ruta);
            if(move_uploaded_file($tmpFilePath, $ruta)){

            }

        }

        $orden= new sw_orden_pago();

        $orden->op_fac_id=$fac_id;
        $orden->op_op_id=$tipo_op;
        $orden->op_consecutivo=$con_op;
        $orden->op_ruta_archivo_adjunto=$ruta;
        $orden->op_nombre_adjunto=$ruta2;
        $orden->op_creado_en=new DateTime();
        $orden->op_creado_por=Auth::user()->usr_name;
        $orden->op_modificado_en=new DateTime();
        $orden->op_modificado_por=Auth::user()->usr_name;

        //dd($orden);

        $orden->save();

    }
    if ($request->he == 7){
        $a= \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' .'FALSE'. '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = '.$fac_id.'
             AND  htc_dtl_id = 7 ');

        $historico= new sw_historico_factura();
        $historico->htc_fac_id=$fac_id;
        $historico->htc_dtl_id= 9;
        $historico->htc_bandera= 't';
        $historico->htc_descripcion='CORRECTO CON ANEXOS';
        $historico->htc_creado_en=new DateTime();
        $historico->htc_creado_por=Auth::user()->usr_name;
        $historico->htc_modificado_en=new DateTime();
        $historico->htc_modificado_por=Auth::user()->usr_name;

        $historico->save();


    }elseif ($request->he == 4 and $facs->fac_tip_fac <> 2 ) {
        $a = \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' . 'FALSE' . '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = ' . $fac_id . '
             AND  htc_dtl_id = 4 ');

        $historico = new sw_historico_factura();
        $historico->htc_fac_id = $fac_id;
        $historico->htc_dtl_id = 9;
        $historico->htc_bandera = 't';
        $historico->htc_descripcion = 'CORRECTA CON ANEXOS';
        $historico->htc_creado_en = new DateTime();
        $historico->htc_creado_por = Auth::user()->usr_name;
        $historico->htc_modificado_en = new DateTime();
        $historico->htc_modificado_por = Auth::user()->usr_name;

        $historico->save();
    }elseif ($request->he == 4 and $facs->fac_tip_fac == 2){
        $a = \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_bandera =  \'' . 'FALSE' . '\',
             htc_modificado_por =  \'' . Auth::user()->usr_name . '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = ' . $fac_id . '
             AND  htc_dtl_id = 4 ');

        $historico = new sw_historico_factura();
        $historico->htc_fac_id = $fac_id;
        $historico->htc_dtl_id = 8;
        $historico->htc_bandera = 't';
        $historico->htc_descripcion = 'GENERADA ORDEN DE PAGO';
        $historico->htc_creado_en = new DateTime();
        $historico->htc_creado_por = Auth::user()->usr_name;
        $historico->htc_modificado_en = new DateTime();
        $historico->htc_modificado_por = Auth::user()->usr_name;

        $historico->save();
    }


    Session::flash('message', 'Orden De Pago Creada Correctamente '  .$facs->fac_consecutivo);
    return redirect()->route('contabilidad.generadordoc.index');


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
