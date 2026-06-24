<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Langsung</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
    * {
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Segoe UI',sans-serif;
    }

    body {
        background:linear-gradient(135deg,#eef2ff,#f8fafc);
        display:flex;
    }

    /* ======================================================
       SIDEBAR MODERN (Identik dengan Dashboard)
    ====================================================== */
    .sidebar {
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

    .brand {
        display:flex;
        align-items:center;
        gap:14px;
        margin-bottom:45px;
    }

    .brand-icon {
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

    .brand-text h2 {
        font-size:28px;
        font-weight:900;
        line-height:1.1;
        margin:0;
        color:#ffffff;
        letter-spacing:-0.5px;
    }

    .brand-text p {
        font-size:12px;
        color:#bfdbfe;
        margin-top:4px;
    }

    .sidebar a {
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

    .sidebar a i {
        width:24px;
        text-align:center;
        font-size:18px; 
    }

    .sidebar a:hover {
        background:rgba(255,255,255,0.10);
        color:#ffffff;
        transform:translateX(6px);
    }

    .sidebar a.active {
        background:linear-gradient(90deg,#38bdf8,#2563eb);
        color:#ffffff;
        box-shadow:0 10px 25px rgba(37,99,235,0.35);
        transform: none; 
    }

    .sidebar a.active::before {
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
    .main {
        flex:1;
        margin-left:290px;
        padding:30px;
        min-height:100vh;
    }

    .header {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    .header h1 {
        font-size:26px;
        color:#0f172a;
        font-weight:800;
    }

    .logout {
        background:#ef4444;
        color:#fff;
        padding:10px 18px;
        border:none;
        border-radius:10px;
        cursor:pointer;
        font-weight:600;
    }

    .logout:hover { background:#dc2626; }

    .welcome { margin-bottom:25px; }
    .welcome h2 { font-size:20px; color:#0f172a; margin-bottom:5px; }
    .welcome p { color:#64748b; font-size:16px; }

    /* Override dikit Bootstrap Card biar matching dengan tema */
    .card {
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    
    .card-header {
        background: linear-gradient(90deg, #1e3a8a, #2563eb) !important;
        padding: 18px 20px;
        border-bottom: none;
    }

    .card-header h3 {
        font-size: 20px;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
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
        body{ display:block; }
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

    <a href="/admin/transaksi" class="{{ request()->is('admin/transaksi') ? 'active' : '' }}">
        <i class="fa fa-money-bill-wave"></i> Transaksi
    </a>

    <a href="{{ route('admin.transaksi.langsung') }}" class="{{ request()->is('admin/transaksi-langsung*') ? 'active' : '' }}">
        <i class="fa fa-cash-register"></i> Transaksi Langsung
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
        <h1>Transaksi Langsung</h1>
        <form method="POST" action="/logout">
            @csrf
            <button class="logout" type="submit">Logout</button>
        </form>
    </div>

    <div class="welcome">
        <h2>Input Transaksi Baru 🛠️</h2>
        <p>Gunakan form di bawah untuk mencatat transaksi pelanggan yang datang langsung ke bengkel.</p>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header text-white">
            <h3>
                <i class="fa fa-cash-register"></i>
                Form Kasir Transaksi Langsung
            </h3>
        </div>

        <div class="card-body p-4">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.transaksi.langsung.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Nama Customer</label>
                    <input type="text" name="customer" class="form-control" placeholder="Masukkan nama pelanggan" required style="border-radius: 10px; padding: 10px;">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Jenis Servis</label>
                    <input type="text" name="jenis_servis" class="form-control" placeholder="Contoh: Ganti gulungan, Overhaul dinamo" required style="border-radius: 10px; padding: 10px;">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Total Bayar (Rp)</label>
                    <input type="number" name="harga" class="form-control" placeholder="Masukkan nominal total pembayaran" required style="border-radius: 10px; padding: 10px;">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Metode Pembayaran</label>
                    <select name="metode" class="form-select" style="border-radius: 10px; padding: 10px; height: auto;">
                        <option value="Cash">Cash (Tunai)</option>
                        <option value="Transfer">Transfer Bank</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 10px; background: linear-gradient(135deg,#3b82f6,#2563eb); border: none;">
                        <i class="fa fa-save me-2"></i> Simpan Transaksi
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>