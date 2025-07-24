<?php

namespace Database\Seeders;

use App\Models\Homes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Homes::create([
            'gambar' => 'images/profile.jpg',
            'nama' => 'Arief Nauvan Ramadha',
            'latarbelakang' => 'Informatics Engineering Graduate (GPA 3.62) <br>State Polytechnic of Malang, 2024',
            'teks' => 'Im usually called Nauvan. I have a strong passion for website and mobile development.',
        ]);
    }
}
