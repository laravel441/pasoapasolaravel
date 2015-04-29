<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditUserRequest extends Request {

    private $route; //necesito incluir la propieda route para utilizar el id en las reglas

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        //dd($this->route->getParameter('users'));
		return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'user_name' => 'required|max:255|unique:users,user_name,'. $this->route->getParameter('users'),
            'email' => 'required|email|max:255|unique:users,email,'. $this->route->getParameter('users'),
            'password' => 'min:6',
            'type' => 'required|in:user,admin',
		];
	}

}
