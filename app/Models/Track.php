<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prt_tracks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_release', 'position', 'bonus', 'artist', 'title', 'url', 'date'];

    /**
     * The attributes that won't be sent back.
     *
     * @var array
     */
    protected $hidden = ['id'];

    /**
     * The track's information.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function info()
    {
        return $this->hasOne('App\Models\TrackInfo', 'id_track', 'id');
    }
}
