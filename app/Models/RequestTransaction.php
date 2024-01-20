<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestTransaction extends Model
{
    protected $table = 'requests_transaction'; // Tên bảng trong database

    protected $primaryKey = 'id'; // Khóa chính của bảng

    protected $guarded = []; // Các trường không được phép gán tự động

    public $timestamps = false; // Sử dụng timestamps hay không

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Các quy tắc validation
    public static $rules = [
        // Quy tắc validation
    ];

    // Các thông báo validation
    public static $messages = [
        // Các thông báo validation
    ];
}
