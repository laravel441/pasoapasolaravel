<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DateTime;

class sw_det_lavado extends Model
{

    protected $table = 'sw_det_lavado';

    protected $fillable = array('det_id', 'det_reg_id', 'det_acc_id', 'det_acc_estado', 'det_creado_en', 'det_creado_por', 'det_modificado_en',
        'det_modificado_por');

    protected $primaryKey = 'det_id';
    public $timestamps = false;

}

