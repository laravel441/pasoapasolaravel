<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



class UsersController extends Controller {

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
        $this->user = User::findOrFail($route->getParameter('users'));
    }

	public function index(Request $request)
	{
        $users= User::filterAndPaginate($request->get('name'),$request->get('type'));//Creacion de un patron de repositorio en el modelo User.php

        //$users= User::name($request->get('name'))->type($request->get('type'))->orderBy('id','DESC')->paginate();
        //dd($request->get('user_name'));
        //$users = User::orderBy('id','DESC')->paginate();
        return view('admin.users.index',compact('users'));
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
	public function store(CreateUserRequest $request)//Inyección de dependecias y llamo mi propio request (face y debo compobarlo)
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


        $user = User::create($request->all());
        Session::flash('message',$user->full_name.' Se ha creado' );
        return redirect()->route('admin.users.index');

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
        //$user = User::findOrFail($id);
		//return view('admin.users.edit', compact('user'));
        return view('admin.users.edit')->with ('user',$this->user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditUserRequest $request,$id)
	{
        //$user = User::findOrFail($id);
        $this->user ->fill($request->all());
        $this->user ->save();
        Session::flash('message',$this->user->full_name.' Se ha modificado en nuestros registros' );
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
        $this->user->delete();
        $message = $this->user->full_name . ' fue eliminado de nuestros registros';
        if ($request->ajax()) {
            return response()->json([
                'id'      => $this->user->id,
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

}
