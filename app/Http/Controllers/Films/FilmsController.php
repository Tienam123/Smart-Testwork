<?php

namespace App\Http\Controllers\Films;

use App\Http\Controllers\Controller;
use App\Http\Requests\Films\FilmStoreRequest;
use App\Http\Requests\Films\FilmUpdateRequest;
use App\Http\Resources\Films\FilmsResource;
use App\Models\Film;
use App\Models\Genre;
use App\UseCases\Films\FilmService;
use App\UseCases\ResponseMessagesService;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    private ResponseMessagesService $messagesService;
    private FilmService $filmService;

    public function __construct(ResponseMessagesService $messagesService, FilmService $filmService)
    {
        $this->messagesService = $messagesService;
        $this->filmService = $filmService;
    }

    public function index(Request $request)
    {
        $limit = $request->query('limit', 10);
        $items = Film::where('status', 1)
                     ->paginate($limit);

        return response()->json([
            'success' => true,
            'data'    => FilmsResource::collection($items),
            'meta'    => [
                'current_page' => $items->currentPage(),
                'per_page'     => $items->perPage(),
                'last_page'    => $items->lastPage(),
                'total'        => $items->total(),
            ]
        ]);
    }


    public function show(string $film)
    {
        $film = Film::where('id',$film)->where('status', 1)->first();
        if (is_null($film)) {
            return response()->json($this->messagesService->errorMessage('Film Not Found'),404);
        }
        return response()->json([
            'success' => true,
            'data'    => FilmsResource::make($film),
        ]);
    }

    public function store(FilmStoreRequest $request)
    {
        $data = $request->validated();
        $genre = Genre::where('slug', $data['category'])->first();
        $thumb = data_get($data, 'thumbnail', null);
        if (is_null($genre)) {
            return response()->json($this->messagesService->errorMessage('Genre not found'), 404);
        }
        $film = $this->filmService->store($data, $thumb, $genre);
        if (is_null($film)) {
            return response()->json($this->messagesService->errorMessage('Bad Request'), 400);
        }
        return response()->json([
            'success' => true,
            'data'    => FilmsResource::make($film),
        ], 201);
    }

    public function update(FilmStoreRequest $request, string $film)
    {
        $data = $request->validated();
        $genre = Genre::where('slug', $data['category'])->first();
        $thumb = data_get($data, 'thumbnail', null);
        if (is_null($genre)) {
            return response()->json($this->messagesService->errorMessage('Genre Not Found'), 404);
        }
        $film = $this->filmService->update($film, $data, $thumb, $genre);
        if (is_null($film)) {
            return response()->json($this->messagesService->errorMessage('Film Not Found'), 404);
        }

        return response()->json([
            'success' => true,
            'data'    => FilmsResource::make($film),
        ]);
    }

    public function destroy(string $film)
    {
        $film = Film::find($film);
        if (is_null($film)) {
            return response()->json($this->messagesService->errorMessage('Film Not Found'), 404);
        }
        if ($film->delete()) {
            return response()->noContent();
        } else {
            return response()->json($this->messagesService->errorMessage('Bad Request'), 400);
        }
    }

    public function publishFilm($filmId)
    {
        $film = Film::find($filmId);
        if (is_null($film)) {
            return response()->json($this->messagesService->errorMessage('Film Not Found'), 404);
        }
        $film->status = true;
        $film->save();
        return [
            'success' => true,
            'data'    => FilmsResource::make($film),
        ];
    }
}
