<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = false; //разрешает добавление в бд 
    public function posts(){
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
