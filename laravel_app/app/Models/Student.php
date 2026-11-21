<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_number',
        'name',
        'kana',
        'birthday',
        'grade',
        'class',
        'department',
        'email',
        'phone',
        'address',
        'photo',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];
}
