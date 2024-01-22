<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
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
            return redirect('/Teacher'); // Đường dẫn giao diện cho giáo viên
        } else {
            return redirect()->to('User/Login')->with('errors', 'Loại người dùng không hợp lệ');
        }
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
            'type'=>0,
            'last_name' => $lastname,
        ];

        $existingEmail = User::where('email', $email)->first();
        if ($existingEmail) {
            return redirect()->back()->withInput()->with('errors', 'Email bạn vừa nhập đã tồn tại !!!');
        }

        $existingUser = User::where('username', $username)->first();
        if ($existingUser) {
            return redirect()->back()->withInput()->with('errors', 'Username bạn vừa nhập đã tồn tại !!!');
        }

        User::create($data);

        // return redirect()->route('User.inforUser.Login');
        return view('User.inforUser.Login');
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
            // $old_password = $request->input('old_password');
            $new_password = $request->input('new_password');
            $confirm_password = $request->input('confirm_password');

            $user = User::find($id);

            // if (!Hash::check($old_password, $user->password)) {
            //     return redirect()->back()->with('errors', 'Mật khẩu cũ không chính xác');
            // }

            if ($new_password !== $confirm_password) {
                return redirect()->back()->with('errors', 'Mật khẩu mới không khớp');
            }

            $user->password = md5((string)$new_password);
            $user->save();

            return view('User.inforUser.Login');
        }

        return redirect()->back();
    }
    //quên mật khẩu
    public function forgotpassword()
    {
        return view('User.inforUser.ForgotPassword');
    }
    public function recoverPass(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "lấy lại mật khẩu luyện thi toeic" . ' ' . $now;

        // Tìm người dùng theo email
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('errors', 'email chưa được đăng ký');
        }

        // Tạo token ngẫu nhiên
        $token_random = Str::random(6);

        // Cập nhật user_token
        $user->user_token = $token_random;
        $user->save();

        // Gửi email thông báo với link đặt lại mật khẩu
        $to_email = $data['email'];
        $link_reset_pass = url('User.ThongBao?email' . $to_email . '&token' . $token_random);
        $mailData = [
            "name" => $title_mail,
            // "body" => $link_reset_pass,
            "body" => "Mã xác nhận của bạn là: " . $token_random ,
            "email" => $to_email
        ];

        Mail::send('User.inforUser.Confirmation', ['token_random' => $token_random, 'to_email' => $to_email], function ($message) use ($title_mail, $to_email) 
        {
            $message->to($to_email)->subject($title_mail);
            $message->from($to_email, $title_mail);
        });
        // dd($to_email, $token_random);
        return view('User.inforUser.EnterConfirmation', ['data' => $mailData,'token_random' => $token_random, 'to_email' => $to_email]);
    } 
    public function confirmToken(Request $request)
    {
        $email = $request->input('email');
        $token_user = $request->input('token_user');
        $token = $request->input('token');
        // Kiểm tra token_user từ input với token được gửi từ email
        if ($token_user === $token) {
            // Nếu token khớp, chuyển hướng người dùng đến trang đặt lại mật khẩu
            // return view('User.inforUser.CreatePass');
            return view('User.inforUser.CreatePass', ['email' => $email]);
        } else {
            // Nếu không khớp, có thể hiển thị thông báo lỗi hoặc chuyển hướng điều hướng khác
            return redirect()->route('login')->with('errors', 'Mã xác nhận không hợp lệ.');
        }
        
    }
    public function showResetPasswordForm(Request $request)
    {
        $email = $request->query('email');
        return view('User.inforUser.CreatePass', compact('email'));
    }
    
    public function resetPassword(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');
        // dd($email);
        // Lấy thông tin người dùng từ email
        $user = User::where('email', $email)->first();
        if ($password !== $confirm_password) {
            return redirect()->back()->with('errors', 'Mật khẩu mới không khớp');
        }
    
        // Cập nhật mật khẩu mới
        $user->password = md5((string)$password);
        $user->save();
    
        return view('User.inforUser.Login');
    }
}
