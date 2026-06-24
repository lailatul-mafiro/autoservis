<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:linear-gradient(135deg,#eef2ff,#f8fafc);
    display:flex;
}

/* =======================
   SIDEBAR MODERN
======================= */
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

.sidebar::-webkit-scrollbar{
    width:6px;
}

.sidebar::-webkit-scrollbar-thumb{
    background:rgba(255,255,255,0.15);
    border-radius:10px;
}

.brand{
    display:flex;
    align-items:center;
    gap:14px;
    margin-bottom:45px;
}
.notif-card{
    display:flex;
    align-items:center;
    gap:15px;
    background:#ffffff;
    padding:18px 20px;
    border-radius:16px;
    margin-bottom:15px;
    text-decoration:none;
    color:#111827;
    box-shadow:0 8px 20px rgba(0,0,0,0.06);
    border:1px solid #e2e8f0;
    transition:all .3s ease;
}

.notif-card:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 25px rgba(0,0,0,0.08);
}

.notif-icon{
    width:60px;
    height:60px;
    border-radius:50%;
    background:#dbeafe;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    flex-shrink:0;
}

.notif-content{
    flex:1;
}

.notif-content h4{
    margin:0;
    color:#0f172a;
    font-size:18px;
    font-weight:700;
}

.notif-content p{
    margin-top:5px;
    color:#64748b;
    font-size:14px;
    line-height:1.5;
}

.notif-arrow{
    font-size:24px;
    font-weight:bold;
    color:#3b82f6;
}

.garansi .notif-icon{
    background:#ede9fe;
}

.notif-success{
    background:#dcfce7;
    color:#166534;
    padding:18px;
    border-radius:12px;
    margin-bottom:15px;
    font-weight:600;
    border:1px solid #bbf7d0;
}

/* BOX NOTIFIKASI */
.notif-box{
    background:#ffffff;
    border-radius:18px;
    padding:20px;
    margin-bottom:25px;
    box-shadow:0 8px 20px rgba(0,0,0,0.04);
    border:1px solid #e2e8f0;
}

