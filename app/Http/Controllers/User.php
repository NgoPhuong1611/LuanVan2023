<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.inforUser.login');
    }

    public function infor()
    {
        return view('user.inforUser.profile');
    }

    public function result()
    {
        return view('user.results.readingResult');
    }

    public function userLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = [
            'username' => $username,
            'password' => $password
        ];

        // Validate inputs
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:3'
        ]);

        // Get user info
        $user = User::where('username', $username)->first();

        if (!$user) {
            return redirect()->route('user.login')->with('error', 'Wrong login info');
        }

        $authPassword = Hash::check($password, $user->password);

        if (!$authPassword) {
            return redirect()->route('user.login')->with('error', 'Wrong login info');
        }

        $user->last_login_at = now();
        $user->save();

        // Create session and start working
        $request->session()->put([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
        ]);

        return redirect()->route('user.infor');
    }

    public function register()
    {
        return view('user.inforUser.register');
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
            'password' => Hash::make($password),
            'email' => $email,
            'first_name' => $firstname,
            'last_name' => $lastname,
        ];

        $user = new User($data);
        $user->save();

        return redirect()->route('user.login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('user.login');
    }
}
