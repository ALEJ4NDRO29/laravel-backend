<?php

use Illuminate\Database\Seeder;

class EmployersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Employer::class, 10)
            ->create();
    }
}
