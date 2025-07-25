<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title'];

    public function details()
    {
        return $this->hasMany(CertificateDetail::class);
    }
}
