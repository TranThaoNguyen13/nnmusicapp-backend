<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Quản lý bài hát</title>
    <style>
        /* Reset mặc định */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
            background-color: #f4f7fa;
            color: #333;
            line-height: 1.6;
        }

        /* Thanh navigation */
        nav {
            background-color: #fff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        nav .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 120px;
        }

        nav .logo img {
            width: 180px;
            height: 140px;
            border-radius: 50%;
        }

        nav .user-menu {
            display: flex;
            align-items: center;
        }

        nav .dropdown {
            position: relative;
        }

        nav .dropdown button {
            background: none;
            border: none;
            color: #6b7280;
            font-size: 0.875rem;
            cursor: pointer;
        }

        nav .dropdown .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1;
        }

        nav .dropdown:hover .dropdown-content {
            display: block;
        }

        nav .dropdown .dropdown-content a,
        nav .dropdown .dropdown-content form button {
            display: block;
            padding: 0.5rem 1rem;
            color: #4b5563;
            text-decoration: none;
            font-size: 0.875rem;
            transition: background-color 0.3s ease;
        }

        nav .dropdown .dropdown-content a:hover,
        nav .dropdown .dropdown-content form button:hover {
            background-color: #f9fafb;
        }

        nav .dropdown .dropdown-content form button {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        /* Container */
        .container {
            width: 90%;
            max-width: 1400px;
            margin: 0 auto;
            display: flex !important;
            flex-wrap: nowrap !important;
            gap: 2rem;
            margin-top: 2rem;
        }

        /* Header */
        header {
            background: linear-gradient(to right, #0cc41e, #038d11);
            color: #fff;
            padding: 0.5rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header img {
            width: 180px;
            height: 140px;
            border-radius: 50%;
            display: block; /* Đảm bảo logo hiển thị */
        }

        header h1 {
            font-size: 1.75rem;
            font-weight: 700;
        }

        header button {
            background-color: #eaf9e9;
            color: #038d11; /* Đổi màu chữ nút thành xanh lá cây đậm */
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        header button:hover {
            background-color: #038d11; /* Đổi màu hover thành xanh lá cây đậm */
            color: #fff; /* Đổi màu chữ thành trắng khi hover */
        }

        /* Sidebar (Menu bên trái) */
        aside {
            width: 25%;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
        }

        aside h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        aside ul {
            list-style: none;
        }

        aside ul li {
            margin-bottom: 0.5rem;
        }

        aside ul li a {
            display: block;
            padding: 0.75rem 1rem;
            color: #4b5563;
            font-weight: 500;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        aside ul li a:hover {
            background-color: #eff6ff;
            color: #0cc41e; /* Đã đúng màu xanh lá cây */
        }

        aside ul li a.active {
            background-color: #e7f7e7; /* Đổi nền active thành xanh lá cây nhạt */
            color: #038d11; /* Đổi màu chữ active thành xanh lá cây đậm */
            font-weight: 600;
        }

        /* Content (Khung bên phải) */
        .content {
            width: 75%;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            border: 1px solid #e5e7eb;
        }

        /* Tiêu đề */
        .content h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        /* Thanh tìm kiếm và nút thêm */
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .header-actions input[type="text"] {
            width: 250px;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9fafb;
            transition: all 0.3s ease;
        }

        .header-actions input[type="text"]:focus {
            outline: none;
            border-color: #0cc41e; /* Đổi viền thành xanh lá cây */
            box-shadow: 0 0 0 3px rgba(12, 196, 30, 0.1); /* Đổi box-shadow thành xanh lá cây */
        }

        .header-actions a.button {
            background-color: #0cc41e; /* Đổi màu nút thành xanh lá cây */
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .header-actions a.button:hover {
            background-color: #038d11; /* Đổi màu hover thành xanh lá cây đậm */
        }

        /* Form */
        form {
            margin-bottom: 2rem;
        }

        form .form-group {
            margin-bottom: 1rem;
        }

        form label {
            display: block;
            font-weight: 500;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }

        form input,
        form select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9fafb;
            transition: all 0.3s ease;
        }

        form input:focus,
        form select:focus {
            outline: none;
            border-color: #0cc41e; /* Đổi viền thành xanh lá cây */
            box-shadow: 0 0 0 3px rgba(12, 196, 30, 0.1); /* Đổi box-shadow thành xanh lá cây */
        }

        form button {
            background-color: #0cc41e; /* Đổi màu nút thành xanh lá cây */
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #038d11; /* Đổi màu hover thành xanh lá cây đậm */
        }

        form a.cancel {
            margin-left: 1rem;
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        form a.cancel:hover {
            color: #0cc41e; /* Đổi màu hover thành xanh lá cây */
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        table thead {
            background-color: #f3f4f6;
        }

        table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #4b5563;
            border: 1px solid #e5e7eb;
        }

        table td {
            padding: 1rem;
            color: #4b5563;
            border: 1px solid #e5e7eb;
        }

        table tbody tr:hover {
            background-color: #f9fafb;
        }

        table .actions {
            display: flex;
            gap: 0.5rem;
        }

        table .actions a,
        table .actions button {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        table .actions a.edit {
            background-color: #f59e0b;
            color: #fff;
        }

        table .actions a.edit:hover {
            background-color: #d97706;
        }

        table .actions button.delete {
            background-color: #ef4444;
            transition: background-color 0.3s ease;
        }

        table .actions button.delete:hover {
            background-color: #dc2626;
        }

        /* Alert */
        .alert-success {
            background-color: #10b981;
            color: #fff;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    .thumbnail-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #e5e7eb;
    }
    .table-container {
        max-height: 500px; /* Chiều cao tối đa của bảng, có thể điều chỉnh */
        overflow-y: auto; /* Kích hoạt cuộn dọc */
        overflow-x: auto; /* Kích hoạt cuộn ngang */
        border: 1px solid #e5e7eb; /* Đường viền cho bảng */
        border-radius: 8px;
    }

    /* Định dạng bảng */
    table {
        width: 100%;
        min-width: 1000px; /* Chiều rộng tối thiểu để kích hoạt cuộn ngang, có thể điều chỉnh */
        border-collapse: collapse;
    }

    th, td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        background-color: #f9fafb;
        font-weight: 600;
        color: #1f2937;
        position: sticky; /* Giữ tiêu đề cố định khi cuộn dọc */
        top: 0;
        z-index: 10;
    }

    td {
        color: #4b5563;
    }

    /* Định dạng hình ảnh thumbnail */
    .thumbnail-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #e5e7eb;
    }

    /* Định dạng audio */
    audio {
        width: 200px; /* Chiều rộng cố định cho thẻ audio */
    }

    /* Định dạng cột hành động */
    .actions {
        display: flex;
        gap: 0.5rem;
    }

    .actions a.edit {
        color: #0cc41e;
        text-decoration: none;
        font-weight: 500;
    }

    .actions a.edit:hover {
        color: #038d11;
    }

    .actions button.delete {
        color: #ef4444;
        background: none;
        border: none;
        font-weight: 500;
        cursor: pointer;
    }

    .actions button.delete:hover {
        color: #dc2626;
    }

    /* Định dạng khi không có dữ liệu */
    .text-center {
        text-align: center;
    }

    .text-gray-500 {
        color: #6b7280;
    }
    </style>
</head>
<body>
    <!-- Thanh navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('images/logonnmusicapp.png') }}" alt="Logo">
                </a>
            </div>
            <div class="user-menu">
                @auth
                    <div class="dropdown">
                        <button>{{ Auth::user()->email }}</button>
                        <div class="dropdown-content">
                            <a href="{{ route('profile.edit') }}">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">Log Out</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
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

        <!-- Khung 2: Nội dung quản lý -->
        <div class="content">
            <!-- Thông báo -->
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Hàng tiêu đề, tìm kiếm và nút thêm -->
            <div class="header-actions">
                <h2>Danh sách bài hát</h2>
                <div>
                    <input type="text" placeholder="Tìm kiếm bài hát...">
                    <a href="{{ route('admin.addSong') }}" class="button">Thêm bài hát</a>
                </div>
            </div>

            <!-- Danh sách bài hát -->
            <div class="overflow-x-auto">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Nghệ sĩ</th>
                            <th>Album</th>
                            <th>File nhạc</th>
                            <th>Chất lượng</th>
                            <th>Điểm đánh giá</th>
                            <th>Đề xuất</th>
                            <th>Hình ảnh</th>
                            <th>Lời bài hát</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($songs->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center text-gray-500">Không có bài hát nào.</td>
                            </tr>
                        @else
                            @foreach($songs as $song)
                                <tr>
                                    <td>{{ $song->id }}</td>
                                    <td>{{ $song->title }}</td>
                                    <td>{{ $song->artist }}</td>
                                    <td>{{ $song->album ? $song->album->title : 'Không có' }}</td>
                                
                                    <td>
                                        <audio controls>
                                            <source src="{{ asset('storage/songs/' . $song->file_path) }}" type="audio/mpeg">
                                                Trình duyệt không hỗ trợ phát audio.
                                        </audio>
                                    </td>
                                    <td>{{ $song->quality }}</td>
                                    <td>{{ $song->trending_score }}</td>
                                    <td>{{ $song->is_recommended }}</td>
                                    <td>
                                         @if($song->thumbnail_url)
                                            <img src="{{ $song->thumbnail_url }}" alt="{{ $song->title }}" class="thumbnail-img">
                                        @else
                                            Không có
                                        @endif
                                    </td>
                                    <td>{{ $song->lyrics }}</td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('admin.editSong', $song->id) }}" class="edit">Sửa</a>
                                            <form action="{{ route('admin.deleteSong', $song->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete">Xóa</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</body>
</html>