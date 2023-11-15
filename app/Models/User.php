<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
//use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public const SUPPORT = 1;
    public const ADMIN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'cpf',
        'email',
        'password',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        $permissions = [];
        foreach($this->roles as $role){
            foreach($role->permissions as $permission){
                $permissions[] = $permission->guard_name;
            }
        }
        return $permissions;
    }

    public function isSupport(): bool
    {
        return $this->roles()->get()->contains(User::SUPPORT);
    }

    public function isAdmin(): bool
    {
        return $this->roles()->get()->contains(User::ADMIN);
    }


    public function hasPermissionTo(string $permission): bool
    {
        //dd($permission);
        return in_array($permission, $this->permissions());
    }

    public function setRole(int $role_id): void
    {
        /** @var Role $role */

        if (!$this->roles()->get()->contains($role_id)) {
            $this->roles()->sync([$role_id]);
        }
    }

    public function hasRole(int $role_id): bool
    {
        foreach ($this->roles as $role) {
            if ($role->id == $role_id) {
                return true;
            }
        }
        return false;
    }
}
