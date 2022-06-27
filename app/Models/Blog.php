<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $table = 'blogs';
    protected $fillable = ['title','post','post_excerpt','slug','user_id','featuredImage','metaDescription','views','jsonData','afafafaf'];

    // public function setTitleAttribute($title){
    //     $this->attributes['slug'] = $this->uniqueSlug($title);
    // }
    // public function uniqueSlug($title){
    //     $slug =  Str::slug($title, '-');
    //     $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();
    //     $newCount = $count > 0 ? ++$count : '';

    //     return $newCount > 0 ? "$slug-$newCount" : $slug ;
    // }

    public function tag(){
        return $this->belongsToMany('App\Models\Tag', 'blogtags');
    }
    public function cat(){
        return $this->belongsToMany('App\Models\Category', 'blogcategories');
    }

    public function user(){
        return $this->belongsTo('App\Models\User')->select('id','fullName','profilePic');
    }






}
