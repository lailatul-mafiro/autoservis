<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dinamo Sumber Rezeki</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI';}

html{scroll-behavior:smooth;}

body{
background:#0f172a;
color:#fff;
}

/* NAVBAR */
.navbar{
background:#0f172a;
padding:15px 30px;
display:flex;
justify-content:space-between;
align-items:center;
}

.navbar h2{color:#38bdf8;}

.navbar a{
color:#cbd5e1;
margin-left:20px;
text-decoration:none;
}

.navbar a:hover{color:#38bdf8;}

/* HERO */
.hero{
height:90vh;
background:url('https://images.unsplash.com/photo-1581091870627-3a4e3d2c1b0e') center/cover;
position:relative;
display:flex;
align-items:center;
justify-content:center;
text-align:center;
}

.hero::before{
content:"";
position:absolute;
width:100%;
height:100%;
background:linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.4));
}

.hero-content{position:relative;max-width:700px;}

.hero h1{font-size:42px;margin-bottom:15px;}
.hero p{color:#cbd5e1;margin-bottom:25px;}

/* BUTTON */
.btn{
padding:12px 25px;
border-radius:10px;
text-decoration:none;
margin:5px;
display:inline-block;
}

.btn-primary{background:#38bdf8;color:#000;font-weight:bold;}
.btn-outline{border:1px solid #38bdf8;color:#38bdf8;}

/* LAYANAN */
.service-section{
padding:60px 20px;
background:#f1f5f9;
color:#000;
text-align:center;
}

.service-grid{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
}

.card{
background:#fff;
padding:25px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
transition:0.3s;
}

.card:hover{
transform:translateY(-6px);
box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.card i{
font-size:30px;
color:#3b82f6;
margin-bottom:10px;
}

/* KONTAK */
.kontak{
padding:60px;
background:#0f172a;
text-align:center;
}

.btn-wa{
display:inline-flex;
align-items:center;
gap:10px;
margin-top:20px;
padding:14px 30px;
background:#25D366;
color:white;
border-radius:12px;
text-decoration:none;
font-weight:bold;
transition:0.3s;
}

.btn-wa:hover{
background:#1ebe5d;
transform:scale(1.05);
}

/* LINK MAPS */
.alamat-link{
display:inline-block;
color:#cbd5e1;
text-decoration:none;
margin-top:5px;
}

.alamat-link:hover{
color:#38bdf8;
transform:scale(1.05);
}

/* FLOATING WA */
.wa-float{
position:fixed;
bottom:25px;
right:25px;
width:60px;
height:60px;
background:#25D366;
color:white;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:28px;
box-shadow:0 8px 20px rgba(0,0,0,0.3);
z-index:999;
text-decoration:none;
animation:pulse 2s infinite;
}

@keyframes pulse{
0%{box-shadow:0 0 0 0 rgba(37,211,102,0.7);}
70%{box-shadow:0 0 0 15px rgba(37,211,102,0);}
100%{box-shadow:0 0 0 0 rgba(37,211,102,0);}
}

/* FOOTER */
.footer{
background:#020617;
padding:15px;
text-align:center;
color:#94a3b8;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
<h2>Dinamo Sumber Rezeki</h2>
<div>
<a href="/">Home</a>
<a href="#layanan">Layanan</a>
<a href="#kontak">Kontak</a>
<a href="/login">Login</a>
<a href="/register">Daftar</a>
</div>
</div>

<!-- HERO -->
<div class="hero">
<div class="hero-content">
<h1>Servis Dinamo Sumber Rezeki</h1>
<p>Layanan servis dinamo dan kelistrikan kendaraan dengan teknisi berpengalaman.</p>
<a href="/login" class="btn btn-primary">Booking Sekarang</a>
<a href="/login" class="btn btn-outline">Masuk</a>
</div>
</div>

<!-- LAYANAN -->
<div id="layanan" class="service-section">
<h2>Layanan Kami</h2>
<div class="service-grid">

@if(isset($layanans))
@foreach($layanans as $l)
<div class="card">
<i class="fa fa-tools"></i>
<h4>{{ $l->nama }}</h4>
</div>
@endforeach
@endif

</div>
</div>

<!-- KONTAK -->
<div id="kontak" class="kontak">

<h2>Hubungi Kami</h2>

@php
$wa = '6281230711773';
$pesan = urlencode("Halo, saya ingin booking servis dinamo");
@endphp

<p><i class="fa fa-phone"></i> 0812-3071-1773</p>

<!-- 🔥 LINK KE GOOGLE MAPS -->
<a href="https://maps.app.goo.gl/omMMFNYC4Pr6uYz29?g_st=aw" target="_blank" class="alamat-link">
<i class="fa fa-map-marker-alt"></i> Pasuruan
</a>

<p><i class="fa fa-envelope"></i> bengkel@email.com</p>

<a href="https://wa.me/{{ $wa }}?text={{ $pesan }}" target="_blank" class="btn-wa">
<i class="fab fa-whatsapp"></i> Chat WhatsApp
</a>

</div>

<!-- FOOTER -->
<div class="footer">
© 2026 Dinamo Sumber Rezeki
</div>

<!-- FLOATING WA -->
<a href="https://wa.me/{{ $wa }}?text={{ $pesan }}" target="_blank" class="wa-float">
<i class="fab fa-whatsapp"></i>
</a>

</body>
</html>