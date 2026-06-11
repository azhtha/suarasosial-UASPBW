@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori Baru')

@section('content')
    <div class="max-w-2xl mx-auto">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="bg-white rounded-lg shadow p-8">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-[var(--text)] mb-2">
                    <i class="fas fa-tag text-[var(--primary)] mr-1"></i>Nama Kategori
                </label>
                <input 
                    type="text" 
                    id="name"
                    name="name" 
                    value="{{ old('name') }}"
                    required
                    placeholder="Masukkan nama kategori..."
                    class="w-full px-4 py-2 border border-[var(--border-soft)] rounded-xl focus:outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--lavender)]/30 @error('name') border-red-500 @enderror"
                    autofocus
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-success flex-1">
                    <i class="fas fa-save mr-2"></i>Simpan Kategori
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn-secondary flex-1 text-center block">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
@endsection
