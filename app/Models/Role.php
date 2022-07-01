<?php

namespace App\Models;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_default'
    ];

    /**
     * relationship with \App\Models\Permission
     * @return [type] [description]
     */
    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'permission_role',
            'role_id',
            'permission_id'
        );
    }

    /**
     * relationship with \App\Models\User
     * @return [type] [description]
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    /**
     * [removeDefaultOfAnotherRole description]
     * @return [type] [description]
     */
    public function removeDefaultOfAnotherRole()
    {
        $this->where('id', '<>', $this->id)
            ->update(['is_default' => false]);
    }
}
