<?php

namespace App\Http\Controllers\Admin;
<<<<<<< HEAD

=======
use Illuminate\Http\Request;
>>>>>>> 49653c2feab2b8dd4182015a38831dee1d4d4518
use Illuminate\Routing\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('Admin.Login.index');
    }

    public function authLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $admin = [
            'username' => $username,
            'password' => $password
        ];

        // Load validation service
        // $request ->validate($admin, [
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:3'
<<<<<<< HEAD
            // ], customValidationErrorMessage());
        ]);
=======
        ]);
    // ], customValidationErrorMessage());
>>>>>>> 49653c2feab2b8dd4182015a38831dee1d4d4518

        // If validation fails, redirect to login page with error message
        if (!$admin) {
            // $error_msg = "Tên đăng nhập không tồn tại";
            return redirect()->route('admin-login')->with('errors', "Tên đăng nhập không tồn tại");
        }

        // Get user information
<<<<<<< HEAD
        $adminModel = new Admin();
        $admin = $adminModel->where('username', $username)->first();
        if (!$admin) {
            return redirect()->route('admin-login')->with('errors', "Tài khoản đăng nhập chưa đúng!!!");
        }

        // $pass = $admin->password;
        // $authPassword = Hash::check($password, $pass);
        // if (!$authPassword) {
        //     return redirect()->route('admin-login')->with('error', "WRONG_LOGIN_INFO_MESSAGE");
        // }

        // Hàm Md5 chạy được
        $adminPassword = md5((string)$password) === $admin->password;
        if (!$adminPassword) {
            return redirect()->route('admin-login')->with('errors', "Mật khẩu đăng nhập chưa đúng!!!");
        } 
=======
        $adminModel = new AdminModel();
        $user = $adminModel->where('username', $username)->first();
        if (!$user) {
            return redirect()->route('admin-login')->with('error', 'WRONG_LOGIN_INFO_MESSAGE');
        }

        $pass = $user->password;
        $authPassword = md5((string)$password) === $user->password;
        if (!$authPassword) {
            return redirect()->route('admin-login')->with('error', 'WRONG_LOGIN_INFO_MESSAGE');
        }
>>>>>>> 49653c2feab2b8dd4182015a38831dee1d4d4518

        $sessionData = [
            'id' => $admin->id,
            'adminName' => $admin->username,
            'level' => $admin->level,
            'isAdminLogin' => true,
        ];


        $is_update = $adminModel->where('id', $admin->id)->update(['last_login_at' => now()]);
        if (!$is_update) {
<<<<<<< HEAD
            return redirect()->route('admin-login')->with('error', "UNEXPECTED_ERROR_MESSAGE");
=======
            return redirect()->route('admin-login')->with('error', 'UNEXPECTED_ERROR_MESSAGE');
>>>>>>> 49653c2feab2b8dd4182015a38831dee1d4d4518
        }

        // Create new session and start working
        session($sessionData);
        return redirect('/dashboard');
    }

    /**
     * Used to logout the user.
     */
    public function logout()
    {
        session()->flush();
        return redirect()->route('admin-login');
    }
}
