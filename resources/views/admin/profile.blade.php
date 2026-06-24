<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile Admin</title>

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

/* =========================================================
   MAIN CONTENT
========================================================= */
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
    margin-bottom:10px;
}

.header h1{
    font-size:34px;
    font-weight:900;
    color:#0f172a;
}

.logout-top{
    background:linear-gradient(135deg,#ef4444,#dc2626);
    color:#fff;
    border:none;
    padding:10px 20px;
    border-radius:12px;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
    box-shadow:0 8px 18px rgba(239,68,68,.18);
    transition:.3s;
}

.logout-top:hover{
    transform:translateY(-2px);
}

/* SUBTITLE */
.subtitle{
    margin-bottom:30px;
}

.subtitle h2{
    font-size:22px;
    font-weight:800;
    color:#0f172a;
    margin-bottom:6px;
}

.subtitle p{
    font-size:14px;
    color:#64748b;
}

/* =========================================================
   PROFILE CARD
========================================================= */
.profile-container{
    display:flex;
    justify-content:center;
}

.profile-card{
    width:100%;
    max-width:980px;
    background:#fff;
    border-radius:22px;
    overflow:hidden;
    border:1px solid #e2e8f0;
    box-shadow:0 10px 28px rgba(15,23,42,.05);
    position:relative;
}

/* COVER */
.cover{
    height:140px;
    background:linear-gradient(90deg,#3b82f6,#1d4ed8,#0f172a);
}

/* STATUS ACTIVE */
.status-online{
    position:absolute;
    top:165px;
    right:35px;
    display:flex;
    align-items:center;
    gap:8px;
    font-size:14px;
    font-weight:600;
    color:#16a34a;
}

.dot{
    width:10px;
    height:10px;
    border-radius:50%;
    background:#22c55e;
}

/* AVATAR */
.avatar{
    width:120px;
    height:120px;
    border-radius:50%;
    overflow:hidden;
    border:5px solid #fff;
    background:#fff;
    position:absolute;
    top:80px;
    left:50%;
    transform:translateX(-50%);
    box-shadow:0 10px 25px rgba(15,23,42,0.15);
}

.avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* CONTENT */
.profile-content{
    padding:80px 35px 35px;
    text-align:center;
}

.name{
    font-size:34px;
    font-weight:900;
    color:#0f172a;
    margin-bottom:5px;
}

.role-text{
    font-size:16px;
    color:#64748b;
    margin-bottom:35px;
}

/* GRID */
.profile-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:24px;
    text-align:left;
    margin-bottom:30px;
}

.info-section h3{
    font-size:20px;
    font-weight:800;
    color:#0f172a;
    margin-bottom:18px;
}

.info-item{
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:14px;
    padding:14px 18px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:12px;
}

.info-label{
    font-size:12px;
    color:#64748b;
    margin-bottom:3px;
}

.info-value{
    font-size:14px;
    font-weight:700;
    color:#0f172a;
}

.info-icon{
    width:44px;
    height:44px;
    border-radius:12px;
    background:linear-gradient(135deg,#dbeafe,#bfdbfe);
    display:flex;
    align-items:center;
    justify-content:center;
    color:#2563eb;
    font-size:18px;
    margin-left:12px;
    flex-shrink:0;
}

/* ACTION BUTTONS */
.profile-actions{
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    gap:18px;
    padding-top:25px;
    border-top:1px solid #e2e8f0;
}

.action-btn{
    border:none;
    padding:12px 20px;
    border-radius:12px;
    color:#fff;
    font-size:14px;
    font-weight:700;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    width:100%;
    transition: .3s;
}

.action-btn:hover{
    transform: translateY(-2px);
}

.btn-primary{
    background:linear-gradient(135deg,#3b82f6,#2563eb);
    box-shadow:0 8px 18px rgba(37,99,235,.18);
}

.btn-warning{
    background:linear-gradient(135deg,#facc15,#eab308);
    color:#1f2937;
    box-shadow:0 8px 18px rgba(234,179,8,.18);
}

.btn-danger{
    background:linear-gradient(135deg,#ef4444,#dc2626);
    box-shadow:0 8px 18px rgba(239,68,68,.18);
}

/* RESPONSIVE */
@media(max-width:1024px){
    .sidebar{
        width:100%;
        height:auto;
        position:relative;
        border-radius:0 0 25px 25px;
    }

    .main{
        margin-left:0;
        width:100%;
        padding:18px;
    }

    .profile-grid{
        grid-template-columns:1fr;
    }

    .profile-actions{
        grid-template-columns:1fr;
    }

    .name{
        font-size:28px;
    }
    
    .header{
        flex-direction:column;
        align-items:flex-start;
        gap:12px;
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

    <a href="/admin/laporan" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
        <i class="fa fa-chart-line"></i> Laporan
    </a>

    <a href="/admin/profile" class="active {{ request()->is('admin/profile*') ? 'active' : '' }}">
        <i class="fa fa-user"></i> Profil
    </a>
</div>

<div class="main">

    <div class="header">
        <h1>Profile Admin</h1>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout-top">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>

    <div class="subtitle">
        <h2>Informasi Akun 👤</h2>
        <p>Lihat dan kelola informasi profil administrator sistem.</p>
    </div>

    <div class="profile-container">
        <div class="profile-card">

            <div class="cover"></div>

            <div class="status-online">
                <span class="dot"></span>
                Active
            </div>

            <div class="avatar">
                @if($user->photo)
                    <img src="{{ asset('uploads/'.$user->photo) }}" alt="Profile Photo">
                @else
                    <img src="{{ asset('images/profile.jpeg') }}" alt="Default Profile">
                @endif
            </div>

            <div class="profile-content">

                <div class="name">{{ $user->name }}</div>
                <div class="role-text">{{ ucfirst($user->role) }}</div>

                <div class="profile-grid">

                    <div class="info-section">
                        <h3>Personal Information</h3>

                        <div class="info-item">
                            <div>
                                <div class="info-label">Email</div>
                                <div class="info-value">{{ $user->email }}</div>
                            </div>
                            <div class="info-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                        </div>

                        <div class="info-item">
                            <div>
                                <div class="info-label">Status</div>
                                <div class="info-value">Akun Aktif</div>
                            </div>
                            <div class="info-icon">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>

                        <div class="info-item">
                            <div>
                                <div class="info-label">Sistem</div>
                                <div class="info-value">Auto Servis System</div>
                            </div>
                            <div class="info-icon">
                                <i class="fa-solid fa-building"></i>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3>Account & Security</h3>

                        <div class="info-item">
                            <div>
                                <div class="info-label">Username</div>
                                <div class="info-value">{{ $user->name }}</div>
                            </div>
                            <div class="info-icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        </div>

                        <div class="info-item">
                            <div>
                                <div class="info-label">Role</div>
                                <div class="info-value">{{ ucfirst($user->role) }}</div>
                            </div>
                            <div class="info-icon">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                        </div>

                        <div class="info-item">
                            <div>
                                <div class="info-label">Access</div>
                                <div class="info-value">Full Access</div>
                            </div>
                            <div class="info-icon">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="profile-actions">

                    <button class="action-btn btn-primary">
                        <i class="fa-solid fa-user-pen"></i>
                        Edit Profile
                    </button>

                    <button class="action-btn btn-warning">
                        <i class="fa-solid fa-key"></i>
                        Reset Password
                    </button>

                    <form method="POST" action="/logout" style="margin:0;">
                        @csrf
                        <button type="submit" class="action-btn btn-danger">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>

</div>

</body>
</html>