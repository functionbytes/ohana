<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        Country::create([
            'uid' => '2bade630-6fc0-49b1-b158-f16c527911a9',
            'title' => 'España',
            'iso' => 'ES'
        ]);
    }
}
