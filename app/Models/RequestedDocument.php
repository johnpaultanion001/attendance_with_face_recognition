<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedDocument extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'request_number',
        'user_id',
        'resident_id',
        'document_id',
        'claiming_date',
        'amount_to_pay',
        'remarks',

        'isRemove',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
