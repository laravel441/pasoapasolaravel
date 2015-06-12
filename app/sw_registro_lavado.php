<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DateTime;

class sw_registro_lavado extends Model
{

    protected $table = 'sw_registro_lavado';

    protected $fillable = array('reg_id', 'reg_ctl_id', 'reg_veh_id', 'reg_tanqueo', 'reg_observacion', 'reg_aprobracion', 'reg_creado_en',
        'reg_creado_por', 'reg_modificado_en', 'reg_modificado_por');

    protected $primaryKey = 'reg_id';
    public $timestamps = false;


    public function scoperegistro($query, $registro)
    {

        if(trim($registro) != "")//si el nombre esta vacio muestreme toda la lista//omite espacios
        {

            $query->where(\DB::raw("CONCAT(veh_movil)"),"ILIKE", "%$registro%");
            //$query->where('full_name',"LIKE", "%$name%");
        }


    }


}
