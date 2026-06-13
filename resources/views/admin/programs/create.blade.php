@extends('layouts.admin')

@section('title', 'Tambah Program')
@section('page-title', 'Tambah Program Baru')

@section('content')
    <form method="POST" action="{{ route('admin.programs.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Card: Basic Info -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-[var(--text)] mb-4">
                        <i class="fas fa-file-alt text-[var(--primary)] mr-2"></i>Informasi Dasar
                    </h3>

                    <!-- Title -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-semibold text-[var(--text)] mb-2">
                            <i class="fas fa-heading text-[var(--primary)] mr-1"></i>Judul Program
                        </label>
                        <input 
                            type="text" 
                            id="title"
                            name="title" 
                            value="{{ old('title') }}"
                            required
                            placeholder="Masukkan judul program..."
                            class="w-full px-4 py-2 border border-[var(--border-soft)] rounded-xl focus:outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--lavender)]/30 @error('title') border-red-500 @enderror"
                        >
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-[var(--text)] mb-2">
                            <i class="fas fa-align-left text-[var(--primary)] mr-1"></i>Deskripsi Program
                        </label>
                        <textarea 
                            id="description"
                            name="description" 
                            rows="8"
                            required
                            placeholder="Masukkan deskripsi lengkap program..."
                            class="w-full px-4 py-2 border border-[var(--border-soft)] rounded-xl focus:outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--lavender)]/30 @error('description') border-red-500 @enderror"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Card: Additional Info -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-[var(--text)] mb-4">
                        <i class="fas fa-info-circle text-[var(--primary)] mr-2"></i>Detail Program
                    </h3>

                    <!-- Category -->
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-semibold text-[var(--text)] mb-2">
                            <i class="fas fa-folder text-[var(--primary)] mr-1"></i>Kategori
                        </label>
                        <select 
                            id="category_id"
                            name="category_id" 
                            required
                            class="w-full px-4 py-2 border border-[var(--border-soft)] rounded-xl focus:outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--lavender)]/30 @error('category_id') border-red-500 @enderror"
                        >
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div class="mb-6">
                        <label for="author" class="block text-sm font-semibold text-[var(--text)] mb-2">
                            <i class="fas fa-user text-[var(--primary)] mr-1"></i>Penulis/Organisasi
                        </label>
                        <input 
                            type="text" 
                            id="author"
                            name="author" 
                            value="{{ old('author') }}"
                            required
                            placeholder="Nama penulis atau organisasi..."
                            class="w-full px-4 py-2 border border-[var(--border-soft)] rounded-xl focus:outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--lavender)]/30 @error('author') border-red-500 @enderror"
                        >
                        @error('author')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-semibold text-[var(--text)] mb-2">
                            <i class="fas fa-map-marker-alt text-[var(--primary)] mr-1"></i>Lokasi
                        </label>
                        <input 
                            type="text" 
                            id="location"
                            name="location" 
                            value="{{ old('location') }}"
                            required
                            placeholder="Lokasi kegiatan..."
                            class="w-full px-4 py-2 border border-[var(--border-soft)] rounded-xl focus:outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--lavender)]/30 @error('location') border-red-500 @enderror"
                        >
                        @error('location')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Card: Image Upload -->
                <div class="bg-white rounded-lg shadow p-6 border border-[var(--border-soft)]">
                    <h3 class="text-lg font-bold text-[var(--text)] mb-4">
                        <i class="fas fa-image text-[var(--primary)] mr-2"></i>Gambar Program
                    </h3>

                    <div class="mb-4">
                        <div id="imagePreview" class="w-full h-40 bg-[var(--background)] rounded-xl mb-4 flex items-center justify-center overflow-hidden" style="display: none;">
                            <img id="previewImage" src="" alt="Preview" class="w-full h-full object-cover">
                        </div>
                        <div id="noImagePlaceholder" class="w-full h-40 bg-[var(--background)] rounded-xl mb-4 flex flex-col items-center justify-center text-[var(--text-muted)]">
                            <i class="fas fa-image text-4xl mb-2"></i>
                            <p class="text-sm">Pilih Gambar</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" id="chooseImageBtn" class="btn-primary w-full text-sm flex items-center justify-center">
                            <i class="fas fa-upload mr-2"></i>
                            <span id="chooseImageLabel">Pilih Gambar</span>
                        </button>
                    </div>
                    <input 
                        type="file" 
                        id="image"
                        name="image" 
                        accept="image/*"
                        class="sr-only"
                    >
                    <p class="text-xs text-[var(--text-muted)] mt-2">
                        <i class="fas fa-info-circle text-[var(--primary)] mr-1"></i>Max 2MB. Format: JPG, PNG, GIF
                    </p>
                    @error('image')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Card: Publish Date -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-[var(--text)] mb-4">
                        <i class="fas fa-calendar text-[var(--primary)] mr-2"></i>Tanggal Publikasi
                    </h3>

                    <input 
                        type="date" 
                        id="publish_date"
                        name="publish_date" 
                        value="{{ old('publish_date', now()->format('Y-m-d')) }}"
                        required
                        class="w-full px-4 py-2 border border-[var(--border-soft)] rounded-xl focus:outline-none focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--lavender)]/30 @error('publish_date') border-red-500 @enderror"
                    >
                    @error('publish_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Card: Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-[var(--text)] mb-4">
                        <i class="fas fa-check text-[var(--primary)] mr-2"></i>Aksi
                    </h3>

                    <div class="space-y-3">
                        <button type="submit" class="btn-success w-full">
                            <i class="fas fa-save mr-2"></i>Simpan Program
                        </button>
                        <a href="{{ route('admin.programs.index') }}" class="btn-secondary w-full text-center block">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        (function(){
            const fileInput = document.getElementById('image');
            const chooseBtn = document.getElementById('chooseImageBtn');
            const chooseLabel = document.getElementById('chooseImageLabel');
            const preview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');
            const placeholder = document.getElementById('noImagePlaceholder');

            // open file picker when custom button clicked
            chooseBtn.addEventListener('click', () => fileInput.click());

            function setButtonState(hasFile, name) {
                if (!hasFile) {
                    chooseBtn.classList.remove('btn-secondary');
                    chooseBtn.classList.add('btn-primary');
                    chooseLabel.textContent = 'Pilih Gambar';
                    chooseBtn.setAttribute('aria-pressed', 'false');
                } else {
                    chooseBtn.classList.remove('btn-primary');
                    chooseBtn.classList.add('btn-secondary');
                    chooseLabel.textContent = name || 'File dipilih';
                    chooseBtn.setAttribute('aria-pressed', 'true');
                }
            }

            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        preview.style.display = 'block';
                        placeholder.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                    setButtonState(true, file.name);
                } else {
                    preview.style.display = 'none';
                    placeholder.style.display = 'flex';
                    setButtonState(false);
                }
            });

            // initialize state (no file selected)
            setButtonState(false);
        })();
    </script>
@endsection
