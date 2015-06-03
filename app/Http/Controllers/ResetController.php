<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\sw_empleado;
use App\sw_usuario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ResetController extends Controller {

    public function recuperar()
    {
        return view('auth.recuperar');

    }

    public function home()
    {
        return view('auth.login');

    }



    public function recuperarpassword (Request $request)
    {
        $correo = $request->input('email');
        $v = Validator::make($request->all(),[
            'email' => 'required|email'
        ]);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors());
        }
        else
        {
            $pass=$this->randomPassword();
            $usrvali = explode("@",$correo , 2);
            $usr_valido = $usrvali[0];


            $empleado = \DB::table('sw_empleados')->where(['emp_correo'=> $correo])->first();
            $usuariovalido = \DB::table('sw_usuarios')->where(['usr_name'=> $usr_valido])->first();
            //dd($usuariovalido);
            if($empleado == null )
            {

                $mensaje = "El correo electronico digitado no esta registrado como un empleado de SWCapital";
                Session::flash('message', $mensaje);
                return view('auth.recuperar');
            }
            elseif($usuariovalido == null)
            {

                $mensaje = "El empleado no tiene usuario asignado en Swcapital";
                Session::flash('message', $mensaje);
                return view('auth.recuperar');
            }
            else{
                $an8 = $empleado->emp_an8;
                $nombrec =$empleado->emp_nombre.' '.$empleado->emp_apellido;
                $emp_emailc =$empleado->emp_correo;

                $usuario = \DB::table('sw_usuarios')->where(['usr_emp_an8'=> $an8])->first();
                $user_namec =$usuario->usr_name;
                \DB::table('sw_usuarios')
                    ->where('usr_emp_an8',$an8)
                    ->update(['password' =>bcrypt($pass),
                        'usr_flag_pass' => 'FALSE',
                        'usr_modificado_en' => new DateTime(),
                        'usr_modificado_por'=>$user_namec
                    ]);
                /////////////////////////////////////////////////////////////////
                $this->sendMailReset($emp_emailc,$nombrec,$user_namec,$pass );
                $mensaje = 'Se ha enviado un correo a la direcciÃ³n registrada con los datos de ingreso a SWCapital.';

                Session::flash('message', $mensaje);

                return view('/auth/recuperar');
                /*$mensaje = null;
                $data = array(
                    'para'=> $nombre,
                    'usuario'     => $user_name,
                    'contraseña' => $pass
                );
                $fromEmail = 'mesadeayuda@masivocapital.com';
                $fromName  = 'Administrador';
                Mail::send('emails.contacto',$data,function($message)use ($fromEmail,$fromName,$correo,$nombre)
                    {
                        $message->to($correo,$nombre);
                        $message->from($fromEmail,$fromName);
                        $message->subject('Recuperación Contraseña SWCapital');
                    }
                );
                $mensaje = 'Se ha enviado un correo a la dirección registrada con los datos de ingreso a SWCapital.';

                Session::flash('message', $mensaje);

                return view('/auth/recuperar');*/
            }
        }

    }

    function sendMailReset($emp_correoc,$nombrec,$user_namec,$pass){

        $subject="ActualizaciÃ³n ContraseÃ±a SWCapital";
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
                                 <h1 style="text-align: center;">ActualizaciÃ³n ContraseÃ±a de SWCapital</h1>';
        $message .= '        <p>Sr (a) ' . $nombrec . '</p>
                                 <p>Se han asignado sus credenciales de ingreso al aplicativo SWCapital.</p>
                                 <p style="font-weight: bold;"> Usuario: '.$user_namec.'</p>
                                  <p style="font-weight: bold;"> ContraseÃ±a: '.$pass.'</p>
                                 <p>Para ingresar lo puede realizar desde la direcciÃ³n web: http://swcapital/</p>
                                 <p>Recuerde no responder a este correo, ya que fue enviado automaticamente por SWCapital.
                         Cualquier consulta por favor comunicarla a: mesadeayuda@masivocapital.com</p>

                  </div>';
        $message .=      '</body>
        </html>';


       if (!mail($emp_correoc, $subject, $message, $headers)) echo 'Error';
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



}
