<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatsResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Section;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $resource = [
            'total' => [
                'authors' => Author::count(),
                'books' => Book::count(),
                'genres'=> Genre::count(),
                'languages'=> Language::count(),
                'sections'=> Section::count(),
            ],
            'version' => '1.0.0'
        ];

        // Convert the array to an object.
        $resource = json_decode(json_encode($resource));

        return StatsResource::make($resource);
    }
}
