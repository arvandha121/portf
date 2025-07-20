<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_id', 
        'subtitle', 
        'experience', 
        'percentage'
    ];

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
