<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'birthdate',
        'birthplace',
        'civil_status',
        'gender',
        'contact_number',
        'isVoter',
        'isRecord',
        'isEmployed',
        'isStudent',
        'isPWD',
        'isSr',
        'isRemove',
        
    ];

    public function requestedDocuments()
    {
        return $this->hasMany(RequestedDocument::class, 'resident_id' , 'id')->latest();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
