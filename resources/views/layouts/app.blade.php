<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SuaraSosial</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        .btn-loading {
            pointer-events: none;
            opacity: 0.75;
        }

        .spinner {
            display: inline-block;
            width: 1.125rem;
            height: 1.125rem;
            border: 3px solid rgba(255,255,255,0.55);
            border-top-color: #fff;
            border-radius: 9999px;
            animation: spin 0.75s linear infinite;
        }

        .hidden {
            display: none !important;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .skeleton {
            position: relative;
            overflow: hidden;
            background-color: #ededf5;
        }

        .skeleton::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.75), transparent);
            transform: translateX(-100%);
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            to { transform: translateX(100%); }
        }

        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(3px);
            display: none;
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .loading-overlay.active {
            display: flex;
        }

        .loading-overlay p {
            margin: 0;
            color: var(--text-muted);
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
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <div id="toast-container" class="fixed inset-x-0 top-6 z-50 flex items-center justify-center px-4 pointer-events-none"></div>

    <script>
        window.toastMessages = {
            success: @json(session('success')),
            error: @json(session('error')),
            validation: @json($errors->any() ? implode(' ', $errors->all()) : null)
        };
    </script>

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
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        @guest
                            <a href="{{ route('login') }}" class="btn-accent text-sm inline-flex items-center justify-center px-4 py-3 rounded-3xl">
                                Login Admin
                            </a>
                        @endguest
                        <p class="text-center text-sm md:text-right">&copy; 2024 SuaraSosial. Semua hak dilindungi.</p>
                    </div>
                </div>
            </div>
        </footer>
    @endif

    <div id="loadingOverlay" class="loading-overlay">
        <div class="flex flex-col items-center gap-3 p-6 rounded-3xl bg-white/90 shadow-2xl">
            <div class="spinner"></div>
            <p>Memuat...</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form.js-loading-form').forEach(function (form) {
                form.addEventListener('submit', function () {
                    var submit = form.querySelector('[type="submit"]');
                    if (submit) {
                        submit.classList.add('btn-loading');
                        submit.setAttribute('disabled', 'disabled');
                        var spinner = submit.querySelector('.spinner');
                        if (spinner) {
                            spinner.classList.remove('hidden');
                        }
                    }

                    var overlay = document.getElementById('loadingOverlay');
                    if (overlay) {
                        overlay.classList.add('active');
                    }
                });
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
