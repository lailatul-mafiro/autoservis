<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

        /* ======================================================
           SIDEBAR
        ====================================================== */
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
        }

        .logo-text h2 {
            font-size: 22px;
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #fff;
        }

        .logo-text p {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 2px;
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
            flex-shrink: 0;
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

        /* ======================================================
           MAIN CONTENT
        ====================================================== */
        .main {
            margin-left: 280px;
            padding: 20px 25px;
            width: calc(100% - 280px);
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            background: #ffffff;
            border-radius: 18px;
            padding: 16px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0,0,0,.05);
            margin-bottom: 25px;
        }

        .page-info h1 {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
        }

        .page-info p {
            margin-top: 4px;
            font-size: 14px;
            color: #64748b;
        }

        .logout-btn {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
            border: none;
            padding: 11px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: .3s;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
        }

        /* PAGE TITLE */
        .page-title {
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-size: 42px;
            font-weight: 900;
            margin-bottom: 8px;
            color: #0f172a;
        }

        .page-title p {
            font-size: 17px;
            color: #64748b;
        }

        .page-title h1 i {
            margin-right: 10px;
            font-size: 36px;
            color: #2563eb;
        }

        /* ALERT SUCCESS & ERROR */
        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1px solid #bbf7d0;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1px solid #fca5a5;
            margin-bottom: 20px;
            font-weight: 600;
        }

        /* ======================================================
           STATISTICS
        ====================================================== */
        @php
    $totalPembayaran = $bookings
        ->whereNotIn('status_bayar', ['lunas'])
        ->count();

    $totalLunas = $bookings
        ->where('status_bayar', 'lunas')
        ->count();

    $totalBiaya = $bookings
        ->whereNotIn('status_bayar', ['lunas'])
        ->sum('harga');
