<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CleanGeoTablesSeeder extends Seeder
{
    public function run()
    {
        // Desactivar temporalmente restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('postalcodes')->truncate();
        DB::table('cities')->truncate();
        DB::table('provinces')->truncate();
        DB::table('countries')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::statement('ALTER TABLE postalcodes AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE cities AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE provinces AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE countries AUTO_INCREMENT = 1');
    }

}
