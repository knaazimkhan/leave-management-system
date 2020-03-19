<?php

namespace App;

use App\Role;
use App\Events\UserCreated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    // protected $dispatchesEvents = [
    //     'created' => UserCreated::class,
    // ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role) {
        $roles = array_column($this->roles->toArray(), 'name');
        return array_search($role, $roles) > -1;
    }

    public function balance()
    {
        return $this->hasMany('App\LeaveBalance');
    }

    public function apply()
    {
        return $this->hasMany('App\LeaveApply');
    }
}
