<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';

    public $fillable = [
        'name',
        'description',
        'user_id'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        
    ];

    
}
