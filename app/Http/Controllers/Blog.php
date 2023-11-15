namespace App\Http\Controllers;

<?php
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('user.blog.blog');
    }
}
