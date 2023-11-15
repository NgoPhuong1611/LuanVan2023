<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller;
use App\Models\Admin;
class LoginController extends Controller{
    public function index()
    {
        return view('Admin.Login.index');
    }

    public function authLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $inputs = [
            'username' => $username,
            'password' => $password
        ];

        // Load validation service
        $validation = $this->validate($inputs, [
            'username' => 'required',
            'password' => 'required|min:3'
        ], customValidationErrorMessage());

        // If validation fails, redirect to login page with error message
        if ($validation->fails()) {
            $error_msg = $validation->errors()->first();
            return redirect()->route('admin-login')->with('error', $error_msg);
        }

        // Get user information
        $adminModel = new AdminModel();
        $user = $adminModel->where('username', $username)->first();
        if (!$user) {
            return redirect()->route('admin-login')->with('error', WRONG_LOGIN_INFO_MESSAGE);
        }

        $pass = $user->password;
        $authPassword = Hash::check($password, $pass);
        if (!$authPassword) {
            return redirect()->route('admin-login')->with('error', WRONG_LOGIN_INFO_MESSAGE);
        }

        $sessionData = [
            'id' => $user->id,
            'adminName' => $user->username,
            'level' => $user->level,
            'isAdminLogin' => true,
        ];

        $is_update = $adminModel->where('id', $user->id)->update(['last_login_at' => now()]);
        if (!$is_update) {
            return redirect()->route('admin-login')->with('error', UNEXPECTED_ERROR_MESSAGE);
        }

        // Create new session and start working
        session($sessionData);
        return redirect()->route('Home');
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
