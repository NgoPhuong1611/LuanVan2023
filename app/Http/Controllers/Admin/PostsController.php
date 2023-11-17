<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Posts;
use Exception;


class PostsController extends Controller
{
    public function index()
    {
        $postsModel = new Posts();
        $posts = $postsModel->paginate(10);

        $datas['posts'] = $posts;
        return view('Admin/Posts/index', $datas);
    }

    public function detail()
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->paginate(10);
        $datas['category'] = $category;
        return view('Admin/Posts/detail',$datas);
    }

    public function save()
    {

        $category_id=$this->request->getPost('category');
        $author = session()->get('id');
        $title = $this->request->getPost('title');
        $slug = $this->request->getPost('slug');
        $description = $this->request->getPost('description');
        $content = $this->request->getPost('content');
        $status=$this->request->getPost('status');
        $datas = [
            'category_id'=>$category_id,
            'author' => $author,
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'content' => $content,
            'status'=> $status,
        ];
        $postsModel = new PostsModel();

        $isInsert = $postsModel->insert($datas);
        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/posts/detail');
    }

    public function delete()
    {
        $id = $this->request->getUri()->getSegment(4);

        $postsModel = new PostsModel();
        $postsModel->delete($id);
        return redirect()->to('dashboard/posts');
    }
    public function edit()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $categoryModel = new CategoryModel();
        $category = $categoryModel->paginate(10);
        $datas['category'] = $category;


        $postsModel = new PostsModel();
        $posts = $postsModel->find($id);
        $datas['posts'] = $posts;
        return view('Admin.Post.edit',$datas);

    }
    public function update()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $postsModel = new PostsModel();
        $postsModel->find($id);

        $category_id=$this->request->getPost('category');
        $author = session()->get('id');
        $title = $this->request->getPost('title');
        $slug = $this->request->getPost('slug');
        $description = $this->request->getPost('description');
        $content = $this->request->getPost('content');
        $status=$this->request->getPost('status');
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $updated_at = date('Y-m-d H:i:s');
        $datas = [
            'category_id'=>$category_id,
            'author' => $author,
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'content' => $content,
            'status'=>$status,
            'updated_at' => $updated_at
        ];
        $postsModel->update($id, $datas);
        return redirect()->to('dashboard/posts');
    }
}
