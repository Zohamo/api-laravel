<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseLink extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prt_release_has_links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_release', 'id_platform', 'url'];

    /**
     * The attributes that won't be sent back.
     *
     * @var array
     */
    protected $hidden = ['id', 'id_release', 'id_platform'];

    /**
     * The link's platform.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function platform()
    {
        return $this->hasOne('App\Models\Platform', 'id', 'id_platform');
    }
}
