<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Sosialisasi Anti-Bullying di Sekolah Dasar',
                'category' => 'Pendidikan',
                'description' => 'Program sosialisasi untuk memberikan edukasi tentang pencegahan bullying kepada siswa sekolah dasar. Kegiatan ini mencakup workshop interaktif, diskusi kelompok, dan pemutaran film edukatif tentang dampak negatif bullying. Peserta akan diajak untuk lebih empati terhadap teman-teman mereka dan memahami pentingnya lingkungan yang aman dan inklusif.',
                'author' => 'Tim Edukasi SuaraSosial',
                'publish_date' => Carbon::now()->subDays(15),
                'location' => 'SD Negeri 01 Jakarta Pusat',
            ],
            [
                'title' => 'Edukasi Internet Sehat untuk Remaja',
                'category' => 'Literasi Digital',
                'description' => 'Sosialisasi mengenai penggunaan internet yang sehat dan aman untuk kalangan remaja. Materi mencakup bahaya cyberbullying, privasi data pribadi, cara mengenali konten berbahaya, dan pentingnya literasi digital. Peserta akan belajar bagaimana memanfaatkan internet dengan bijak untuk pengembangan diri mereka.',
                'author' => 'Divisi Literasi Digital',
                'publish_date' => Carbon::now()->subDays(10),
                'location' => 'SMP Negeri 05 Bandung',
            ],
            [
                'title' => 'Kampanye Kebersihan Lingkungan Sekitar Sungai',
                'category' => 'Lingkungan',
                'description' => 'Kegiatan sosial yang bertujuan untuk membersihkan lingkungan sekitar sungai dan meningkatkan kesadaran masyarakat tentang pentingnya menjaga kebersihan lingkungan. Mahasiswa mengajak warga untuk berpartisipasi dalam aksi pembersihan dan memberikan edukasi tentang dampak sampah terhadap ekosistem sungai.',
                'author' => 'Kelompok Hijau Kampus',
                'publish_date' => Carbon::now()->subDays(8),
                'location' => 'Sungai Ciliwung, Jakarta',
            ],
            [
                'title' => 'Sosialisasi Pola Hidup Bersih dan Sehat',
                'category' => 'Kesehatan',
                'description' => 'Program edukasi kesehatan yang membahas pentingnya menjaga kebersihan diri, olahraga teratur, pola makan seimbang, dan istirahat yang cukup. Kegiatan ini melibatkan pemeriksaan kesehatan gratis, demonstrasi cara mencuci tangan yang benar, dan konsultasi kesehatan dengan tenaga medis profesional.',
                'author' => 'Tim Kesehatan Masyarakat',
                'publish_date' => Carbon::now()->subDays(5),
                'location' => 'Puskesmas Kelurahan Cipete',
            ],
            [
                'title' => 'Kegiatan Berbagi Buku untuk Anak-Anak',
                'category' => 'Sosial Masyarakat',
                'description' => 'Inisiatif sosial untuk mendistribusikan buku-buku berkualitas kepada anak-anak dari keluarga kurang mampu. Kegiatan ini juga termasuk story telling session dan workshop menulis kreatif untuk menumbuhkan minat baca sejak dini. Kami percaya bahwa setiap anak berhak mendapatkan akses ke literatur yang berkualitas.',
                'author' => 'Program Berbagi Literasi',
                'publish_date' => Carbon::now()->subDays(3),
                'location' => 'Pos Keamanan RW 05, Komplek Perumahan Sentosa',
            ],
        ];

        foreach ($programs as $program) {
            $category = Category::where('name', $program['category'])->first();
            
            Program::create([
                'category_id' => $category->id,
                'title' => $program['title'],
                'slug' => Str::slug($program['title']),
                'image' => null, // Will be set manually or through upload
                'description' => $program['description'],
                'author' => $program['author'],
                'publish_date' => $program['publish_date'],
                'location' => $program['location'],
            ]);
        }
    }
}
