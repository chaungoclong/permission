<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * [hasRole description]
     * @param  [type]  $key [description]
     * @return boolean      [description]
     */
    public function hasRole($key)
    {
        $role = $this->getRoleByAnyKey($key);

        if ($role === null) {
            return false;
        }

        return optional($this->role)->id === $role->id;
    }

    /**
     * [getRoleByAnyKey description]
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function getRoleByAnyKey($key)
    {
        if (is_numeric($key)) {
            return Role::find($key);
        }

        if (is_string($key)) {
            return Role::where('slug', $key)->first();
        }

        if (!$key instanceof Role) {
            return null;
        }

        return $key;
    }

    /**
     * [permissions description]
     * @return [type] [description]
     */
    public function getPermissions()
    {
        return optional($this->role)->permissions;
    }

    /**
     * [getUriAccessable description]
     * @return [type] [description]
     */
    public function getUriAccessable()
    {
        $listUri = [];

        $permissions = $this->getPermissions();

        if ($permissions !== null) {
            foreach ($permissions as $permission) {
                foreach (json_decode($permission->uri) as $uri) {
                    $listUri[] = substr($uri, strpos($uri, ':') + 1);
                }
            }
        }

        return $listUri;
    }
}
