<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory, Filterable;
    protected $fillable = ['title'];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tags')->withTimestamps();
    }
}
