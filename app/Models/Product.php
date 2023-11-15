<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'book';
    //id
    protected $primaryKey = 'book_id';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'book_id',
        'book_name',
        'description',
        'price',
        'img',
        'pub_id',
        'cat_id',
    ]; // them csdl cho nhnah
}
