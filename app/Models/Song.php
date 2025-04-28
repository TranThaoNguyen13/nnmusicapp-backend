<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'title', 'artist', 'file_path', 'quality', 'trending_score',
        'is_recommended', 'thumbnail_url', 'album_id', 'lyrics'
    ];

    protected $casts = [
        'is_recommended' => 'boolean',
        'trending_score' => 'float',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}