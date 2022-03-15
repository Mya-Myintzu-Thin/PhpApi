<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use HasFactory, Notifiable, HasApiTokens;

class Post extends Model
{
    use SoftDeletes;
    protected $table = 'posts';

    protected $fillable = [
        'title', 
        'comment',
        'created_at',
        'updated_at'
    ];

    protected $date = [
        'deleted_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
