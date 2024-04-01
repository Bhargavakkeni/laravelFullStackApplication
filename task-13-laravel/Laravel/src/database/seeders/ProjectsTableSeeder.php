<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Host;
use App\Models\Project;
use Faker\Factory as Faker;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Project::factory(30)->create();
        
        /*$faker = Faker::create('en_US');

        // Populate projects table with random user_id referencing Hosts table's id
        $hostIds = Host::pluck('id')->toArray(); // Get all ids from Hosts table
        foreach (range(1, 10) as $index) {
            Project::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'user_id' => $faker->randomElement($hostIds), // Randomly select a host id
            ]);
        }*/
    }
}
