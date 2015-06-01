<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DateTime;

class sw_ctl_lavado extends Model
{

    protected $table = 'sw_ctl_lavado';

    protected $fillable = array('ctl_id', 'ctl_usr_id', 'ctl_pto_id', 'ctl_pve_an8', 'ctl_fecha_inicio', 'ctl_fecha_fin', 'ctl_creado_en',
        'ctl_creado_por', 'ctl_modificado_en', 'ctl_modificado_por');

    protected $primaryKey = 'ctl_id';
    public $timestamps = false;


}
