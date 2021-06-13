<?php

namespace App\Http\Controllers;

use App\Models\Release;
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

    /* public function generate()
    {
        $dir = '/home/zoh/Dev/api/api-laravel/sources';
        $files = scandir($dir);

        $data = [];
        $dataInfo = [];
        foreach ($files as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            include("$dir/$file");
            if (empty($album['tracklist'])) {
                continue;
            }

            $release = Release::where('id', $album['id'])->first();
            $i = 1;
            foreach ($album['tracklist'] as $key => $track) {
                if (!is_string($key)) {
                    $id = Track::create([
                        'position' => $i,
                        'bonus' => 0,
                        'id_release' => $album['id'],
                        'title' => !empty($track['title']) ? $track['title'] : null,
                        'url' => !empty($track['url']) ? $track['url'] : null,
                        'artist' => !empty($track['artist']) ? $track['artist'] : $album['artist'],
                        'date' => $release->date_modified
                    ])->id;
                    if (!empty($track['info'])) {
                        TrackInfo::create([
                            'id_track' => $id,
                            'content' => $track['info']
                        ]);
                    }
                    $i++;
                } else {
                    $i = 1;
                    foreach ($track as $sideTrack) {
                        $id = Track::create([
                            'position' => $key . $i,
                            'bonus' => 0,
                            'id_release' => $album['id'],
                            'title' => !empty($sideTrack['title']) ? $sideTrack['title'] : null,
                            'url' => !empty($sideTrack['url']) ? $sideTrack['url'] : null,
                            'artist' => !empty($sideTrack['artist']) ? $sideTrack['artist'] : $album['artist'],
                            'date' => $release->date_modified
                        ])->id;
                        if (!empty($track['info'])) {
                            TrackInfo::create([
                                'id_track' => $id,
                                'content' => $track['info']
                            ]);
                        }
                        $i++;
                    }
                }
            }
            if (!empty($album['tracklist_bonus'])) {
                foreach ($album['tracklist_bonus'] as $track) {
                    $id = Track::create([
                        'position' => $i,
                        'bonus' => 1,
                        'id_release' => $album['id'],
                        'title' => $track['title'],
                        'url' => !empty($track['url']) ? $track['url'] : null,
                        'artist' => !empty($track['artist']) ? $track['artist'] : $album['artist'],
                        'date' => $release->date_modified
                    ])->id;
                    if (!empty($track['info'])) {
                        TrackInfo::create([
                            'id_track' => $id,
                            'content' => $track['info']
                        ]);
                    }
                    $i++;
                }
            }
            $album = [];
        }

        // Track::insert($data);

        return response([$id]);
    } */
}
