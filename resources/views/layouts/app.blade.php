<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Restoran') - Pak Resto UNIKOM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --brand-color: #1d5c8a;
            --brand-color-dark: #123f5f;
            --brand-accent: #5bb8e8;
        }
        body {
            background-color: #f2f6fa;
            font-family: 'Poppins', sans-serif;
        }
        nav.navbar {
            background: linear-gradient(90deg, var(--brand-color) 0%, var(--brand-color-dark) 100%);
            border-bottom: 3px solid var(--brand-accent);
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .brand-logo-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--brand-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--brand-color-dark);
            flex-shrink: 0;
        }
        .brand-logo-text {
            line-height: 1.1;
        }
        .brand-logo-text .brand-name {
            font-weight: 700;
            font-size: 1.1rem;
            color: #fff;
            letter-spacing: 0.3px;
        }
        .brand-logo-text .brand-tagline {
            font-size: 0.7rem;
            color: #bfe3f7;
            letter-spacing: 0.5px;
        }
        .btn-primary {
            background-color: var(--brand-color);
            border-color: var(--brand-color);
        }
        .btn-primary:hover {
            background-color: var(--brand-color-dark);
            border-color: var(--brand-color-dark);
        }
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
        }
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .card:hover {
            box-shadow: 0 4px 14px rgba(0,0,0,0.12);
        }
        .card-title i {
            color: var(--brand-color);
        }
    </style>
</head>
<body>
    @auth
    <nav class="navbar navbar-dark mb-4">
        <div class="container-fluid">
            <div class="brand-logo">
                <div class="brand-logo-icon"><i class="bi bi-egg-fried"></i></div>
                <div class="brand-logo-text">
                    <div class="brand-name">Pak Resto UNIKOM</div>
                    <div class="brand-tagline">SISTEM INFORMASI RESTORAN</div>
                </div>
            </div>
            <div class="d-flex align-items-center text-light">
                <span class="me-3"><i class="bi bi-person-circle me-1"></i>{{ auth()->user()->nama_pegawai }} ({{ auth()->user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <div class="container pb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
