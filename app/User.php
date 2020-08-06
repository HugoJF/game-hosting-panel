<?php

namespace App;

use App\Traits\HasTransactions;
use Glorand\Model\Settings\Traits\HasSettingsField;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasTransactions;
    use Notifiable;
    use HasSettingsField;

    public array $defaultSettings = [
        'notify_transaction_updated' => true,
        'notify_server_deployed'     => true,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'locale', 'password',
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
        'admin'             => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function servers()
    {
        return $this->hasMany(Server::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class)->withTimestamps();
    }

    public function apiKeys()
    {
        return $this->hasMany(ApiKey::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
