<?php namespace App\Http\Controllers\Facturacion;

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

class Fac1Controller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        //dd($request->all());
        //$z = $request->count;

        $facturas_usr = \DB::select('select fac_id from sw_facturas where fac_usr_id ='.Auth::user()->usr_id);
        $reg_u = array_pop($facturas_usr);
        //dd($reg_u);
        if (empty($reg_u)){

            $d=0;
            //dd($reg_u,'primer sticker');
        }else{
            $reg_factura = sw_factura::find($reg_u->fac_id);
            //dd($reg_u,$reg_factura,'ya tiene');
            $d=1;
        }

        $id =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($id));
        $proveedores = \DB::select('select * from sw_proveedor ');
        $tipos_facturas = \DB::select('select * from sw_detalle_tipos where tip_mtp_id = 1');
        $companias = \DB::select('select * from sw_companias ORDER by comp_id ASC');



        $contmas = \DB::select('select count(fac_id)from sw_facturas where fac_comp_id = 1;');
        $tmas = current($contmas);
        $umas=$tmas->count;
        $vmas = $umas+1;

        $contmub = \DB::select('select count(fac_id)from sw_facturas where fac_comp_id = 2;');
        $tmub = current($contmub);
        $umub=$tmub->count;
        $vmub = $umub+1;

        $contmai = \DB::select('select count(fac_id)from sw_facturas where fac_comp_id = 3;');
        $tmai = current($contmai);
        $umai=$tmai->count;
        $vmai = $umai+1;


        $x = 'F15-MAS-'.$vmas;
        $y = 'F15-MUB-'.$vmub;
        $z = 'F15-MAI-'.$vmai;


        //dd($x,$y,$z);

        //dd($newsticker);
        return view('facturacion.sticker.index',compact('menus','proveedores','x','y','z', 'tipos_facturas','companias','d','reg_factura'));
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

        $identi = $request->num_identi;
        $idprovee = \DB::select('select pvd_an8 from sw_proveedor where pvd_nombre LIKE '."'".$identi."'");
        $idprove = $idprovee[0]->pvd_an8;

        $idcomp = $request->dirigido_a;
        $idcompan = \DB::select('select comp_id from sw_companias where comp_nombre LIKE '."'".$idcomp."'");
        $idcompa = $idcompan[0]->comp_id;

        $contmas = \DB::select('select count(fac_id)from sw_facturas where fac_comp_id = 1;');
        $tmas = current($contmas);
        $umas=$tmas->count;
        $vmas = $umas+1;

        $contmub = \DB::select('select count(fac_id)from sw_facturas where fac_comp_id = 2;');
        $tmub = current($contmub);
        $umub=$tmub->count;
        $vmub = $umub+1;

        $contmai = \DB::select('select count(fac_id)from sw_facturas where fac_comp_id = 3;');
        $tmai = current($contmai);
        $umai=$tmai->count;
        $vmai = $umai+1;


        $x = 'F15-MAS-'.$vmas;
        $y = 'F15-MUB-'.$vmub;
        $z = 'F15-MAI-'.$vmai;

//----------------------Facturas-----------------
        $reg_factura = new sw_factura();
        $reg_factura->fac_pvd_an8 = $idprove;
        $reg_factura->fac_comp_id = $idcompa;
        $reg_factura->fac_usr_id = Auth::user()->usr_id;
        $reg_factura->fac_tip_fac = ($request->tipo_doc);
        if($idcompa == 1){
            $reg_factura->fac_consecutivo = $x;
        }else if ($idcompa ==2){
            $reg_factura->fac_consecutivo = $y;
        }else{
            $reg_factura->fac_consecutivo = $z;
        }
        $reg_factura->fac_fecha_rad = ($request->date_doc);
        $reg_factura->fac_valor = 0;
        $reg_factura->fac_tip_mon = 0;
        $reg_factura->fac_asunto = "";
        if(($request->tipo_doc) == 3) {
            $reg_factura->fac_num_documento = "NA";
        }else{
            $reg_factura->fac_num_documento= ($request->num_doc);
        }
        $reg_factura->fac_creado_en= new DateTime();
        $reg_factura->fac_creado_por= Auth::user()->usr_name;
        $reg_factura->fac_modificado_en= new DateTime();
        $reg_factura->fac_modificado_por= Auth::user()->usr_name;
        $reg_factura->save();
