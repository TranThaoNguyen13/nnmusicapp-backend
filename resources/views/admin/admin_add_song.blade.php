<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Thêm bài hát</title>
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
            overflow: hidden; /* Ngăn cuộn toàn trang */
            padding-top: 120px; /* Khoảng cách để thanh navigation không che nội dung */
        }

        /* Thanh navigation */
        nav {
            background-color: #fff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            position: fixed; /* Cố định trên cùng */
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
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
            height: calc(100vh - 120px); /* Chiều cao container bằng chiều cao màn hình trừ thanh nav */
        }

        /* Sidebar (Menu bên trái) */
        aside {
            width: 25%;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            border: 1px solid #e5e7eb;
            position: fixed; /* Cố định menu bên trái */
            top: 120px; /* Dưới thanh navigation */
            bottom: 0;
            overflow-y: auto; /* Cuộn dọc nếu nội dung dài */
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
            color: #0cc41e;
        }

        aside ul li a.active {
            background-color: #e7f7e7;
            color: #038d11;
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
            margin-left: 27%; /* Khoảng cách để không bị che bởi menu bên trái */
            height: calc(100vh - 120px); /* Chiều cao bằng màn hình trừ thanh nav */
            overflow-y: auto; /* Cuộn dọc nếu nội dung dài */
            overflow-x: hidden; /* Ngăn cuộn ngang */
        }

        /* Tiêu đề */
        .content h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
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
        form select,
        form textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9fafb;
            transition: all 0.3s ease;
        }

        form textarea {
            resize: vertical;
        }

        form input:focus,
        form select:focus,
        form textarea:focus {
            outline: none;
            border-color: #0cc41e;
            box-shadow: 0 0 0 3px rgba(12, 196, 30, 0.1);
        }

        form button {
            background-color: #0cc41e;
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
            background-color: #038d11;
        }

        form a.cancel {
            margin-left: 1rem;
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        form a.cancel:hover {
            color: #0cc41e;
        }

        /* Thông báo lỗi */
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
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
    </style>
</head>
<body>
    <!-- Thanh navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                <a href="/">
                <img src="/images/logonnmusicapp.png" alt="Logo">
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

    <!-- Nội dung chính -->
    <main>
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

            <!-- Khung 2: Form thêm bài hát -->
            <div class="content">
                <!-- Thông báo -->
                @if (session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form thêm bài hát -->
                <h2>Thêm bài hát mới</h2>
                <form action="{{ route('admin.createSong') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Tiêu đề:</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="artist">Nghệ sĩ:</label>
                        <input type="text" name="artist" id="artist" value="{{ old('artist') }}" required>
                        @error('artist')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">File bài hát:</label>
                        <input type="file" name="file" id="file" accept="audio/*" required>
                        @error('file')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quality">Chất lượng:</label>
                        <select name="quality" id="quality">
                            <option value="cao" {{ old('quality') == 'cao' ? 'selected' : '' }}>Cao</option>
                            <option value="thap" {{ old('quality') == 'thap' ? 'selected' : '' }}>Thấp</option>
                        </select>
                        @error('quality')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="trending_score">Điểm đánh giá:</label>
                        <input type="number" name="trending_score" id="trending_score" value="{{ old('trending_score') }}" step="0.1" min="0" max="100">
                        @error('trending_score')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="is_recommended">Đề xuất:</label>
                        <select name="is_recommended" id="is_recommended">
                            <option value="1" {{ old('is_recommended') == '1' ? 'selected' : '' }}>Có</option>
                            <option value="0" {{ old('is_recommended') == '0' ? 'selected' : '' }}>Không</option>
                        </select>
                        @error('is_recommended')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thumbnail_url">Thumbnail URL:</label>
                        <input type="url" name="thumbnail_url" id="thumbnail_url" value="{{ old('thumbnail_url') }}">
                        @error('thumbnail_url')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="album_id">Album:</label>
                        <select name="album_id" id="album_id">
                            <option value="">Không có album</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}" {{ old('album_id') == $album->id ? 'selected' : '' }}>{{ $album->title }}</option>
                            @endforeach
                        </select>
                        @error('album_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lyrics">Lời bài hát:</label>
                        <textarea name="lyrics" id="lyrics" rows="5">{{ old('lyrics') }}</textarea>
                        @error('lyrics')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit">Thêm bài hát</button>
                    <a href="{{ route('admin.songs') }}" class="cancel">Hủy</a>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
