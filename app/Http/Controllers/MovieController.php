<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Return the list of the ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::select('id', 'slug', 'title', 'artist', 'description', 'created_at', 'updated_at')
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    /**
     * Return the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $slug)
    {
        return response(
            Movie::where('slug', '=', $slug)->first()
        );
    }
}
