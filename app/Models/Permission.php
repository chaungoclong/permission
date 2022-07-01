<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'uri',
    ];

    /**
     * relationship with \App\Models\Role
     * @return [type] [description]
     */
    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'permission_role',
            'permission_id',
            'role_id'
        );
    }

    // public static function getAllUri()
    // {
    //     $listUri = [];

    //     $permissions = Permission::all();

    //     if ($permissions !== null) {
    //         foreach ($permissions as $permission) {
    //             foreach (json_decode($permission->uri) as $uri) {
    //                 $listUri[] = substr($uri, strpos($uri, ':') + 1);
    //             }
    //         }
    //     }

    //     return $listUri;
    // }

    public function getUri()
    {
        $listUri = [];

        foreach (json_decode($this->uri) as $uri) {
            $listUri[] = substr($uri, strpos($uri, ':') + 1);
        }

        return $listUri;
    }
}
