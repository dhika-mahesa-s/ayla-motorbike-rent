<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ayla Motorbike Rent</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="w-full max-w-md">
        <!-- Logo/Brand -->
        <div class="text-center mb-6 sm:mb-8">
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-2">AYLA</h1>
            <p class="text-white/90 text-base sm:text-lg">Motorbike Rent Admin</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login to Dashboard</h2>

            <!-- Session Status -->
            @if (session('status'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                    <p class="text-sm text-green-700">{{ session('status') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ $errors->first() }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                        placeholder="admin@example.com"
                        required 
                        autofocus
                    >
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                        placeholder="••••••••"
                        required
                    >
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input 
                        type="checkbox" 
                        id="remember_me" 
                        name="remember" 
                        class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500"
                    >
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition transform hover:scale-105 shadow-lg"
                >
                    Sign In
                </button>
            </form>

            <!-- Default Credentials Info -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <p class="text-xs text-blue-800 font-medium mb-1">Default Admin Credentials:</p>
                <p class="text-xs text-blue-600">Email: admin@example.com</p>
                <p class="text-xs text-blue-600">Password: password</p>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-white/75 text-sm mt-6">
            &copy; 2025 Ayla Motorbike Rent. All rights reserved.
        </p>
    </div>
</body>
</html>
