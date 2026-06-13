@extends('layouts.app')

@section('title', 'Daftar Program')

@section('content')
    <!-- Header -->
    <div class="bg-purple-700 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-2 text-white">
                <i class="fas fa-list mr-3 text-white"></i>Daftar Program Sosialisasi
            </h1>
            <p class="text-purple-50">Jelajahi semua kegiatan sosialisasi yang tersedia</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:col-span-1">
                <div class="card p-6 sticky top-20">
                    <h3 class="text-lg font-bold text-(--text) mb-4">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </h3>

                    <!-- Search Box -->
                    <form method="GET" action="{{ route('programs.index') }}" class="mb-6">
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-(--text) mb-2">Cari Program</label>
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Cari judul, author, lokasi..." 
                                class="w-full px-3 py-2 border border-(--border-soft) rounded-xl focus:outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--lavender)/30"
                            >
                        </div>

                        <!-- Category Filter -->
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-(--text) mb-2">Kategori</label>
                            <select 
                                name="category" 
                                class="w-full px-3 py-2 border border-(--border-soft) rounded-xl focus:outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--lavender)/30"
                            >
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            <i class="fas fa-search mr-2"></i>Cari
                        </button>
                        
                        @if(request('search') || request('category'))
                            <a href="{{ route('programs.index') }}" class="btn-secondary w-full text-center block mt-2">
                                <i class="fas fa-times mr-2"></i>Reset Filter
                            </a>
                        @endif
                    </form>

                    <!-- Category List -->
                    <div>
                        <h4 class="font-semibold text-(--text) mb-3">Kategori Populer</h4>
                        <ul class="space-y-2">
                            @foreach($categories as $category)
                                <li>
                                    <a 
                                        href="{{ route('programs.index', ['category' => $category->slug]) }}"
                                        class="text-(--primary) hover:text-(--primary-dark) transition text-sm block py-1 px-2 rounded hover:bg-(--lavender)/20"
                                    >
                                        {{ $category->name }}
                                        <span class="text-(--text-muted) text-xs">({{ $category->programs->count() }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Programs Grid -->
            <div class="lg:col-span-3">
                @if($programs->count() > 0)
                    <div class="mb-6">
                        <p class="text-(--text-muted)">
                            Menampilkan {{ $programs->count() }} dari {{ $programs->total() }} program
                            @if(request('search'))
                                untuk "<strong>{{ request('search') }}</strong>"
                            @endif
                            @if(request('category'))
                                di kategori "<strong>{{ request()->query('category') }}</strong>"
                            @endif
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        @foreach($programs as $program)
                            <div class="card hover:shadow-xl transition overflow-hidden">
                                <!-- Image -->
                                <div class="w-full h-40 bg-(--lavender) flex items-center justify-center overflow-hidden relative">
                                    <div class="image-fallback absolute inset-0 flex items-center justify-center text-white text-center px-4" style="display: none;">
                                        <i class="fas fa-image text-5xl opacity-50"></i>
                                    </div>
                                    @if($program->image_url)
                                        <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.closest('.relative').querySelector('.image-fallback').style.display='flex';">
                                    @else
                                        <div class="absolute inset-0 flex items-center justify-center text-white text-center px-4">
                                            <i class="fas fa-image text-5xl opacity-50"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-5">
                                    <!-- Category Badge -->
                                    <div class="mb-2">
                                        <a href="{{ route('programs.index', ['category' => $program->category->slug]) }}" class="badge badge-primary text-xs hover:opacity-80">
                                            {{ $program->category->name }}
                                        </a>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-lg font-bold text-(--text) mb-2 line-clamp-2 hover:text-(--primary)">
                                        <a href="{{ route('programs.show', $program->slug) }}">
                                            {{ $program->title }}
                                        </a>
                                    </h3>

                                    <!-- Meta -->
                                    <div class="space-y-1 text-xs text-(--text-muted) mb-3">
                                        <div>
                                            <i class="fas fa-user text-(--primary) mr-1"></i>{{ $program->author }}
                                        </div>
                                        <div>
                                            <i class="fas fa-calendar text-(--primary) mr-1"></i>{{ $program->formatted_publish_date }}
                                        </div>
                                        <div class="flex items-center text-xs text-(--text-muted)">
                                            <i class="fas fa-map-marker-alt text-(--primary) mr-1 flex-shrink-0"></i>
                                            <span class="truncate min-w-0 block">{{ $program->location }}</span>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <p class="text-(--text-muted) text-sm mb-4 line-clamp-2">
                                        {{ $program->description }}
                                    </p>

                                    <!-- Button -->
                                    <a href="{{ route('programs.show', $program->slug) }}" class="btn-primary w-full text-center block text-sm">
                                        <i class="fas fa-arrow-right mr-1"></i>Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $programs->links('pagination::tailwind') }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="card p-12 text-center">
                        <i class="fas fa-inbox text-6xl text-(--border-soft) mb-4"></i>
                        <h3 class="text-2xl font-bold text-(--text) mb-2">Tidak Ada Program</h3>
                        <p class="text-(--text-muted) mb-6">
                            Tidak ada program yang cocok dengan pencarian Anda.
                        </p>
                        <a href="{{ route('programs.index') }}" class="btn-primary inline-block">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Semua Program
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
