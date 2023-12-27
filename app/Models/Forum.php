<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'forum'; // Tên bảng trong database

    protected $primaryKey = 'id'; // Khóa chính của bảng

    protected $guarded = []; // Các trường không được phép gán tự động

    public $timestamps = false; // Sử dụng timestamps hay không

    // Các quy tắc validation
    public static $rules = [
        // Quy tắc validation
    ];

    // Các thông báo validation
    public static $messages = [
    ];
}

