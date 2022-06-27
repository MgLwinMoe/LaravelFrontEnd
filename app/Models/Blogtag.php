<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogtag extends Model
{
    use HasFactory;

    protected $table= 'blogtags';
    protected $fillable = ['tag_id','blog_id'];
}
