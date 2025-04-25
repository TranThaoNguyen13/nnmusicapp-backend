<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Container chính của form */
        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            border: 1px solid #e5e7eb;
        }

        /* Tiêu đề (nếu có) */
        .login-container h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Session Status */
        .session-status {
            background-color: #10b981;
            color: #fff;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Label */
        label {
            display: block;
            font-weight: 500;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }

        /* Input */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #f9fafb;
            transition: all 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #0cc41e; /* Màu xanh lá cây */
            box-shadow: 0 0 0 3px rgba(12, 196, 30, 0.1);
        }

        /* Input Error */
        .input-error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Checkbox "Remember me" */
        .checkbox-label {
            display: flex;
            align-items: center;
            color: #4b5563;
        }

        input[type="checkbox"] {
            width: 1.25rem;
            height: 1.25rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="checkbox"]:checked {
            background-color: #0cc41e; /* Màu xanh lá cây */
            border-color: #0cc41e;
        }

        /* Link "Forgot your password?" */
        a {
            color: #0cc41e; /* Màu xanh lá cây */
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #038d11; /* Màu xanh lá cây đậm */
            text-decoration: underline;
        }

        /* Nút "Log in" */
        button {
            background-color: #0cc41e; /* Màu xanh lá cây */
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #038d11; /* Màu xanh lá cây đậm */
        }

        /* Định dạng layout */
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .flex {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1rem;
        }
    </style>
</x-guest-layout>