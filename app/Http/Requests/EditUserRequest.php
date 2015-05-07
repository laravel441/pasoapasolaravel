<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;
use DateTime;

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

            'emp_an8' => 'required|max:255|unique:sw_empleados,emp_an8,'. $this->route->getParameter('users'),
            'emp_area_id'=>'',
            'emp_cod_tm'=>'required|max:255|unique:sw_empleados,emp_cod_tm',
            'emp_identificacion'=>'required|max:255|unique:sw_empleados,emp_identificacion,'. $this->route->getParameter('users'),
            'emp_nombre'=>'required|max:255',
            'emp_nombre2'=>'max:255',
            'emp_apellido'=>'required|max:255',
            'emp_apellido2'=>'max:255',
            'emp_direccion'=>'max:255',
            'emp_telefono'=>'max:255|max:10',
            'emp_celular'=>'max:255|max:10',
            'emp_correo'=>'required|email|max:255|unique:sw_empleados,emp_correo,'. $this->route->getParameter('users'),
            'emp_fecha_nacimiento'=>new DateTime,
            'emp_unidad_negocio'=>'max:255',
            'emp_fecha_ingreso'=>new DateTime,
            'emp_fecha_salida'=>'',
            'emp_creado_en' => new DateTime,
            'emp_creado_por' => 'Swcapital',
            'emp_modificado_en' => new DateTime,
            'emp_modificado_por' => 'Swcapital'


        ];
	}

}
