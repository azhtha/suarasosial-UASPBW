@extends('errors.layout')

@section('content')
    @php
        $code = 419;
        $title = 'Halaman Kedaluwarsa';
        $message = 'Token CSRF sudah kedaluwarsa.';
        $description = 'Silakan segarkan halaman dan coba lagi. Jika masih bermasalah, masuk kembali.';
    @endphp
@endsection
