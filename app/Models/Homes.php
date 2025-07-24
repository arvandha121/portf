<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homes extends Model
{
    use HasFactory;

    protected $table = 'homes';

    protected $fillable = [
        'nama',
        'latarbelakang',
        'teks'
    ];
}
