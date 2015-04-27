<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateTerceroRequest extends Request {

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
		return [
            'nit' => 'required|min:4|unique:terceros,nit',
            'nombre' => 'required|min:3',
            'rol' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|min:10',
            'email' => 'required|email|max:255|unique:terceros,email',

		];
	}

}