//---------------------Historico Facturas-------------
        $reg_hfactura = new sw_historico_factura();
        $reg_hfactura->htc_fac_id=$reg_factura->fac_id;
        $reg_hfactura->htc_dtl_id=1;
        $reg_hfactura->htc_creado_en= new DateTime();
        $reg_hfactura->htc_creado_por= Auth::user()->usr_name;
        $reg_hfactura->htc_modificado_en= new DateTime();
        $reg_hfactura->htc_modificado_por= Auth::user()->usr_name;
        $reg_hfactura->save();
//-------------------------
        Session::flash('message', 'Se ha agregado un nuevo sticker: '.$reg_factura->fac_consecutivo );
        return redirect()->route('facturacion.sticker.index');

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
        //dd($id);
        $reg_factura = sw_factura::find($id);
        //dd($reg_factura->fac_creado_en);
        //$fecharad=date_format($reg_factura->fac_creado_en,'Y-m-d (H:i)');

        $identi = $reg_factura->fac_pvd_an8;
        $idprovee = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 = '.$identi);
        $idprove = $idprovee[0]->pvd_nombre;

        $idcomp = $reg_factura->fac_comp_id;
        $idcompan = \DB::select('select comp_nombre from sw_companias where comp_id = '.$idcomp);
        $idcompa = $idcompan[0]->comp_nombre;

        $mpdf=new mPDF('c','A7-L','','',5,5,22,22,5,5);

        // Use different Odd/Even headers and footers and mirror margins

        $header = '
                    <table width="100%" style="border-bottom: 0px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
                    <td width="80%" align="right"><img src="/images/logo.jpg" width="80px" /></td>
                    </tr></table>';
//        $footer = '<div class="main-footer">© Copyright Masivo Capital S.A.S | <a class="text-danger" title="Masivo Capital" target="_blank" href="http://www.masivocapital.com/">www.masivocapital.com</a> | TIC | IDI | 2015</div>';
        $footer = '<div class="text-center">© Copyright Masivo Capital S.A.S | <a class="text-danger" title="Masivo Capital" target="_blank" href="http://www.masivocapital.com/">www.masivocapital.com</a> | TIC | IDI | 2015</div>';
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);




        $html1 = '<table class="table table-hover" border ="0">
                            <thead>
                            <tr>
                            <th  align="left"> <h5>Número de radicado: </h5></th>
                            <td class="text-danger" align="left"><h4>'.$reg_factura->fac_consecutivo.'</h4></td>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <th align="left"> <h5>Fecha de radicado:</h5> </th>
                            <td class="text-danger" align="left"><h5>'.$reg_factura->fac_creado_en.'</h5></td>

                            </tr>
                            <tr>
                            <th  align="left"> <h5>Empresa Emisora:</h5></th>
                            <td class="text-danger" align="left"><h5>'.$idprove.'</h5></td>
                            </tr>

                            <tr>
                            <th  align="left"> <h5>Empresa Receptora:</h5></th>
                            <td class="text-danger" align="left"><h5>'.$idcompa.'</h5></td>
                            </tr>

                            <tr>
                            <th  align="left"><h5>Recibido por:</h5></th>
                            <td class="text-danger" align="left"><h5>'.Auth::user()->usr_name.'</h5></td>
                            </tr>

                            </tbody>
                            </table>';

        $mpdf->SetDisplayMode('fullpage');
        $stylesheet = file_get_contents('bower_components/bootstrap/dist/css/bootstrap.min.css');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html1);

        //dd($mpdf);
        $name =$reg_factura->fac_consecutivo;
        $mpdf->Output($name.'.pdf', 'I');
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
