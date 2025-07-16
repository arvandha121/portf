<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'platform',
        'username',
        'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
