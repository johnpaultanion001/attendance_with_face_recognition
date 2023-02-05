<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_code',
        'subject_title',
        'isRemove',
    ];

    public function subjectsTeachersStudents()
    {
        return $this->hasMany(SubjectTeacherStudent::class, 'subject_id');
    }

}
