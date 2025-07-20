<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPortofolio extends Model
{
    use HasFactory;

    protected $table = 'project_portofolio';

    protected $fillable = [
        'user_id',
        'title',
        'tipe',
        'description',
        'image',
        'link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
