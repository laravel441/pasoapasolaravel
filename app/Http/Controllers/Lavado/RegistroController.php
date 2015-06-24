<?php namespace App\Http\Controllers\Lavado;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\sw_empleado;
use App\sw_usuario;
use App\sw_ctl_lavado;
use App\sw_registro_lavado;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\ServiceProvider;



use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;

use DateTime;
use Faker\Factory as Faker;

class RegistroController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

        $id = $request->ctl_id;
        //dd($request->all());
            $iduser =Auth::user()->usr_id;

            $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));



            $regs = sw_registro_lavado::join('sw_ctl_lavado AS ctl','sw_registro_lavado.reg_ctl_id','=','ctl.ctl_id')
                ->join('sw_vehiculo AS sveh', 'sw_registro_lavado.reg_veh_id', '=', 'sveh.veh_id')
                ->select('sw_registro_lavado.reg_id','sw_registro_lavado.reg_ctl_id','sveh.veh_id','sveh.veh_movil',
                    'sw_registro_lavado.reg_tanqueo','sw_registro_lavado.reg_observacion','sw_registro_lavado.reg_aprobacion',
                    'sw_registro_lavado.reg_creado_en')

                ->where ('reg_ctl_id',$id)
                ->registro($request->get('registro'))
                ->orderBY('reg_id', 'DESC')

                ->paginate(3);

            //dd($regs);

            $reg_list = \DB::select('
                           select * from
                            fn_reg_list (?)',array($id));
            //dd($regs);



            //dd($idctl);
            $ctls = sw_ctl_lavado::find($id);

            $ptoid = $ctls->ctl_pto_id;
            $pveid = $ctls->ctl_pve_an8;

            $ptoctls = \DB::select('select pto_nombre from sw_patio where pto_id ='.$ptoid);
            $pvectls = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pveid);

            $ptoctl= $ptoctls[0];
            $pvectl= $pvectls[0];

            $usr_name = Auth::user()->usr_name ;

            $patios = \DB::select('select * from sw_patio
        ');
            $proveedores = \DB::select('select * from sw_proveedor
        ');

            return view('lavado.indexreg',compact('menus','ctls','usr_name','ptoctl','pvectl','regs','reg_list','id'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
        dd($request);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

        //dd($request->all());

        $id = $request->reg_ctl_id;
        $ctl = sw_ctl_lavado::find($id);
        //dd($ctl);

        $ctl->ctl_pto_id = $request->pto_id;
        $ctl->ctl_pve_an8 = $request->prove_id;

        $ctl->ctl_modificado_en = new DateTime();
        $ctl->ctl_modificado_por = Auth::user()->usr_name;

        $ctl->save();
        Session::flash('message', 'Se ha editado el control. ID: '.$id );
        return redirect()->route('lavado.index');



	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id)
	{
		//dd($id);
        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));



        $regs = sw_registro_lavado::join('sw_ctl_lavado AS ctl','sw_registro_lavado.reg_ctl_id','=','ctl.ctl_id')
            ->join('sw_vehiculo AS sveh', 'sw_registro_lavado.reg_veh_id', '=', 'sveh.veh_id')
            ->select('sw_registro_lavado.reg_id','sw_registro_lavado.reg_ctl_id','sveh.veh_id','sveh.veh_movil',
                'sw_registro_lavado.reg_tanqueo','sw_registro_lavado.reg_observacion','sw_registro_lavado.reg_aprobacion',
                'sw_registro_lavado.reg_creado_en')

            ->where ('reg_ctl_id',$id)
            ->orderBY('reg_id', 'DESC')

            ->paginate(3);

        //dd($regs);

        $reg_list = \DB::select('
                           select * from
                            fn_reg_list (?)',array($id));
        //dd($reg_list);

        $regctl = $regs[0];
        $idctl = $regctl->reg_ctl_id;

        //dd($idctl);
        $ctls = sw_ctl_lavado::find($idctl);

        $ptoid = $ctls->ctl_pto_id;
        $pveid = $ctls->ctl_pve_an8;
        //dd($ctls->ctl_observacion);

        $ptoctls = \DB::select('select pto_nombre from sw_patio where pto_id ='.$ptoid);
        $pvectls = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pveid);

        $ptoctl= $ptoctls[0];
        $pvectl= $pvectls[0];

        $usr_name = Auth::user()->usr_name ;

        $patios = \DB::select('select * from sw_patio
        ');
        $proveedores = \DB::select('select * from sw_proveedor
        ');

        return view('lavado.indexreg',compact('menus','ctls','usr_name','ptoctl','pvectl','regs','reg_list','id'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));

        //dd($menus);

        $ctl = sw_ctl_lavado::find($id);

        $pto_id = $ctl->ctl_pto_id;
        $pvd_id = $ctl->ctl_pve_an8;


        $ptonombre = \DB::select('select pto_nombre from sw_patio where pto_id ='.$pto_id);
        $pvdnombre = \DB::select('select pvd_nombre from sw_proveedor where pvd_an8 ='.$pvd_id);

        $pto_nombre= $ptonombre[0];
        $pvd_nombre= $pvdnombre[0];

        //dd($ptonombre);
        $usr_name = Auth::user()->usr_name ;

        //dd($ctl_id);
        $acciones = \DB::select('select * from sw_accion_lavado
        ');

        $patios = \DB::select('select * from sw_patio
        ');
        $vehiculos = \DB::select('select * from sw_vehiculo
        ');
        $proveedores = \DB::select('select * from sw_proveedor
        ');

        //dd($vehiculos);

        return view('lavado.updatectl',compact('menus','usr_name','acciones','vehiculos','id','pto_nombre','pvd_nombre','patios','proveedores','ctl'));
        //dd($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		//dd($request->all());
        $ctl = sw_ctl_lavado::find($request->ctl_id);

        $ctl->ctl_observacion = $request->ctl_observacion;
        $ctl->ctl_fecha_fin = new DateTime();
        $ctl->ctl_modificado_en = new DateTime();
        $ctl->ctl_modificado_por = Auth::user()->usr_name;

        //dd($ctl);
        $ctl->save();
        return redirect()->route('lavado.index');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */



    public function destroy($id)
	{
		dd($id);
	}



}
