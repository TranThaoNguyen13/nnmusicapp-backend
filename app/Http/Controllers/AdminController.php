<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Song;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $albums = Album::all();
        $songs = Song::with('album')->get();
        return view('admin.dashboard', compact('albums', 'songs'));
    }

    public function createSong(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'url' => 'nullable|url',
            'thumbnail_url' => 'nullable|url',
            'album_id' => 'nullable|exists:albums,id',
        ]);

        Song::create($request->all());
        return redirect()->back()->with('success', 'Thêm bài hát thành công.');
    }

    public function deleteSong($id)
    {
        Song::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Xóa bài hát thành công.');
    }
}