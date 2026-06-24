<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Servis - Bengkel Dinamo</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background: #f8fafc;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #0f172a 0%, #1e3a8a 40%, #2563eb 100%);
            color: white;
            padding: 25px 0;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0,0,0,.08);
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 0 20px;
            margin-bottom: 30px;
            gap: 12px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            flex-shrink: 0;
        }

        .logo h2 {
            font-size: 20px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #ffffff;
            margin: 0;
        }

        .logo p {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 2px;
            margin-bottom: 0;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 0 12px;
        }

        .menu a {
            color: #94a3b8;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .menu a i {
            font-size: 18px;
            width: 22px;
            text-align: center;
        }

        .menu a:hover {
            color: white;
            background: rgba(255, 255, 255, 0.05);
        }

        .menu a.active {
            color: white;
            background: linear-gradient(90deg, #1d4ed8, #3b82f6);
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.15);
        }

        /* ==================== MAIN AREA ==================== */
        .main {
            margin-left: 280px;
            padding: 20px 25px;
            width: calc(100% - 280px);
            min-height: 100vh;
        }

        /* ==================== HERO AREA ==================== */
        .hero {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px 40px;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
            color: #1e293b;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hero-content {
            max-width: 55%;
            z-index: 2;
        }

        .hero h2 {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .hero p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .hero-info {
            display: flex;
            gap: 12px;
        }

        .hero-info div {
            background: #f1f5f9;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #e2e8f0;
        }

        .hero-info div i.fa-calendar { color: #2563eb; }
        .hero-info div i.fa-circle-check { color: #10b981; }

        .hero-illustration {
            display: flex;
            align-items: flex-end;
            gap: 15px;
            z-index: 2;
        }

        .illustration-wrapper {
            display: flex;
            align-items: center;
            position: relative;
        }

        .il-car { font-size: 100px; color: #2563eb; line-height: 1; }
        .il-mechanic { font-size: 75px; color: #334155; margin-left: -10px; line-height: 1; }
        .il-toolbox { font-size: 50px; color: #64748b; line-height: 1; }

        /* ==================== STAT CARDS ==================== */
        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .card {
            border-radius: 16px;
            padding: 16px;
            min-height: 110px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        }

        .card h3 {
            font-size: 12px;
            margin-bottom: 6px;
            font-weight: 700;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        .card h1 { font-size: 32px; font-weight: 800; }
        .card i { position: absolute; right: 15px; bottom: 15px; font-size: 34px; opacity: .2; }

        .purple { background: linear-gradient(135deg, #6366f1, #4f46e5); }
        .blue { background: linear-gradient(135deg, #0ea5e9, #2563eb); }
        .green { background: linear-gradient(135deg, #10b981, #059669); }
        .orange { background: linear-gradient(135deg, #f59e0b, #ea580c); }

        /* ==================== CONTENT GRID ==================== */
        .content-grid-bottom {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 15px;
        }

        .panel {
            background: white;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 3px 10px rgba(0,0,0,.02);
        }

        .panel h2 {
            font-size: 18px;
            margin-bottom: 25px;
            color: #0f172a;
            font-weight: 700;
        }

        /* ==================== STEPPER PROGRESS ==================== */
        .progress-stepper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            position: relative;
            margin: 30px 0 25px 0;
            padding: 0 10px;
        }

        .stepper-line {
            position: absolute;
            top: 20px;
            left: 40px;
            right: 40px;
            height: 3px;
            background: #e2e8f0;
            z-index: 1;
        }

        .stepper-line-fill {
            position: absolute;
            top: 20px;
            left: 40px;
            height: 3px;
            background: #2563eb;
            z-index: 1;
            transition: width 0.5s ease;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            z-index: 2;
            width: 80px;
        }

        .step-item .step-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid #dbe4ee;
            color: #94a3b8;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
        }

        .step-item.completed .step-icon {
            background: #10b981;
            border-color: #10b981;
            color: white;
        }

        .step-item.active .step-icon {
            background: #2563eb;
            border-color: #2563eb;
            color: white;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .step-label { font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 4px; }
        .step-date { font-size: 11px; color: #64748b; line-height: 1.3; }

        .info-status-banner {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 12px 16px;
            border-radius: 10px;
            margin-top: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #1e40af;
            font-weight: 500;
        }

        .no-data-banner {
            text-align: center;
            padding: 40px 20px;
            color: #64748b;
        }
        .no-data-banner i { font-size: 48px; color: #cbd5e1; margin-bottom: 15px; }

        /* ==================== ANTREAN LIST ==================== */
        .queue-list { display: flex; flex-direction: column; gap: 10px; }
        .queue-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }
        .queue-item.is-me { background: #eff6ff; border-color: #bfdbfe; }
        .queue-info { display: flex; align-items: center; gap: 10px; }
        .queue-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #e0e7ff;
            color: #2563eb;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 800;
            font-size: 14px;
        }
        .queue-item.is-me .queue-icon { background: #2563eb; color: white; }
        .queue-name { font-size: 14px; color: #1e293b; font-weight: 600; }
        .queue-item.is-me .queue-name { color: #1d4ed8; }
        .queue-car { font-size: 11px; color: #64748b; }

        .badge { padding: 4px 10px; border-radius: 12px; color: white; font-size: 10px; font-weight: 700; text-transform: uppercase; }
        .badge.waiting { background: #64748b; }
        .badge.active   { background: #3b82f6; }

        /* RESPONSIVE FILTER */
        @media(max-width:1150px){ .hero-illustration { display: none; } .hero-content { max-width: 100%; } }
        @media(max-width:1024px){
            .main { margin-left: 0; width: 100%; padding: 15px; }
            .sidebar { display: none; }
            .cards { grid-template-columns: repeat(2,1fr); }
            .content-grid-bottom { grid-template-columns: 1fr; }
        }
        @media(max-width:768px){
            .hero h2 { font-size: 22px; }
            .hero p { width: 100%; font-size: 13px; }
            .cards { grid-template-columns: 1fr; }
            .stepper-line, .stepper-line-fill { display: none; }
            .progress-stepper { flex-direction: column; gap: 20px; align-items: flex-start; }
            .step-item { flex-direction: row; text-align: left; width: 100%; gap: 15px; }
            .step-item .step-icon { margin-bottom: 0; }
        }
    </style>
</head>

<body>

<div class="sidebar">
    <div class="logo">
        <div class="logo-icon">
            <i class="fa-solid fa-car" style="color: #ffffff;"></i>
        </div>
        <div>
            <h2>Bengkel Dinamo</h2>
            <p>Auto Servis System</p>
        </div>
    </div>
    
    <div class="menu">
        <a href="/customer/dashboard" class="active"><i class="fa-solid fa-house"></i> Dashboard</a>
        <a href="/customer/layanan"><i class="fa-solid fa-screwdriver-wrench"></i> Layanan</a>
        <a href="/customer/riwayat"><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Servis</a>
        <a href="/customer/pembayaran"><i class="fa-solid fa-credit-card"></i> Pembayaran</a>
        <a href="/customer/profile"><i class="fa-solid fa-user"></i> Profil</a>
    </div>
</div>

<div class="main">

    <div class="hero">
        <div class="hero-content">
            <h2>Selamat datang, {{ Auth::user()->name ?? 'Pelanggan' }} 👋</h2>
            <p>Pantau status servis kendaraan Anda dengan mudah, cepat, dan real-time.</p>
            <div class="hero-info">
                <div><i class="fa-solid fa-calendar"></i> {{ date('d F Y') }}</div>
                <div><i class="fa-solid fa-circle-check"></i> Sistem Aktif</div>
            </div>
        </div>
        
        <div class="hero-illustration">
            <div class="illustration-wrapper">
                <div class="il-car"><i class="fa-solid fa-car-side"></i></div>
                <div class="il-mechanic"><i class="fa-solid fa-user-gear"></i></div>
                <div class="il-toolbox"><i class="fa-solid fa-toolbox"></i></div>
            </div>
        </div>
    </div>

    <div class="cards">
        <div class="card purple">
            <h3>TOTAL BOOKING</h3>
            <h1>{{ $totalBooking ?? 0 }}</h1>
            <i class="fa-solid fa-database"></i>
        </div>
        <div class="card blue">
            <h3>DIPROSES</h3>
            <h1>{{ $diproses ?? 0 }}</h1>
            <i class="fa-solid fa-xl fa-gears"></i>
        </div>
        <div class="card green">
            <h3>SELESAI</h3>
            <h1>{{ $selesai ?? 0 }}</h1>
            <i class="fa-solid fa-check"></i>
        </div>
        <div class="card orange">
            <h3>ANTREAN ANDA</h3>
            <h1>#{{ $noAntrean ?? '00' }}</h1>
            <i class="fa-solid fa-arrow-up-1-9"></i>
        </div>
    </div>

    <div class="content-grid-bottom">
        
        <div class="panel">
            <h2>Progress Servis Kendaraan Anda</h2>

            @if(isset($bookingAktif) && $bookingAktif != null)
                
                @php
                $lineWidth = '0%';
                if($bookingAktif){
                    switch($bookingAktif->status){
                        case 'pending':
                            $lineWidth = '0%';
                            break;
                        case 'diterima':
                            $lineWidth = '33%';
                            break;
                        case 'proses':
                            $lineWidth = '66%';
                            break;
                        case 'selesai':
                            $lineWidth = '84%';
                            break;
                    }
                }
                @endphp

                <div class="progress-stepper">
                    <div class="stepper-line"></div>
                    <div class="stepper-line-fill" style="width: {{ $lineWidth }}"></div>

                    <div class="step-item completed">
                        <div class="step-icon"><i class="fa-solid fa-check"></i></div>
                        <div class="step-label">Booking</div>
                        <div class="step-date">{{ \Carbon\Carbon::parse($bookingAktif->created_at)->format('d M Y') }}</div>
                    </div>

                    <div class="step-item 
                        {{ in_array($bookingAktif->status, ['diterima','proses','selesai']) ? 'completed' : '' }} 
                        {{ $bookingAktif->status == 'diterima' ? 'active' : '' }}">
                        <div class="step-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                        <div class="step-label">Diterima</div>
                        <div class="step-date">Dikonfirmasi</div>
                    </div>

                    <div class="step-item 
                        {{ $bookingAktif->status == 'selesai' ? 'completed' : '' }} 
                        {{ $bookingAktif->status == 'proses' ? 'active' : '' }}">
                        <div class="step-icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                        <div class="step-label">Diproses</div>
                        <div class="step-date">{{ $bookingAktif->status == 'proses' ? 'Pengerjaan' : 'Antre' }}</div>
                    </div>

                    <div class="step-item 
                        {{ $bookingAktif->status == 'selesai' ? 'active' : '' }}">
                        <div class="step-icon"><i class="fa-solid fa-car"></i></div>
                        <div class="step-label">Selesai</div>
                        <div class="step-date">{{ $bookingAktif->status == 'selesai' ? 'Siap Ambil' : 'Menunggu' }}</div>
                    </div>
                </div>

                <div class="info-status-banner">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>
                        @if($bookingAktif->status == 'diterima')
                            Kendaraan Anda telah dikonfirmasi admin. Menunggu giliran mekanik memulai perbaikan.
                        @elseif($bookingAktif->status == 'proses')
                            Mekanik sedang melakukan tindakan perbaikan {{ $bookingAktif->jenis_servis ?? 'kendaraan Anda' }}.
                        @elseif($bookingAktif->status == 'selesai')
                            Selamat! Perbaikan selesai dilakukan. Silakan lakukan penyelesaian di kasir bengkel.
                        @else
                            Booking Anda berhasil didaftarkan ke sistem bengkel.
                        @endif
                    </span>
                </div>

            @else
                <div class="no-data-banner">
                    <i class="fa-solid fa-car-tunnel"></i>
                    <p>Anda belum memiliki pendaftaran servis aktif saat ini.</p>
                    <p style="font-size: 12px; margin-top: 5px; color:#94a3b8;">Silakan buat reservasi baru melalui menu Booking Servis.</p>
                </div>
            @endif
        </div>

        <div class="panel">
            <h2>Antrean Saat Ini</h2>
            <div class="queue-list">
                @forelse($antreanHariIni ?? [] as $index => $item)
                    <div class="queue-item {{ $item->user_id == Auth::id() ? 'is-me' : '' }}">
                        <div class="queue-info">
                            <div class="queue-icon">#{{ $index + 1 }}</div>
                            <div>
                                <div class="queue-name">
                                    {{ $item->user_id == Auth::id() ? 'Anda' : ($item->user->name ?? 'Pelanggan') }}
                                </div>
                                <div class="queue-car">
                                    {{ $item->jenis_servis ?? 'Servis Dinamo' }} - {{ $item->nomor_plat ?? '-' }}
                                </div>
                            </div>
                        </div>
                        
                        @if($item->status == 'Diproses' || $item->status == 'proses')
                            <span class="badge active">Servis</span>
                        @else
                            <span class="badge waiting">Menunggu</span>
                        @endif
                    </div>
                @empty
                    <div style="text-align: center; color: #64748b; font-size: 14px; padding: 20px 0;">
                        Tidak ada antrean aktif hari ini.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>

</body>
</html>