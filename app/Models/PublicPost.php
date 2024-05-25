<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicPost extends Model
{
    use HasFactory;
    protected $table = 'public_posts';
    public $timestamps = false;
    protected $guarded = [];
}
