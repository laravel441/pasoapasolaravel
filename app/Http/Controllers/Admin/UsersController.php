<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Controllers\Controller;
use App\sw_empleado;
use App\sw_usuario;
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





class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct()
    {
        $this->middleware('auth');
        $this->beforeFilter('@findUser',['only'=>['show']]);
    }

    public function findUser(Route $route)
    {
        //dd($route->getParameter('users'));
        //$this->user = sw_usuario::findOrFail($route->getParameter('users'));

    }

	public function index(Request $request)
	{
        //$users= sw_empleado::filterAndPaginate($request->get('name'),$request->get('type'));//Creacion de un patron de repositorio en el modelo User.php

        //$users= User::name($request->get('name'))->type($request->get('type'))->orderBy('id','DESC')->paginate();
        //dd($request->get('user_name'));
        $id =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($id));

        $users = sw_empleado::leftjoin('sw_usuarios','sw_empleados.emp_an8','=','sw_usuarios.usr_emp_an8')
                ->select(
                    'sw_empleados.*',
                    'sw_usuarios.usr_emp_an8 as usr_emp_an8',
                    'sw_usuarios.usr_name',
                    'sw_usuarios.usr_id as usr_id',

                   'sw_usuarios.*')

         ->an8($request->get('an8'))
        ->orderBy('emp_an8','DESC')
        ->paginate(8);

        //dd($users);
//



         return view('admin.users.index',compact('users','menus'));

