<?php

use Illuminate\Database\Seeder;

class PruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nueva_migration')->insert([
            'id' => Str::random(10),
            'name' => Str::random(10),
        ]);
    }
}

