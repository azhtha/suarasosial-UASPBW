@extends('layouts.app')

@section('title', $program->title)

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-[var(--background)] py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-2 text-sm text-[var(--text-muted)]">
                <a href="{{ route('home') }}" class="text-[var(--primary)] hover:text-[var(--primary-dark)]">Beranda</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('programs.index') }}" class="text-[var(--primary)] hover:text-[var(--primary-dark)]">Program</a>
                <i class="fas fa-chevron-right"></i>
                <span class="text-[var(--text)]">{{ Str::limit($program->title, 40) }}</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <article class="card overflow-hidden">
                    <!-- Featured Image -->
                    <div class="w-full h-96 bg-[var(--lavender)] flex items-center justify-center overflow-hidden">
                        @if($program->image)
                            <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-white text-center">
                                <i class="fas fa-image text-8xl opacity-30"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-8">
                        <!-- Title -->
                        <h1 class="text-4xl font-bold text-[var(--text)] mb-4">
                            {{ $program->title }}
                        </h1>

                        <!-- Meta Information -->
                        <div class="flex flex-wrap gap-4 text-[var(--text-muted)] mb-6 pb-6 border-b border-[var(--border-soft)]">
                            <div class="flex items-center">
                                <i class="fas fa-tag text-[var(--primary)] mr-2"></i>
                                <a href="{{ route('programs.index', ['category' => $program->category->slug]) }}" class="text-[var(--primary)] hover:text-[var(--primary-dark)] font-semibold">
                                    {{ $program->category->name }}
                                </a>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-user text-[var(--primary)] mr-2"></i>
                                <span>{{ $program->author }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-[var(--primary)] mr-2"></i>
                                <span>{{ $program->publish_date->format('d F Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-[var(--primary)] mr-2"></i>
                                <span>{{ $program->location }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="text-[var(--text-muted)] leading-relaxed whitespace-pre-line">
                            {{ $program->description }}
                        </div>

                        <!-- Back to Programs -->
                        <div class="mt-12 pt-8 border-t border-gray-200">
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
                    <h3 class="text-lg font-bold text-[var(--text)] mb-4">
                        <i class="fas fa-info-circle text-[var(--primary)] mr-2"></i>Informasi Program
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-[var(--text-muted)] font-semibold mb-1">Kategori</p>
                            <a href="{{ route('programs.index', ['category' => $program->category->slug]) }}" class="text-[var(--primary)] hover:text-[var(--primary-dark)]">
                                <i class="fas fa-folder mr-1"></i>{{ $program->category->name }}
                            </a>
                        </div>
                        <div class="border-t border-[var(--border-soft)] pt-4">
                            <p class="text-sm text-[var(--text-muted)] font-semibold mb-1">Penulis/Organisasi</p>
                            <p class="text-[var(--text)]">{{ $program->author }}</p>
                        </div>
                        <div class="border-t border-[var(--border-soft)] pt-4">
                            <p class="text-sm text-[var(--text-muted)] font-semibold mb-1">Tanggal Publikasi</p>
                            <p class="text-[var(--text)]">{{ $program->publish_date->format('d F Y') }}</p>
                        </div>
                        <div class="border-t border-[var(--border-soft)] pt-4">
                            <p class="text-sm text-[var(--text-muted)] font-semibold mb-1">Lokasi</p>
                            <p class="text-[var(--text)]">
                                <i class="fas fa-map-marker-alt text-[var(--primary)] mr-1"></i>{{ $program->location }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Related Programs -->
                @if($relatedPrograms->count() > 0)
                    <div class="card p-6">
                        <h3 class="text-lg font-bold text-[var(--text)] mb-4">
                            <i class="fas fa-th-list text-[var(--primary)] mr-2"></i>Program Terkait
                        </h3>
                        
                        <div class="space-y-4">
                            @foreach($relatedPrograms as $related)
                                <div class="border-b border-[var(--border-soft)] pb-4 last:border-b-0">
                                    <h4 class="font-semibold text-[var(--text)] mb-1 line-clamp-2 hover:text-[var(--primary)]">
                                        <a href="{{ route('programs.show', $related->slug) }}">
                                            {{ $related->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-[var(--text-muted)] mb-2">
                                        <i class="fas fa-calendar mr-1"></i>{{ $related->publish_date->format('d M Y') }}
                                    </p>
                                    <a href="{{ route('programs.show', $related->slug) }}" class="text-[var(--primary)] hover:text-[var(--primary-dark)] text-sm">
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
