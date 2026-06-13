@extends('layouts.admin')

@section('title', 'Kelola Program')
@section('page-title', 'Kelola Program')

@section('content')
    <!-- Header with Search -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex-1">
            <form method="GET" action="{{ route('admin.programs.index') }}" class="flex gap-2">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari program..." 
                    class="flex-1 px-4 py-2 border border-(--border-soft) rounded-xl focus:outline-none focus:border-(--primary) focus:ring-2 focus:ring-(--lavender)/30"
                >
                <button type="submit" class="btn-primary">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.programs.index') }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i>Reset
                    </a>
                @endif
            </form>
        </div>
        <a href="{{ route('admin.programs.create') }}" class="btn-primary ml-4 whitespace-nowrap">
            <i class="fas fa-plus mr-2"></i>Tambah Program
        </a>
    </div>

    <!-- Programs Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($programs->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-(--lavender)/30 border-b border-(--border-soft)">
                        <tr>
                            <th class="w-[30%] px-4 py-3 text-left text-sm font-semibold text-(--text-muted)">Judul</th>
                            <th class="w-[14%] px-4 py-3 text-left text-sm font-semibold text-(--text-muted)">Kategori</th>
                            <th class="w-[16%] px-4 py-3 text-left text-sm font-semibold text-(--text-muted)">Penulis</th>
                            <th class="w-[16%] px-4 py-3 text-left text-sm font-semibold text-(--text-muted)">Lokasi</th>
                            <th class="w-[14%] px-4 py-3 text-left text-sm font-semibold text-(--text-muted)">Tanggal</th>
                            <th class="w-[10%] px-4 py-3 text-center text-sm font-semibold text-(--text-muted)">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-(--border-soft)">
                        @foreach($programs as $program)
                            <tr class="row-hover-lavender">
                                <td class="px-4 py-4">
                                    <div class="text-sm font-semibold text-(--text) line-clamp-1">{{ $program->title }}</div>
                                    <div class="text-xs text-(--text-muted)">{{ Str::limit($program->description, 50) }}</div>
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
                                    {{ Str::limit($program->location, 20) }}
                                </td>
                                <td class="px-4 py-4 text-sm text-(--text-muted) whitespace-nowrap">
                                    {{ $program->publish_date->format('d M Y') }}
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <div class="inline-flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.programs.edit', $program) }}" class="btn-secondary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('programs.show', $program->slug) }}" target="_blank" class="btn-primary btn-sm" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.programs.destroy', $program) }}" class="inline" onsubmit="return confirm('Hapus program ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger btn-sm" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-(--border-soft)">
                {{ $programs->links('pagination::tailwind') }}
            </div>
        @else
            <div class="p-12 text-center">
                <i class="fas fa-inbox text-4xl text-(--border-soft) mb-3"></i>
                <p class="text-(--text-muted) mb-4">Belum ada program</p>
                <a href="{{ route('admin.programs.create') }}" class="btn-primary inline-block">
                    <i class="fas fa-plus mr-2"></i>Buat Program Pertama
                </a>
            </div>
        @endif
    </div>
@endsection
