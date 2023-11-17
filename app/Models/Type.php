<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    public function createSlug($title)
    {
        return Str::slug($title, '-');
    }

    protected $fillable = ['name', 'slug'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
