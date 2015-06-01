<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\sw_empleado;
use App\sw_usuario;
use App\sw_ctl_lavado;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;

use DateTime;
use Faker\Factory as Faker;

class LavadoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct()
    {
        $this->middleware('auth');

    }
	public function index(Request $request)
	{
        $id =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($id));

        $ctls = \DB::select('
                           select * from
                            fn_lavado (?) ORDER BY ctl_id DESC',array($id));


        //dd($ctls);
        $ctl = $ctls[0];


        //dd($ctl);
        $usr_name = $ctl->usr_name;

        $patios = \DB::select('select * from sw_patio
        ');


        $proveedores = \DB::select('select * from sw_proveedor
        ');


        return view('lavado.index',compact('menus','ctls','patios','proveedores','ctl','usr_name'));

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

        $control = new sw_ctl_lavado();
        $control->fill($request->all());

        $control->ctl_usr_id = Auth::user()->usr_id;
        $control->ctl_pto_id = ($request->pto_id);
        $control->ctl_pve_an8 = ($request->prove_id);
        $control->ctl_fecha_inicio =new DateTime();
        $control->ctl_fecha_fin = new DateTime('0001-01-01 00:00:00');
        $control->ctl_creado_en = new DateTime();
        $control->ctl_creado_por =Auth::user()->usr_name;
        $control->ctl_modificado_en = new DateTime();
        $control->ctl_modificado_por =Auth::user()->usr_name;
        //dd($control);
        $control->save();

        Session::flash('message', 'Se ha creado en nuevo control. ID: '.$control->ctl_id );

        return redirect()->route('lavado.edit',compact('control'));

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
	public function edit(Request $request, $id)
	{
        //dd($id);
        $iduser =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules(?)',array($iduser));

        $controlnr = \DB::select('
                            select * from
                            fn_lavado(?)',array($iduser));



        //dd($controlnr);
        $ctl = $controlnr[0];


        //dd($ctl);
        $usr_name = $ctl->usr_name;



        return view('lavado.edit',compact('menus','ctl','usr_name'));
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
