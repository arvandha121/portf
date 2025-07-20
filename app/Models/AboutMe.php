<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    use HasFactory;

    protected $table = 'about_me';

    protected $fillable = [
        'image',
        'description',
        'years_experience',
        'certification_total',
        'companies_worked',
        'cv_file',
    ];
}
