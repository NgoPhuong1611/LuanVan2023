<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index()
    {
        $user = User::paginate(10);
        $user = User::where('type',0)->get();
        return view('Admin.User.index', ['user' => $user]);
    }
    public function indexteacher()
    {
        $teacher = User::where('type',1)->get();
        return view('Admin.Teacher.index', ['teacher' => $teacher]);
    }

    public function detail()
    {
        return view('Admin/User/detail');
    }
    public function detailteacher()
    {
        return view('Admin/User/detail');
    }
    public function save(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'username' =>$request->input('username'),
            'password' => md5($request->input('password')),
            'email' =>$request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name' =>$request->input('last_name'),
            'status' => $request->input('status'),
        ];

        $isInsert = User::create($data);

        if (!$isInsert) {
            throw new Exception(UNEXPECTED_ERROR_MESSAGE);
        }

        return redirect()->to('dashboard/user/detail');
    }
    public function delete($id)
    {
        // Delete related posts

        // Delete category
        User::destroy($id);

        return redirect()->to('dashboard/user/');
    }
    public function edit($id)
    {
        $user = User::find($id);

        return view('Admin.User.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'username' =>$request->input('username'),
            'password' => md5($request->input('password')),
            'email' =>$request->input('email'),
            'first_name' => $request->input('first_name'),
            'last_name' =>$request->input('last_name'),
            'status' => $request->input('status'),
        ];


        User::find($id)->update($data);

       return redirect()->to('dashboard/user');
    }
}
