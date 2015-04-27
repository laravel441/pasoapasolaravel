<?php namespace App;
use Illuminate\Database\Eloquent\Model;
class Buscar_usuario extends Model
{
    protected $table = 'users';

    protected $fillable = array('first_name', 'last_name', 'user_name', 'email', 'password', 'type');





    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}


