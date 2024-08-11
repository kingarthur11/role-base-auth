<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table = 'posts';

    public $fillable = [
        'name',
        'description'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        
    ];

    
}
