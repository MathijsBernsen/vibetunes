<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use hasFactory;

    protected $fillable = ['name', 'duration', 'album_id', 'release_date'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }
}
