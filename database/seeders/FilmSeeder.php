<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Film::factory()->count(100)->create();
        $films = Film::all();
        $genres = Genre::all();
        foreach ($films as $movieName) {
            $movieName->genres()->attach($genres->random(rand(1, count($genres)))->pluck('id')->toArray());
        }
    }
}
