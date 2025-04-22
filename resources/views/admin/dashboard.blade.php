<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

        <!-- Thông báo -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form thêm bài hát -->
        <form action="{{ route('admin.createSong') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-2">
                <label for="title">Tiêu đề:</label>
                <input type="text" name="title" id="title" class="border p-2 w-full" required>
            </div>
            <div class="mb-2">
                <label for="artist">Nghệ sĩ:</label>
                <input type="text" name="artist" id="artist" class="border p-2 w-full" required>
            </div>
            <div class="mb-2">
                <label for="url">URL:</label>
                <input type="url" name="url" id="url" class="border p-2 w-full">
            </div>
            <div class="mb-2">
                <label for="thumbnail_url">Thumbnail URL:</label>
                <input type="url" name="thumbnail_url" id="thumbnail_url" class="border p-2 w-full">
            </div>
            <div class="mb-2">
                <label for="album_id">Album:</label>
                <select name="album_id" id="album_id" class="border p-2 w-full">
                    <option value="">Không có album</option>
                    @foreach($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Thêm bài hát</button>
        </form>

        <!-- Danh sách bài hát -->
        <h2 class="text-xl font-bold mb-2">Danh sách bài hát</h2>
        <table class="w-full border-collapse border">
            <thead>
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Tiêu đề</th>
                    <th class="border p-2">Nghệ sĩ</th>
                    <th class="border p-2">Album</th>
                    <th class="border p-2">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($songs as $song)
                    <tr>
                        <td class="border p-2">{{ $song->id }}</td>
                        <td class="border p-2">{{ $song->title }}</td>
                        <td class="border p-2">{{ $song->artist }}</td>
                        <td class="border p-2">{{ $song->album ? $song->album->title : 'Không có' }}</td>
                        <td class="border p-2">
                            <form action="{{ route('admin.deleteSong', $song->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white p-1 rounded">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>