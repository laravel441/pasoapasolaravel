<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class sw_empleado extends Model {

    protected $table = 'sw_empleados';

    protected $fillable = array ('emp_an8', 'emp_area_id','emp_cod_tm','emp_correo', 'emp_identificacion','emp_nombre',
        'emp_nombre2', 'emp_apellido','emp_apellido2','emp_direccion', 'emp_telefono','emp_celular',
        'emp_correo');

    protected $primaryKey = 'emp_an8';
    public $timestamps = false;

    public function getFullNameAttribute()
    {
        return $this->emp_nombre . ' ' . $this->emp_apellido;
    }
    public function getUsrNameAttribute()
    {

        $full_user = explode("@",$this->emp_correo , 2);


        return $full_user[0];

    }

    public static function FilterAndPaginate ($an8)
    {
        return $users= sw_empleado::an8($an8)

            ->orderBy('emp_an8','DES')
            ->paginate();
    }
    public function profile()
    {
        return $this->hasOne('App\UserProfile');
    }





    public function setPasswordAttribute($value)
    {
        if(! empty ($value))
        {
            $this->attributes['password']= bcrypt($value);
        }

    }



    public function scopeAn8($query, $an8)
    {

        if(trim($an8) != "")//si el nombre esta vacio muestreme toda la lista//omite espacios
        {
            $query->where(\DB::raw("CONCAT(emp_nombre,' ',emp_apellido,emp_an8,emp_identificacion)"),"LIKE", "%$an8%");
            //$query->where('full_name',"LIKE", "%$name%");
        }


    }

//    public function scopeType($query, $type)
//    {
//        $types = ['ful_name','emp_an8','emp_identificacion'];
//
//        if ($type != "" && isset ($types[$type])) {
//            $query->where('type', '=', $type);
//        }
//    }
//    public function is($type)
//    {
//        return $this->type === $type;
//    }





}

