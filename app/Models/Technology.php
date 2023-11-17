<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug',];

    public function createSlug($title)
    {
        return Str::slug($title, '-');
    }

    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
