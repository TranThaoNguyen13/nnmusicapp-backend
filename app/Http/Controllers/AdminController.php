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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'file' => 'required|file|mimes:mp3,wav|max:10240', // Giới hạn file MP3/WAV, tối đa 10MB
            'thumbnail_url' => 'nullable|url',
            'album_id' => 'nullable|exists:albums,id',
            'quality' => 'required|in:cao,thap',
            'trending_score' => 'nullable|numeric|min:0|max:100',
            'is_recommended' => 'required|boolean',
            'lyrics' => 'nullable|string',
        ]);

        // Upload file bài hát
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/songs', $fileName);
            $validated['file_path'] = $fileName; // Lưu vào cột file_path
        }

        Song::create($validated);

        return redirect()->route('admin.songs')->with('success', 'Bài hát đã được thêm thành công!');
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

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'artist' => 'required|string|max:255',
        'file' => 'nullable|file|mimes:mp3,wav|max:10240',
        'thumbnail_url' => 'nullable|url',
        'album_id' => 'nullable|exists:albums,id',
        'quality' => 'required|in:cao,thap',
        'trending_score' => 'nullable|numeric|min:0|max:100',
        'is_recommended' => 'required|boolean',
        'lyrics' => 'nullable|string',
    ]);

    // Upload file bài hát mới (nếu có)
    if ($request->hasFile('file')) {
        // Xóa file cũ nếu tồn tại
        if ($song->file_path && Storage::exists('public/songs/' . $song->file_path)) {
            Storage::delete('public/songs/' . $song->file_path);
        }

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/songs', $fileName);
        $validated['file_path'] = $fileName;
    }

    // Cập nhật bài hát
    $song->update($validated);

    return redirect()->route('admin.songs')->with('success', 'Bài hát đã được cập nhật thành công!');
}
    public function deleteSong($id)
{
    $song = Song::findOrFail($id);

    // Xóa file bài hát khỏi storage
    if ($song->file_path && Storage::exists('public/songs/' . $song->file_path)) {
        Storage::delete('public/songs/' . $song->file_path);
    }

    // Xóa bài hát khỏi cơ sở dữ liệu
    $song->delete();

    return redirect()->route('admin.songs')->with('success', 'Bài hát đã được xóa thành công!');
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