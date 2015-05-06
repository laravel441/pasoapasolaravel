<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateEmpRequest;
use App\Http\Requests\EditEmpRequest;
use App\Http\Controllers\Controller;
use App\sw_empleado;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



class EmpleadoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->beforeFilter('@findUser',['only'=>['show', 'update', 'edit', 'destroy']]);
    }

    public function findUser(Route $route)
    {
        //dd($route->getParameter('users'));
        $this->emp = sw_empleado::findOrFail($route->getParameter('emps'));
    }
	public function index()
	{
        //$emps= sw_empleado::filterAndPaginate($request->all());//Creacion de un patron de repositorio en el modelo User.php

        $emps = sw_empleado::orderBy('emp_id','DESC')->paginate();
        return view('admin.emps.index',compact('emps'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.emps.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store(CreateEmpRequest $request)//Inyección de dependecias y llamo mi propio request (face y debo compobarlo)
    {
        //dd($request);
        //$User->save();
//        $user = User::create($request->all());
//        $User = new User();
//        $User->fill($request->all());


//            'first_name' => 'required|max:255',
//            'last_name' => 'required|max:255',
//            'user_name' => 'required|max:255|unique:users,user_name',
//            'email' => 'required|email|max:255|unique:users,email',
//            'password' => 'required|min:6',
//            'type' => 'required|max:255',


        //sw_empleado->emp_creado_en = new DateTime();
        $emp = sw_empleado::create($request->all());


        Session::flash('message',$emp->emp_nombre.' Se ha creado' );

        return redirect()->route('admin.emps.index');

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
        //return view('admin.users.edit')->with ('emp',$this->emp);
        return view('admin.emps.edit')->with ('emp',$this->emp);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditEmpRequest $request,$id)
	{
        $this->emp ->fill($request->all());
        $this->emp ->save();
        Session::flash('message',$this->emp->emp_nombre.' Se ha modificado en nuestros registros' );
        return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id, Request $request)
    {
        $this->emp->delete();
        $message = $this->emp->emp_name . ' fue eliminado de nuestros registros';
        if ($request->ajax()) {
            return response()->json([
                'id'      => $this->emp->emp_id,
                'message' => $message
            ]);
        }
        Session::flash('message', $message);
        return redirect()->route('admin.emps.index');

        //return $id;
        //dd($id);
        //$user = User::findOrFail($id);
        //$this->user->delete();
        //Session::flash('message',$this->user->full_name.' fue eliminado de nuestros registros' );
        //User::destroy($id);
        //return redirect()->route('admin.users.index');
    }

}