<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
        \App\Models\Profile::factory(100)->create();
        \App\Models\Patient::factory(100)->create();
        \App\Models\Pharmacist::factory(100)->create();
        \App\Models\PrescriptionForm::factory(100)->create();
        \App\Models\Prescription::factory(100)->create();


    }
}
