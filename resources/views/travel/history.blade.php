<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Trips - TripMate AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --primary-light: rgba(99, 102, 241, 0.15);
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-teal: #14b8a6;
            --accent-rose: #f43f5e;
            --accent-amber: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: var(--bg-gradient);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            padding: 1.25rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--text-main);
            font-weight: 800;
            font-size: 1.4rem;
        }

        .logo-icon {
            background: linear-gradient(135deg, #6366f1, #a855f7);
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-link {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--text-main);
            background: rgba(255, 255, 255, 0.08);
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
            width: 100%;
            flex: 1;
        }

        .header-section {
            margin-bottom: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header-title h1 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(to right, #ffffff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-title p {
            color: var(--text-muted);
            margin-top: 0.25rem;
            font-size: 0.95rem;
        }

        .btn-new-trip {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            transition: all 0.2s ease;
        }

        .btn-new-trip:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
        }

        .alert-success {
            background: rgba(20, 184, 166, 0.15);
            border: 1px solid rgba(20, 184, 166, 0.3);
            color: #2dd4bf;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .trips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.75rem;
        }

        .trip-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 18px;
            padding: 1.5rem;
            backdrop-filter: blur(12px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .trip-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #6366f1, #a855f7);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .trip-card:hover {
            transform: translateY(-4px);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }

        .trip-card:hover::before {
            opacity: 1;
        }

        .trip-destination {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .trip-dates {
            color: var(--text-muted);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .trip-meta {
            display: flex;
            gap: 1rem;
            background: rgba(15, 23, 42, 0.6);
            padding: 0.85rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .meta-item {
            flex: 1;
        }

        .meta-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.2rem;
        }

        .meta-value {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .preferences-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-bottom: 1.25rem;
        }

        .badge-pref {
            background: rgba(99, 102, 241, 0.15);
            color: #818cf8;
            border: 1px solid rgba(99, 102, 241, 0.3);
            font-size: 0.75rem;
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .card-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--glass-border);
        }

        .btn-detail {
            flex: 1;
            background: rgba(99, 102, 241, 0.2);
            color: #818cf8;
            border: 1px solid rgba(99, 102, 241, 0.4);
            padding: 0.65rem 1rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-detail:hover {
            background: var(--primary);
            color: white;
        }

        .btn-pdf {
            background: rgba(20, 184, 166, 0.2);
            color: #2dd4bf;
            border: 1px solid rgba(20, 184, 166, 0.4);
            padding: 0.65rem 0.85rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            transition: all 0.2s;
        }

        .btn-pdf:hover {
            background: #14b8a6;
            color: white;
        }

        .btn-delete {
            background: rgba(244, 63, 94, 0.15);
            color: var(--accent-rose);
            border: 1px solid rgba(244, 63, 94, 0.3);
            padding: 0.65rem 0.85rem;
            border-radius: 10px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-delete:hover {
            background: var(--accent-rose);
            color: white;
        }


        .empty-state {
            background: var(--glass-bg);
            border: 1px dashed var(--glass-border);
            border-radius: 20px;
            padding: 4rem 2rem;
            text-align: center;
            max-width: 550px;
            margin: 3rem auto;
        }

        .empty-icon {
            font-size: 3.5rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
            opacity: 0.6;
        }

        .empty-state h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('travel.index') }}" class="logo">
                <div class="logo-icon">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <span>TripMate AI</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('travel.index') }}" class="nav-link">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Buat Rencana
                </a>
                <a href="{{ route('travel.history') }}" class="nav-link active">
                    <i class="fa-solid fa-suitcase"></i> My Trips
                </a>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <div class="header-section">
            <div class="header-title">
                <h1>Riwayat Perjalanan Saya</h1>
                <p>Daftar rencana perjalanan yang telah Anda simpan</p>
            </div>
            <a href="{{ route('travel.index') }}" class="btn-new-trip">
                <i class="fa-solid fa-plus"></i> Buat Rencana Baru
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($trips->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <h2>Belum Ada Perjalanan Tersimpan</h2>
                <p>Anda belum menyimpan rencana perjalanan apapun. Mulai buat itinerary impian Anda sekarang!</p>
                <a href="{{ route('travel.index') }}" class="btn-new-trip">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Buat Rencana Sekarang
                </a>
            </div>
        @else
            <div class="trips-grid">
                @foreach($trips as $trip)
                    @php
                        $startDate = $trip->start_date ? \Carbon\Carbon::parse($trip->start_date) : null;
                        $endDate = $trip->end_date ? \Carbon\Carbon::parse($trip->end_date) : null;
                        $durasi = ($startDate && $endDate) ? $startDate->diffInDays($endDate) + 1 : 1;
                    @endphp
                    <div class="trip-card">
                        <div>
                            <div class="trip-destination">
                                <i class="fa-solid fa-location-dot" style="color: #6366f1;"></i>
                                {{ $trip->destination }}
                            </div>
                            <div class="trip-dates">
                                <i class="fa-regular fa-calendar"></i>
                                @if($startDate && $endDate)
                                    {{ $startDate->translatedFormat('d M Y') }} - {{ $endDate->translatedFormat('d M Y') }} ({{ $durasi }} Hari)
                                @else
                                    -
                                @endif
                            </div>

                            <div class="trip-meta">
                                <div class="meta-item">
                                    <div class="meta-label">Peserta</div>
                                    <div class="meta-value"><i class="fa-solid fa-users" style="font-size: 0.8rem; color: #14b8a6;"></i> {{ $trip->jumlah_orang }} Orang</div>
                                </div>
                                <div class="meta-item">
                                    <div class="meta-label">Total Budget</div>
                                    <div class="meta-value" style="color: #2dd4bf;">Rp {{ number_format($trip->budget, 0, ',', '.') }}</div>
                                </div>
                            </div>

                            @if(!empty($trip->preferences))
                                <div class="preferences-badges">
                                    @foreach($trip->preferences as $pref)
                                        <span class="badge-pref">#{{ $pref }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('travel.show', $trip->id) }}" class="btn-detail">
                                <i class="fa-solid fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('travel.pdf', $trip->id) }}" target="_blank" class="btn-pdf" title="Cetak / Simpan PDF">
                                <i class="fa-solid fa-file-pdf"></i> PDF
                            </a>
                            <form action="{{ route('travel.destroy', $trip->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rencana perjalanan ke {{ $trip->destination }}?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" title="Hapus Perjalanan">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
