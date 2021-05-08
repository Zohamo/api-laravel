<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prt_releases';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference',
        'slug',
        'date_published',
        'date_modified',
        'artist',
        'title',
        'description',
        'disc_number',
        'bandcamp_id',
        'bandcamp_url',
        'fma_url',
        'internet_archive_url',
        'discogs_url',
        'jamendo_url',
        'lastfm_url',
    ];

    /**
     * The release's external links.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function links()
    {
        return $this->hasMany('App\Models\ReleaseLink', 'id_release', 'id')->with('platform');
    }
}