.notif-box h3{
    color:#0f172a;
    margin-bottom:15px;
    font-size:20px;
    font-weight:800;
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

/* PERBAIKAN: Menyamakan kecerahan gradasi biru aktif & menghilangkan pergeseran x agar tetap sejajar */
.sidebar a.active{
    background:linear-gradient(90deg,#38bdf8,#2563eb);
    color:#ffffff;
    box-shadow:0 10px 25px rgba(37,99,235,0.35);
    transform: none; /* Dibuat normal agar presisi dengan menu lainnya */
}

/* PERBAIKAN UTAMA: Menggeser indikator garis putih ke dalam (dari left: -20px menjadi left: 10px) agar tidak menutupi teks dashboard */
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

/* =======================
   MAIN CONTENT
======================= */
.main{
    flex:1;
    padding:30px;
    margin-left:290px;
    min-height:100vh;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.header h1{
    font-size:26px;
    color:#0f172a;
    font-weight:800;
}

.logout{
    background:#ef4444;
    color:#fff;
    padding:10px 18px;
    border-radius:10px;
    border:none;
    cursor:pointer;
    font-weight:600;
}

.logout:hover{
    background:#dc2626;
}

.welcome{
    margin-bottom:15px;
}

.welcome h2{
    font-size:20px;
    margin-bottom:5px;
    color:#0f172a;
}

.welcome p{
    color:#64748b;
    font-size:16px;
}

.info{
    background:linear-gradient(135deg,#0ea5e9,#2563eb);
    color:white;
    padding:20px;
    border-radius:16px;
    margin-bottom:20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 10px 25px rgba(37,99,235,0.15);
}

.cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
    margin-bottom:25px;
}

.cards-6{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    gap:15px;
    margin-bottom:25px;
}

.card{
    padding:20px;
    border-radius:16px;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-4px);
}

.card.total{ background:linear-gradient(135deg,#6366f1,#4f46e5); }
.card.pending{ background:linear-gradient(135deg,#f59e0b,#d97706); }
.card.proses{ background:linear-gradient(135deg,#3b82f6,#2563eb); }
.card.selesai{ background:linear-gradient(135deg,#22c55e,#16a34a); }
.card.online{ background:linear-gradient(135deg,#0ea5e9,#0284c7); }
.card.walkin{ background:linear-gradient(135deg,#ec4899,#db2777); }

.card span{
    font-size:32px;
    font-weight:bold;
}

.card i{
    font-size:28px;
    opacity:0.85;
}

.table-box{
    background:#ffffff;
    border-radius:18px;
    padding:20px;
    box-shadow:0 8px 20px rgba(0,0,0,0.04);
    border:1px solid #e2e8f0;
    margin-bottom:25px;
}

.table-box h3{
    margin-bottom:15px;
    color:#0f172a;
}

table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    text-align:center;
    vertical-align:middle;
}

th{
    padding:12px;
    background:#f1f5f9;
    font-weight:700;
    color:#0f172a;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
}

tr:nth-child(even){ background:#f8fafc; }

tbody tr:hover{
    background:#f1f5f9;
}

.badge{
    padding:5px 12px;
    border-radius:20px;
    color:white;
    font-size:12px;
    font-weight:600;
    display:inline-block;
}

.badge.menunggu,
.badge.pending{ background:#f59e0b; }
.badge.proses{ background:#3b82f6; }
.badge.selesai{ background:#22c55e; }

.charts{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

@media(max-width:1000px){
    .cards{ grid-template-columns:repeat(2,1fr); }
    .cards-6{ grid-template-columns:repeat(2,1fr); }
}

@media(max-width:768px){
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

    .cards,
    .cards-6,
    .charts{
        grid-template-columns:1fr;
    }
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

    <a href="/admin/booking" class="{{ request()->is('admin/booking*') ? 'active' : '' }}">
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

    <div class="header">
        <h1>AUTO SERVIS</h1>

        <form method="POST" action="/logout">
            @csrf
            <button class="logout" type="submit">Logout</button>
        </form>
    </div>

    <div class="welcome">
        <h2>Selamat Datang 👋</h2>
        <p>Ringkasan aktivitas bengkel hari ini</p>
    </div>

    <div class="info">
        <div>
            <h3>Servis Hari Ini</h3>
            <p>{{ $bookings->filter(function($item){
                return isset($item->tanggal_masuk) && \Carbon\Carbon::parse($item->tanggal_masuk)->toDateString() == now()->toDateString();
            })->count() }} kendaran masuk</p>
        </div>
        <i class="fa fa-car" style="font-size:28px;opacity:0.3;"></i>
    </div>

    @php
        $total = $bookings->whereIn('status', ['menunggu', 'proses'])->count();
        $pending = $bookings->where('status','pending')->count();
        $proses  = $bookings->where('status','diproses')->count();
        $selesai = $bookings->where('status','selesai')->count();

        $totalOnline = DB::table('transaksi')->count();
        $totalWalkIn = DB::table('transaksi_langsung')->count();

        $bookingPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $bookingPerBulan[] = $bookings->filter(function($item) use ($i) {
                return isset($item->tanggal_masuk)
                    && \Carbon\Carbon::parse($item->tanggal_masuk)->month == $i;
            })->count(); 
        }
    @endphp

{{-- ==========================================================
   NOTIFIKASI ADMIN
========================================================== --}}
<div class="cards" style="margin-bottom:25px;">
    <div class="card" style="background:linear-gradient(135deg,#ef4444,#dc2626);">
        <div>
            <h4>🔔 Total Notifikasi</h4>
            <span>{{ $totalNotifikasi }}</span>
        </div>
        <i class="fa fa-bell"></i>
    </div>

    <a href="/admin/booking" style="text-decoration:none;">
        <div class="card" style="background:linear-gradient(135deg,#3b82f6,#2563eb); cursor:pointer;">
            <div>
                <h4>📥 Booking Baru</h4>
                <span>{{ $bookingBaru }}</span>
            </div>
            <i class="fa fa-calendar-plus"></i>
        </div>
    </a>

    <a href="/admin/riwayat" style="text-decoration:none;">
        <div class="card" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed); cursor:pointer;">
            <div>
                <h4>🛡️ Claim Garansi</h4>
                <span>{{ $claimBaru }}</span>
            </div>
            <i class="fa fa-shield-alt"></i>
        </div>
    </a>
</div>

{{-- ==========================================================
   DETAIL NOTIFIKASI
========================================================== --}}
<div class="table-box">
<h3>🔔 Notifikasi Admin</h3>

@if($bookingBaru > 0)
<a href="/admin/booking" class="notif-card">
    <div class="notif-icon">📥</div>
    <div class="notif-content">
        <h4>{{ $bookingBaru }} Booking Baru</h4>
        <p>Ada pelanggan yang baru melakukan booking servis. Klik untuk membuka halaman booking.</p>
    </div>
    <div class="notif-arrow">→</div>
</a>
@else
<div class="notif-success">
✅ Tidak ada booking baru saat ini.
</div>
@endif

@if($claimBaru > 0)
<a href="/admin/riwayat" class="notif-card garansi">
    <div class="notif-icon">🛡️</div>
    <div class="notif-content">
        <h4>{{ $claimBaru }} Claim Garansi</h4>
        <p>Ada claim garansi yang perlu diperiksa admin.</p>
    </div>
    <div class="notif-arrow">→</div>
</a>
@endif

@if($totalNotifikasi == 0)
    <div style="background:#f0fdf4; border-left:5px solid #22c55e; padding:15px 20px; border-radius:12px; color:#166534; font-weight:600;">
        ✅ Tidak ada notifikasi baru.
    </div>
@endif
</div>

    <div class="cards">
        <div class="card total">
            <div>
                <h4>Total Antrean</h4>
                <span>{{ $total }}</span>
            </div>
            <i class="fa fa-database"></i>
        </div>

        <div class="card pending">
            <div>
                <h4>Menunggu</h4>
                <span>{{ $pending }}</span>
            </div>
            <i class="fa fa-clock"></i>
        </div>

        <div class="card proses">
            <div>
                <h4>Proses</h4>
                <span>{{ $proses }}</span>
            </div>
            <i class="fa fa-cogs"></i>
        </div>

        <div class="card selesai">
            <div>
                <h4>Selesai</h4>
                <span>{{ $selesai }}</span>
            </div>
            <i class="fa fa-check"></i>
        </div>
    </div>

    <div class="cards-6">
        <div class="card online">
            <div>
                <h4>Transaksi Online</h4>
                <span>{{ $totalOnline }}</span>
            </div>
            <i class="fa fa-globe"></i>
        </div>

        <div class="card walkin">
            <div>
                <h4>Transaksi Walk-In</h4>
                <span>{{ $totalWalkIn }}</span>
            </div>
            <i class="fa fa-walking"></i>
        </div>
    </div>

    <div class="table-box">
        <h3>Booking Terbaru</h3>
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Customer</th>
                    <th>Servis</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings->take(5) as $b)
                <tr>
                    <td>{{ $b->kode }}</td>
                    <td>{{ $b->customer }}</td>
                    <td>{{ $b->jenis_servis }}</td>
                    <td>{{ $b->tanggal_masuk }}</td>
                    <td>
                        <span class="badge {{ $b->status }}">
                            {{ ucfirst($b->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="charts">
        <div class="table-box">
            <h3>Grafik Booking per Bulan</h3>
            <canvas id="bookingChart" height="120"></canvas>
        </div>

        <div class="table-box">
            <h3>Grafik Status Servis</h3>
            <canvas id="statusChart" height="120"></canvas>
        </div>
    </div>

</div>

<script>
// Grafik Booking per Bulan
new Chart(document.getElementById('bookingChart'), {
    type: 'bar', 
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'], 
        datasets: [{
            label: 'Jumlah Booking', 
            data: @json($bookingPerBulan), 
            backgroundColor: 'rgba(59,130,246,0.8)', 
            borderRadius: 10
        }]
    }, 
    options: {
        responsive: true, 
        plugins: {
            legend: { display: false }
        }, 
        scales: {
            y: {
                beginAtZero: true, 
                ticks: { precision: 0 }
            }
        }
    }
}); 

// Grafik Status Servis
new Chart(document.getElementById('statusChart'), {
    type: 'doughnut', 
    data: {
        labels: ['Menunggu', 'Proses', 'Selesai'], 
        datasets: [{
            data: [{{ $pending }}, {{ $proses }}, {{ $selesai }}], 
            backgroundColor: ['#f59e0b', '#3b82f6', '#22c55e'], 
            borderWidth: 0
        }]
    }, 
    options: {
        responsive: true, 
        cutout: '70%', 
        plugins: {
            legend: { position: 'bottom' }
        }
    }
}); 
</script>

</body>
</html>