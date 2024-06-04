<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Collection $childrens
 * @property Collection $files
 */
class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_root',
        'name',
        'user_id',
        'folder_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function childrens()
    {
        return $this->hasMany(Folder::class, 'folder_id')->with('childrens');
    }

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'folder_id')->with('parent');
    }

}
