@extends('layouts.admin')

@section('title', 'Manajemen Akun')
@section('page-title', 'Manajemen Akun')

@section('content')
    <div class="max-w-3xl">
        <div class="bg-white rounded-3xl shadow p-8">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-[var(--text)] mb-2">Profil Admin</h3>
                <p class="text-[var(--text-muted)]">Perbarui nama, email, dan kata sandi admin Anda.</p>
            </div>

            <form method="POST" action="{{ route('admin.account.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-[var(--text)] mb-2" for="name">Nama Lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $admin->name) }}" class="w-full input-soft px-4 py-3" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[var(--text)] mb-2" for="email">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $admin->email) }}" class="w-full input-soft px-4 py-3" required>
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-[var(--text)] mb-2" for="password">Password Baru</label>
                        <input id="password" name="password" type="password" class="w-full input-soft px-4 py-3" placeholder="Kosongkan jika tidak diubah">
                        <p class="text-xs text-[var(--text-muted)] mt-2">Isi hanya jika ingin mengganti kata sandi.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[var(--text)] mb-2" for="password_confirmation">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="w-full input-soft px-4 py-3" placeholder="Konfirmasi password baru">
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-[var(--text-muted)]">Diperbarui terakhir: {{ $admin->updated_at ? $admin->updated_at->format('d F Y H:i') : '-' }}</p>
                    </div>
                    <button type="submit" class="btn-primary inline-flex items-center">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
