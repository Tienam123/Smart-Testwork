<?php

namespace App\Http\Controllers\Genres;

use App\Http\Controllers\Controller;
use App\Http\Requests\Genres\GenreStoreRequest;
use App\Http\Requests\Genres\GenreUpdateRequest;
use App\Http\Resources\Films\FilmsResource;
use App\Http\Resources\Genres\GenresResource;
use App\Models\Genre;
use App\UseCases\ResponseMessagesService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenresController extends Controller
{
    private ResponseMessagesService $messagesService;

    public function __construct(ResponseMessagesService $messagesService)
    {
        $this->messagesService = $messagesService;
    }

    public function index()
    {
        $genres = Genre::all();
        return response()->json([
            'success' => true,
            'data'    => GenresResource::collection($genres),
        ]);
    }

    public function show(Request $request, string $genre)
    {
        $limit = $request->query('limit', 10);
        $genre = Genre::where('slug', $genre)->first();

        if (is_null($genre)) {
           return response()->json($this->messagesService->errorMessage('Genre not found.'), 404);
        }
        $films = $genre->films()->paginate($limit);

        return response()->json([
            'success'       => true,
            'name' => $genre->name,
            'data'          => FilmsResource::collection($films->items()),
            'meta'          => [
                'current_page' => $films->currentPage(),
                'last_page'    => $films->lastPage(),
                'total'        => $films->total(),
            ]
        ]);
    }

    public function store(GenreStoreRequest $request)
    {
        $data = $request->validated();
        $genre = Genre::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name'])
        ]);

        if (is_null($genre)) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create genre',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data'    => GenresResource::make($genre),
        ], 201);

    }


    public function update(GenreUpdateRequest $request, string $genre)
    {
        $data = $request->validated();
        $genre = Genre::where('slug', $genre)
                      ->first();
        if (is_null($genre)) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found',
                'code'    => 404,
            ], 404);
        }
        $genre->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name'])
        ]);
        return response()->json([
            'success' => true,
            'data'    => new GenresResource($genre),
            'code'    => 200,
        ]);
    }

    public function destroy(string $genre)
    {
        $genre = Genre::where('slug', $genre)
                      ->first();
        if (is_null($genre)) {
            return response()->json([
                'success' => false,
                'message' => 'Genre not found',
            ], 404);
        }
        if ($genre->delete()) {
            return response()->noContent();
        }

    }
}
