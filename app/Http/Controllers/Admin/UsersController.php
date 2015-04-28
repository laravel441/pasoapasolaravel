<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{
        $users = User::paginate();
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
	public function store( Redirector $redirect)//Inyección de dependecias y llamo mi propio request (face y debo compobarlo)
	{
        //dd($request);
        //$User->save();
//        $user = User::create($request->all());
//        $User = new User();
//        $User->fill($request->all());
        $data =Request::all();
        $rules= Array(
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'type' => 'required',
//            'first_name' => 'required|max:255',
//            'last_name' => 'required|max:255',
//            'user_name' => 'required|max:255|unique:users,user_name',
//            'email' => 'required|email|max:255|unique:users,email',
//            'password' => 'required|min:6',
//            'type' => 'required|max:255',

        );
        $v = Validator::make($data,$rules);
        if($v->fails())
        {
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput(Request::except('password'));


        }
        $user = User::create($data);
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
        $user = User::findOrFail($id);
		return view('admin.users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $user = User::findOrFail($id);

        $user ->fill(Request::all());
        $user ->save();
        return redirect()->back();


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
