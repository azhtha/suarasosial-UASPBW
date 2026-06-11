<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SuaraSosial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #7C3AED;
            --primary-dark: #6D28D9;
            --lavender: #A78BFA;
            --background: #FAF7FF;
            --text: #2E1065;
            --text-muted: #6B7280;
            --card: #FFFFFF;
            --border-soft: #E9D5FF;
            --accent: #FBBF24;
        }

        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            color: var(--text);
            background-color: var(--background);
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            padding: 0.625rem 1rem;
            border-radius: 0.75rem;
            transition: background-color 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
            font-weight: 600;
            padding: 0.625rem 1rem;
            border-radius: 0.75rem;
            transition: background-color 0.2s ease, color 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary:hover {
            background-color: rgba(124, 58, 237, 0.08);
            color: var(--primary-dark);
        }

        .btn-accent {
            background-color: var(--accent);
            color: var(--text);
            font-weight: 600;
            padding: 0.625rem 1rem;
            border-radius: 0.75rem;
            transition: background-color 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-accent:hover {
            background-color: #f59e0b;
        }

        .card {
            background-color: var(--card);
            border: 1px solid var(--border-soft);
            border-radius: 1rem;
            box-shadow: 0 12px 30px rgba(124, 58, 237, 0.08);
            overflow: hidden;
        }

        .badge {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 9999px;
        }

        .badge-primary {
            background-color: #EDE9FE;
            color: var(--primary);
        }

        .badge-secondary {
            background-color: var(--accent);
            color: #1f2937;
        }

        .text-primary {
            color: var(--text);
        }

        .text-muted {
            color: var(--text-muted);
        }

        .input-soft {
            border: 1px solid var(--border-soft);
            background-color: #ffffff;
            color: var(--text);
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            width: 100%;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .input-soft:focus {
            outline: none;
            border-color: var(--lavender);
            box-shadow: 0 0 0 4px rgba(167, 139, 250, 0.18);
        }

        .table-soft thead {
            background-color: #F8F0FF;
        }

        .table-soft th,
        .table-soft td {
            border-color: var(--border-soft);
        }

        .row-hover-lavender:hover {
            background-color: #F3EDFF;
        }

        .line-clamp-1,
        .line-clamp-2,
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-1 {
            -webkit-line-clamp: 1;
        }

        .line-clamp-2 {
            -webkit-line-clamp: 2;
        }

        .line-clamp-3 {
            -webkit-line-clamp: 3;
        }

        .line-clamp-1,
        .line-clamp-2,
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-1 {
            -webkit-line-clamp: 1;
        }

        .line-clamp-2 {
            -webkit-line-clamp: 2;
        }

        .line-clamp-3 {
            -webkit-line-clamp: 3;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-[var(--background)]">
    <!-- Navigation -->
    @if(strpos(Route::currentRouteName(), 'admin') === false && Route::currentRouteName() !== 'login')
        <nav class="bg-white/95 backdrop-blur-sm text-[var(--text)] shadow-sm border-b border-[var(--border-soft)] sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-between gap-4 h-20">
                    <a href="{{ route('home') }}" class="text-2xl font-extrabold tracking-tight flex items-center text-[var(--primary)]">
                        <i class="fas fa-bullhorn mr-2"></i>SuaraSosial
                    </a>
                    <div class="flex flex-wrap items-center gap-4 text-sm">
                        <a href="{{ route('home') }}" class="text-[var(--text-muted)] hover:text-[var(--primary)] transition">Beranda</a>
                        <a href="{{ route('programs.index') }}" class="text-[var(--text-muted)] hover:text-[var(--primary)] transition">Program</a>
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="text-[var(--text-muted)] hover:text-[var(--primary)] transition">Admin</a>
                            <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-[var(--text-muted)] hover:text-[var(--primary)] transition">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn-accent text-sm">Login Admin</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    @endif

    <!-- Main Content -->
    <main>
        @if ($errors->any())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    @if(strpos(Route::currentRouteName(), 'admin') === false && Route::currentRouteName() !== 'login')
        <footer class="bg-[var(--background)] text-[var(--text-muted)] py-8 mt-12 border-t border-[var(--border-soft)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div>
                        <h3 class="text-[var(--text)] font-bold text-lg mb-4">SuaraSosial</h3>
                        <p class="text-sm">Platform informasi kegiatan sosialisasi mahasiswa kepada masyarakat.</p>
                    </div>
                    <div>
                        <h3 class="text-[var(--text)] font-bold text-lg mb-4">Kategori</h3>
                        <ul class="text-sm space-y-2">
                            <li><a href="{{ route('programs.index', ['category' => 'pendidikan']) }}" class="hover:text-[var(--primary)] transition">Pendidikan</a></li>
                            <li><a href="{{ route('programs.index', ['category' => 'lingkungan']) }}" class="hover:text-[var(--primary)] transition">Lingkungan</a></li>
                            <li><a href="{{ route('programs.index', ['category' => 'literasi-digital']) }}" class="hover:text-[var(--primary)] transition">Literasi Digital</a></li>
                            <li><a href="{{ route('programs.index', ['category' => 'kesehatan']) }}" class="hover:text-[var(--primary)] transition">Kesehatan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-[var(--text)] font-bold text-lg mb-4">Kontak</h3>
                        <p class="text-sm">Email: info@suarasosial.test</p>
                        <p class="text-sm">Telepon: (021) 1234-5678</p>
                    </div>
                </div>
                <div class="border-t border-[var(--border-soft)] pt-8">
                    <p class="text-center text-sm">&copy; 2024 SuaraSosial. Semua hak dilindungi.</p>
                </div>
            </div>
        </footer>
    @endif

    @yield('scripts')
</body>
</html>
