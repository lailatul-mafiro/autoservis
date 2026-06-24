<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Admin</title>

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

/* ======================================================
    SIDEBAR (DISAMAKAN AGAR KONSISTEN)
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

/* =======================
    MAIN CONTENT
======================= */
.main{
    flex:1;
    margin-left:290px;
    padding:30px;
    min-height:100vh;
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.header h1{
    font-size:32px;
    font-weight:800;
    color:#0f172a;
}

/* LOGOUT */
.logout{
    background:#ef4444;
    color:#fff;
    padding:12px 22px;
    border:none;
    border-radius:12px;
    cursor:pointer;
    font-weight:600;
    font-size:14px;
    transition:0.3s;
}

.logout:hover{
    background:#dc2626;
    transform:translateY(-2px);
}

/* SUBTITLE */
.welcome{
    margin-bottom:24px;
}

.welcome h2{
    font-size:22px;
    color:#0f172a;
    margin-bottom:6px;
}

.welcome p{
    color:#64748b;
    font-size:15px;
    line-height:1.6;
}

/* =======================
    STAT CARDS
======================= */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));
    gap:20px;
    margin-bottom:25px;
}

.card{
    color:#ffffff;
    padding:24px;
    border-radius:20px;
    box-shadow:0 12px 30px rgba(15,23,42,0.08);
}