//        $id =Auth::user()->usr_id;
//
//        $menus = \DB::select('
//                            select * from
//                            sw_get_modules (?)',array($id));


        //dd($users);




                    //->orderBy(\DB::raw('RAND()')) //Funciones de SQL

                    //->leftJoin('user_profiles','users.id','=','user_profiles.user_id')
                    //->first();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{


        return view('admin.users.create');
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Route $route, CreateUserRequest $request)//Inyección de dependecias y llamo mi propio request (face y debo compobarlo)
	{



        $faker = Faker::create();
        $pass='';
        $pass=$this->randomPassword();
        $users = new sw_usuario();
        $users->fill($request->all());

        $users->password =$pass;
        $users->usr_flag_pass ='FALSE';
        $users->usr_creado_en = new DateTime();
        $users->usr_creado_por =Auth::user()->usr_name;
        $users->usr_modificado_en = new DateTime();
        $users->usr_modificado_por =Auth::user()->usr_name;
        $users->remember_token =$faker->sha256;
        $users->save();
        //dd($users);
       // $users = sw_usuario::create($request->all());

//        $users = User::create($request->all());
//        $User = new User();
//        $User->fill($request->all());

//        $user = sw_usuario::create($request->all());
        $emps = sw_empleado::leftjoin('sw_usuarios','sw_empleados.emp_an8','=','sw_usuarios.usr_emp_an8')
            ->select(
                'sw_empleados.*',
                'sw_usuarios.usr_emp_an8 as usr_emp_an8',
                'sw_usuarios.usr_name',
                'sw_usuarios.usr_id as usr_id',

                'sw_usuarios.*')

            ->findOrFail($request->usr_emp_an8);

        $this->sendMailCreate($pass, $emps);
//
        Session::flash('message', 'El usuario ' .$emps->full_name.' '.' Se ha creado en nuestros registros' );

        return redirect()->route('admin.users.index');





	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Route $route, $id)
	{
        //dd($id);
        $id =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($id));

        $users = sw_empleado::leftjoin('sw_usuarios','sw_empleados.emp_an8','=','sw_usuarios.usr_emp_an8')
            ->select(
                'sw_empleados.*',
                'sw_usuarios.usr_emp_an8 as usr_emp_an8',
                'sw_usuarios.usr_name',
                'sw_usuarios.usr_id as usr_id',

                'sw_usuarios.*')

            ->findOrFail($route->getParameter('users'));

        //dd($users);
        return view('admin.users.edit')->with ('user',$users)->with ('menus',$menus);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Route $route, $id)
	{

        $id =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($id));

        $users = sw_usuario::leftjoin('sw_empleados','sw_usuarios.usr_emp_an8','=','sw_empleados.emp_an8')
            ->select(
                'sw_usuarios.*',
                'sw_empleados.emp_an8 as emp_an8',
                'sw_empleados.*')

            ->
        findOrFail($route->getParameter('users'));

        //dd($users);
        return view('admin.users.edit')->with ('user',$users)->with ('menus',$menus);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Route $route, EditUserRequest $request, $id)
	{
        $pass='';
        $users = sw_usuario::leftjoin('sw_empleados','sw_usuarios.usr_emp_an8','=','sw_empleados.emp_an8')
            ->select(
                'sw_usuarios.*',
                'sw_empleados.emp_an8 as emp_an8',
                'sw_empleados.*')

            ->
            findOrFail($route->getParameter('users'));
        //$users= sw_usuario::findOrFail($route->getParameter('users'));
        if ($request->contrasenia == '1'){
            $pass=$this->randomPassword();
//
//
        $users->password =$pass;
        $users->usr_flag_pass = 'FALSE';
        $users->usr_modificado_por =Auth::user()->usr_name;
        $users->usr_modificado_en = new DateTime();
        $users->fill($request->all());
        $users->save();
        $this->sendMailUpdate($pass, $users);

        Session::flash('message', $users->full_name.' '.$pass.' Se ha modificado en nuestros registros' );
        return redirect()->back();

        }else
        $users->usr_modificado_por =Auth::user()->usr_name;
        $users->usr_modificado_en = new DateTime();
        $users->fill($request->all());
        $users->save();
        Session::flash('message', $users->full_name.' '.$pass.' Se ha modificado en nuestros registros' );
        return redirect()->back();


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Route $route, $id, Request $request)
	{
        $users = sw_usuario::leftjoin('sw_empleados','sw_usuarios.usr_emp_an8','=','sw_empleados.emp_an8')
            ->select(
                'sw_usuarios.*',
                'sw_empleados.emp_an8 as emp_an8',
                'sw_empleados.*')

            ->
            findOrFail($route->getParameter('users'));

        //dd($users);
        $users->delete();

        $message = 'El usuario '. $users->usr_name . ' fue eliminado de nuestros registros';
        if ($request->ajax()) {
            return response()->json([
                'id'      => $users->usr_id,
                'message' => $message
            ]);
        }
        Session::flash('message', $message);

        return redirect()->route('admin.users.index');

        //return $id;
		//dd($id);
        //$user = User::findOrFail($id);
        //$this->user->delete();
        //Session::flash('message',$this->user->full_name.' fue eliminado de nuestros registros' );
        //User::destroy($id);
        //return redirect()->route('admin.users.index');
	}

    function randomPassword() {

        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789.";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string

    }

    function sendMailUpdate($contraseña, $users){

        $subject="Actualización Contraseña SWCapital";
        $headers = "From: mesadeayuda@masivocapital.com";
        $headers .= "MIME-Version: Admin\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = '<html>
            <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Actionable emails e.g. reset password</title>
                <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
            </head>

            <body>
                  <div class="alert-danger">
                                 <h1 style="text-align: center;">Actualización Contraseña de SWCapital</h1>';
            $message .= '        <p>Sr (a) ' . $users->full_name. '</p>
                                 <p>Se han asignado sus credenciales de ingreso al aplicativo SWCapital.</p>
                                 <p style="font-weight: bold;"> Usuario: '.$users->usr_name.'</p>
                                  <p style="font-weight: bold;"> Contraseña: '.$contraseña.'</p>
                                 <p>Para ingresar lo puede realizar desde la dirección web: http://swcapital/</p>
                                 <p>Recuerde no responder a este correo, ya que fue enviado automaticamente por SWCapital.
                         Cualquier consulta por favor comunicarla a: mesadeayuda@masivocapital.com</p>

                  </div>';
        $message .=      '</body>
        </html>';


        if (!mail($users->emp_correo, $subject, $message, $headers)) echo 'Error';
    }

    function sendMailCreate($contraseña, $users){

        $subject="Credenciales SWCapital";
        $headers = "From: mesadeayuda@masivocapital.com";
        $headers .= "MIME-Version: Admin\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = '<html>
            <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Actionable emails e.g. reset password</title>
                <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
            </head>

            <body>
                  <div class="alert-danger">
                                 <h1 style="text-align: center;">Credenciales de acceso SWCapital</h1>';
        $message .= '        <p>Sr (a) ' . $users->full_name. '</p>
                                 <p>Se han asignado sus credenciales de ingreso al aplicativo SWCapital.</p>
                                 <p style="font-weight: bold;"> Usuario: '.$users->usr_name.'</p>
                                  <p style="font-weight: bold;"> Contraseña: '.$contraseña.'</p>
                                 <p>Para ingresar lo puede realizar desde la dirección web: http://swcapital/</p>
                                 <p>Recuerde no responder a este correo, ya que fue enviado automaticamente por SWCapital.
                         Cualquier consulta por favor comunicarla a: mesadeayuda@masivocapital.com</p>

                  </div>';
        $message .=      '</body>
        </html>';


        if (!mail($users->emp_correo, $subject, $message, $headers)) echo 'Error';
    }

}
