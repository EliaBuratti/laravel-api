<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'slug', 'cover_image', 'skills', 'project_link', 'type_id', 'github_link'];

    public function createSlug($title)
    {
        return Str::slug($title, '-');
    }

    public function createSkills($title)
    {
        return Str::slug($title, ', ');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function technology(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }
}
