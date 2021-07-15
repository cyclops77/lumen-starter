<?php

namespace Database\Seeders;

use \App\Models\AppKey;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AppKeyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppKey::create([
        	'owner' => 'Moch Alfian Ferdiansyah',
        	'app_code' => Str::random(30),
        ]);
        AppKey::create([
            'owner' => 'Debugging',
            'app_code' => 'debugging123',
        ]);
    }
}
