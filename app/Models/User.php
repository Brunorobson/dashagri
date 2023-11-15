<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    use HasFactory;

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
