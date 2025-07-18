<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_id', 
        'subtitle', 
        'description', 
        'link', 
        'image'
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }
}
