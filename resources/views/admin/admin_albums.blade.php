<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản lý Album</title>
    <style>
        /* Căn chỉnh cơ bản */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Header */
        header {
            background-color: #2563eb;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header img {
            height: 40px;
            width: 40px;
            margin-right: 12px;
        }

        header h1 {
            font-size: 20px;
            font-weight: bold;
        }

        header input[type="text"] {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            border: none;
            color: #1f2937;
            outline: none;
            transition: all 0.3s ease-in-out;
        }

        header input[type="text"]:focus {
            box-shadow: 0 0 0 2px #93c5fd;
        }

        header button {
            background-color: #ef4444;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        header button:hover {
            background-color: #dc2626;
        }

        /* Nội dung chính */
        .container {
            max-width: 1200px;
            margin: 24px auto;
            display: flex;
            gap: 24px;
        }

        /* Menu bên trái */
        aside {
            width: 25%;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 16px;
        }

        aside h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        aside ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        aside li a {
            display: block;
            padding: 8px;
            border-radius: 8px;
            color: #1f2937;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out;
        }

        aside li a:hover {
            background-color: #dbeafe;
        }

        aside li a.active {
            background-color: #bfdbfe;
        }

        /* Nội dung chính */
        main {
            width: 75%;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 24px;
        }

        main h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 16px;
        }

        /* Thông báo */
        .success-message {
            background-color: #22c55e;
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        /* Form thêm album */
        form {
            margin-bottom: 24px;
        }

        form .mb-4 {
            margin-bottom: 16px;
        }

        form label {
            display: block;
            color: #4b5563;
            font-weight: 500;
            margin-bottom: 4px;
        }

        form input {
            width: 100%;
            padding: 8px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: all 0.3s ease-in-out;
        }

        form input:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 2px #93c5fd;
        }

        form button {
            background-color: #3b82f6;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        form button:hover {
            background-color: #2563eb;
        }

        /* Bảng danh sách album */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #d1d5db;
        }

        table th, table td {
            border: 1px solid #d1d5db;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #e5e7eb;
            font-weight: 600;
        }

        table tbody tr:hover {
            background-color: #f9fafb;
        }

        table td button {
            background-color: #ef4444;
            color: white;
            padding: 4px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        table td button:hover {
            background-color: #dc2626;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <!-- Logo -->
            <div style="display: flex; align-items: center;">
                <img src="https://via.placeholder.com/40" alt="Logo" style="height: 40px; width: 40px; margin-right: 12px;">
                <h1>Admin Dashboard</h1>
            </div>

            <!-- Thanh tìm kiếm -->
            <div style="flex: 1; margin: 0 24px;">
                <input type="text" placeholder="Tìm kiếm...">
            </div>

            <!-- Nút Logout -->
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Nội dung chính -->
    <div class="container">
        <!-- Khung 1: Menu quản lý -->
        <aside>
            <h2>Quản lý</h2>
            <ul>
                <li>
                    <a href="{{ route('admin.songs') }}" class="{{ request()->routeIs('admin.songs') ? 'active' : '' }}">Quản lý bài hát</a>
                </li>
                <li>
                    <a href="{{ route('admin.albums') }}" class="{{ request()->routeIs('admin.albums') ? 'active' : '' }}">Quản lý album</a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">Quản lý người dùng</a>
                </li>
            </ul>
        </aside>

        <!-- Khung 2: Nội dung quản lý album -->
        <main>
            <!-- Thông báo -->
            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form thêm album -->
            <h2>Thêm album mới</h2>
            <form action="{{ route('admin.createAlbum') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title">Tiêu đề album:</label>
                    <input type="text" name="title" id="title" required>
                </div>
                <div class="mb-4">
                    <label for="artist">Nghệ sĩ:</label>
                    <input type="text" name="artist" id="artist">
                </div>
                <div class="mb-4">
                    <label for="cover_url">URL ảnh bìa:</label>
                    <input type="url" name="cover_url" id="cover_url">
                </div>
                <button type="submit">Thêm album</button>
            </form>

            <!-- Danh sách album -->
            <h2>Danh sách album</h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Nghệ sĩ</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($albums->isEmpty())
                            <tr>
                                <td colspan="4" style="text-align: center; color: #6b7280;">Không có album nào.</td>
                            </tr>
                        @else
                            @foreach($albums as $album)
                                <tr>
                                    <td>{{ $album->id }}</td>
                                    <td>{{ $album->title }}</td>
                                    <td>{{ $album->artist ?? 'Không có' }}</td>
                                    <td>
                                        <form action="{{ route('admin.deleteAlbum', $album->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>