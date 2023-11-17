<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post; // Assuming your model is named Post, change it if it's different
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::paginate(10);
        return view('Admin.Category.index', ['category' => $category]);
    }

    public function detail()
    {
        return view('Admin.Category.detail');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'status' => $request->input('status'),
        ];

        $isInsert = Category::create($data);

        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }

        return redirect()->to('dashboard/category/detail');
    }

    public function delete($id)
    {
        // Delete related posts
        Post::where('category_id', $id)->delete();

        // Delete category
        Category::destroy($id);

        return redirect()->to('dashboard/category');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('Admin.Category.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'status' => $request->input('status'),
        ];
        
        Category::find($id)->update($data);

       return redirect()->to('dashboard/category');
    }
}
