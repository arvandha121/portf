<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'title'];

    public function details()
    {
        return $this->hasMany(SkillDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
