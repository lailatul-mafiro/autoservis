<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Servis Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f1f5f9;
    display:flex;
    color:#1e293b;
}

/* ======================================================
   SIDEBAR (KONSISTEN DENGAN DATA BOOKING)
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
   MAIN CONTENT
====================================================== */
.main{
    flex:1;
    margin-left:290px; 
    padding:30px;
    min-height:100vh;
}

/* ======================================================
   TOPBAR
====================================================== */
.topbar{
    background:#fff;
    border-radius:18px;
    padding:16px 22px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:16px;
    margin-bottom:24px;
    box-shadow:0 10px 24px rgba(15,23,42,.05);
    border:1px solid #e2e8f0;
}

.page-title{
    font-size:16px;
    font-weight:800;
    color:#0f172a;
    margin-bottom:3px;
}

.page-subtitle{
    font-size:12px;
    color:#64748b;
}

.logout-btn{
    border:none;
    padding:10px 18px;
    border-radius:12px;
    background:linear-gradient(135deg,#ef4444,#dc2626);
    color:#fff;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
    box-shadow:0 8px 18px rgba(239,68,68,.18);
    transition:.3s;
}

.logout-btn:hover{
    transform:translateY(-2px);
}

/* ======================================================
   HEADER
====================================================== */
.header{
    margin-bottom:24px;
}

.header h1{
    font-size:34px;
    font-weight:900;
    color:#0f172a;
    line-height:1.1;
}

.header p{
    margin-top:6px;
    font-size:14px;
    color:#64748b;
}

/* ======================================================
   STATISTICS
====================================================== */
.stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:18px;
    margin-bottom:24px;
}

.stat-card{
    position:relative;
    overflow:hidden;
    border-radius:20px;
    padding:22px;
    color:#fff;
    min-height:120px;
}

.stat-card::after{
    content:'';
    position:absolute;
    width:80px;
    height:80px;
    border-radius:50%;
    right:-12px;
    top:-12px;
    background:rgba(255,255,255,.10);
}

.stat-card .icon{
    position:absolute;
    top:18px;
    right:18px;
    font-size:24px;
    opacity:.9;
}

.stat-card .label{
    font-size:13px;
    font-weight:700;
    margin-bottom:8px;
}

.stat-card .value{
    font-size:36px;
    font-weight:900;
    line-height:1;
}

