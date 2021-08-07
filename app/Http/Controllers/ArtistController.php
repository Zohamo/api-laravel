<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Return the list of the ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist
            ::with('categories')
            ->orderBy('name')
            ->get();

        return array_map(function ($artist) {
            $artist['categories'] = array_map(function ($artistCategory) {
                return $artistCategory['category'];
            }, $artist['categories']);
            return $artist;
        }, $artists->toArray());
    }

    /**
     * Return the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $slug)
    {
        $artist = Artist::where('slug', '=', $slug)
            ->select(['id', 'slug', 'name', 'description'])
            ->with(['categories', 'relationships'])
            ->first()
            ->toArray();

        // Flatten the artist's categories
        $artist['categories'] = array_map(function ($artistCategory) {
            return $artistCategory['category'];
        }, $artist['categories']);

        // Flatten the artist's relationships
        $relationships = $artist['relationships'];
        $artist['relationships'] = [
            'releases' => [],
            'proojects' => [],
            'videos' => []
        ];
        foreach ($relationships as $relationship) {
            if (!empty($relationship['release'])) {
                $artist['relationships']['releases'][] = $relationship['release'];
            } elseif (!empty($relationship['prooject'])) {
                $artist['relationships']['proojects'][] = $relationship['prooject'];
            } elseif (!empty($relationship['video'])) {
                $artist['relationships']['videos'][] = $relationship['video'];
            }
        }

        // Sort each relationship type by descending 'updated_at'
        foreach (['releases', 'proojects'] as $relationshipType) {
            usort($artist['relationships'][$relationshipType], function ($item1, $item2) {
                return $item2['updated_at'] <=> $item1['updated_at'];
            });
        }

        return response($artist);
    }
}
