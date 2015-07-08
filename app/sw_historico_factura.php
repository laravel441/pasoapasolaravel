<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class sw_historico_factura extends Model {

    protected $table = 'sw_historico_facturas';

    public $timestamps = false;

    protected $primaryKey = 'htc_id';

}
