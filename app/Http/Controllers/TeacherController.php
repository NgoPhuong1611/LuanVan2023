<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('User.inforUser.Login');
    }
    public function showInforTeacher(){
              
        $user = User::find(session()->get('id'));

        return view('User.Teacher.profile', ['user' => $user]);
    }
    public function terms(){
        return view('User.Teacher.terms');
    }
    public function detail(){
        return view('User.Teacher.detail');
    }
    public function mission(){
        return view('User.Teacher.mission');
    }
    // public function coin(){
    //     return view('User.Teacher.Transaction.index');
    // }
    public function transaction(){
        return view('User.Teacher.transaction');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function result()
    {
        return view('User.Results.readingResult');
    }

    public function editPassword()
    {
        $user = User::where('id', session()->get('id'))->get();

        return view('User.Teacher.UpdatePass', ['user' => $user]);
    }

    public function userLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $request->validate([
            'username' => 'required',
            'password' => 'required|min:3'
        ]);

        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->to('User/Login')->with('errors', 'Thông tin đăng nhập không đúng');
            // return redirect()->route('userlogin')->with('errors', "Tên đăng nhập không tồn tại");
        }

        $authPassword = md5((string)$password) === $user->password;

        if (!$authPassword) {
            return redirect()->to('User/Login')->with('errors', 'Mật khẩu đăng nhập không đúng');
            // return redirect()->route('userlogin')->with('errors', "mat khau hk dung");
        }

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

        if ($user->type === 0) {
            return redirect('/'); // Đường dẫn giao diện cho người dùng
        } elseif ($user->type === 1) {
            return redirect('/teacher-dashboard'); // Đường dẫn giao diện cho giáo viên
        } else {
            return redirect()->to('User/Login')->with('error', 'Loại người dùng không hợp lệ');
        }
    }

    public function registerTeacher()
    {  
        return view('User.teacher.RegisterTeacher');
    }

    public function saveTeacher(Request $request)
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
            'type'=> 1,
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
        return view('User.Teacher.Login');
    }

    public function logout()
    {
        session()->flush();
        // return view('User.inforUser.Login');
        return redirect()->to('User/Login');
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
