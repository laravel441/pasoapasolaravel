<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request {

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

    public function rules()//Reglas para el formulario(si el email ya este en uso y el user_name
    {

        $usr_req=$this->all();

        if ($usr_req[user_name]!=$usr_req[user_name_c]) {
            return [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'user_name' => 'required|max:255|unique:users,user_name',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:6',
                'type' => 'required|max:255',

            ];
        } else {
            return [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'user_name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:6',
                'type' => 'required|max:255',

            ];
        }
    }


}
