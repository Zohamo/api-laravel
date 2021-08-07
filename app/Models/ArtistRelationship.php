<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistRelationship extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prt_artist_has_relationships';

    /**
     * The artist's related release.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function release()
    {
        return $this->hasOne('App\Models\Release', 'id', 'release_id');
    }

    /**
     * The artist's related prooject.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function prooject()
    {
        return $this->hasOne('App\Models\Prooject', 'id', 'prooject_id');
    }
}
