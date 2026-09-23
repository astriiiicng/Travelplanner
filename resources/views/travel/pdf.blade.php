<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itinerary {{ $trip->destination }} - TripMate AI</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- html2pdf.js for auto PDF download -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #0f172a;
            padding: 2rem 1rem;
        }

        .action-bar {
            max-width: 800px;
            margin: 0 auto 1.5rem auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-action {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            background: #4338ca;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #ffffff;
            color: #334155;
            border: 1px solid #cbd5e1;
            box-shadow: none;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        /* PDF Document Paper Sheet */
        .pdf-container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 3rem;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-icon {
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .brand-name {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e1b4b;
        }

        .doc-badge {
            background: #e0e7ff;
            color: #3730a3;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .trip-title-section {
            margin-bottom: 2rem;
        }

        .trip-title-section h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.5rem;
        }

        .trip-title-section p {
            color: #64748b;
            font-size: 1rem;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 1.25rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .summary-item .label {
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .summary-item .value {
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
        }

        .section-header {
            font-size: 1.25rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Budget Table */
        .budget-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        .budget-table th, .budget-table td {
            padding: 0.85rem 1rem;
            text-align: left;
            font-size: 0.9rem;
        }

        .budget-table th {
            background: #f1f5f9;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .budget-table td {
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            font-weight: 500;
        }

        .budget-table tr:last-child td {
            font-weight: 800;
            color: #0f172a;
            border-bottom: none;
            background: #f8fafc;
        }

        /* Day Itinerary */
        .day-block {
            margin-bottom: 2rem;
            page-break-inside: avoid;
        }

        .day-header {
            background: #1e293b;
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .activity-card {
            border-left: 3px solid #6366f1;
            background: #f8fafc;
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
            border-radius: 0 8px 8px 0;
        }

        .act-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.35rem;
        }

        .act-title {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
        }

        .act-cat {
            font-size: 0.75rem;
            background: #e0e7ff;
            color: #4338ca;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .act-desc {
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 0.4rem;
            line-height: 1.4;
        }

        .act-cost {
            font-size: 0.8rem;
            font-weight: 700;
            color: #0d9488;
        }

        .footer {
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 0.8rem;
            color: #94a3b8;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .action-bar {
                display: none !important;
            }

            .pdf-container {
                box-shadow: none;
                border: none;
                padding: 0;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="action-bar">
        <a href="{{ route('travel.history') }}" class="btn-action btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Riwayat
        </a>
        <div style="display: flex; gap: 0.75rem;">
            <button onclick="window.print()" class="btn-action btn-secondary">
                <i class="fa-solid fa-print"></i> Cetak
            </button>
            <button id="btn-download-pdf" onclick="downloadPDF()" class="btn-action">
                <i class="fa-solid fa-file-pdf"></i> Unduh PDF
            </button>
        </div>
    </div>

    <div class="pdf-container" id="pdf-content">
        <div class="header">
            <div class="brand">
                <div class="brand-icon">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <div class="brand-name">TripMate AI</div>
            </div>
            <div class="doc-badge">Travel Plan Itinerary</div>
        </div>

        @php
            $startDate = $trip->start_date ? \Carbon\Carbon::parse($trip->start_date) : null;
            $endDate = $trip->end_date ? \Carbon\Carbon::parse($trip->end_date) : null;
            $durasi = ($startDate && $endDate) ? $startDate->diffInDays($endDate) + 1 : 1;
            $breakdown = $trip->budget_breakdown ?? [];
        @endphp

        <div class="trip-title-section">
            <h1>{{ $trip->destination }}</h1>
            <p>Rencana perjalanan lengkap disusun oleh AI untuk rombongan {{ $trip->jumlah_orang }} orang</p>
        </div>

        <div class="summary-grid">
            <div class="summary-item">
                <div class="label">Tanggal</div>
                <div class="value">
                    @if($startDate && $endDate)
                        {{ $startDate->translatedFormat('d M') }} - {{ $endDate->translatedFormat('d M Y') }}
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="summary-item">
                <div class="label">Durasi</div>
                <div class="value">{{ $durasi }} Hari</div>
            </div>
            <div class="summary-item">
                <div class="label">Anggota</div>
                <div class="value">{{ $trip->jumlah_orang }} Orang</div>
            </div>
            <div class="summary-item">
                <div class="label">Total Budget</div>
                <div class="value" style="color: #0d9488;">Rp {{ number_format($trip->budget, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- RINCIAN BUDGET -->
        @if(!empty($breakdown))
            <div class="section-header">
                <i class="fa-solid fa-wallet" style="color: #6366f1;"></i> Rincian Estimasi Biaya
            </div>
            <table class="budget-table">
                <thead>
                    <tr>
                        <th>Kategori Pengeluaran</th>
                        <th>Estimasi Alokasi (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Transportasi Lokal</td>
                        <td>Rp {{ number_format($breakdown['transportasi'] ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Penginapan / Akomodasi</td>
                        <td>Rp {{ number_format($breakdown['penginapan'] ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Konsumsi & Kuliner</td>
                        <td>Rp {{ number_format($breakdown['makan'] ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Tiket Wisata & Rekreasi</td>
                        <td>Rp {{ number_format($breakdown['tiket_wisata'] ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Total Estimasi Terpakai</td>
                        <td>Rp {{ number_format($breakdown['total'] ?? 0, 0, ',', '.') }} (Sisa: Rp {{ number_format($breakdown['sisa_budget'] ?? 0, 0, ',', '.') }})</td>
                    </tr>
                </tbody>
            </table>
        @endif

        <!-- ITINERARY HARIAN -->
        <div class="section-header">
            <i class="fa-solid fa-route" style="color: #6366f1;"></i> Rencana Perjalanan Harian
        </div>

        @if(!empty($trip->itinerary) && is_array($trip->itinerary))
            @foreach($trip->itinerary as $dayIdx => $day)
                <div class="day-block">
                    <div class="day-header">
                        <span>HARI {{ $day['hari'] ?? ($dayIdx + 1) }}</span>
                        <span style="font-size: 0.85rem; font-weight: 500;">📅 {{ $day['tanggal'] ?? '-' }}</span>
                    </div>

                    @if(!empty($day['rekomendasi']) && is_array($day['rekomendasi']))
                        @foreach($day['rekomendasi'] as $act)
                            <div class="activity-card">
                                <div class="act-header">
                                    <div class="act-title">{{ $act['nama_tempat'] ?? ($act['rekomendasi'] ?? '-') }}</div>
                                    <span class="act-cat">#{{ $act['kategori'] ?? 'wisata' }}</span>
                                </div>
                                <div class="act-desc">{{ $act['deskripsi'] ?? '' }}</div>
                                <div class="act-cost">
                                    💰 Estimasi Biaya: Rp {{ number_format($act['estimasi_biaya'] ?? 0, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endforeach
        @endif

        <div class="footer">
            Dicetak secara otomatis dari TripMate AI Travel Planner &bull; {{ date('d M Y H:i') }}
        </div>
    </div>

    <script>
        function downloadPDF() {
            const btn = document.getElementById('btn-download-pdf');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses PDF...';
            }

            const element = document.getElementById('pdf-content');
            const opt = {
                margin:       [0.4, 0.4, 0.4, 0.4],
                filename:     'TripMate_Itinerary_{{ \Illuminate\Support\Str::slug($trip->destination) }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            html2pdf().set(opt).from(element).save().then(() => {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-file-pdf"></i> Unduh PDF';
                }
            }).catch(err => {
                console.error('PDF error:', err);
                window.print(); // fallback ke print browser
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-file-pdf"></i> Unduh PDF';
                }
            });
        }
    </script>
</body>
</html>
