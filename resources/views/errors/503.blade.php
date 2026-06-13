@extends('errors.layout')

@section('content')
    @php
        $code = 503;
        $title = 'Layanan Tidak Tersedia';
        $message = 'SuaraSosial sedang dalam pemeliharaan sementara.';
        $description = 'Kami akan segera kembali. Silakan coba lagi beberapa saat nanti.';
    @endphp
@endsection
