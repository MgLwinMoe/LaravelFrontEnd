<?php

namespace App\Http\Controllers;


use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(){
        $categories = Category::select('id','categoryName')->get();
        $blogs = Blog::orderBy('id', 'desc')->with(['cat','user'])->limit(6)->get(['id','title','post_excerpt','slug','user_id','featuredImage']);
        return view('home')->with(['categories' => $categories, 'blogs' => $blogs]);
    }

    public function singleBlog(Request $request, $slug){
        $blogs = Blog::where('slug',$slug)->with(['cat','tag','user'])->first(['id','title','user_id','featuredImage', 'post']);
        $category_ids= [];
        foreach($blogs->cat as $c){
            array_push($category_ids, $c->id);
        }
        $relatedBlog =  Blog::with('user')->where('id', '!=', $blogs->id)->whereHas('cat', function($q) use($category_ids){
            $q->whereIn('category_id', $category_ids);
        })->limit(5)->orderBy('id', 'desc')->get(['id','title','slug','user_id','featuredImage']);

        return view('blogsingle')->with(['blog' => $blogs, 'relatedBlog' => $relatedBlog]);
    }


    public function compose(View $view){
        $cat = Category::select('id','categoryName')->get(['id','categoryName']);
        $view->with('cat',$cat);
    }

    public function categoryIndex(Request $request, $categoryName, $id){
        $blogs =  Blog::with('user')->whereHas('cat', function($q) use($id){
            $q->where('category_id', $id);
        })->orderBy('id','desc')->select(['id','title','slug','user_id','featuredImage'])->paginate(1);
        // return $blogs;
        return view('category')->with(['categoryName' => $categoryName, 'blogs' => $blogs]);
    }
    public function tagIndex(Request $request, $tagName, $id){
        $blogs =  Blog::with('user')->whereHas('tag', function($q) use($id){
            $q->where('tag_id', $id);
        })->orderBy('id','desc')->select(['id','title','slug','user_id','featuredImage'])->paginate(1);
        // return $blogs;
        return view('tag')->with(['tagName' => $tagName, 'blogs' => $blogs]);
    }

    public function getBlogs(Request $request){
        $blogs = Blog::orderBy('id', 'desc')->with(['cat','user'])->select(['id','title','post_excerpt','slug','user_id','featuredImage'])->paginate(1);
        return view('blogs')->with(['blogs' => $blogs]);
    }

    public function search(Request $request){
        $str = $request->str;
        $blogs = Blog::orderBy('id', 'desc')->with(['cat','user','tag'])->select(['id','title','post_excerpt','slug','user_id','featuredImage']);
        $blogs->when(!$str = '', function ($q) use($str){
            $q->where('title', 'LIKE', "%{$str}%")
              ->orwhereHas('cat', function ($q) use($str){
            $q->where('categoryName', $str);
            })
            ->orwhereHas('tag', function ($q) use($str){
            $q->where('tagName', $str);
            });
        });
        $blogs = $blogs->paginate(1);
        return $blogs->appends($request->all());
    }

}
