<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use hasFactory;

    protected $fillable = ['name'];

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
