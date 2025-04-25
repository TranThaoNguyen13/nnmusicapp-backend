<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $songs = Song::with('album')->get();
        $albums = Schema::hasTable('albums') ? Album::all() : collect();
        return view('admin.admin_dashboard', compact('songs', 'albums'));
    }
}