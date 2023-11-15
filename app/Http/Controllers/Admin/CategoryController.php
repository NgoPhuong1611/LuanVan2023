<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\PostsModel;
use Exception;

class Category extends BaseController
{
    public function index()
    {

        $categoryModel = new CategoryModel();
        $category = $categoryModel->paginate(10);
        $datas['category'] = $category;
        return view('Admin/Category/index',$datas);
    }

    public function detail()
    {
        return view('Admin/Category/detail');
    }
    public function save()
    {

        $name=$this->request->getPost('name');
        $slug = $this->request->getPost('slug');
        $status=$this->request->getPost('status');
        $datas = [

            'name' => $name,
            'slug' => $slug,
            'status'=> $status,
        ];
        $category = new CategoryModel();

        $isInsert = $category->insert($datas);
        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('dashboard/category/detail');
    }
    public function delete()
    {
         $id = $this->request->getUri()->getSegment(4);
        //xóa bảng posts chứa khóa ngoai
        $postsModel = new PostsModel();
        $posts = $postsModel->where('category_id', $id)->findAll();
        $posts = $postsModel->where('category_id', $id)->delete();


        $categoryModel=new CategoryModel();
        $categoryModel->delete($id);

         return redirect()->to('dashboard/category');
    }
    public function edit()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);
        $datas['category'] = $category;

        return view('Admin/Category/edit',$datas);
    }
    public function update()
    {
        $id = $this->request->getUri()->getSegment(4);
        // $a = current_url(true);
        // $uri = new \CodeIgniter\HTTP\URI($a);
        // $id = $uri->getSegment(4);

        $categoryModel = new CategoryModel();
        $categoryModel->find($id);


        $name=$this->request->getPost('name');
        $slug = $this->request->getPost('slug');
        $status=$this->request->getPost('status');
        $datas = [

            'name' => $name,
            'slug' => $slug,
            'status'=>$status,
        ];
        $categoryModel->update($id, $datas);
        return redirect()->to('dashboard/category');
    }
}
