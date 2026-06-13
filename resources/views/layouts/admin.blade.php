<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin SuaraSosial</title>
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
            --border-soft: #E9D5FF;
            --accent: #FBBF24;
        }

        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            background-color: var(--background);
            color: var(--text);
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

        .btn-danger {
            background-color: #dc2626;
            color: white;
            font-weight: 600;
            padding: 0.625rem 1rem;
            border-radius: 0.75rem;
            transition: background-color 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-success {
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

        .btn-success:hover {
            background-color: var(--primary-dark);
        }

        .btn-sm {
            padding: 0.375rem 0.5rem;
            font-size: 0.875rem;
        }

        .sidebar-card {
            background-color: white;
            border: 1px solid var(--border-soft);
        }

        .sidebar-link {
            color: white;
        }

        .sidebar-link-active {
            background-color: var(--primary-dark);
            border-left: 4px solid var(--accent);
            color: white;
        }

        .sidebar-bottom {
            border-top: 1px solid rgba(255,255,255,0.15);
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

        .input-soft {
            border: 1px solid var(--border-soft);
            border-radius: 0.75rem;
        }

        .input-soft:focus {
            outline: none;
            border-color: var(--lavender);
            box-shadow: 0 0 0 4px rgba(167, 139, 250, 0.18);
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Admin Sidebar + Header -->
    <div class="flex h-screen bg-[var(--background)]">
        <!-- Sidebar -->
        <div class="w-64 bg-[var(--primary)] text-white shadow-lg flex flex-col">
            <div class="p-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-user-shield mr-2"></i>Admin
                </h1>
                <p class="text-sm text-[rgba(255,255,255,0.85)]">SuaraSosial</p>
            </div>
            
            <nav class="mt-6 px-2 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-5 py-3 rounded-r-3xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-[var(--primary-dark)] border-l-4 border-[var(--accent)] text-white' : 'text-white hover:bg-[var(--lavender)]/20' }}">
                    <i class="fas fa-chart-line mr-3"></i>Dashboard
                </a>
                <a href="{{ route('admin.programs.index') }}" class="group flex items-center px-5 py-3 rounded-r-3xl text-sm font-medium transition {{ request()->routeIs('admin.programs.*') ? 'bg-[var(--primary-dark)] border-l-4 border-[var(--accent)] text-white' : 'text-white hover:bg-[var(--lavender)]/20' }}">
                    <i class="fas fa-bullhorn mr-3"></i>Program
                </a>
                <a href="{{ route('admin.categories.index') }}" class="group flex items-center px-5 py-3 rounded-r-3xl text-sm font-medium transition {{ request()->routeIs('admin.categories.*') ? 'bg-[var(--primary-dark)] border-l-4 border-[var(--accent)] text-white' : 'text-white hover:bg-[var(--lavender)]/20' }}">
                    <i class="fas fa-folder mr-3"></i>Kategori
                </a>
                <a href="{{ route('admin.account.edit') }}" class="group flex items-center px-5 py-3 rounded-r-3xl text-sm font-medium transition {{ request()->routeIs('admin.account.*') ? 'bg-[var(--primary-dark)] border-l-4 border-[var(--accent)] text-white' : 'text-white hover:bg-[var(--lavender)]/20' }}">
                    <i class="fas fa-user-cog mr-3"></i>Akun
                </a>
            </nav>

            <div class="mt-auto border-t border-white/20 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-[rgba(255,255,255,0.85)]">{{ Auth::user()->email }}</p>
                    </div>
                    <a href="{{ route('home') }}" class="text-[rgba(255,255,255,0.85)] hover:text-white" title="Kembali ke Beranda">
                        <i class="fas fa-home"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm px-6 py-4 flex justify-between items-center border-b border-[var(--border-soft)]">
                <h2 class="text-xl font-semibold text-[var(--text)]">@yield('page-title')</h2>
                <a href="{{ route('home') }}" class="text-[var(--primary)] hover:text-[var(--primary-dark)] flex items-center">
                    <i class="fas fa-external-link-alt mr-2"></i>Lihat Website
                </a>
            </div>

            <!-- Content -->
            <div class="flex-1 overflow-auto p-6">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="list-disc list-inside mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
