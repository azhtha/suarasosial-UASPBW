@extends('layouts.app')

@section('title', $program->title)

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-(--background)] py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-2 text-sm text-(--text-muted)]">
                <a href="{{ route('home') }}" class="text-(--primary)] hover:text-(--primary-dark)]">Beranda</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('programs.index') }}" class="text-(--primary)] hover:text-(--primary-dark)]">Program</a>
                <i class="fas fa-chevron-right"></i>
                <span class="text-(--text)]">{{ Str::limit($program->title, 40) }}</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <article class="card overflow-hidden">
                    <!-- Featured Image -->
                    <div class="w-full h-96 bg-(--lavender)] flex items-center justify-center overflow-hidden relative">
                        <div class="image-fallback absolute inset-0 flex items-center justify-center text-white text-center px-4" style="display: none;">
                            <i class="fas fa-image text-8xl opacity-30"></i>
                        </div>
                        @if($program->image_url)
                            <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.closest('.relative').querySelector('.image-fallback').style.display='flex';">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-white text-center px-4">
                                <i class="fas fa-image text-8xl opacity-30"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-8">
                        <!-- Title -->
                        <h1 class="text-4xl font-bold text-(--text)] mb-4">
                            {{ $program->title }}
                        </h1>

                        <!-- Meta Information -->
                        <div class="flex flex-wrap gap-4 text-(--text-muted)] mb-6 pb-6 border-b border-(--border-soft)">
                            <div class="flex items-center">
                                <i class="fas fa-tag text-(--primary)] mr-2"></i>
                                <a href="{{ route('programs.index', ['category' => $program->category->slug]) }}" class="text-(--primary)] hover:text-(--primary-dark)] font-semibold">
                                    {{ $program->category->name }}
                                </a>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-user text-(--primary)] mr-2"></i>
                                <span>{{ $program->author }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-(--primary)] mr-2"></i>
                                <span>{{ $program->formatted_publish_date }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-(--primary)] mr-2"></i>
                                <span>{{ $program->location }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="text-(--text-muted)] leading-relaxed whitespace-pre-line">
                            {{ $program->description }}
                        </div>

                        <!-- Back to Programs -->
                        <div class="mt-12 pt-8 border-t border-(--border-soft)">
                            <a href="{{ route('programs.index') }}" class="btn-secondary inline-block">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Program
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Program Info Card -->
                <div class="card p-6 mb-6 sticky top-20">
                    <h3 class="text-lg font-bold text-(--text)] mb-4">
                        <i class="fas fa-info-circle text-(--primary)] mr-2"></i>Informasi Program
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-(--text-muted)] font-semibold mb-1">Kategori</p>
                            <a href="{{ route('programs.index', ['category' => $program->category->slug]) }}" class="text-(--primary)] hover:text-(--primary-dark)]">
                                <i class="fas fa-folder mr-1"></i>{{ $program->category->name }}
                            </a>
                        </div>
                        <div class="border-t border-(--border-soft)] pt-4">
                            <p class="text-sm text-(--text-muted)] font-semibold mb-1">Penulis/Organisasi</p>
                            <p class="text-(--text)]">{{ $program->author }}</p>
                        </div>
                        <div class="border-t border-(--border-soft)] pt-4">
                            <p class="text-sm text-(--text-muted)] font-semibold mb-1">Tanggal Publikasi</p>
                            <p class="text-(--text)]">{{ $program->formatted_publish_date }}</p>
                        </div>
                        <div class="border-t border-(--border-soft)] pt-4">
                            <p class="text-sm text-(--text-muted)] font-semibold mb-1">Lokasi</p>
                            <p class="text-(--text)]">
                                <i class="fas fa-map-marker-alt text-(--primary)] mr-1"></i>{{ $program->location }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Related Programs -->
                @if($relatedPrograms->count() > 0)
                    <div class="card p-6">
                        <h3 class="text-lg font-bold text-(--text)] mb-4">
                            <i class="fas fa-th-list text-(--primary)] mr-2"></i>Program Terkait
                        </h3>
                        
                        <div class="space-y-4">
                            @foreach($relatedPrograms as $related)
                                <div class="border-b border-(--border-soft)] pb-4 last:border-b-0">
                                    <h4 class="font-semibold text-(--text)] mb-1 line-clamp-2 hover:text-(--primary)]">
                                        <a href="{{ route('programs.show', $related->slug) }}">
                                            {{ $related->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-(--text-muted)] mb-2">
                                        <i class="fas fa-calendar mr-1"></i>{{ $related->formatted_publish_date }}
                                    </p>
                                    <a href="{{ route('programs.show', $related->slug) }}" class="text-(--primary)] hover:text-(--primary-dark)] text-sm">
                                        <i class="fas fa-arrow-right mr-1"></i>Baca Selengkapnya
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
