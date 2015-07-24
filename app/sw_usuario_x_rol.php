<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class sw_usuario_x_rol extends Model {

    protected $table = 'sw_usuario_x_roles';

    public $timestamps = false;

    protected $fillable = array ( 'uxr_usr_id','uxr_rol_id');

    protected $primaryKey = 'uxr_id';

    public function sw_usuario_rol()
    {
        return $this->hasOne('App\sw_usuario');
    }

}