.card.total-transaksi{ background:linear-gradient(135deg,#6366f1,#4f46e5); }
.card.total-pendapatan{ background:linear-gradient(135deg,#22c55e,#16a34a); }
.card.online-income{ background:linear-gradient(135deg,#0ea5e9,#0284c7); }
.card.walkin-income{ background:linear-gradient(135deg,#ec4899,#db2777); }

.card .label{
    font-size:14px;
    opacity:0.9;
    margin-bottom:8px;
    font-weight:600;
}

.card .value{
    font-size:28px;
    font-weight:800;
    line-height:1.2;
    word-break:break-word;
}

/* =======================
    BOX
======================= */
.box{
    background:#ffffff;
    border-radius:22px;
    padding:24px;
    box-shadow:0 12px 35px rgba(15,23,42,0.06);
    border:1px solid #e2e8f0;
    margin-bottom:25px;
}

/* SECTION TITLE */
.section-title{
    font-size:24px;
    font-weight:800;
    color:#0f172a;
    margin-bottom:20px;
}

/* =======================
    GRAFIK LAPORAN
======================= */
.laporan-chart-box{
    margin-top:30px;
}

.laporan-chart-title{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:28px;
    font-weight:800;
    color:#0f172a;
    margin-bottom:10px;
}

.laporan-chart-title i{
    color:#2563eb;
    font-size:26px;
}

.laporan-chart-subtitle{
    color:#64748b;
    font-size:14px;
    margin-bottom:20px;
    line-height:1.6;
}

.chart-wrapper{
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:20px;
    padding:20px;
    height:420px;
    position:relative;
    box-shadow:inset 0 1px 0 rgba(255,255,255,0.8);
}

.chart-wrapper canvas{
    width:100% !important;
    height:100% !important;
}

/* =======================
    TABLE
======================= */
.table-wrapper{
    overflow-x:auto;
    border-radius:18px;
}

table{
    width:100%;
    min-width:900px;
    border-collapse:collapse;
    border:1px solid #e2e8f0;
    border-radius:18px;
    overflow:hidden;
}

th{
    background:linear-gradient(180deg,#f8fafc,#f1f5f9);
    padding:16px 12px;
    font-size:14px;
    font-weight:700;
    text-align:center;
    color:#0f172a;
    border:1px solid #e2e8f0;
    white-space:nowrap;
}

td{
    padding:14px 12px;
    text-align:center;
    font-size:14px;
    color:#334155;
    border:1px solid #eef2f7;
    vertical-align:middle;
}

tbody tr:nth-child(even) td{
    background:#f8fbff;
}

tbody tr:hover td{
    background:#eff6ff !important;
}

/* KODE */
.kode{
    display:inline-block;
    padding:6px 12px;
    border-radius:10px;
    background:#1e3a8a;
    color:#ffffff;
    font-weight:700;
    font-size:13px;
}

/* HARGA */
.harga{
    color:#16a34a;
    font-weight:700;
    font-size:15px;
    white-space:nowrap;
}

/* =======================
    RESPONSIVE
======================= */
@media (max-width: 1024px){
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

    .header{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }

    .header h1{
        font-size:26px;
    }

    .welcome h2{
        font-size:20px;
    }

    .cards{
        grid-template-columns:1fr;
    }

    .card .value{
        font-size:24px;
    }

    .section-title{
        font-size:20px;
    }

    .laporan-chart-title{
        font-size:22px;
    }

    .laporan-chart-title i{
        font-size:22px;
    }

    .chart-wrapper{
        height:300px;
        padding:15px;
    }

    table{
        min-width:700px;
    }

    th, td{
        padding:12px 10px;
        font-size:13px;
    }

    .logout{
        width:100%;
    }

    .sidebar a.active::before { display:none; }
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

    <a href="/admin/laporan" class="active {{ request()->is('admin/laporan*') ? 'active' : '' }}">
        <i class="fa fa-chart-line"></i> Laporan
    </a>

    <a href="/admin/profile" class="{{ request()->is('admin/profile*') ? 'active' : '' }}">
        <i class="fa fa-user"></i> Profil
    </a>
</div>

<div class="main">

    <div class="header">
        <h1>Laporan Admin</h1>

        <form method="POST" action="/logout">
            @csrf
            <button class="logout" type="submit">Logout</button>
        </form>
    </div>

    <div class="welcome">
        <h2>Analisis Pendapatan 📈</h2>
        <p>Lihat total transaksi, pendapatan, grafik, dan detail transaksi secara lengkap.</p>
    </div>

    <div class="cards">
        <div class="card total-transaksi">
            <div class="label">Total Transaksi</div>
            <div class="value">{{ $jumlahTransaksi ?? 0 }}</div>
        </div>

        <div class="card total-pendapatan">
            <div class="label">Total Pendapatan (Gabungan)</div>
            <div class="value">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
        </div>

        <div class="card online-income">
            <div class="label">Pendapatan Online</div>
            <div class="value">Rp {{ number_format($totalOnline ?? 0, 0, ',', '.') }}</div>
        </div>

        <div class="card walkin-income">
            <div class="label">Pendapatan Walk-In</div>
            <div class="value">Rp {{ number_format($totalWalkin ?? 0, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="box laporan-chart-box">
        <div class="section-title laporan-chart-title">
            <i class="fas fa-chart-line"></i>
            Grafik Jumlah Pendapatan
        </div>

        <p class="laporan-chart-subtitle">
            Menampilkan total pendapatan bengkel setiap bulan.
        </p>

        <div class="chart-wrapper">
            <canvas id="chart"></canvas>
        </div>
    </div>

    <div class="box">
        <div class="section-title">Detail Transaksi Terbaru</div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Customer</th>
                        <th>Servis</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::parse($d->created_at)->format('d-m-Y') }}
                        </td>

                        <td>
                            <span class="kode">
                                {{ $d->kode }}
                            </span>
                        </td>

                        <td>
                            {{ $d->customer }}
                        </td>

                        <td>
                            {{ $d->jenis_servis }}
                        </td>

                        <td>
                            <span class="harga">
                                Rp {{ number_format($d->total ?? 0, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
var labels = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

var dataPendapatan = [
    @for($i = 1; $i <= 12; $i++)
        {{ $grafik[$i] ?? 0 }}{{ $i < 12 ? ',' : '' }}
    @endfor
];

var maxData = Math.max.apply(null, dataPendapatan);
var maxY = Math.ceil(maxData / 500000) * 500000;

if (maxY < 500000) {
    maxY = 500000;
}

new Chart(document.getElementById('chart'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Jumlah Pendapatan',
            data: dataPendapatan,
            borderColor: '#f59e0b',
            backgroundColor: 'rgba(245, 158, 11, 0.15)',
            borderWidth: 4,
            tension: 0.35,
            fill: false,
            pointRadius: 6,
            pointHoverRadius: 8,
            pointBackgroundColor: '#f59e0b',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Rp ' + Number(context.raw).toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Bulan'
                },
                grid: {
                    display: false
                }
            },
            y: {
                beginAtZero: true,
                min: 0,
                max: maxY,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + Number(value).toLocaleString('id-ID');
                    }
                },
                title: {
                    display: true,
                    text: 'Pendapatan (Rp)'
                },
                grid: {
                    color: 'rgba(148, 163, 184, 0.15)'
                }
            }
        }
    }
});
</script>
</body>
</html>