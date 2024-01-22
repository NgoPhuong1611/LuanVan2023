<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    protected $table = 'admin'; // Tên bảng trong database

    protected $primaryKey = 'id'; // Khóa chính của bảng
    protected $fillable = ['id','username','password','level','last_login_at','quantity_coin','user_token','email'];

    protected $guarded = []; // Các trường không được phép gán tự động

    public $timestamps = false; // Sử dụng timestamps hay không

    // Các quy tắc validation
    public static $rules = [
        // Quy tắc validation
    ];

    // Các thông báo validation
    public static $messages = [
        // Các thông báo validation
    ];
}