.blue{
    background:linear-gradient(135deg,#6366f1,#4f46e5);
}

.green{
    background:linear-gradient(135deg,#22c55e,#16a34a);
}

.orange{
    background:linear-gradient(135deg,#f59e0b,#ea580c);
}

/* ======================================================
   CARD
====================================================== */
.card{
    background:#fff;
    border-radius:22px;
    padding:24px;
    box-shadow:0 10px 28px rgba(15,23,42,.05);
    border:1px solid #e2e8f0;
}

.card-header{
    margin-bottom:20px;
}

.card-title{
    font-size:22px;
    font-weight:800;
    color:#0f172a;
    margin-bottom:4px;
}

.card-subtitle{
    font-size:13px;
    color:#64748b;
}

/* ======================================================
   TABLE
====================================================== */
.table-wrapper{
    overflow-x:auto;
}

table{
    width:100%;
    min-width:950px;
    border-collapse:separate;
    border-spacing:0;
}

thead th{
    background:#f8fafc;
    padding:14px 16px;
    text-align:left;
    font-size:13px;
    font-weight:700;
    color:#334155;
    border-bottom:2px solid #e2e8f0;
    white-space:nowrap;
}

thead th:first-child{
    border-top-left-radius:12px;
}

thead th:last-child{
    border-top-right-radius:12px;
}

tbody td{
    padding:15px 16px;
    font-size:13px;
    color:#1e293b;
    border-bottom:1px solid #edf2f7;
    vertical-align:middle;
}

tbody tr:hover{
    background:#f8fafc;
}

.code{
    font-size:15px;
    font-weight:800;
    color:#1e3a8a;
}

.customer-name{
    font-weight:700;
    color:#0f172a;
}

.service-name{
    font-weight:700;
    color:#1d4ed8;
}

/* ======================================================
   EXPORT EXCEL BUTTON
====================================================== */
.export-btn{
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 12px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #ffffff;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    box-shadow: 0 8px 18px rgba(34,197,94,.18);
    transition: .3s;
    margin-top: 16px;
}

.export-btn:hover{
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(34,197,94,.25);
}

/* ======================================================
   BADGE
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
    min-width:75px;
}

.badge.success{
    background:#22c55e;
}

.badge.warning{
    background:#f59e0b;
}

.badge.danger{
    background:#ef4444;
}

.badge.secondary {
    background:#64748b;
}

.badge.info {
    background:#3b82f6;
}

/* ======================================================
   EMPTY
====================================================== */
.empty{
    text-align:center;
    padding:28px;
    color:#94a3b8;
    font-size:13px;
}

/* ======================================================
   RESPONSIVE
====================================================== */
@media (max-width:1024px){
    .sidebar{
        width:100%;
        height:auto;
        position:relative;
        border-radius:0 0 25px 25px;
    }

    .main{
        margin-left:0;
        width:100%;
        padding:20px;
    }

    .header h1{
        font-size:28px;
    }

    .topbar{
        flex-direction:column;
        align-items:flex-start;
    }

    .stats{
        grid-template-columns:1fr;
    }

    .sidebar a.active::before { 
        display:none; 
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
        <i class="fa-solid fa-house"></i> Dashboard
    </a>

    <a href="/admin/pelanggan" class="{{ request()->is('admin/pelanggan*') ? 'active' : '' }}">
        <i class="fa-solid fa-users"></i> Pelanggan
    </a>

    <a href="/admin/layanan" class="{{ request()->is('admin/layanan*') ? 'active' : '' }}">
        <i class="fa-solid fa-screwdriver-wrench"></i> Layanan
    </a>

    <a href="/admin/booking" class="{{ request()->is('admin/booking*') ? 'active' : '' }}">
        <i class="fa-solid fa-calendar-days"></i> Booking
    </a>

    <a href="/admin/transaksi" class="{{ request()->is('admin/transaksi*') ? 'active' : '' }}">
        <i class="fa-solid fa-money-bill-wave"></i> Transaksi
    </a>

    <a href="/admin/riwayat" class="{{ request()->is('admin/riwayat*') ? 'active' : '' }}">
        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Servis
    </a>

    <a href="/admin/laporan" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
        <i class="fa-solid fa-chart-line"></i> Laporan
    </a>

    <a href="/admin/profile" class="{{ request()->is('admin/profile*') ? 'active' : '' }}">
        <i class="fa-solid fa-user"></i> Profil
    </a>

</div>

<div class="main">

    <div class="topbar">
        <div>
            <div class="page-title">Riwayat Servis Admin</div>
            <div class="page-subtitle">
                Pantau seluruh riwayat servis dan masa garansi customer.
            </div>
        </div>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>

    <div class="header">
        <h1>Riwayat Servis</h1>
        <p>Data seluruh servis yang telah selesai beserta informasi garansi.</p>
    </div>

    <div class="stats">
        <div class="stat-card blue">
            <div class="icon">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div class="label">Total Servis</div>
            <div class="value">{{ $data->count() }}</div>
        </div>

        <div class="stat-card green">
            <div class="icon">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div class="label">Garansi Aktif</div>
            <div class="value">
                {{ $data->filter(function($item){
                    return !empty($item->garansi_sampai)
                        && strtotime($item->garansi_sampai) >= strtotime(date('Y-m-d'));
                })->count() }}
            </div>
        </div>

        <div class="stat-card orange">
            <div class="icon">
                <i class="fa-solid fa-calendar-xmark"></i>
            </div>
            <div class="label">Garansi Expired</div>
            <div class="value">
                {{ $data->filter(function($item){
                    return !empty($item->garansi_sampai)
                        && strtotime($item->garansi_sampai) < strtotime(date('Y-m-d'));
                })->count() }}
            </div>
        </div>
    </div>

   <div class="card">
    <div class="card-header">
        <div class="card-title">Daftar Riwayat Servis</div>

        <div class="card-subtitle">
            Menampilkan seluruh data servis customer yang telah selesai.
        </div>

        <a href="/admin/riwayat/export" class="export-btn">
            <i class="fa-solid fa-file-excel"></i>
            Export Excel Garansi
        </a>
    </div>
        <div class="table-wrapper">
            <table>
              <thead>
    <tr>
        <th>Kode</th>
        <th>Customer</th>
        <th>Layanan</th>
        <th>Tanggal Selesai</th>
        <th>Garansi</th>
        <th>Berlaku Sampai</th>
        <th>Status Garansi</th> 
        <th>Keluhan Claim</th>
        <th>Status Claim</th>
        <th>Catatan Admin</th>
        <th>Aksi Claim</th>
    </tr>
</thead>

               <tbody>
    @forelse($data as $d)
        <tr>
            <td class="code">{{ $d->kode }}</td>

            <td class="customer-name">
                {{ $d->customer ?? ($d->name ?? '-') }}
            </td>

            <td class="service-name">
                {{ $d->jenis_servis }}
            </td>

            <td>
                {{ $d->tanggal_selesai
                    ? date('d M Y', strtotime($d->tanggal_selesai))
                    : '-' }}
            </td>

            <td>
                {{ $d->garansi_hari ?? 0 }} Hari
            </td>

            <td>
                {{ $d->garansi_sampai
                    ? date('d M Y', strtotime($d->garansi_sampai))
                    : '-' }}
            </td>

            <td>
                @php
                    $status = 'danger';
                    $text = 'Tidak Ada';

                    if (!empty($d->garansi_sampai)) {
                        if (strtotime($d->garansi_sampai) >= strtotime(date('Y-m-d'))) {
                            $status = 'success';
                            $text = 'Aktif';
                        } else {
                            $status = 'warning';
                            $text = 'Expired';
                        }
                    }
                @endphp

                <span class="badge {{ $status }}">
                    {{ $text }}
                </span>
            </td>

            {{-- =========================================================
               CLAIM GARANSI
            ========================================================= --}}
            @php
                $claim = $claims[$d->id] ?? null;
            @endphp

            <td>
                {{ $claim->keluhan ?? '-' }}
            </td>

            <td>
    @if($claim)
        @php
            $statusClaim = strtolower(trim($claim->status ?? ''));
            $badgeClass = 'badge secondary';

            if ($statusClaim == 'pending') {
                $badgeClass = 'badge warning';
            } elseif ($statusClaim == 'disetujui') {
                $badgeClass = 'badge success';
            } elseif ($statusClaim == 'sedang dikerjakan') {
                $badgeClass = 'badge info';
            } elseif ($statusClaim == 'selesai') {
                $badgeClass = 'badge success';
            } elseif ($statusClaim == 'ditolak') {
                $badgeClass = 'badge danger';
            }
        @endphp

        <span class="{{ $badgeClass }}">
            {{ $claim->status }}
        </span>
    @else
        -
    @endif
</td>
            <td>
                {{ $claim->catatan_admin ?? '-' }}
            </td>

            <td>
                @if($claim)
                    <form action="{{ route('admin.claim.garansi.update', $claim->id) }}"
                          method="POST"
                          style="min-width:220px;">
                        @csrf

                        <select name="status"
                                style="
                                    width:100%;
                                    padding:8px 10px;
                                    border:1px solid #cbd5e1;
                                    border-radius:8px;
                                    margin-bottom:8px;
                                ">
                            <option value="Pending"
                                {{ $claim->status == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Disetujui"
                                {{ $claim->status == 'Disetujui' ? 'selected' : '' }}>
                                Disetujui
                            </option>

                            <option value="Sedang Dikerjakan"
                                {{ $claim->status == 'Sedang Dikerjakan' ? 'selected' : '' }}>
                                Sedang Dikerjakan
                            </option>

                            <option value="Selesai"
                                {{ $claim->status == 'Selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                            <option value="Ditolak"
                                {{ $claim->status == 'Ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                        </select>

                       <textarea name="catatan_admin"
          rows="2"
          placeholder="Catatan admin..."
          style="
              width:100%;
              border:1px solid #cbd5e1;
              border-radius:8px;
              padding:8px;
              margin-bottom:8px;
              resize:none;
          ">{{ $claim->catatan_admin ?? '' }}</textarea>

                        <button type="submit"
                                style="
                                    width:100%;
                                    background:linear-gradient(135deg,#22c55e,#16a34a);
                                    color:#ffffff;
                                    border:none;
                                    padding:9px 12px;
                                    border-radius:8px;
                                    font-weight:700;
                                    cursor:pointer;
                                ">
                            Simpan
                        </button>
                    </form>
                @else
                    -
                @endif
            </td>
        </tr>
    @empty
       <tr>
                            <td colspan="11" class="empty">
                                Belum ada riwayat servis yang selesai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>