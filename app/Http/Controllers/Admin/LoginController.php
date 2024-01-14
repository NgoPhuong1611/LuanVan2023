<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        $user->password;
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
    public function forgotpassword()
    {
        return view('Admin.Login.ForgotPassword');
    }
    public function recoverPass(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "lấy lại mật khẩu luyện thi toeic" . ' ' . $now;
        // Tìm người dùng theo email
        $admin = Admin::where('email', $data['email'])->first();
        if (!$admin) {
            return redirect()->back()->withInput()->with('errors', 'email chưa được đăng ký');
        }
        // Tạo token ngẫu nhiên
        $token_random = Str::random(6);
        // Cập nhật user_token
        $admin->user_token = $token_random;
        $admin->save();
        // Gửi email thông báo với link đặt lại mật khẩu
        $to_email = $data['email'];
        // $link_reset_pass = url('User.ThongBao?email' . $to_email . '&token' . $token_random);
        $mailData = [
            "name" => $title_mail,
            // "body" => $link_reset_pass,
            "body" => "Mã xác nhận của bạn là: " . $token_random ,
            "email" => $to_email
        ];

        Mail::send('Admin.Login.Confirmation', ['token_random' => $token_random, 'to_email' => $to_email], function ($message) use ($title_mail, $to_email) 
        {
            $message->to($to_email)->subject($title_mail);
            $message->from($to_email, $title_mail);
        });
        // dd($to_email, $token_random);
        return view('Admin.Login.EnterConfirmation', ['data' => $mailData,'token_random' => $token_random, 'to_email' => $to_email]);
    } 
    public function showConfirmTokenForm(Request $request)
    {
      // Assuming $to_email and $token are part of the request
        $to_email = $request->input('to_email');
        $token = $request->input('token_admin');
        // Check if the token and email match in the Admin table
        $admin = Admin::where('email', $to_email)->where('user_token', $token)->first();
        // Logic to handle and return the view for the confirmation form
        return view('Admin.Login.EnterConfirmation', ['token_random' => $token, 'to_email' => $to_email]);
    }
    public function confirmToken(Request $request)
    {
        $email = $request->input('email');
        $token_admin = $request->input('token_admin');
        $token = $request->input('token');
        // Kiểm tra token_user từ input với token được gửi từ email
        if ($token_admin === $token) {
            // Nếu token khớp, chuyển hướng người dùng đến trang đặt lại mật khẩu
            return view('Admin.Login.CreatePass', ['email' => $email]);
        } else {
            // Nếu không khớp, có thể hiển thị thông báo lỗi hoặc chuyển hướng điều hướng khác
            // return redirect()->back()->withInput()->with('errors', 'Mã xác nhận không hợp lệ');
            return redirect()->route('showConfirmTokenForm')->withInput()->with('errors', 'Mã xác nhận không hợp lệ');
            // dd(request()->all());
        }
    }
    public function showResetPasswordForm(Request $request)
    {
        $email = $request->input('email');
        return view('Admin.Login.CreatePass', ['email' => $email]);
    }
    
    public function resetPassword(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        // dd($email);
        // Lấy thông tin người dùng từ email
        $admin = Admin::where('email', $email)->first();
        if ($password !== $confirm_password) {
            // return redirect()->back()->withInput()->withErrors(['Mật khẩu mới không khớp']);
            return redirect()->route('showResetPasswordForm')->withInput()->withErrors(['Mật khẩu mới không khớp']);
        }
        
        // Cập nhật mật khẩu mới
        $admin->password = md5((string)$password);
        // dd(request()->all());   
        $admin->save();
    
        return view('Admin.Login.index');
    }
}
