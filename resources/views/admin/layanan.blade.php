<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Layanan - Admin</title>

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
            SIDEBAR
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

        /* Menyembunyikan scrollbar bawaan browser pada sidebar agar tampilan lebih bersih */
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

        /* KONSISTENSI: Menghapus transform translateX agar sejajar rapi */
        .sidebar a.active{
            background:linear-gradient(90deg,#38bdf8,#2563eb);
            color:#ffffff;
            box-shadow:0 10px 25px rgba(37,99,235,0.35);
            transform:none;
        }

        /* KONSISTENSI: Menambahkan penanda indikator garis putih vertikal di dalam area menu aktif */
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
            HEADER
        ====================================================== */
        .header{
            background:#ffffff;
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

        .header h1{
            font-size:16px;
            font-weight:800;
            color:#0f172a;
            margin-bottom:3px;
        }

        .header p{
            font-size:12px;
            color:#64748b;
        }

        .logout{
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

        .logout:hover{
            transform:translateY(-2px);
        }

        /* ======================================================
            PAGE TITLE
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

        /* ======================================================
            STAT CARD
        ====================================================== */
        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:18px;
            margin-bottom:24px;
        }

        .card-stat{
            position:relative;
            overflow:hidden;
            border-radius:20px;
            padding:22px;
            color:#fff;
            min-height:120px;
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
        }

        .card-stat::after{
            content:'';
            position:absolute;
            width:80px;
            height:80px;
            border-radius:50%;
            right:-12px;
            top:-12px;
            background:rgba(255,255,255,.10);
        }

        .card-stat .icon{
            position:absolute;
            top:18px;
            right:18px;
            font-size:24px;
            opacity:.9;
        }

        .card-stat .label{
            font-size:13px;
            font-weight:700;
            margin-bottom:8px;
        }

        .card-stat .value{
            font-size:36px;
            font-weight:900;
            line-height:1;
        }

        /* ======================================================
            ALERT
        ====================================================== */
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
            BOX
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

        /* ======================================================
            SERVICE CATEGORIES
        ====================================================== */
        .category-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
            gap:14px;
            margin-bottom:22px;
        }

        .category-card{
            background:#f8fafc;
            border:1px solid #e2e8f0;
            border-radius:16px;
            padding:18px;
            text-align:center;
            transition:.3s;
        }

        .category-card:hover{
            transform:translateY(-4px);
            box-shadow:0 10px 20px rgba(15,23,42,.06);
            border-color:#93c5fd;
        }

        .category-card i{
            font-size:26px;
            color:#2563eb;
            margin-bottom:10px;
        }

        .category-card h4{
            font-size:14px;
            font-weight:700;
            color:#0f172a;
            margin-bottom:4px;
        }

        .category-card p{
            font-size:12px;
            color:#64748b;
            line-height:1.5;
        }

        /* ======================================================
            FORM
        ====================================================== */
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
            BUTTON
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

        .btn-danger{
            padding:9px 14px;
            background:linear-gradient(135deg,#ef4444,#dc2626);
            color:#fff;
            font-size:12px;
            box-shadow:0 6px 14px rgba(239,68,68,.18);
        }

        .btn-danger:hover{
            transform:translateY(-2px);
        }

        /* ======================================================
            TABLE
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
            text-align:left;
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
        }

        tbody tr:hover{
            background:#f8fafc;
        }

        .service-name{
            font-weight:700;
            color:#0f172a;
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
            background:#dcfce7;
            color:#166534;
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

            .header{
                flex-direction:column;
                align-items:flex-start;
            }

            .form-group{
                flex-direction:column;
            }

            .form-group .btn-primary{
                width:100%;
            }

            .category-grid{
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
    <div class="welcome">
        <h2>Layanan Kelistrikan Mobil</h2>
    </div>

    <div class="cards">
        <div class="card-stat">
            <div class="icon">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <div class="label">Total Layanan</div>
            <div class="value">{{ count($data) }}</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="box">
        <div class="section-title">Kategori Layanan Unggulan</div>
        <div class="section-subtitle">
            pekerjaan utama yang ditangani bengkel Dinamo Sumber Rezeki
        </div>

        <div class="category-grid">
            <div class="category-card">
                <i class="fa-solid fa-car-battery"></i>
                <h4>Servis Aki</h4>
                <p>Pengecekan dan penggantian aki kendaraan.</p>
            </div>

            <div class="category-card">
                <i class="fa-solid fa-gear"></i>
                <h4>Dinamo Starter</h4>
                <p>Perbaikan starter yang lemah atau mati total.</p>
            </div>

            <div class="category-card">
                <i class="fa-solid fa-bolt"></i>
                <h4>Alternator</h4>
                <p>Servis sistem pengisian dan regulator.</p>
            </div>

            <div class="category-card">
                <i class="fa-solid fa-lightbulb"></i>
                <h4>Lampu & Wiring</h4>
                <p>Perbaikan kabel, fuse, relay, dan lampu.</p>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="section-title">Tambah Layanan Baru</div>
        <div class="section-subtitle">
            Tambahkan jenis layanan baru sesuai kebutuhan bengkel.
        </div>

        <form method="POST" action="{{ url('/admin/layanan/tambah') }}">
            @csrf

            <div class="form-group">
                <input
                    type="text"
                    name="nama"
                    placeholder="Contoh: Servis Dinamo Starter"
                    required
                >

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Layanan
                </button>
            </div>
        </form>
    </div>

    <div class="box">
        <div class="section-title">Daftar Layanan Tersedia</div>
        <div class="section-subtitle">
            Seluruh layanan kelistrikan mobil yang tersedia di bengkel.
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="70">No</th>
                        <th>Nama Layanan</th>
                        <th width="120">Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td class="service-name">
                                {{ $item->nama }}
                            </td>

                            <td>
                                <span class="badge">Aktif</span>
                            </td>

                            <td>
                                <a href="{{ url('/admin/layanan/hapus/'.$item->id) }}"
                                   class="btn btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus layanan ini?')">
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty">
                                Belum ada data layanan.
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