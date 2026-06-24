<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Saya</title>

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

/* ======================================================
   PROFILE CARD
====================================================== */
.profile-card {
    max-width: 900px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(15, 23, 42, .08);
    border: 1px solid #e2e8f0;
}

/* COVER */
.cover {
    height: 180px;
    background: linear-gradient(135deg, #3b82f6, #2563eb, #7c3aed);
    position: relative;
}

.cover::after {
    content: '';
    position: absolute;
    top: -40px;
    right: -40px;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .08);
}

/* PROFILE HEADER */
.profile-header {
    position: relative;
    text-align: center;
    padding: 0 40px 40px;
}

/* AVATAR */
.avatar {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    overflow: hidden;
    margin: -70px auto 20px;
    border: 6px solid #ffffff;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .12);
    background: #f8fafc;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* USER INFO */
.profile-name {
    font-size: 36px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 8px;
    line-height: 1.2;
}

.profile-email {
    font-size: 18px;
    color: #64748b;
    margin-bottom: 18px;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 999px;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 30px;
    box-shadow: 0 10px 25px rgba(37, 99, 235, .25);
}

/* ALERT */
.success {
    background: #dcfce7;
    color: #166534;
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 25px;
    font-size: 14px;
    font-weight: 600;
    border: 1px solid #bbf7d0;
}

/* FORM */
.profile-form {
    text-align: left;
    max-width: 700px;
    margin: 0 auto;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group.full {
    grid-column: 1 / -1;
}

.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 8px;
}

.form-group label i {
    color: #3b82f6;
    margin-right: 6px;
}

.form-control {
    width: 100%;
    padding: 14px 16px;
    border: 1px solid #cbd5e1;
    border-radius: 14px;
    font-size: 15px;
    outline: none;
    transition: .3s;
    background: #ffffff;
}

.form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, .10);
}

.form-control[readonly] {
    background: #f8fafc;
    color: #64748b;
}

/* FILE INPUT */
input[type="file"].form-control {
    padding: 12px;
}

/* BUTTON */
.btn-save {
    width: 100%;
    border: none;
    padding: 16px;
    border-radius: 16px;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #ffffff;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 15px 30px rgba(37, 99, 235, .25);
    transition: .3s;
    margin-top: 10px;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 35px rgba(37, 99, 235, .30);
}

/* RESPONSIVE SUB-SYSTEM */
@media(max-width:1024px) {
    .main { margin-left: 0; width: 100%; padding: 15px; }
    .sidebar { display: none; }
}

@media (max-width:768px) {
    .profile-card {
        border-radius: 24px;
    }

    .cover {
        height: 140px;
    }

    .avatar {
        width: 110px;
        height: 110px;
        margin-top: -55px;
    }

    .profile-header {
        padding: 0 20px 30px;
    }

    .profile-name {
        font-size: 28px;
    }

    .profile-email {
        font-size: 15px;
    }

    .form-grid {
        grid-template-columns: 1fr;
        gap: 0;
    }
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
        <a href="/customer/pembayaran">
            <i class="fa-solid fa-credit-card"></i> Pembayaran
        </a>
        <a href="/customer/profile" class="active">
            <i class="fa-solid fa-user"></i> Profil
        </a>
    </div>
</div>

<div class="main">

    <div class="topbar">
        <div class="page-info">
            <h1>Profil Saya</h1>
            <p>Kelola informasi akun customer Anda.</p>
        </div>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="profile-card">

        <div class="cover"></div>

        <div class="profile-header">

            <div class="avatar">
                @if($user->foto)
                    <img src="/foto/{{ $user->foto }}" alt="Foto Profil">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=2563eb&color=ffffff&size=300" alt="Avatar">
                @endif
            </div>

            <div class="profile-name">{{ $user->name }}</div>
            <div class="profile-email">{{ $user->email }}</div>

            <div class="role-badge">
                <i class="fa-solid fa-user-shield"></i>
                Customer
            </div>

            @if(session('success'))
                <div class="success">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/customer/profile/update" enctype="multipart/form-data" class="profile-form">
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label>
                            <i class="fa-solid fa-user"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fa-solid fa-envelope"></i>
                            Email
                        </label>
                        <input type="email" value="{{ $user->email }}" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fa-solid fa-phone"></i>
                            Nomor HP
                        </label>
                        <input type="text" name="no_hp" value="{{ $user->no_hp }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fa-solid fa-camera"></i>
                            Foto Profil
                        </label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                    <div class="form-group full">
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

</div>

</body>
</html>