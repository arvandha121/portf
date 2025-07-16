<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Skill;
use App\Models\SkillDetail;

class SkillSeeder extends Seeder
{
    public function run()
    {
        // Ambil user pertama
        $user = User::first();

        if (!$user) {
            $this->command->error('User not found. Make sure at least one user exists.');
            return;
        }

        // Skill 1: Web Development
        $webSkill = Skill::create([
            'user_id' => $user->id,
            'title' => 'Web Development'
        ]);

        $webSkill->details()->createMany([
            [
                'subtitle' => 'HTML',
                'experience' => '2 tahun',
                'percentage' => 90
            ],
            [
                'subtitle' => 'CSS',
                'experience' => '2 tahun',
                'percentage' => 80
            ],
            [
                'subtitle' => 'JavaScript',
                'experience' => '1 tahun',
                'percentage' => 70
            ],
        ]);

        // Skill 2: Mobile Development
        $mobileSkill = Skill::create([
            'user_id' => $user->id,
            'title' => 'Mobile Development'
        ]);

        $mobileSkill->details()->createMany([
            [
                'subtitle' => 'Flutter',
                'experience' => '1 tahun',
                'percentage' => 75
            ],
            [
                'subtitle' => 'Dart',
                'experience' => '1 tahun',
                'percentage' => 70
            ],
        ]);
    }
}
