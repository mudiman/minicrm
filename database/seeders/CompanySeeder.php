<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'logo' => 'Mudassar1_netflix.png',
        ]);
    }
}
