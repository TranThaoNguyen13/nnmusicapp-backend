<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['title', 'artist', 'cover_url'];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}