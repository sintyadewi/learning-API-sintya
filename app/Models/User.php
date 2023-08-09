<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    protected function getNameCollection($fullName): object
    {
        $nameCollection = Str::of($fullName)->explode(' ');

        return $nameCollection;
    }

    public function getFirstName($fullName): string
    {
        $nameCollection = $this->getNameCollection($fullName);
        $firstName      = $nameCollection->take(count($nameCollection) - 1)->all();
        $firstName      = implode(' ', $firstName);

        return $firstName;
    }

    public function getLastName($fullName): string
    {
        $nameCollection = $this->getNameCollection($fullName);
        $lastName       = $nameCollection->last();

        return $lastName;
    }

    public function getEncryptedPassword($password)
    {
        return Hash::make($password);
    }
}
