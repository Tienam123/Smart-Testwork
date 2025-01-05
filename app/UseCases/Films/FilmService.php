<?php

namespace App\UseCases\Films;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class FilmService
{
    public function store(array $data, $thumb,Genre $genre)
    {
        $imgUrl = '';
        if (!is_null($thumb)) {
            $path = Storage::disk('public')
                           ->put('/films', $thumb);
            $imgUrl = $path;
        } else {
            $imgUrl = Film::POSTER_URL;
        }
        $film = Film::create([
            'title'      => $data['title'],
            'thumbnail' => $imgUrl,
            'status'    => false
        ]);
        if (!$film) {
            return null;
        }
        $film->genres()->attach($genre->id);
        return $film;
    }

    public function update($id,$data,$thumb,$genre)
    {

        $film = Film::find($id);
        if (!$film) {
            return null;
        }
        $film->title = $data['title'];
        if (!is_null($thumb)) {
            $path = Storage::disk('public')->put('/films', $thumb);
           $film->thumbnail = $path;
        }
        $film->status = false;
        $film->genres()->sync($genre->id);
        return $film;
    }
}