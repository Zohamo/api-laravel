<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prt_artists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['categories'];

    /**
     * Get all of the categories for the artist.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function categories()
    {
        return $this->hasMany(ArtistCategory::class)->with('category');
    }

    /**
     * The artist's relationships.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function relationships()
    {
        return $this->hasMany(ArtistRelationship::class)->with(['release', 'prooject']);
    }
}
