<?php

namespace App\Http\Controllers;

use App\Models\Prooject;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProojectController extends Controller
{
    /**
     * Return the list of the ressource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Prooject::with('tracks')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($prooject) {
                $prooject->setRelation('tracks', $prooject->tracks->take(3));
                return $prooject;
            });
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
            Prooject::with('tracks')
                ->where('slug', $slug)
                ->first()
        );
    }
}
