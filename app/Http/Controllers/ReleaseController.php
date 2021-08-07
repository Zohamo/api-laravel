<?php

namespace App\Http\Controllers;

use App\Models\Release;

class ReleaseController extends Controller
{
    /**
     * Return the list of the ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Release
            ::select('ref', 'slug', 'artist', 'title', 'style', 'disc_number', 'bandcamp_id', 'date_published', 'date_modified')
            ->orderBy('date_modified', 'DESC')
            ->get();
    }

    /**
     * Return the specified resource.
     *
     * @param  string  $ref
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $ref)
    {
        return $ref === 'last'
            ? response(Release::with('links')->orderBy('date_modified', 'desc')->first())
            : response(
                Release::with(['tracks', 'credits', 'links'])
                    ->where('ref', '=', $ref)
                    ->orWhere('slug', '=', $ref)
                    ->first()
            );
    }
}
