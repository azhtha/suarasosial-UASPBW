@extends('errors.layout')

@section('content')
    @php
        $code = 404;
        $title = 'Halaman Tidak Ditemukan';
        $message = 'Maaf, halaman yang Anda cari tidak tersedia di SuaraSosial.';
        $description = 'Periksa kembali alamat URL atau gunakan tombol di bawah untuk kembali ke beranda.';
    @endphp
@endsection
