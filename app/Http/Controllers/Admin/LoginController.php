<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

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
            // ], customValidationErrorMessage());
        ]);
    // ], customValidationErrorMessage());

        // If validation fails, redirect to login page with error message
        if (!$admin) {
            // $error_msg = "Tên đăng nhập không tồn tại";
            return redirect()->route('admin-login')->with('errors', "Tên đăng nhập không tồn tại");
        }

        // Get user information
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
        $adminModel = new Admin();
        $user = $adminModel->where('username', $username)->first();
        if (!$user) {
            return redirect()->route('admin-login')->with('error', 'Tài khoản không đúng');
        }

        $pass = $user->password;
        $authPassword = md5((string)$password) === $user->password;
        if (!$authPassword) {
            return redirect()->route('admin-login')->with('error', 'Mật khẩu chưa đúng');
        }
        $sessionData = [
            'id' => $admin->id,
            'adminName' => $admin->username,
            'level' => $admin->level,
            'isAdminLogin' => true,
        ];


        $is_update = $adminModel->where('id', $admin->id)->update(['last_login_at' => now()]);
        if (!$is_update) {

            return redirect()->route('admin-login')->with('error', "UNEXPECTED_ERROR_MESSAGE");
            return redirect()->route('admin-login')->with('error', 'UNEXPECTED_ERROR_MESSAGE');
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
