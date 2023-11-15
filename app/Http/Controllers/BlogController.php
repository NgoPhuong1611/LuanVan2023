<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $data['posts'] = $posts;
        return view('User.Blog.index', $data);
    }

    public function detail(Request $request, $id)
    {
        $post = Post::find($id);
        $data['post'] = $post;
        $category = Category::find($post->category_id);
        $data['category'] = $category;

        $admin = Admin::find($post->author);
        $data['admin'] = $admin;

        return view('User.Blog.detail', $data);
    }
}
