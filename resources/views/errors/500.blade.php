@extends('errors.layout')

@section('content')
    @php
        $code = 500;
        $title = 'Kesalahan Server';
        $message = 'Terjadi masalah pada server SuaraSosial.';
        $description = 'Kami sedang memperbaiki masalah ini. Silakan coba lagi beberapa saat kemudian.';
    @endphp
@endsection
