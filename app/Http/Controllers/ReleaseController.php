<?php

namespace App\Http\Controllers;

use App\Models\Release;
use App\Models\ReleaseLink;
use Illuminate\Http\Request;

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
            ::select('ref', 'slug', 'artist', 'title', 'disc_number', 'bandcamp_id', 'date_published', 'date_modified')
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
        return $ref == 'last'
            ? response(Release::with('links')->orderBy('date_modified', 'desc')->first())
            : response(Release::with('links')->where('ref', '=', $ref)->first());
    }
}
