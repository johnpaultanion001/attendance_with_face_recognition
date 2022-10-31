<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'student_folder',
        'name',
        'age',
        'address',
        'grade',
        'section',
        'schedule',
        'image1',
        'image2',
        'isRemove',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
