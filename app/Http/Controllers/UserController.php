<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('User.inforUser.Login');
    }


    public function showInforUser()
    {
        $user = User::find(session()->get('id'));

        return view('User.inforUser.profile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(session()->get('id'));

        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name')
        ];

        $user->update($data);

        return redirect('/');
    }

    public function editPassword()
    {
        $user = User::where('id', session()->get('id'))->get();

        return view('User.inforUser.UpdatePass', ['user' => $user]);
    }

    public function userLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = [
            'username' => $username,
            'password' => $password
        ];

        $request->validate([
            'username' => 'required',
            'password' => 'required|min:3'
        ]);

        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->to('User/Login')->with('error', 'Wrong login info');
        }

        $authPassword = md5((string)$password) === $user->password;

        if (!$authPassword) {
            return redirect()->to('User/Login')->with('error', 'Wrong login info');
        }

        $user->updated_at = now();
        $user->save();

        $sessionData = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'isUserLogin' => true,
        ];

        $user->update(['updated_at' => now()]);

        session($sessionData);

        return redirect('/');
    }

    public function register()
    {

        return view('User.inforUser.Register');
    }

    public function save(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $firstname = $request->input('first_name');
        $lastname = $request->input('last_name');

        $data = [
            'username' => $username,
            'password' => md5((string)$password),
            'email' => $email,
            'first_name' => $firstname,
            'last_name' => $lastname,
        ];

        $existingEmail = User::where('email', $email)->first();
        if ($existingEmail) {
            return redirect()->back()->withInput()->with('error', 'Email bạn vừa nhập đã tồn tại !!!');
        }

        $existingUser = User::where('username', $username)->first();
        if ($existingUser) {
            return redirect()->back()->withInput()->with('error', 'Username bạn vừa nhập đã tồn tại !!!');
        }

        User::create($data);

        // return redirect()->route('User.inforUser.Login');
        return view('User.inforUser.Login');
    }

    public function logout()
    {
        session()->flush();
        return view('User.inforUser.Login');
    }

    public function changePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $id = $request->input('iduser');
            $old_password = $request->input('old_password');
            $new_password = $request->input('new_password');
            $confirm_password = $request->input('confirm_password');

            $user = User::find($id);

            if (!Hash::check($old_password, $user->password)) {
                return redirect()->back()->with('error', 'Mật khẩu cũ không chính xác');
            }

            if ($new_password !== $confirm_password) {
                return redirect()->back()->with('error', 'Mật khẩu mới không khớp');
            }

            $user->password = Hash::make($new_password);
            $user->save();

            return redirect()->route('User/Profile')->with('success', 'Mật khẩu đã được thay đổi thành công');
        }

        return redirect()->back();
    }



}
