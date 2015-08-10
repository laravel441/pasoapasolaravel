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


class Fac2Controller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));

        $d = 1; //Estado generado el sticker
        $f = 5; //Estado No aprobado contabilidad y enviado a radicación
        $radicacion = sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->join('sw_proveedor AS pvd', 'pvd.pvd_an8', '=', 'sw_facturas.fac_pvd_an8')
            ->select('sw_facturas.*','dett.tip_nombre','comp.comp_nombre','pvd.pvd_nombre','htc.htc_dtl_id')
            ->where ('htc.htc_dtl_id', $d)
            ->Orwhere ('htc.htc_dtl_id', $f)
            ->orderBY('fac_id', 'DESC')
            ->radicacion($request->get('radicacion'))
            ->paginate();
        $e = 2;

        //dd($radicacion);

        $envio = sw_factura::join('sw_historico_facturas AS htc','sw_facturas.fac_id','=','htc.htc_fac_id')
            ->join('sw_companias AS comp', 'comp.comp_id', '=', 'sw_facturas.fac_comp_id')
            ->join('sw_detalle_tipos AS dett', 'dett.tip_id', '=', 'sw_facturas.fac_tip_fac')
            ->join('sw_proveedor AS pvd', 'pvd.pvd_an8', '=', 'sw_facturas.fac_pvd_an8')
            ->select('sw_facturas.*','dett.tip_nombre','comp.comp_nombre','pvd.pvd_nombre')
            ->where ('htc.htc_dtl_id', $e)
            ->orderBY('fac_id', 'DESC')
            ->get();
       if (empty($envio[0])){
           $envi = 1;
        //dd($envio,$envi,'no tiene');
       }else
           $envi = 2;
        //dd($envio,$envi,'si tiene');




        $users_contabilidad = \DB::select('
                             SELECT DISTINCT 	usr.usr_id,
	usr.usr_name,
	emp.emp_nombre,
	emp.emp_nombre2,
	emp.emp_apellido


  FROM    sw_usuarios usr,
	    sw_empleados emp,
	sw_modulo_x_roles mxr,
	sw_usuario_x_roles uxr

    WHERE	mxr.mxr_mod_id	=	4
    AND	uxr.uxr_rol_id	=	mxr.mxr_rol_id
    AND     usr.usr_id 	=       uxr.uxr_usr_id
    AND     emp.emp_an8 	=       usr.usr_emp_an8');

       //dd($users_contabilidad);//mod_4
        $monedas= \DB::select('select * from sw_detalle_tipos where tip_mtp_id = 2');
        $proveedores= \DB::select('select * from sw_proveedor');


        //dd($radicacion,$proveedores);

        return view('facturacion.radicacion.index',compact('menus','radicacion','envio','users_contabilidad','envi','monedas','proveedores'));
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
        //$array_nombre=$_FILES["archivos"]['name'];
        //dd($array_nombre);
        $con = $request->con;
        $id=$request->a;
        $fac= sw_factura::find($id);
        $fac->fac_pvd_an8=$request->provee;
        $fac->fac_valor=$request->valor_fac;
        $fac->fac_asunto=$request->asunto;
        $fac->fac_num_documento=$request->num_doc;
        $fac->fac_tip_mon=$request->monedas;
        $fac->fac_modificado_en = new DateTime();
        $fac->fac_modificado_por =Auth::user()->usr_name;
        //dd($registro);
        $fac->save();
/** Factura valor y asunto */
//        $id_htc = \DB::select('select htc_id from sw_historico_facturas where htc_fac_id ='.$id);
//        $idhtc = array_pop($id_htc);
//        $hfac= sw_historico_factura::find($idhtc->htc_id);
//        $hfac->htc_dtl_id=2;
//        $hfac->htc_modificado_en=new DateTime();
//        $hfac->htc_modificado_por=Auth::user()->usr_name;
//        $hfac->save();
        $reg_hfactura = new sw_historico_factura();
        $reg_hfactura->htc_fac_id=$id;
        $reg_hfactura->htc_dtl_id=2;
        $reg_hfactura->htc_descripcion=2;
        $reg_hfactura->htc_creado_en= new DateTime();
        $reg_hfactura->htc_creado_por= Auth::user()->usr_name;
        $reg_hfactura->htc_modificado_en= new DateTime();
        $reg_hfactura->htc_modificado_por= Auth::user()->usr_name;
        $reg_hfactura->save();



        $array_nombre=$_FILES["archivos"]['name'];
        $ruta1 = 'Z:\adjuntos_swcapital\facturas\ ';
        $rutafac = '\ ';
        $rutafac= rtrim($rutafac);
        $ruta11 = rtrim($ruta1).$con.$rutafac;
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
        }

        if($array_nombre[0]== null){

        }else {
            foreach ($array_nombre as $datos){
                $ruta1 = 'Z:\adjuntos_swcapital\facturas\ ';
                $rutafac = '\ ';
                $rutafac = rtrim($rutafac);
                $ruta11 = rtrim($ruta1).$con.$rutafac;
                $route=$datos;
                $ruta = $ruta11.$route;


                $archivo=new sw_archivos_facturas();

                $archivo->arc_fac_id=$id;
                $archivo->arc_fac_ruta =$ruta;
                $archivo->arc_fac_nombre=$datos;
                $archivo->arc_creado_en= new DateTime();
                $archivo->arc_creado_por =Auth::user()->usr_name;
                $archivo->arc_modificado_en = new DateTime();
                $archivo->arc_modificado_por =Auth::user()->usr_name;

                $archivo->save();
            }
        }


        /** Historico factura estado 2 */
        Session::flash('message', 'Se radicó el documento: '.$request->con );
        return redirect()->route('facturacion.radicacion.index');
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
	public function update(Request $request)
	{
       // dd($request->all());

        $d = $request->items;
        $e = $request->usr_asignado;



           //dd($d);
        if (is_null($d)){
            //dd($request->all(),':(');
            Session::flash('message2', 'Debes seleccionar la(s) factura(s) para enviar' );
            return redirect()->back();

        }

        foreach($d as $r){
            $user = Auth::user()->usr_name;
            $x= \DB::statement('
             UPDATE sw_historico_facturas
             SET htc_dtl_id = 3,
             htc_modificado_por =  \'' .$user. '\',
             htc_modificado_en = CURRENT_TIMESTAMP
             WHERE htc_fac_id = '.$r);
        }

        foreach($d as $f) {
            $asignar = new sw_asignacion_facturas();
            $asignar->asg_fac_id = $f;
            $asignar->asg_usr_asignacion = Auth::user()->usr_id;
            $asignar->asg_usr_asignado = $e;
            $asignar->asg_creado_en = new DateTime();
            $asignar->asg_creado_por = Auth::user()->usr_name;
            $asignar->asg_modificado_en = new DateTime();
            $asignar->asg_modificado_por = Auth::user()->usr_name;

            $asignar->save();


        }
        //dd($asignar);
        Session::flash('message', 'Se han enviado la(s) factura(s).');
        return redirect()->route('facturacion.radicacion.index');
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
