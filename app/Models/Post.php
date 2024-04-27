<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'status'];
    public $timestamps = false;

    const PRIVATE = 0;
    const PUBLIC = 1;
}
