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
        'style',
        'disc_number',
    ];

    /**
     * The release's tracklist.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tracks()
    {
        return $this->hasMany('App\Models\Track', 'id_release', 'id')->with('info');
    }

    /**
     * The release's credits.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function credits()
    {
        return $this->hasMany('App\Models\ReleaseCredit', 'id_release', 'id')->with('type');
    }

    /**
     * The release's external links.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany('App\Models\ReleaseLink', 'id_release', 'id')->with('platform');
    }
}
