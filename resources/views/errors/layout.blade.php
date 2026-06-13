<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Error' }} - SuaraSosial</title>
    @include('partials.favicon')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body class="min-h-screen bg-linear-to-b from-[#F8F5FF] to-white text-[#2E1065]">
    <div class="min-h-screen flex items-center justify-center px-8 py-12">
        <div class="w-full max-w-3xl bg-white border border-[#E9D5FF] rounded-3xl shadow-[0_28px_80px_rgba(124,58,237,0.12)] overflow-hidden">
            <div class="bg-[linear-gradient(135deg,rgba(124,58,237,0.15),rgba(167,139,250,0.12))] p-12 text-center">
                <h1 class="text-[clamp(3rem,4vw,4.5rem)] tracking-[-0.06em] m-0">{{ $code ?? 'Error' }}</h1>
                <p class="mt-4 text-[#6B7280] text-lg">{{ $title ?? 'Terjadi kesalahan' }}</p>
            </div>
            <div class="p-12">
                <h2 class="text-3xl font-semibold mb-4">{{ $message ?? 'Halaman yang diminta tidak dapat ditampilkan.' }}</h2>
                <p class="text-[#6B7280] leading-8 mb-8">{{ $description ?? 'Silakan kembali ke halaman utama atau coba lagi nanti.' }}</p>
                <a href="{{ route('home') }}" class="btn-primary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
