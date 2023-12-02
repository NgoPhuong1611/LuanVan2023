<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::paginate(10);
        return view('Admin.Admin.index', ['admin' => $admin]);
    }

    public function detail()
    {
        return view('Admin/Admin/detail');
    }

    public function save(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]);

        $data = [
            'username' =>$request->input('username'),
            'password' => md5($request->input('password')),
            'level' => $request->input('level'),

        ];

        $isInsert = Admin::create($data);

        if (!$isInsert) {
            // throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }

        return redirect()->to('dashboard/admin/detail');
    }

    public function delete($id)
    {
        // Delete related posts

        // Delete category
        Admin::destroy($id);

        return redirect()->to('dashboard/admin/');
    }
    public function edit($id)
    {
        $admin = Admin::find($id);

        return view('Admin.Admin.edit', ['admin' => $admin]);
    }
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]);

        $data = [
            'username' =>$request->input('username'),
            'password' => md5($request->input('password')),
            'level' => $request->input('level'),

        ];

        Admin::find($id)->update($data);

       return redirect()->to('dashboard/admin');
    }
}
