<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        // panggil class JobsSeeder
        $this->call(JobsSeeder::class);
        // panggil class SkillsSeeder
        $this->call(SkillsSeeder::class);
    }
}
