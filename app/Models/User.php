<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method \Illuminate\Database\Eloquent\Collection<int, \jeremykenedy\LaravelRoles\Models\Role> getRoles()
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    protected function firstname(): Attribute
    {
        return Attribute::make(
            null,
            function ($value) {
                $nameCollection = Str::of($value)->explode(' ');

                return $nameCollection->first();
            }
        );
    }

    protected function lastname(): Attribute
    {
        return Attribute::make(
            null,
            function ($value) {
                $nameCollection = Str::of($value)->explode(' ');

                return $nameCollection->skip(1)->implode(' ');
            }
        );
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            null,
            function ($value) {
                return Hash::make($value);
            }
        );
    }
}
