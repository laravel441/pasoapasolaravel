<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class sw_rol extends Model {

    protected $table = 'sw_roles';

    public $timestamps = false;

    protected $fillable = array ( 'rol_id','rol_nombre');

    protected $primaryKey = 'rol_id';




}
