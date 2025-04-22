<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'title', 'artist', 'url', 'quality', 'trending_score',
        'is_recommended', 'thumbnail_url', 'album_id', 'lyrics'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}