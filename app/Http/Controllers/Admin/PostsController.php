<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

use App\Models\Admin;
use Exception;


class PostsController extends Controller
{
    public function index()
    {
        $postsModel = new Post();
        $posts = $postsModel->paginate(10);

        $datas['posts'] = $posts;
        return view('Admin/Posts/index', $datas);
    }

    public function detail()
    {
        $categoryModel = new Category();
        $category = $categoryModel->paginate(10);
        $datas['category'] = $category;
        return view('Admin/Posts/detail',$datas);
    }

    public function save(Request $request)
    {

        $category_id = $request->input('category');
        // $author = session('id');
        $author = 1;
        $title = $request->input('title');
        $slug = $request->input('slug');
        $description = $request->input('description');
        $content = $request->input('content');
        $status = $request->input('status');

        $data = [
            'category_id' => $category_id,
            'author' => $author,
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'content' => $content,
            'status' => $status,
        ];

        try {
            $post = Post::create($data);
        } catch (\Exception $e) {
            throw new \Exception('UNEXPECTED_ERROR_MESSAGE');
        }
        return redirect()->to('dashboard/posts/detail');
    }

    public function delete($id)
    {
        $post = Post::find($id);

        if (!$post) {
            // Handle the case where the post with the given ID is not found
            abort(404);
        }

        $post->delete();
        return redirect()->to('dashboard/posts');
    }
    public function edit(Request $request, $id)
    {
        $category = Category::paginate(10);
        $posts = Post::find($id);

        $data = [
            'category' => $category,
            'posts' => $posts,
        ];

        return View('Admin.Posts.edit', $data);
    }

public function update(Request $request, $id)
{
    $post = Post::find($id);

    $category_id = $request->input('category');
    //$author = session()->get('id');
    $author=1;
    $title = $request->input('title');
    $slug = $request->input('slug');
    $description = $request->input('description');
    $content = $request->input('content');
    $status = $request->input('status');


    $data = [
        'category_id' => $category_id,
        'author' => $author,
        'title' => $title,
        'slug' => $slug,
        'description' => $description,
        'content' => $content,
        'status' => $status,
    ];

    $post->update($data);

    return redirect()->to('dashboard/posts');
}
}
