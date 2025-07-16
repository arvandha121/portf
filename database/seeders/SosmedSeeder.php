<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sosmed;

class SosmedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first(); // atau sesuai user_id

        Sosmed::create([
            'user_id' => $user->id,
            'platform' => 'LinkedIn',
            'username' => 'ariefnauvan',
            'url' => 'https://www.linkedin.com/in/anauvanr/',
        ]);

        Sosmed::create([
            'user_id' => $user->id,
            'platform' => 'GitHub',
            'username' => 'arvandha',
            'url' => 'https://github.com/arvandha121',
        ]);

        Sosmed::create([
            'user_id' => $user->id,
            'platform' => 'Instagram',
            'username' => 'nauvan.id',
            'url' => 'https://instagram.com/arvandha_',
        ]);
    }
}
