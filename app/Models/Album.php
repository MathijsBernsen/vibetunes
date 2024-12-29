<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use hasFactory;

    protected $fillable = ['name', 'duration', 'release_date'];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
