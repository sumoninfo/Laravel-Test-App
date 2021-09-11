<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * super admin checking
     *
     * @param $query
     * @return mixed
     */
    public function scopeNotSuperAdmin($query)
    {
        $auth = Helper::getAuth();
        if ($auth && $auth->name != config('app.super_admin_name')) {
            $query->where('name', '!=', 'SuperAdmin');
        }
        return $query;
    }

    /**
     * The "booting" method of the model. (Global Scope)
     *
     * @return void
     */
   /* protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SuperAdmin());
    }*/
}
