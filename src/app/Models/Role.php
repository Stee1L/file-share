<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Role extends Model
{
    use HasFactory;
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
