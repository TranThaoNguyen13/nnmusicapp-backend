<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;

class SongController extends Controller
{
    public function getTrendingSongs()
    {
        $songs = Song::orderBy('trending_score', 'desc')->get();
        return response()->json($songs);
    }

    public function getRecommendations()
    {
        $songs = Song::where('is_recommended', true)->get();
        return response()->json($songs);
    }
}