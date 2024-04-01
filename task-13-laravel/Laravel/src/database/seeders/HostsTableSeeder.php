<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Host;
use Faker\Factory as Faker;

class HostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Host::factory(30)->create();
        
        /*$faker = Faker::create('en_US');

        // Populate hosts table
        foreach (range(1, 10) as $index) {
            Host::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'gender' => $faker->randomElement(['male', 'female']),
            ]);
        }*/
    }
}
