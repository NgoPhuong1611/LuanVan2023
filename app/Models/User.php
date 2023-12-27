<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    protected $table = 'users'; // Table name in the database

    protected $primaryKey = 'id'; // Primary key of the table

    protected $guarded = []; // Fields not allowed to be mass assigned

    public $timestamps = false; // Use timestamps or not

    // Validation rules
    public static $rules = [
        // Validation rules
    ];
    protected $fillable = [
        'type',
        'username',
        'password',
        'email',
        'first_name',
        'last_name',
        'status',
        'updated_at',
        'quantity_coin',
    ];
    // Validation messages
    public static $messages = [
        // Validation messages
    ];
}
