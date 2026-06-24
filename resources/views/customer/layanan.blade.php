<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>jenis servis</title>

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

/* ==================== SIDEBAR ==================== */
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

.logo h2 {
    font-size: 22px;
    line-height: 1.1;
    font-weight: 800;
    letter-spacing: -0.5px;
    color: #fff;
}

.logo p {
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

/* ==================== MAIN AREA ==================== */
.main {
    margin-left: 280px;
    padding: 20px 25px;
    width: calc(100% - 280px);
    min-height: 100vh;
}

/* TOPBAR */
.topbar {
    background: #fff;
    padding: 16px 22px;
    border-radius: 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 30px rgba(0,0,0,.05);
    margin-bottom: 25px;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #f8fafc;
    padding: 12px 16px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    width: 420px;
}

.search-box input {
    border: none;
    outline: none;
    background: none;
    width: 100%;
    font-size: 14px;
}

.search-btn {
    border: none;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #fff;
    padding: 10px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
    white-space: nowrap;
}

.search-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(37,99,235,.25);
}

.logout-btn {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border: none;
    padding: 11px 20px;
    border-radius: 12px;
    color: #fff;
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

/* GRID */
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

/* CARD LAYANAN */
.card {
    background: #fff;
    border-radius: 24px;
    padding: 25px 20px;
    text-align: center;
    box-shadow: 0 12px 35px rgba(0,0,0,.05);
    border: 1px solid #e2e8f0;
    transition: .35s;
    position: relative;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(37,99,235,.12);
}

.card::before {
    content: '';
    position: absolute;
    top: -40px;
    right: -40px;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: rgba(59,130,246,.06);
}

.icon {
    font-size: 42px;
    margin-bottom: 18px;
    position: relative;
    z-index: 2;
}

.card h3 {
    font-size: 16px;
    font-weight: 800;
    color: #1e293b;
    line-height: 1.4;
    margin-bottom: 20px;
    min-height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 2;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border-radius: 12px;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: #fff;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    box-shadow: 0 10px 20px rgba(37,99,235,.2);
    transition: .3s;
    position: relative;
    z-index: 2;
    border: none;
    cursor: pointer;
}

.btn:hover {
    transform: translateY(-2px);
}

/* EMPTY DATA */
.empty-box {
    background: #fff;
    border-radius: 25px;
    padding: 60px 20px;
    text-align: center;
    color: #94a3b8;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 35px rgba(0,0,0,.05);
}

.empty-box i {
    font-size: 60px;
    margin-bottom: 20px;
}

/* MODAL BOOKING */
.modal-booking {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.5);
    z-index: 9999;
    overflow-y: auto;
}

.booking-content {
    width: 460px;
    max-width: 95%;
    background: #fff;
    padding: 25px;
    border-radius: 20px;
    margin: 40px auto;
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
}

.close-booking {
    float: right;
    font-size: 26px;
    cursor: pointer;
    color: #64748b;
    transition: .2s;
}

.close-booking:hover {
    color: #0f172a;
}

.booking-content h2 {
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 20px;
    color: #0f172a;
}

