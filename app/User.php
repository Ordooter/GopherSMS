<?php

namespace App;

use App\UserMessage;
use App\UserPayment;
use App\UserTransaction;
use App\UserSubscription;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

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
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function transactions()
    {
        return $this->hasMany('App\UserTransaction');
    }

    public function subscriptions()
    {
        return $this->belongsTo('App\UserSubscription');
    }

    public function payments()
    {
        return $this->hasMany('App\UserPayment');
    }

    public function messages()
    {
        return $this->hasMany('App\UserMessage');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_roles');
    }

}