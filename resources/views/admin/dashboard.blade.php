@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border border-(--border-soft)">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-(--lavender) text-white">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-(--text-muted)]">Total Program</p>
                    <p class="text-3xl font-bold text-(--text)]">{{ $totalPrograms }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border border-(--border-soft)]">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-(--primary) text-white">
                        <i class="fas fa-folder"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-(--text-muted)]">Total Kategori</p>
                    <p class="text-3xl font-bold text-(--text)]">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h3 class="text-lg font-bold text-(--text) mb-4">
            <i class="fas fa-flash text-yellow-500 mr-2"></i>Aksi Cepat
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.programs.create') }}" class="btn-primary flex items-center justify-center">
                <i class="fas fa-plus mr-2"></i>Tambah Program
            </a>
            <a href="{{ route('admin.categories.create') }}" class="btn-secondary flex items-center justify-center">
                <i class="fas fa-folder-plus mr-2"></i>Tambah Kategori
            </a>
            <a href="{{ route('admin.programs.index') }}" class="btn-primary flex items-center justify-center">
                <i class="fas fa-list mr-2"></i>Kelola Program
            </a>
        </div>
    </div>

    <!-- Latest Programs -->
    <div class="bg-white rounded-lg shadow overflow-hidden border border-(--border-soft)">
        <div class="px-6 py-4 border-b border-(--border-soft)">
            <h3 class="text-lg font-bold text-(--text)">
                <i class="fas fa-history text-(--primary) mr-2"></i>Program Terbaru
            </h3>
        </div>
        
        @if($latestPrograms->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-(--lavender)/30 border-b border-(--border-soft)">
                        <tr>
                            <th class="w-[35%] px-4 py-3 text-left text-sm font-semibold text-(--text-muted)">Judul</th>
                            <th class="w-[15%] px-4 py-3 text-left text-sm font-semibold text-(--text-muted)">Kategori</th>
                            <th class="w-[17%] px-4 py-3 text-left text-sm font-semibold text-(--text-muted)">Penulis</th>
                            <th class="w-[18%] px-4 py-3 text-left text-sm font-semibold text-(--text-muted)">Tanggal</th>
                            <th class="w-[15%] px-4 py-3 text-center text-sm font-semibold text-(--text-muted)">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-(--border-soft)">
                        @foreach($latestPrograms as $program)
                            <tr class="row-hover-lavender">
                                <td class="px-4 py-4">
                                    <div class="text-sm font-semibold text-(--text)">{{ Str::limit($program->title, 40) }}</div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center px-3 py-1 bg-(--lavender)/25 text-(--primary) text-sm rounded-full">
                                        {{ $program->category->name }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm text-(--text-muted) whitespace-nowrap">
                                    {{ $program->author }}
                                </td>
                                <td class="px-4 py-4 text-sm text-(--text-muted) whitespace-nowrap">
                                    {{ $program->publish_date->format('d M Y') }}
                                </td>
                                <td class="px-4 py-4 text-sm text-center">
                                    <div class="inline-flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.programs.edit', $program) }}" class="btn-secondary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('programs.show', $program->slug) }}" target="_blank" class="btn-primary btn-sm" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-6 text-center">
                <i class="fas fa-inbox text-4xl text-(--border-soft) mb-3"></i>
                <p class="text-(--text-muted)">Belum ada program</p>
                <a href="{{ route('admin.programs.create') }}" class="btn-primary inline-block mt-4">
                    <i class="fas fa-plus mr-2"></i>Buat Program Pertama
                </a>
            </div>
        @endif
    </div>
@endsection
