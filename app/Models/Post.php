<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts'; //хороший тон прописывать название таблицы
    protected $guarded = false; //разрешает добавление в бд 
}
