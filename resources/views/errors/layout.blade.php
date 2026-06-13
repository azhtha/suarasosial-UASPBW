<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Error' }} - SuaraSosial</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #7C3AED;
            --primary-dark: #6D28D9;
            --background: #F8F5FF;
            --card: #FFFFFF;
            --text: #2E1065;
            --text-muted: #6B7280;
            --border-soft: #E9D5FF;
        }
        body {
            margin: 0;
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            background: linear-gradient(180deg, #F8F5FF 0%, #FFFFFF 100%);
            color: var(--text);
        }
        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .card {
            width: 100%;
            max-width: 760px;
            background: var(--card);
            border: 1px solid var(--border-soft);
            border-radius: 1.5rem;
            box-shadow: 0 28px 80px rgba(124, 58, 237, 0.12);
            overflow: hidden;
        }
        .hero {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.15), rgba(167, 139, 250, 0.12));
            padding: 3rem;
            text-align: center;
        }
        .hero h1 {
            margin: 0;
            font-size: clamp(3rem, 4vw, 4.5rem);
            letter-spacing: -0.06em;
        }
        .hero p {
            margin-top: 1rem;
            color: var(--text-muted);
            font-size: 1.05rem;
        }
        .content {
            padding: 3rem;
        }
        .content h2 {
            margin: 0;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .content p {
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: var(--primary);
            color: #fff;
            padding: 0.95rem 1.75rem;
            border-radius: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }
        .meta {
            display: grid;
            gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            margin-top: 2rem;
        }
        .meta-item {
            background: #F8F5FF;
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            border: 1px solid var(--border-soft);
        }
        .meta-item span {
            display: block;
            color: var(--text-muted);
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="hero">
                <h1>{{ $code ?? 'Error' }}</h1>
                <p>{{ $title ?? 'Terjadi kesalahan' }}</p>
            </div>
            <div class="content">
                <h2>{{ $message ?? 'Halaman yang diminta tidak dapat ditampilkan.' }}</h2>
                <p>{{ $description ?? 'Silakan kembali ke halaman utama atau coba lagi nanti.' }}</p>
                <a href="{{ route('home') }}" class="btn-primary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
