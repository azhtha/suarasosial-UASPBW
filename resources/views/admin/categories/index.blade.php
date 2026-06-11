@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')

@section('content')
    <!-- Header with Button -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <p class="text-[var(--text-muted)]">Total kategori: {{ count($categories) }}</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary">
            <i class="fas fa-plus mr-2"></i>Tambah Kategori
        </a>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden border border-[var(--border-soft)]">
        @if($categories->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[var(--lavender)]/30 border-b border-[var(--border-soft)]">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[var(--text-muted)]">Nama Kategori</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[var(--text-muted)]">Slug</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[var(--text-muted)]">Jumlah Program</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-[var(--text-muted)]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-soft)]">
                        @foreach($categories as $category)
                            <tr class="row-hover-lavender">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-[var(--text)]">{{ $category->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <code class="text-sm text-[var(--text-muted)] bg-[var(--background)]/70 px-2 py-1 rounded">{{ $category->slug }}</code>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-[var(--lavender)]/25 text-[var(--primary)] text-sm rounded-full">
                                        {{ $category->programs_count }} Program
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn-secondary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($category->programs_count == 0)
                                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Hapus kategori ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="btn-danger btn-sm opacity-50 cursor-not-allowed" title="Tidak bisa hapus, masih ada program">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <i class="fas fa-folder text-4xl text-[var(--border-soft)] mb-3"></i>
                <p class="text-[var(--text-muted)] mb-4">Belum ada kategori</p>
                <a href="{{ route('admin.categories.create') }}" class="btn-primary inline-block">
                    <i class="fas fa-plus mr-2"></i>Buat Kategori Pertama
                </a>
            </div>
        @endif
    </div>
@endsection
