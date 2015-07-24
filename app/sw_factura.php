<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class sw_factura extends Model {

    protected $table = 'sw_facturas';

    public $timestamps = false;

    protected $primaryKey = 'fac_id';
    public function scopeFactus($query, $factus)
    {
        if(trim($factus) != "")//si el nombre esta vacio muestreme toda la lista//omite espacios
        {

            $query->where(\DB::raw("CONCAT(fac_id,comp_nombre,fac_consecutivo,fac_num_documento,htc_dtl_id,tip_nombre)"),"ILIKE", "%$factus%");
            //$query->where('full_name',"LIKE", "%$name%");
        }

    }

    public function scopeRadicacion($query, $radicacion)
    {

        if(trim($radicacion) != "")//si el nombre esta vacio muestreme toda la lista//omite espacios
        {

            $query->where(\DB::raw("CONCAT(fac_id)"),"ILIKE", "%$radicacion%");
            //$query->where('full_name',"LIKE", "%$name%");
        }



    }
    public function scopeEnvio($query, $envio)
    {

        if(trim($envio) != "")//si el nombre esta vacio muestreme toda la lista//omite espacios
        {

            $query->where(\DB::raw("CONCAT(fac_id)"),"ILIKE", "%$envio%");
            //$query->where('full_name',"LIKE", "%$name%");
        }



    }

}
