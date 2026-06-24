<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Booking Servis - Admin Bengkel Dinamo</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background:#f1f5f9;
            display:flex;
            color:#1e293b;
        }

        /* ======================================================
            SIDEBAR (KONSISTEN)
        ====================================================== */
        .sidebar{
            position:fixed;
            top:0;
            left:0;
            width:290px;
            height:100vh;
            background:linear-gradient(180deg,#0f172a 0%, #1e3a8a 50%, #2563eb 100%);
            padding:28px 20px;
            color:#ffffff;
            box-shadow:12px 0 35px rgba(15,23,42,0.25);
            overflow-y:auto;
            z-index:1000;
        }

        /* Menyembunyikan scrollbar bawaan browser pada sidebar */
        .sidebar::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        .brand{
            display:flex;
            align-items:center;
            gap:14px;
            margin-bottom:45px;
        }

        .brand-icon{
            width:58px;
            height:58px;
            border-radius:18px;
            background:linear-gradient(135deg,#38bdf8,#2563eb);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:26px;
            color:#fff;
            box-shadow:0 12px 30px rgba(56,189,248,0.35);
        }

        .brand-text h2{
            font-size:28px;
            font-weight:900;
            line-height:1.1;
            margin:0;
            color:#ffffff;
            letter-spacing:-0.5px;
        }

        .brand-text p{
            font-size:12px;
            color:#bfdbfe;
            margin-top:4px;
        }

        .sidebar a{
            display:flex;
            align-items:center;
            gap:14px;
            padding:15px 18px;
            margin-bottom:10px;
            border-radius:16px;
            text-decoration:none;
            color:#dbeafe;
            font-size:16px;
            font-weight:600;
            transition:all 0.3s ease;
            position:relative;
        }

        .sidebar a i{
            width:24px;
            text-align:center;
            font-size:18px;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,0.10);
            color:#ffffff;
            transform:translateX(6px);
        }

        /* KONSISTENSI AKTIF: Menghapus transform translateX & Menggunakan class active langsung pada tag 'a' */
        .sidebar a.active{
            background:linear-gradient(90deg,#38bdf8,#2563eb);
            color:#ffffff;
            box-shadow:0 10px 25px rgba(37,99,235,0.35);
            transform:none;
        }

        /* KONSISTENSI AKTIF: Indikator garis putih vertikal di dalam area menu aktif */
        .sidebar a.active::before{
            content:'';
            position:absolute;
            left:10px;
            top:12px;
            bottom:12px;
            width:4px;
            border-radius:10px;
            background:#ffffff;
        }

        /* ======================================================
            MAIN CONTENT AREA
        ====================================================== */
        .main{
            flex:1;
            margin-left:290px;
            padding:30px;
            min-height:100vh;
        }

        /* ======================================================
            PAGE HEADER & ALERTS
        ====================================================== */
        .welcome{
            margin-bottom:24px;
        }

        .welcome h2{
            font-size:34px;
            font-weight:900;
            color:#0f172a;
            line-height:1.1;
            margin-bottom:6px;
        }

        .welcome p{
            font-size:14px;
            color:#64748b;
        }

        .alert{
            background:#dcfce7;
            color:#166534;
            border:1px solid #bbf7d0;
            padding:14px 18px;
            border-radius:12px;
            margin-bottom:20px;
            font-size:13px;
            font-weight:600;
        }

        /* ======================================================
            BOX COMPONENTS (SEARCH & CARDS)
        ====================================================== */
        .box{
            background:#ffffff;
            border-radius:22px;
            padding:24px;
            box-shadow:0 10px 28px rgba(15,23,42,.05);
            border:1px solid #e2e8f0;
            margin-bottom:24px;
        }

        .section-title{
            font-size:22px;
            font-weight:800;
            color:#0f172a;
            margin-bottom:4px;
        }

        .section-subtitle{
            font-size:13px;
            color:#64748b;
            margin-bottom:20px;
        }

        .form-group{
            display:flex;
            gap:16px;
            flex-wrap:wrap;
        }

        .form-group input{
            flex:1;
            min-width:280px;
            padding:14px 18px;
            border:1px solid #cbd5e1;
            border-radius:14px;
            font-size:14px;
            outline:none;
            transition:.3s;
        }

        .form-group input:focus{
            border-color:#2563eb;
            box-shadow:0 0 0 4px rgba(37,99,235,.10);
        }

        /* ======================================================
            BUTTON STYLES
        ====================================================== */
        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            border:none;
            border-radius:14px;
            font-weight:700;
            text-decoration:none;
            cursor:pointer;
            transition:.3s;
            white-space:nowrap;
        }

        .btn-primary{
            padding:14px 24px;
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
            color:#fff;
            font-size:14px;
            box-shadow:0 8px 18px rgba(37,99,235,.22);
        }

        .btn-primary:hover{
            transform:translateY(-2px);
        }

        .btn-reset { 
            padding:14px 24px;
            background:#64748b; 
            color:#fff; 
            font-size:14px;
            box-shadow:0 8px 18px rgba(100,116,139,.18);
        }
        .btn-reset:hover { 
            transform:translateY(-2px);
        }

        .btn-detail { 
            background:#f8fafc; 
            color:#1e293b; 
            border:1px solid #cbd5e1; 
            border-radius:10px; 
            padding:8px 14px; 
            cursor:pointer; 
            font-weight:700; 
            font-size:12px;
            transition:all 0.2s; 
        }
        .btn-detail:hover { 
            background:#e2e8f0; 
        }

        /* ======================================================
            TABLE STYLES
        ====================================================== */
        .table-wrapper{
            overflow-x:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        thead th{
            background:#f8fafc;
            padding:14px 16px;
            text-align:center;
            font-size:13px;
            font-weight:700;
            color:#334155;
            border-bottom:2px solid #e2e8f0;
        }

        tbody td{
            padding:16px;
            font-size:13px;
            color:#1e293b;
            border-bottom:1px solid #eef2f7;
            vertical-align:middle;
            text-align:center;
        }

        tbody tr:hover{
            background:#f8fafc;
        }

        .kode { font-size:14px; font-weight:700; color:#1e3a8a; }

        /* ======================================================
            BADGE STATUSES
        ====================================================== */
        .badge{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:5px 12px;
            border-radius:999px;
            font-size:11px;
            font-weight:700;
            color:#fff;
            text-transform:capitalize;
        }
        .badge.pending { background:#64748b; }
        .badge.diterima { background:#22c55e; }
        .badge.proses { background:#3b82f6; }
        .badge.selesai { background:#16a34a; }
        .badge.tolak { background:#ef4444; }

        .empty{
            text-align:center;
            padding:28px;
            color:#94a3b8;
            font-size:13px;
        }

        /* ======================================================
            MODAL STYLES
        ====================================================== */
        .modal { 
            display:none; 
            position:fixed; 
            inset:0; 
            background:rgba(15,23,42,0.4); 
            z-index:9999; 
            justify-content:center; 
            align-items:center; 
            backdrop-filter:blur(4px); 
            padding:20px; 
        }
        
        .modal-content { 
            width:750px; 
            max-width:100%; 
            max-height:90vh; 
            overflow-y:auto; 
            padding:30px; 
            border-radius:22px; 
            background:white; 
            position:relative; 
            box-shadow:0 20px 25px -5px rgba(0,0,0,0.1); 
            border:1px solid #e2e8f0;
        }

        .modal p { margin-bottom:8px; font-size:15px; }
        .modal hr { border:0; border-top:1px solid #e2e8f0; margin:15px 0; }
        .close { position:absolute; top:25px; right:25px; font-size:24px; font-weight:bold; color:#94a3b8; cursor:pointer; z-index:10; }
        .close:hover { color:#475569; }
        
        .keluhan-box { background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:15px; min-height:90px; max-height:120px; overflow-y:auto; font-size:14px; line-height:1.6; color:#334155; margin-top:10px; text-align:left; }
        
        .action-buttons { display:flex; gap:10px; margin-top:20px; margin-bottom:20px; flex-wrap:wrap; }
        .action-buttons button, .btn-action-danger { padding:12px 20px; border:none; border-radius:12px; font-size:14px; font-weight:700; cursor:pointer; color:white; transition:.3s; }
        .action-buttons button:hover, .btn-action-danger:hover { transform:translateY(-2px); }
        
        .btn-success { background:linear-gradient(135deg,#22c55e,#16a34a); box-shadow:0 6px 14px rgba(34,197,94,.18); }
        .btn-primary-action { background:linear-gradient(135deg,#3b82f6,#2563eb); box-shadow:0 6px 14px rgba(59,130,246,.18); }
        .btn-finish  { background:linear-gradient(135deg,#16a34a,#15803d); box-shadow:0 6px 14px rgba(22,163,74,.18); }
        .btn-action-danger  { background:linear-gradient(135deg,#ef4444,#dc2626); box-shadow:0 6px 14px rgba(239,68,68,.18); }

        #alasan_tolak { width:100%; height:100px; resize:none; padding:15px; border:1px solid #cbd5e1; border-radius:14px; font-size:14px; margin-top:10px; outline:none; transition:.3s; }
        #alasan_tolak:focus { border-color:#ef4444; box-shadow:0 0 0 4px rgba(239,68,68,.10); }

        .modal-section-title { font-size:24px; font-weight:800; margin-bottom:20px; color:#0f172a; }

        .detail-grid { display:grid; grid-template-columns:repeat(3, 1fr); gap:12px; margin-bottom:20px; }
        .detail-item { background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:12px; transition:all 0.2s ease; text-align:left; }
        .detail-item:hover { background:#f1f5f9; border-color:#cbd5e1; }
        .detail-item label { display:block; font-size:10px; font-weight:800; color:#64748b; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px; }
        .detail-item span { font-size:13px; font-weight:700; color:#1e293b; word-break:break-word; }

        /* ======================================================
            RESPONSIVE STYLES
        ====================================================== */
        @media(max-width:1024px){
            .sidebar{
                width:100%;
                height:auto;
                position:relative;
                border-radius:0 0 25px 25px;
            }

            .main{
                margin-left:0;
                padding:20px;
            }

            .welcome h2{
                font-size:28px;
            }

            .form-group{
                flex-direction:column;
            }

            .form-group .btn{
                width:100%;
            }

            .sidebar a.active::before { display:none; }
            .detail-grid { grid-template-columns:repeat(2, 1fr); }
        }

        @media (max-width: 640px) {
            .detail-grid { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <div class="brand-icon">
            <i class="fa-solid fa-gear"></i>
        </div>
        <div class="brand-text">
            <h2>Bengkel Dinamo</h2>
            <p>Admin Panel</p>
        </div>
    </div>

    <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <i class="fa fa-home"></i> Dashboard
    </a>

    <a href="/admin/pelanggan" class="{{ request()->is('admin/pelanggan*') ? 'active' : '' }}">
        <i class="fa fa-users"></i> Pelanggan
    </a>

    <a href="/admin/layanan" class="{{ request()->is('admin/layanan*') ? 'active' : '' }}">
        <i class="fa fa-tools"></i> Layanan
    </a>

    <a href="/admin/booking" class="active {{ request()->is('admin/booking*') ? 'active' : '' }}">
        <i class="fa fa-calendar"></i> Booking
    </a>

    <a href="/admin/transaksi" class="{{ request()->is('admin/transaksi*') ? 'active' : '' }}">
        <i class="fa fa-money-bill-wave"></i> Transaksi
    </a>

    <a href="/admin/riwayat" class="{{ request()->is('admin/riwayat*') ? 'active' : '' }}">
        <i class="fa fa-clock-rotate-left"></i> Riwayat Servis
    </a>

    <a href="/admin/laporan" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
        <i class="fa fa-chart-line"></i> Laporan
    </a>

    <a href="/admin/profile" class="{{ request()->is('admin/profile*') ? 'active' : '' }}">
        <i class="fa fa-user"></i> Profil
    </a>
</div>

<div class="main">
    <div class="welcome">
        <h2>Data Booking Servis</h2>
        <p>Kelola konfirmasi pesanan pelanggan, atur status alur servis, dan monitor antrean bengkel.</p>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="box">
        <form method="GET" class="form-group">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pelanggan atau kode booking...">
            
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i> Cari
            </button>
            <a href="/admin/booking" class="btn btn-reset">
                <i class="fa-solid fa-rotate-right"></i> Reset
            </a>
        </form>
    </div>

    <div class="box">
        <div class="section-title">Daftar Masuk Antrean</div>
        <div class="section-subtitle">Seluruh berkas pesanan booking kendaraan customer hari ini.</div>
        
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="90">Kode</th>
                        <th>Customer</th>
                        <th>Servis</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Selesai</th>
                        <th width="120">Status</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td><span class="kode">{{ $booking->kode }}</span></td>
                        <td style="font-weight:700; color:#0f172a;">{{ $booking->customer }}</td>
                        <td>{{ $booking->jenis_servis }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->tanggal_masuk ?? $booking->created_at)->format('Y-m-d') }}</td>
                        <td>{{ $booking->tanggal_selesai ? \Carbon\Carbon::parse($booking->tanggal_selesai)->format('Y-m-d') : '-' }}</td>
                        <td><span class="badge {{ $booking->status ?? 'pending' }}">{{ ucfirst($booking->status ?? 'Pending') }}</span></td>
                        <td>
                            <button type="button" class="btn-detail" onclick="showDetailBooking(
                                '{{ $booking->id }}',
                                '{{ $booking->kode }}',
                                '{{ $booking->customer }}',
                                '{{ $booking->jenis_servis }}',
                                '{{ $booking->merek ?? '-' }}',
                                '{{ $booking->tipe_kendaraan ?? '-' }}',
                                '{{ $booking->plat_nomor ?? '-' }}',
                                '{{ $booking->keluhan ?? 'Tidak ada keluhan' }}',
                                '{{ $booking->tanggal_booking }}',
                                '{{ $booking->jam_booking }}'
                            )">🔍 Detail</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="empty">Belum ada data booking terbaru saat ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 class="modal-section-title">Detail Berkas Booking</h2>
        
        <div class="detail-grid">
            <div class="detail-item">
                <label>Kode Booking</label>
                <span id="bkKode"></span>
            </div>

            <div class="detail-item">
                <label>Customer</label>
                <span id="bkCustomer"></span>
            </div>

            <div class="detail-item">
                <label>Jenis Servis</label>
                <span id="bkServis"></span>
            </div>

            <div class="detail-item">
                <label>Merek Kendaraan</label>
                <span id="bkMerek"></span>
            </div>

            <div class="detail-item">
                <label>Tipe Kendaraan</label>
                <span id="bkTipe"></span>
            </div>

            <div class="detail-item">
                <label>Nomor Polisi</label>
                <span id="bkPlat"></span>
            </div>

            <div class="detail-item">
                <label>Tanggal Booking</label>
                <span id="bkTanggalBooking"></span>
            </div>

            <div class="detail-item">
                <label>Jam Booking</label>
                <span id="bkJamBooking"></span>
            </div>
        </div>

        <hr>
        <h4 style="font-weight: 800; color: #0f172a; font-size:14px;">Keluhan Customer</h4>
        <div class="keluhan-box" id="mKeluhan">Tidak ada keluhan</div>
        <hr style="margin:20px 0;">

        <form action="/admin/verifikasi-booking" method="POST">
            @csrf
            <input type="hidden" id="bookingId" name="id" value="">

            <div class="action-buttons">
                <button type="submit" name="status" value="diterima" class="btn-success">Terima</button>
                <button type="submit" name="status" value="proses" class="btn-primary-action">Proses</button>
                <button type="submit" name="status" value="selesai" class="btn-finish">Selesai</button>
            </div>

            <div id="alasanTolakBox" style="display:none; margin-top:15px; text-align: left;">
                <label style="font-weight:700; color:#1e293b; font-size:13px;">Alasan Penolakan</label>
                <textarea name="alasan_tolak" id="alasan_tolak" placeholder="Tuliskan alasan penolakan secara jelas ke customer..."></textarea>
            </div>

            <button type="button" id="btnTriggerTolak" class="btn-action-danger" style="margin-top: 10px;" onclick="showAlasanTolak()">Tolak</button>
            <button type="submit" name="status" value="tolak" id="btnSubmitTolak" class="btn-action-danger" style="display:none; margin-top: 15px;">Simpan Penolakan</button>
        </form>
    </div>
</div>

<script>
    function showDetailBooking(id, kode, customer, servis, merek, tipe, plat, keluhan, tanggalBooking, jamBooking) {
        document.getElementById('bookingId').value = id;

        document.getElementById('bkKode').innerText = kode;
        document.getElementById('bkCustomer').innerText = customer;
        document.getElementById('bkServis').innerText = servis;

        document.getElementById('bkMerek').innerText = merek;
        document.getElementById('bkTipe').innerText = tipe;
        document.getElementById('bkPlat').innerText = plat;

        document.getElementById('bkTanggalBooking').innerText = tanggalBooking;
        document.getElementById('bkJamBooking').innerText = jamBooking;

        document.getElementById('mKeluhan').innerText = keluhan;

        document.getElementById('alasanTolakBox').style.display = 'none';
        document.getElementById('btnSubmitTolak').style.display = 'none';
        document.getElementById('btnTriggerTolak').style.display = 'inline-block';
        document.getElementById('alasan_tolak').value = '';

        document.getElementById('bookingModal').style.display = 'flex';
        
        document.querySelector('.modal-content').scrollTop = 0;
    }

    function closeModal() {
        document.getElementById('bookingModal').style.display = 'none';
    }

    function showAlasanTolak() {
        document.getElementById('alasanTolakBox').style.display = 'block';
        document.getElementById('btnSubmitTolak').style.display = 'inline-block';
        document.getElementById('btnTriggerTolak').style.display = 'none';
        
        setTimeout(() => {
            const modalContent = document.querySelector('.modal-content');
            modalContent.scrollTo({  
                top: modalContent.scrollHeight,  
                behavior: 'smooth'  
            });
        }, 50);
    }

    window.onclick = function(event) {
        const modal = document.getElementById('bookingModal');
        if (event.target == modal) { closeModal(); }
    }
</script>
</body>
</html>