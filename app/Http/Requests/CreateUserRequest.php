<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;
use DateTime;

class CreateUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
    private $route; //necesito incluir la propieda route para utilizar el id en las reglas

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    public function authorize()
	{
		return true;//PErmite manejar la logica adicional de usar Request o no
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [


            'usr_emp_an8'=>'',
            'usr_name' => 'required|unique:sw_usuarios,usr_name',
            'password' => '',
            'usr_caducidad' => 'in: 30,60,90,180',
            'usr_flag_pass' => 'boolean',
            'usr_creado_en' => new DateTime,
            'usr_creado_por' => 'Swcapital',
            'usr_modificado_en' => new DateTime,
            'usr_modificado_por' => 'Swcapital',







		];
	}

}
