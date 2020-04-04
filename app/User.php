<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'last_name', 'username', 'email', 'password',
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

	public function transactions()
	{
		return $this->hasMany(Transaction::class);
	}

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

	public function getBalanceAttribute()
	{
		return $this->transactions()->sum('value');
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
