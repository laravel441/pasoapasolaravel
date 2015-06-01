<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use DateTime;



class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        //dd(Auth::user());
        $bandera = Auth::user()->usr_flag_pass;
        $id =Auth::user()->usr_id;
        $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($id));

        if(Auth::user()->usr_flag_pass == "TRUE")
        {
            return view('home',compact('menus'));
        }
        $mensaje = "Es su primer ingreso, es necesario que cambie su contraseña";
        Session::flash('message', $mensaje);
        return view('admin.users.cambio',compact('menus'));




      //return view('auth.change_pass');
       // return view('home');
    }
    public function guardar(){
        $id =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                           fn_get_modules (?)',array($id));


        return view('admin.users.cambio',compact('menus'));

    }

    public function  cambiar(Request $requests)
    {
        $id =Auth::user()->usr_id;

        $menus = \DB::select('
                            select * from
                            fn_get_modules (?)',array($id));



        $v = Validator::make($requests->all(),[
            'passwordActual' => 'required',
            'password'      => 'required|confirmed|min:8|max:60|alpha_num|regex:/^[\pL\pN]*(?=[\pL\pN]*\pL)(?=[\pL\pN]*\pN)[\pL\pN]*$/'
        ]);
        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            if (Auth::user())
            {
                $usuario = Auth::user();
                $usuariopassword = Auth::user()->password;
                $actual = $requests->input('passwordActual');
                $nueva = $requests->input('password');
                $bandera =Auth::user()->usr_flag_pass;


                if (Hash::check($actual, $usuariopassword))
                {

                    $usuario->setPasswordAttribute($nueva);
                    $usuario->usr_flag_pass ='TRUE';
                    $usuario->usr_modificado_en = new DateTime();
                    $usuario->usr_modificado_por =Auth::user()->usr_name;
                    $usuario->save();
                    $mensaje = "La contraseña fue cambiada con exito";
                    Session::flash('message', $mensaje);
                    return view('home',compact('menus'));

                }
                else
                {
                    $mensaje = "La contraseña actual no coincide con nuestros registros";
                    Session::flash('message', $mensaje);
                    return view('admin.users.cambio',compact('menus'));
                }

            }
            else
            {
                return "Debe estar autenticado en el sistema";
            }

        }

    }

}