.form-group {
    margin-bottom: 14px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    font-size: 14px;
    color: #334155;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px 14px; 
    font-size: 14px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    outline: none;
    transition: .2s;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.btn-submit {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 12px;
    background: #2563eb;
    color: white;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: .3s;
    margin-top: 10px;
}

.btn-submit:hover {
    background: #1d4ed8;
}

/* RESPONSIVE SUB-SYSTEM (Sama Persis dengan Dashboard) */
@media(max-width:1024px){
    .main { margin-left: 0; width: 100%; padding: 15px; }
    .sidebar { display: none; }
}
@media(max-width:768px){
    .page-title h1 { font-size: 30px; }
    .grid { grid-template-columns: 1fr; }
}
</style>
</head>

<body>

<div class="sidebar">

    <div class="logo">
        <div class="logo-icon">
            <i class="fa-solid fa-car"></i>
        </div>
        <div>
            <h2>Bengkel Dinamo</h2>
            <p>Auto Servis System</p>
        </div>
    </div>

    <div class="menu">
        <a href="/customer/dashboard">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="/customer/layanan" class="active">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            Layanan
        </a>

        <a href="/customer/riwayat">
            <i class="fa-solid fa-clock-rotate-left"></i>
            Riwayat Servis
        </a>

        <a href="/customer/pembayaran">
            <i class="fa-solid fa-credit-card"></i>
            Pembayaran
        </a>

        <a href="/customer/profile">
            <i class="fa-solid fa-user"></i>
            Profil
        </a>
    </div>

</div>

<div class="main">

    <div class="topbar">
        <form method="GET" action="/customer/layanan" class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input
                type="text"
                name="search"
                placeholder="Cari layanan servis..."
                value="{{ request('search') }}"
            >
            <button type="submit" class="search-btn">
                Cari
            </button>
        </form>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout-btn">
                Logout
            </button>
        </form>
    </div>

    <div class="page-title">
        <h1>Daftar Layanan</h1>
        <p>Pilih layanan yang tersedia dan lakukan booking servis dengan mudah.</p>
    </div>

    @php
        $search = strtolower(trim(request('search', '')));

        $filtered = collect($data)->filter(function($item) use ($search) {
            if ($search == '') {
                return true;
            }
            return str_contains(strtolower($item->nama), $search);
        });
    @endphp

    @if($filtered->count() > 0)
    <div class="grid">
        @foreach($filtered as $d)
        <div class="card">
            <div class="icon">
                @if(str_contains(strtolower($d->nama), 'ac'))
                    <i class="fa-solid fa-snowflake" style="color:#06b6d4;"></i>
                @elseif(str_contains(strtolower($d->nama), 'kulkas'))
                    <i class="fa-solid fa-temperature-low" style="color:#0ea5e9;"></i>
                @elseif(str_contains(strtolower($d->nama), 'pompa'))
                    <i class="fa-solid fa-water" style="color:#38bdf8;"></i>
                @elseif(str_contains(strtolower($d->nama), 'mesin cuci'))
                    <i class="fa-solid fa-soap" style="color:#a78bfa;"></i>
                @elseif(str_contains(strtolower($d->nama), 'dinamo'))
                    <i class="fa-solid fa-bolt" style="color:#f59e0b;"></i>
                @elseif(str_contains(strtolower($d->nama), 'panel'))
                    <i class="fa-solid fa-microchip" style="color:#6366f1;"></i>
                @elseif(str_contains(strtolower($d->nama), 'rewinding'))
                    <i class="fa-solid fa-rotate" style="color:#22c55e;"></i>
                @elseif(str_contains(strtolower($d->nama), 'kelistrikan'))
                    <i class="fa-solid fa-plug" style="color:#ef4444;"></i>
                @else
                    <i class="fa-solid fa-screwdriver-wrench" style="color:#64748b;"></i>
                @endif
            </div>

            <h3>{{ $d->nama }}</h3>

            <button class="btn" onclick="openBooking('{{ $d->nama }}')">
                <i class="fa-solid fa-calendar-plus"></i>
                Booking
            </button>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <h2>Layanan Tidak Ditemukan</h2>
        <p>Tidak ada layanan yang sesuai dengan pencarian Anda.</p>
    </div>
    @endif

</div>

<div id="bookingModal" class="modal-booking">
    <div class="booking-content">
        <span class="close-booking" onclick="closeBooking()">
            <i class="fa-solid fa-xmark"></i>
        </span>

        <h2>Booking Servis</h2>

        <form action="{{ route('customer.booking.store') }}" method="POST">
    @csrf
           <input type="hidden" name="jenis_servis" id="namaLayanan">

            <div class="form-group">
                <label>Merek Kendaraan</label>
                <input type="text" name="merek" placeholder="Contoh: Toyota, Honda" required>
            </div>

            <div class="form-group">
                <label>Tipe Kendaraan</label>
                <input type="text" name="tipe_kendaraan" placeholder="Contoh: Avanza, Vario" required>
            </div>

            <div class="form-group">
                <label>Nomor Polisi</label>
                <input type="text" name="plat_nomor" placeholder="Contoh: B 1234 ABC" required>
            </div>

            <div class="form-group">
                <label>Tanggal Booking</label>
                <input type="date" name="tanggal_booking" required>
            </div>

            <div class="form-group">
                <label>Jam Booking</label>
                <input type="time" name="jam_booking" required>
            </div>

            <div class="form-group">
                <label>Keluhan</label>
                <textarea name="keluhan" rows="4" placeholder="Tuliskan keluhan atau kendala pada kendaraan Anda..." required></textarea>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-paper-plane"></i> Kirim Booking
            </button>
        </form>
    </div>
</div>

<script>
function openBooking(layanan) {
    document.getElementById('bookingModal').style.display = 'block';
    document.getElementById('namaLayanan').value = layanan;
    document.body.style.overflow = 'hidden';
}

function closeBooking() {
    document.getElementById('bookingModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

window.onclick = function(event) {
    var modal = document.getElementById('bookingModal');
    if (event.target == modal) {
        modal.style.display = "none";
        document.body.style.overflow = 'auto';
    }
}
</script>

</body>
</html>