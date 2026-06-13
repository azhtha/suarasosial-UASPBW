@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <div class="bg-purple-700 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-4 text-white">
                <i class="fas fa-bullhorn mr-3 text-white"></i>SuaraSosial
            </h1>
            <p class="text-xl text-purple-50 mb-8">Platform Informasi Kegiatan Sosialisasi Mahasiswa</p>
            <p class="text-lg text-purple-50 mb-8 max-w-3xl mx-auto">
                Menyediakan informasi lengkap tentang berbagai kegiatan sosialisasi dan edukasi masyarakat yang dilakukan oleh mahasiswa. Dari pendidikan, lingkungan, literasi digital, kesehatan, hingga kegiatan sosial masyarakat.
            </p>
            <a href="{{ route('programs.index') }}" class="btn-accent inline-block">
                <i class="fas fa-arrow-right mr-2"></i>Lihat Semua Program
            </a>
        </div>
    </div>

    <!-- Statistics -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-center">
                <div class="rounded-lg border border-purple-200 bg-linear-to-br from-purple-50 to-purple-200 p-6 shadow-sm">
                    <div class="text-4xl font-bold text-purple-700 mb-2">{{ $totalPrograms }}</div>
                    <div class="text-purple-700">Program Sosialisasi</div>
                </div>
                <div class="rounded-lg border border-amber-200 bg-linear-to-br from-amber-50 to-amber-200 p-6 shadow-sm">
                    <div class="text-4xl font-bold text-purple-700 mb-2">{{ count($categories) }}</div>
                    <div class="text-purple-700">Kategori Kegiatan</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Programs -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-4xl font-bold text-(--text)] mb-4">Program Terbaru</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestPrograms as $program)
                <div class="card hover:shadow-xl transition overflow-hidden">
                    <!-- Image -->
                    <div class="w-full h-48 bg-(--lavender)] flex items-center justify-center overflow-hidden relative">
                        <div class="image-fallback absolute inset-0 flex flex-col items-center justify-center text-white text-center px-4" style="display: none;">
                            <i class="fas fa-image text-6xl opacity-50"></i>
                            <p class="text-sm mt-2 opacity-75">Tidak ada gambar</p>
                        </div>
                        @if($program->image_url)
                            <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.closest('.relative').querySelector('.image-fallback').style.display='flex';">
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center px-4">
                                <i class="fas fa-image text-6xl opacity-50"></i>
                                <p class="text-sm mt-2 opacity-75">Tidak ada gambar</p>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Category Badge -->
                        <div class="mb-3">
                            <span class="badge badge-primary text-xs">
                                {{ $program->category->name }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-(--text)] mb-2 line-clamp-2">
                            {{ $program->title }}
                        </h3>

                        <!-- Meta Info -->
                        <div class="space-y-2 text-sm text-(--text-muted)] mb-4">
                            <div>
                                <i class="fas fa-user text-(--primary)] mr-2"></i>{{ $program->author }}
                            </div>
                            <div>
                                <i class="fas fa-calendar text-(--primary)] mr-2"></i>{{ $program->publish_date->format('d M Y') }}
                            </div>
                            <div class="flex items-center text-sm text-(--text-muted)]">
                                <i class="fas fa-map-marker-alt text-(--primary)] mr-2 shrink-0"></i>
                                <span class="truncate min-w-0 block">{{ $program->location }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-(--text-muted)] text-sm mb-4 line-clamp-3">
                            {{ $program->description }}
                        </p>

                        <!-- Button -->
                        <a href="{{ route('programs.show', $program->slug) }}" class="btn-primary w-full text-center block">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <i class="fas fa-inbox text-6xl text-(--border-soft)] mb-4"></i>
                    <p class="text-(--text-muted)]">Belum ada program yang tersedia</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('programs.index') }}" class="btn-secondary inline-block">
                <i class="fas fa-arrow-right mr-2"></i>Lihat Semua Program
            </a>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-(--background)] py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-(--text)] mb-8 text-center">Kategori Kegiatan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('programs.index', ['category' => $category->slug]) }}" class="card p-6 text-center hover:shadow-lg transition">
                        <div class="text-4xl text-(--primary)] mb-3">
                            @switch($category->slug)
                                @case('pendidikan')
                                    <i class="fas fa-graduation-cap"></i>
                                @break
                                @case('lingkungan')
                                    <i class="fas fa-leaf"></i>
                                @break
                                @case('literasi-digital')
                                    <i class="fas fa-laptop"></i>
                                @break
                                @case('kesehatan')
                                    <i class="fas fa-heartbeat"></i>
                                @break
                                @case('sosial-masyarakat')
                                    <i class="fas fa-people-carry"></i>
                                @break
                                @default
                                    <i class="fas fa-tag"></i>
                            @endswitch
                        </div>
                        <h3 class="font-bold text-(--text)]">{{ $category->name }}</h3>
                        <p class="text-sm text-(--text-muted)] mt-2">{{ $category->programs->count() }} Program</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
