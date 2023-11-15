<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    protected $table = 'question'; // Table name in the database

    protected $primaryKey = 'id'; // Primary key of the table

    protected $guarded = []; // Fields not allowed to be mass assigned

    public $timestamps = false; // Use timestamps or not

    // Validation rules
    public static $rules = [
        // Validation rules
    ];

    // Validation messages
    public static $messages = [
        // Validation messages
    ];
}
