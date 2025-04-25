<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
//     public function showAdminDashboard()
// {
//     $songs = Song::with('album')->get();
//     $albums = Schema::hasTable('albums') ? Album::all() : collect();
//     return view('admin.admin_dashboard', compact('songs', 'albums'));
// }
    public function dashboard()
{
    return view('admin_dashboard');
}
    public function index()
    {
        return redirect()->route('admin.songs');
    }

    public function songs()
    {
        $songs = Song::with('album')->get();
        $albums = Schema::hasTable('albums') ? Album::all() : collect();
        return view('admin.admin_dashboard', compact('songs', 'albums'));
    }

    public function addSong()
    {
        $albums = Schema::hasTable('albums') ? Album::all() : collect();
        return view('admin.admin_add_song', compact('albums'));
    }

    public function albums()
    {
        $albums = Schema::hasTable('albums') ? Album::all() : collect();
        return view('admin.admin_albums', compact('albums'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.admin_users', compact('users'));
    }

    public function createSong(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'url' => 'nullable|url',
            'thumbnail_url' => 'nullable|url',
            'album_id' => 'nullable|exists:albums,id',
        ]);

        Song::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'url' => $request->url,
            'thumbnail_url' => $request->thumbnail_url,
            'album_id' => $request->album_id,
        ]);

        return redirect()->route('admin.songs')->with('success', 'Thêm bài hát thành công!');
    }

    public function editSong($id)
    {
        $song = Song::findOrFail($id);
        $albums = Schema::hasTable('albums') ? Album::all() : collect();
        return view('admin.admin_edit_song', compact('song', 'albums'));
    }

    public function updateSong(Request $request, $id)
    {
        $song = Song::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'url' => 'nullable|url',
            'thumbnail_url' => 'nullable|url',
            'album_id' => 'nullable|exists:albums,id',
        ]);

        $song->update([
            'title' => $request->title,
            'artist' => $request->artist,
            'url' => $request->url,
            'thumbnail_url' => $request->thumbnail_url,
            'album_id' => $request->album_id,
        ]);

        return redirect()->route('admin.songs')->with('success', 'Cập nhật bài hát thành công!');
    }

    public function deleteSong($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();

        return redirect()->route('admin.songs')->with('success', 'Xóa bài hát thành công!');
    }

    public function createAlbum(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'nullable|string|max:255',
            'cover_url' => 'nullable|url',
        ]);

        Album::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'cover_url' => $request->cover_url,
        ]);

        return redirect()->route('admin.albums')->with('success', 'Thêm album thành công!');
    }

    public function deleteAlbum($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('admin.albums')->with('success', 'Xóa album thành công!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Xóa người dùng thành công!');
    }
}