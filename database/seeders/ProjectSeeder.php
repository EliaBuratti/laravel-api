<?php

namespace Database\Seeders;

use App\Models\project;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Faker\Factory;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {

            $project = new project();
            $project->title = $faker->words(3, true);
            $project->slug = Str::slug($project->title, '-');
            $project->description = $faker->paragraph();
            //$project->cover_image = $faker->imageUrl(640, 400, 'Posts', false);
            $project->cover_image = Storage::copy('placeholder/Placeholder.png', 'cover_images/Placeholder'. $i . '.png');
            $project->cover_image = 'cover_images/Placeholder'. $i . '.png';
            $project->skills = implode(', ', $faker->words(5));
            $project->project_link = $faker->url();
            //dd($project->cover_image);
            $project->save();
        }
    }
}