@endphp

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            border-radius: 20px;
            padding: 20px 24px;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 12px 30px rgba(15,23,42,.08);
            min-height: 120px;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -25px;
            right: -25px;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .12);
        }

        .stat-card h4 {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: 800;
            line-height: 1.2;
        }

        .stat-card .number.small {
            font-size: 24px;
        }

        .stat-card i {
            position: absolute;
            right: 20px;
            bottom: 20px;
            font-size: 34px;
            opacity: .2;
        }

        .stat-total { background: linear-gradient(135deg, #6366f1, #4f46e5); }
        .stat-lunas { background: linear-gradient(135deg, #10b981, #059669); }
        .stat-biaya { background: linear-gradient(135deg, #f59e0b, #ea580c); }

        /* ======================================================
           CARD TABLE
        ====================================================== */
        .card {
            background: #ffffff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 15px 40px rgba(15, 23, 42, .06);
            border: 1px solid #e2e8f0;
        }

        .card-header {
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
        }

        .card-subtitle {
            font-size: 13px;
            color: #64748b;
            margin-top: 4px;
        }

        .table-wrapper {
            overflow-x: auto;
            width: 100%;
        }

        table {
            width: 100%;
            min-width: 950px;
            border-collapse: separate;
            border-spacing: 0;
            table-layout: fixed;
        }

        /* HEADER */
        thead th {
            background: #f8fafc;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
            padding: 16px 18px;
            text-align: center;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }

        thead th:first-child { border-top-left-radius: 16px; }
        thead th:last-child { border-top-right-radius: 16px; }

        /* BODY */
        tbody td {
            padding: 18px;
            font-size: 14px;
            color: #1e293b;
            border-bottom: 1px solid #edf2f7;
            vertical-align: middle;
            text-align: center;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        /* COLUMN WIDTH */
        thead th:nth-child(1), tbody td:nth-child(1) { width: 15%; }
        thead th:nth-child(2), tbody td:nth-child(2) { width: 20%; }
        thead th:nth-child(3), tbody td:nth-child(3) { width: 15%; }
        thead th:nth-child(4), tbody td:nth-child(4) { width: 15%; }
        thead th:nth-child(5), tbody td:nth-child(5) { width: 20%; }
        thead th:nth-child(6), tbody td:nth-child(6) { width: 15%; }

        /* KODE */
        .kode {
            font-size: 16px;
            font-weight: 800;
            color: #1e3a8a;
            letter-spacing: .3px;
        }

        /* BIAYA */
        .price {
            font-size: 16px;
            font-weight: 800;
            color: #16a34a;
        }

        /* BADGE */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            min-width: 90px;
            text-transform: uppercase;
        }

        .lunas { background: linear-gradient(135deg, #10b981, #059669); }
        .belum { background: linear-gradient(135deg, #ef4444, #dc2626); }
        .menunggu { background: linear-gradient(135deg, #f59e0b, #d97706); }

        /* METODE */
        .metode {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            background: #e2e8f0;
            color: #475569;
            text-transform: capitalize;
            min-width: 90px;
        }

        .method-badge-empty {
            color: #94a3b8;
            font-weight: 700;
        }

        /* BUTTON NOTA & ACTION */
        .btn-nota {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 999px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            box-shadow: 0 8px 18px rgba(34, 197, 94, 0.18);
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-nota:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(34, 197, 94, 0.25);
            color: #ffffff;
        }

        .btn-pay {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.2);
        }

        .btn-pay:hover {
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.3);
        }

        /* EMPTY */
        .empty {
            text-align: center;
            padding: 40px 20px;
            color: #64748b;
        }

        .empty i {
            font-size: 40px;
            margin-bottom: 15px;
            color: #94a3b8;
        }

        .empty h3 {
            font-size: 18px;
            margin-bottom: 6px;
            color: #334155;
        }

        /* ======================================================
           MODAL WINDOW
        ====================================================== */
        .modal-bayar {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            width: 500px;
            max-width: 95%;
            background: #fff;
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-content h2 {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            font-size: 14px;
            color: #334155;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 14px;
            color: #0f172a;
            background-color: #f8fafc;
            outline: none;
            transition: all 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2563eb;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-group input[readonly] {
            background-color: #e2e8f0;
            color: #475569;
            font-weight: 600;
            cursor: not-allowed;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 25px;
        }

        .btn-close {
            background: #e2e8f0;
            color: #475569;
            padding: 10px 18px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn-close:hover {
            background: #cbd5e1;
        }

        .btn-submit {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            padding: 10px 22px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.2);
            transition: 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(34, 197, 94, 0.3);
        }

        /* RESPONSIVE SUB-SYSTEM */
        @media(max-width:1024px){
            .main { margin-left: 0; width: 100%; padding: 15px; }
            .sidebar { display: none; }
        }
        @media (max-width: 768px) {
            .page-title h1 { font-size: 30px; }
            table { min-width: 850px; }
            thead th, tbody td { padding: 14px 12px; font-size: 13px; }
            .kode { font-size: 15px; }
            .price { font-size: 14px; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo">
            <div class="logo-icon">
                <i class="fa-solid fa-car"></i>
            </div>
            <div class="logo-text">
                <h2>Bengkel Dinamo</h2>
                <p>Auto Servis System</p>
            </div>
        </div>

        <div class="menu">
            <a href="/customer/dashboard">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="/customer/layanan">
                <i class="fa-solid fa-screwdriver-wrench"></i> Layanan
            </a>
            <a href="/customer/riwayat">
                <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Servis
            </a>
            <a href="/customer/pembayaran" class="active">
                <i class="fa-solid fa-credit-card"></i> Pembayaran
            </a>
            <a href="/customer/profile">
                <i class="fa-solid fa-user"></i> Profil
            </a>
        </div>
    </div>

    <div class="main">

        <div class="topbar">
            <div class="page-info">
                <h1>Pembayaran</h1>
                <p>Lihat status pembayaran dan total biaya servis Anda.</p>
            </div>

            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>

        <div class="page-title">
            <h1>
                <i class="fa-solid fa-credit-card"></i> Pembayaran
            </h1>
            <p>Informasi biaya, status pembayaran, dan metode pembayaran.</p>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="stats">
            <div class="stat-card stat-total">
                <i class="fa-solid fa-file-invoice"></i>
                <h4>Total Tagihan</h4>
                <div class="number">{{ $totalPembayaran }}</div>
            </div>

            <div class="stat-card stat-lunas">
                <i class="fa-solid fa-circle-check"></i>
                <h4>Sudah Lunas</h4>
                <div class="number">{{ $totalLunas }}</div>
            </div>

            <div class="stat-card stat-biaya">
                <i class="fa-solid fa-money-bill-wave"></i>
                <h4>Total Biaya</h4>
                <div class="number small">
                    Rp {{ number_format($totalBiaya, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title">Daftar Pembayaran</div>
                <div class="card-subtitle">Menampilkan seluruh data pembayaran servis Anda.</div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th>Metode</th>
                            <th>Aksi</th>
                            <th>Nota</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($bookings->isEmpty())
                            <tr>
                                <td colspan="6">
                                    <div class="empty">
                                        <i class="fa-solid fa-credit-card"></i>
                                        <h3>Belum Ada Data Pembayaran</h3>
                                        <p>Data pembayaran Anda akan tampil di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach($bookings as $b)
                                <tr>
                                    <td>
                                        <div class="kode">
                                            {{ $b->kode }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="price">
                                            Rp {{ number_format($b->harga ?? 0, 0, ',', '.') }}
                                        </div>
                                    </td>

                                    <td>
                                        @php
                                            $statusBayar = strtolower(trim($b->status_bayar ?? 'belum'));

                                            if ($statusBayar == 'lunas') {
                                                $statusClass = 'lunas';
                                                $statusText = 'Lunas';
                                            } elseif ($statusBayar == 'menunggu' || $statusBayar == 'upload_bukti') {
                                                $statusClass = 'menunggu';
                                                $statusText = 'Menunggu Konfirmasi';
                                            } elseif ($statusBayar == 'ditolak') {
                                                $statusClass = 'belum';
                                                $statusText = 'Ditolak';
                                            } else {
                                                $statusClass = 'belum';
                                                $statusText = 'Belum Dibayar';
                                            }
                                        @endphp

                                        <span class="badge {{ $statusClass }}">
                                            {{ $statusText }}
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                            $metode = $b->metode ?? null;
                                            $metodeLower = strtolower(trim($metode ?? ''));
                                        @endphp

                                        @if($metode)
                                            @if($metodeLower == 'cash')
                                                <span class="metode" style="background:linear-gradient(135deg,#3b82f6,#2563eb); color:#fff;">
                                                    Cash
                                                </span>
                                            @elseif($metodeLower == 'transfer')
                                                <span class="metode" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed); color:#fff;">
                                                    Transfer
                                                </span>
                                            @else
                                                <span class="metode">
                                                    {{ $metode }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="method-badge-empty">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if(($b->status_bayar ?? 'belum') == 'belum')
                                            <button class="btn-nota btn-pay" onclick="openBayar('{{ $b->id }}', '{{ $b->kode }}', '{{ $b->harga ?? 0 }}')">
                                                <i class="fa fa-wallet"></i> Bayar
                                            </button>
                                        @elseif(($b->status_bayar ?? '') == 'menunggu' || ($b->status_bayar ?? '') == 'upload_bukti')
                                            @if(!empty($b->bukti_pembayaran))
                                                <a href="{{ asset('uploads/bukti/'.$b->bukti_pembayaran) }}" target="_blank" class="btn-nota" style="background:#f59e0b;">
                                                    <i class="fa fa-image"></i> Lihat Bukti
                                                </a>
                                            @else
                                                <span class="badge menunggu">Menunggu Verifikasi</span>
                                            @endif
                                        @else
                                            @if(strtolower(trim($b->metode ?? '')) == 'transfer' && !empty($b->bukti_pembayaran))
                                                <a href="{{ asset('uploads/bukti/'.$b->bukti_pembayaran) }}" target="_blank" class="btn-nota">
                                                    <i class="fa fa-image"></i> Lihat Bukti
                                                </a>
                                            @else
                                                <span class="badge lunas">Sudah Dibayar</span>
                                            @endif
                                        @endif
                                    </td>

                                    <td>
                                        @if(strtolower(trim($b->status_bayar ?? 'belum')) == 'lunas')
                                            <a href="{{ route('customer.invoice', $b->id) }}" target="_blank" class="btn-nota">
                                                <i class="fa-solid fa-file-invoice"></i> Nota
                                            </a>
                                        @else
                                            <span class="method-badge-empty">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal-bayar" id="modalBayar">
        <div class="modal-content">
            <h2><i class="fa fa-money-bill-wave" style="color: #2563eb;"></i> Pembayaran Servis</h2>
            
            <form action="{{ route('customer.bayar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="id" id="booking_id">

                <div class="form-group">
                    <label for="kode_booking">Kode Booking</label>
                    <input type="text" id="kode_booking" readonly>
                </div>

                <div class="form-group">
                    <label for="harga_booking">Total Biaya</label>
                    <input type="text" id="harga_booking" readonly>
                </div>

                <div class="form-group">
                    <label for="metode_bayar">Metode Pembayaran</label>
                    <select name="metode" id="metode_bayar" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="Transfer">Transfer Bank</option>
                        <option value="Cash">Cash / Tunai di Bengkel</option>
                    </select>
                </div>

                <div class="form-group" id="input-bukti">
                    <label for="bukti_bayar">Upload Bukti Transfer</label>
                    <input type="file" name="bukti" id="bukti_bayar" accept="image/*,.pdf">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-close" onclick="closeBayar()">Batal</button>
                    <button type="submit" class="btn-submit">Kirim Pembayaran</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openBayar(id, kode, harga) {
            document.getElementById('modalBayar').style.display = 'flex';
            document.getElementById('booking_id').value = id;
            document.getElementById('kode_booking').value = kode;
            
            let formattedHarga = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(harga);
            document.getElementById('harga_booking').value = formattedHarga;
            
            // Default awal saat modal dibuka: sembunyikan input bukti sebelum metode dipilih
            document.getElementById('input-bukti').style.display = 'none';
            document.getElementById('bukti_bayar').removeAttribute('required');
        }

        function closeBayar() {
            document.getElementById('modalBayar').style.display = 'none';
            document.getElementById('metode_bayar').value = "";
            document.getElementById('bukti_bayar').value = "";
            document.getElementById('input-bukti').style.display = 'none';
            document.getElementById('bukti_bayar').removeAttribute('required');
        }

        document.getElementById('metode_bayar').addEventListener('change', function() {
            let infoBukti = document.getElementById('input-bukti');
            let fileInput = document.getElementById('bukti_bayar');
            
            if(this.value === 'Transfer') {
                infoBukti.style.display = 'block';
                fileInput.setAttribute('required', 'required');
            } else {
                // Jika Cash atau kosong, sembunyikan input bukti & lepas required agar form bisa dikirim
                infoBukti.style.display = 'none';
                fileInput.removeAttribute('required');
                fileInput.value = ""; 
            }
        });

        window.onclick = function(event) {
            let modal = document.getElementById('modalBayar');
            if (event.target == modal) {
                closeBayar();
            }
        }
    </script>

</body>
</html>