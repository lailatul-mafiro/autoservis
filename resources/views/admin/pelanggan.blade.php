<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - Admin</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
            color:#1e293b;
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
            color:#ffffff;
        }

        .brand-text p{
            font-size:12px;
            color:#bfdbfe;
            margin-top:4px;
        }

        /* MENU */
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
            transition:all .3s ease;
            position:relative;
            white-space:nowrap;
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

        /* PERBAIKAN: Menghapus transform translateX agar menu aktif tetap lurus presisi */
        .sidebar a.active{
            background:linear-gradient(90deg,#38bdf8,#2563eb);
            color:#ffffff;
            box-shadow:0 10px 25px rgba(37,99,235,0.35);
            transform:none;
        }

        /* PERBAIKAN UTAMA: Mengubah left dari -20px menjadi 10px agar garis putih berada di dalam menu dan tidak meluber keluar */
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

        /* =======================
           PAGE HERO
        ======================= */
        .welcome{
            position:relative;
            overflow:hidden;
            background:linear-gradient(135deg,#1d4ed8 0%, #2563eb 45%, #3b82f6 100%);
            border-radius:20px;
            padding:28px 32px;
            margin-bottom:20px;
            color:#ffffff;
            box-shadow:
                0 15px 35px rgba(37, 99, 235, 0.18),
                0 4px 12px rgba(15, 23, 42, 0.05);
        }

        .welcome::before{
            content:'';
            position:absolute;
            top:-50px;
            right:-50px;
            width:160px;
            height:160px;
            border-radius:50%;
            background:rgba(255,255,255,.08);
        }

        .welcome::after{
            content:'';
            position:absolute;
            bottom:-40px;
            left:-40px;
            width:110px;
            height:110px;
            border-radius:50%;
            background:rgba(255,255,255,.06);
        }

        .welcome > *{
            position:relative;
            z-index:2;
        }

        .welcome h2{
            font-size:35px;
            font-weight:800;
            line-height:1.05;
            letter-spacing:-1.5px;
            margin-bottom:10px;
            color:#ffffff;
        }

        .welcome h3{
            display:inline-flex;
            align-items:center;
            gap:12px;
            font-size:25px;
            font-weight:800;
            margin-bottom:14px;
            color:#ffffff;
        }

        .welcome h3::after{
            content:'👥';
            font-size:20px;
        }

        .welcome p{
            max-width:650px;
            font-size:15px;
            line-height:1.8;
            color:rgba(255,255,255,.92);
            margin-bottom:30px;
        }

        /* SEARCH */
        .search-box{
            display:flex;
            gap:14px;
            align-items:center;
            flex-wrap:wrap;
        }

        .search-box input{
            flex:1;
            min-width:280px;
            padding:15px 22px;
            border:none;
            border-radius:16px;
            background:rgba(255,255,255,.96);
            color:#0f172a;
            font-size:16px;
            font-weight:500;
            box-shadow:
                inset 0 1px 2px rgba(15,23,42,.04),
                0 10px 25px rgba(0,0,0,.08);
            outline:none;
            transition:all .3s ease;
        }

        .search-box input::placeholder{
            color:#64748b;
        }

        .search-box input:focus{
            transform:translateY(-2px);
            box-shadow:
                0 0 0 4px rgba(255,255,255,.18),
                0 14px 30px rgba(0,0,0,.12);
        }

        .search-box button{
            padding:15px 28px;
            border:none;
            border-radius:16px;
            background:linear-gradient(135deg,#ffffff,#eff6ff);
            color:#1d4ed8;
            font-size:16px;
            font-weight:800;
            cursor:pointer;
            box-shadow:0 12px 28px rgba(0,0,0,.10);
            transition:all .3s ease;
        }

        .search-box button:hover{
            transform:translateY(-3px) scale(1.02);
            box-shadow:0 18px 36px rgba(0,0,0,.14);
        }

        /* CARD TABLE */
        .card{
            background:#ffffff;
            border-radius:28px;
            padding:30px;
            box-shadow:
                0 18px 50px rgba(15,23,42,.06),
                0 2px 8px rgba(15,23,42,.03);
            border:1px solid #e2e8f0;
        }

        .card h3{
            margin-bottom:22px;
            color:#0f172a;
            font-size:30px;
            font-weight:900;
        }

        /* TABLE */
        .table-wrapper{
            overflow-x:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#f8fafc;
            padding:18px 20px;
            font-size:14px;
            text-align:left;
            color:#0f172a;
            font-weight:800;
            border-bottom:2px solid #e2e8f0;
        }

        td{
            padding:20px;
            border-bottom:1px solid #eef2f7;
            color:#334155;
            font-size:15px;
        }

        tbody tr:hover{
            background:#f8fafc;
        }

        /* BADGE */
        .badge{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:8px 16px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
            color:#ffffff;
            background:#22c55e;
            min-width:72px;
        }

        /* EMPTY */
        .empty{
            text-align:center;
            color:#94a3b8;
            padding:30px;
            font-size:14px;
        }

        /* RESPONSIVE */
        @media(max-width:1024px){
            .sidebar{
                width:100%;
                height:auto;
                position:relative;
            }

            .main{
                margin-left:0;
                padding:20px;
            }

            .welcome{
                padding:34px 28px;
                border-radius:28px;
            }

            .welcome h2{
                font-size:42px;
            }

            .welcome h3{
                font-size:24px;
            }

            .welcome p{
                font-size:16px;
            }
        }

        @media(max-width:768px){
            .search-box{
                flex-direction:column;
                align-items:stretch;
            }

            .search-box input{
                min-width:100%;
                padding:16px 20px;
                border-radius:16px;
            }

            .search-box button{
                width:100%;
                padding:16px 20px;
                border-radius:16px;
            }

            .welcome{
                padding:28px 22px;
                border-radius:24px;
            }

            .welcome h2{
                font-size:32px;
                line-height:1.15;
            }

            .welcome h3{
                font-size:22px;
            }

            .welcome p{
                font-size:14px;
                line-height:1.7;
            }

            .card{
                padding:22px;
                border-radius:22px;
            }

            .card h3{
                font-size:24px;
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
        <h2>Data Pelanggan</h2>

        <h3>Daftar Pelanggan</h3>

        <p>
            Kelola seluruh data pelanggan yang telah terdaftar dalam sistem.
            Cari pelanggan berdasarkan nama atau email untuk mempermudah
            proses administrasi dan pelayanan bengkel.
        </p>

        <form method="GET" class="search-box">
            <input
                type="text"
                name="search"
                placeholder="Cari nama atau email pelanggan..."
                value="{{ request('search') }}"
            >

            <button type="submit">
                <i class="fa-solid fa-search"></i>
                Cari
            </button>
        </form>
    </div>

    <div class="card">
        <h3>Daftar Pelanggan</h3>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>
                                <span class="badge">Aktif</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty">
                                Tidak ada data pelanggan.
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