<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SuaraSosial</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-[var(--lavender)] to-[var(--background)] min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo Card -->
        <div class="text-center mb-8">
            <div class="inline-block bg-white p-4 rounded-full mb-4 shadow-lg">
                <i class="fas fa-bullhorn text-[var(--primary)] text-4xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-[var(--text)] mb-2">SuaraSosial</h1>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-lg shadow-2xl p-8 border border-[var(--border-soft)]">
            <h2 class="text-2xl font-bold text-[var(--text)] mb-6 text-center">
                Login Admin
            </h2>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Login Gagal:</strong>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="space-y-6 js-loading-form">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-[var(--text)] mb-2">
                        <i class="fas fa-envelope mr-2 text-[var(--primary)]"></i>Email
                    </label>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        value="{{ old('email') }}"
                        required 
                        autofocus
                        placeholder="Masukkan email"
                        class="w-full px-4 py-2 border border-[var(--border-soft)] rounded-xl focus:outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--lavender)]/30 @error('email') border-red-500 @enderror"
                    >
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-[var(--text)] mb-2">
                        <i class="fas fa-lock mr-2 text-[var(--primary)]"></i>Password
                    </label>
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        required 
                        placeholder="Masukkan password"
                        class="w-full px-4 py-2 border border-[var(--border-soft)] rounded-xl focus:outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--lavender)]/30 @error('password') border-red-500 @enderror"
                    >
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember"
                        class="rounded border-[var(--border-soft)] text-[var(--primary)] focus:ring-[var(--primary)]"
                    >
                    <label for="remember" class="ml-2 text-sm text-[var(--text-muted)]">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded-xl transition flex items-center justify-center text-lg shadow-md hover:shadow-lg"
                >
                    <span class="spinner hidden mr-2"></span>
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    <span>Login</span>
                </button>
            </form>

            <!-- Demo Info -->
            <div class="mt-8 pt-6 border-t border-[var(--border-soft)]">
                <p class="text-center text-sm text-[var(--text-muted)] mb-3">
                    <i class="fas fa-info-circle text-[var(--primary)] mr-1"></i>Demo Credentials:
                </p>
                <div class="bg-[var(--lavender)]/20 rounded p-3 text-sm space-y-1 text-[var(--text-muted)]">
                    <p><strong>Email:</strong> admin@suarasosial.test</p>
                    <p><strong>Password:</strong> password</p>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-[var(--primary)] hover:text-[var(--primary-dark)] text-sm flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali ke Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>
