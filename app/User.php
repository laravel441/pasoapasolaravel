<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	
	protected $fillable = array ('first_name', 'last_name','user_name','email', 'password','type');


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function profile()
	{
		return $this->hasOne('App\UserProfile');
	}


	public function getFullNameAttribute()
	{
		return $this->first_name . ' ' . $this->last_name;
	}



    public function setPasswordAttribute($value)
    {
        if(! empty ($value))
        {
            $this->attributes['password']= bcrypt($value);
        }

    }

    public function scopeName($query, $name)
    {

        if(trim($name) != "")//si el nombre esta vacio muestreme toda la lista//omite espacios
        {
            //$query->where(\DB::raw("CONCAT(first_name,' ',last_name)"),"LIKE", "%$name%");//consulta Db::raw
            $query->where(\DB::raw("CONCAT(first_name,' ',last_name)"),"LIKE", "%$name%");
        }

    }


}
