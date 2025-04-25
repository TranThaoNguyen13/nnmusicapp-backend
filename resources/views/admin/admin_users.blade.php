<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản lý Người dùng</title>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="https://via.placeholder.com/40" alt="Logo" class="h-10 w-10 mr-3">
                <h1 class="text-xl font-bold">Admin Dashboard</h1>
            </div>

            <!-- Thanh tìm kiếm -->
            <div class="flex-1 mx-6">
                <input type="text" placeholder="Tìm kiếm..." class="w-full p-2 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <!-- Nút Logout -->
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Nội dung chính -->
    <div class="container mx-auto mt-6 flex gap-6">
        <!-- Khung 1: Menu quản lý -->
        <aside class="w-1/4 bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-4">Quản lý</h2>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.songs') }}" class="block p-2 rounded-lg hover:bg-blue-100 {{ request()->routeIs('admin.songs') ? 'bg-blue-200' : '' }}">Quản lý bài hát</a>
                </li>
                <li>
                    <a href="{{ route('admin.albums') }}" class="block p-2 rounded-lg hover:bg-blue-100 {{ request()->routeIs('admin.albums') ? 'bg-blue-200' : '' }}">Quản lý album</a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="block p-2 rounded-lg hover:bg-blue-100 {{ request()->routeIs('admin.users') ? 'bg-blue-200' : '' }}">Quản lý người dùng</a>
                </li>
            </ul>
        </aside>

        <!-- Khung 2: Nội dung quản lý người dùng -->
        <main class="w-3/4 bg-white shadow-md rounded-lg p-6">
            <!-- Thông báo -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Danh sách người dùng -->
            <h2 class="text-xl font-bold mb-4">Danh sách người dùng</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-3 text-left">ID</th>
                            <th class="border border-gray-300 p-3 text-left">Tên</th>
                            <th class="border border-gray-300 p-3 text-left">Email</th>
                            <th class="border border-gray-300 p-3 text-left">Password</th>
                            <th class="border border-gray-300 p-3 text-left">Role</th>
                            <th class="border border-gray-300 p-3 text-left">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="border border-gray-300 p-3">{{ $user->id }}</td>
                                <td class="border border-gray-300 p-3">{{ $user->name }}</td>
                                <td class="border border-gray-300 p-3">{{ $user->email }}</td>
                                <td class="border border-gray-300 p-3">{{ $user->password }}</td>
                                <td class="border border-gray-300 p-3">{{ $user->role }}</td>
                                <td class="border border-gray-300 p-3">
                                    <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>