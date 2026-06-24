<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Servis</title>

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
display:flex;
background:#f1f5f9;
color:#0f172a;
}

/* ================= SIDEBAR ================= */

.sidebar{
position:fixed;
left:0;
top:0;
width:280px;
height:100vh;
background:linear-gradient(180deg,#0f172a,#1e3a8a,#2563eb);
padding:25px 18px;
overflow-y:auto;
}

.logo{
display:flex;
align-items:center;
gap:15px;
margin-bottom:40px;
}

.logo-icon{
width:60px;
height:60px;
border-radius:18px;
background:linear-gradient(135deg,#38bdf8,#2563eb);
display:flex;
align-items:center;
justify-content:center;
font-size:28px;
color:#fff;
box-shadow:0 10px 25px rgba(37,99,235,.4);
}

.logo-text h2{
font-size:20px;
font-weight:800;
line-height:1.2;
color:#fff;
}

.logo-text p{
font-size:12px;
color:#bfdbfe;
margin-top:3px;
}

/* MENU */

.sidebar a{
display:flex;
align-items:center;
gap:14px;
padding:15px 18px;
margin-bottom:12px;
border-radius:16px;
text-decoration:none;
color:#dbeafe;
font-size:16px;
font-weight:600;
transition:.3s;
position:relative;
}

.sidebar a i{
width:22px;
text-align:center;
font-size:18px;
}

.sidebar a:hover{
background:rgba(255,255,255,.1);
transform:translateX(5px);
}

.sidebar a.active{
background:linear-gradient(90deg,#38bdf8,#2563eb);
color:#fff;
box-shadow:0 10px 25px rgba(37,99,235,.4);
transform:translateX(5px);
}

.sidebar a.active::before{
content:'';
position:absolute;
left:-18px;
top:10px;
bottom:10px;
width:5px;
background:#fff;
border-radius:10px;
}

/* ================= MAIN ================= */

.main{
flex:1;
margin-left:280px;
padding:30px;
}

/* TOPBAR */

.topbar{
background:#fff;
padding:16px 22px;
border-radius:18px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 10px 30px rgba(0,0,0,.05);
margin-bottom:25px;
}

.search-box{
display:flex;
align-items:center;
gap:10px;
background:#f8fafc;
padding:12px 16px;
border-radius:12px;
border:1px solid #e2e8f0;
width:350px;
}

.search-box input{
border:none;
outline:none;
background:none;
width:100%;
font-size:14px;
}

.logout-btn{
background:linear-gradient(135deg,#ef4444,#dc2626);
border:none;
padding:11px 20px;
border-radius:12px;
color:#fff;
font-weight:700;
cursor:pointer;
}

/* ================= TITLE ================= */

.page-title{
margin-bottom:25px;
}

.page-title h1{
font-size:42px;
font-weight:900;
margin-bottom:8px;
}

.page-title p{
color:#64748b;
font-size:17px;
}

/* ================= BOX ================= */

.box{
background:#fff;
border-radius:25px;
padding:28px;
box-shadow:0 10px 35px rgba(0,0,0,.05);
margin-bottom:25px;
border:1px solid #e2e8f0;
}

.box h2{
font-size:30px;
font-weight:900;
margin-bottom:20px;
}

/* ================= FORM ================= */

.booking-form{
display:flex;
gap:15px;
flex-wrap:wrap;
align-items:center;
}

.booking-form select{
padding:14px 16px;
border-radius:12px;
border:1px solid #cbd5e1;
min-width:280px;
font-size:15px;
outline:none;
}

.booking-btn{
padding:14px 24px;
border:none;
border-radius:12px;
background:linear-gradient(135deg,#3b82f6,#2563eb);
color:#fff;
font-weight:700;
font-size:15px;
cursor:pointer;
box-shadow:0 10px 20px rgba(37,99,235,.2);
}

/* ================= TABLE ================= */

.table-responsive{
overflow-x:auto;
}

table{
width:100%;
border-collapse:collapse;
min-width:800px;
}

th{
background:#f8fafc;
padding:16px;
font-size:14px;
font-weight:800;
text-align:left;
border-bottom:1px solid #e2e8f0;
}

td{
padding:18px 16px;
border-bottom:1px solid #edf2f7;
font-size:15px;
}

tbody tr:hover{
background:#f8fafc;
}

.kode{
font-size:20px;
font-weight:900;
color:#1e3a8a;
}

/* BADGE */

.badge{
display:inline-block;
padding:7px 18px;
border-radius:30px;
font-size:13px;
font-weight:700;
color:#fff;
}

.selesai{
background:linear-gradient(135deg,#22c55e,#16a34a);
}

.proses{
background:linear-gradient(135deg,#3b82f6,#2563eb);
}

.pending{
background:linear-gradient(135deg,#f59e0b,#d97706);
}

/* BUTTON TABLE */

.table-btn{
padding:10px 18px;
border:none;
border-radius:12px;
font-size:14px;
font-weight:700;
color:#fff;
cursor:pointer;
}

.btn-green{
background:linear-gradient(135deg,#22c55e,#16a34a);
}

/* ================= RESPONSIVE ================= */

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

.topbar{
flex-direction:column;
gap:15px;
}

.search-box{
width:100%;
}

.page-title h1{
font-size:30px;
}

.box{
padding:20px;
}

.box h2{
font-size:24px;
}

.booking-form{
flex-direction:column;
align-items:stretch;
}

.booking-form select{
width:100%;
}

}

</style>
</head>

<body>

<!-- SIDEBAR -->

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

<a href="/customer/dashboard">
<i class="fa-solid fa-house"></i>
Dashboard
</a>

<a href="/customer/booking" class="active">
<i class="fa-solid fa-calendar-check"></i>
Booking Servis
</a>

<a href="/customer/layanan">
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

<!-- MAIN -->

<div class="main">

<!-- TOPBAR -->

<div class="topbar">

<div class="search-box">
<i class="fa-solid fa-magnifying-glass"></i>
<input type="text" placeholder="Cari booking servis...">
</div>

<form method="POST" action="/logout">
@csrf
<button class="logout-btn">Logout</button>
</form>

</div>

<!-- TITLE -->

<div class="page-title">
<h1>Booking Servis</h1>
<p>Ajukan booking servis kendaraan Anda dengan mudah dan cepat.</p>
</div>

<!-- FORM -->
<div class="box">

    <h2>Tambah Booking</h2>

    {{-- Pesan sukses --}}
@if(session('success'))
<div style="
    background:#dcfce7;
    color:#166534;
    padding:15px 20px;
    border-radius:12px;
    border:1px solid #86efac;
    margin-bottom:20px;
    font-weight:600;
">
    <i class="fa fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

    <form method="POST"
          action="{{ route('customer.booking.store') }}"
          class="booking-form">

        @csrf

        <select name="jenis_servis" required>
            <option value="">Pilih Layanan</option>

            @foreach($layanan as $l)
                <option value="{{ $l->nama }}">
                    {{ $l->nama }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="booking-btn">
            <i class="fa-solid fa-plus"></i>
            Booking Sekarang
        </button>

    </form>

</div>

<!-- TABLE -->

<div class="box">

<h2>Riwayat Booking</h2>

<div class="table-responsive">

<table>

<thead>
<tr>
<th>Kode</th>
<th>Servis</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Status</th>
</tr>
</thead>

<!-- JIKA INGIN LEBIH AMAN, GANTI SELURUH <tbody> DENGAN KODE BERIKUT -->

<tbody>

@forelse(($booking ?? $bookings ?? []) as $b)

<tr>

    <td class="kode">
        {{ $b->kode }}
    </td>

    <td>
        {{ $b->jenis_servis }}
    </td>

    <td>
        {{ !empty($b->tanggal_masuk) ? date('d-m-Y', strtotime($b->tanggal_masuk)) : '-' }}
    </td>
<td>
    {{ !empty($b->tanggal_masuk)
        ? date('H:i', strtotime($b->tanggal_masuk))
        : '-' }}
</td>
    <td>
        <span class="badge {{ strtolower($b->status ?? 'pending') }}">
            {{ ucfirst($b->status ?? 'Pending') }}
        </span>
    </td>

</tr>

@empty

<tr>
    <td colspan="5"
        style="text-align:center;padding:40px;color:#94a3b8;">
        Belum ada booking servis.
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