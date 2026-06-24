<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Servis</title>

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

/* ======================================================
   MAIN CONTENT & TOPBAR
====================================================== */
.main {
    margin-left: 280px;
    padding: 20px 25px;
    width: calc(100% - 280px);
    min-height: 100vh;
}

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

.page-title h1 i {
    margin-right: 10px;
    font-size: 36px;
    color: #2563eb;
}

/* ======================================================
   STATISTICS
====================================================== */
.stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}

.stat-card {
    border-radius: 20px;
    padding: 20px 24px;
    color: #fff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 12px 30px rgba(15,23,42,.08);
    min-height: 120px;
}

.stat-card::after {
    content: '';
    position: absolute;
    top: -25px;
    right: -25px;
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: rgba(255,255,255,.12);
}

.stat-card h4 {
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0.9;
}

.stat-card .number {
    font-size: 32px;
    font-weight: 800;
}

.stat-card i {
    position: absolute;
    right: 20px;
    bottom: 20px;
    font-size: 34px;
    opacity: .2;
}

.stat-total { background: linear-gradient(135deg, #6366f1, #4f46e5); }
.stat-selesai { background: linear-gradient(135deg, #10b981, #059669); }

/* ======================================================
   CARD TABLE
====================================================== */
.card {
    background: #ffffff;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 15px 40px rgba(15,23,42,.06);
    border: 1px solid #e2e8f0;
}

.card-header {
    margin-bottom: 20px;
}

.card-title {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
}

.card-subtitle {
    font-size: 13px;
    color: #64748b;
    margin-top: 4px;
}

.table-wrapper {
    overflow-x: auto;
    width: 100%;
}

table {
    width: 100%;
    min-width: 1000px;
    border-collapse: separate;
    border-spacing: 0;
}

/* HEADER */
thead th {
    background: #f8fafc;
    color: #334155;
    font-size: 13px;
    font-weight: 700;
    padding: 16px 18px;
    text-align: left;
    border-bottom: 2px solid #e2e8f0;
    white-space: nowrap;
}

thead th:first-child { border-top-left-radius: 16px; }
thead th:last-child { border-top-right-radius: 16px; }

/* TABLE BODY */
tbody td {
    padding: 18px 20px;
    font-size: 14px;
    color: #1e293b;
    border-bottom: 1px solid #edf2f7;
    vertical-align: middle;
}

tbody tr:hover {
    background: #f8fafc;
}

/* CONTENT STYLE IN TABLE */
.kode {
    font-size: 16px;
    font-weight: 800;
    color: #1e3a8a;
}

.service-name {
    font-size: 14px;
    font-weight: 700;
    color: #1e40af;
    line-height: 1.5;
}

.badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    color: #ffffff;
    text-transform: uppercase;
}

/* PERBAIKAN BADGE AGAR RAPI DI TENGAH */
.badge.bg-secondary {
    background: #64748b;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    white-space: nowrap; 
    line-height: 1;      
}

/* Menyetarakan lebar tombol dan badge klaim garansi */
tbody td:nth-child(5) .badge, 
tbody td:nth-child(5) .btn {
    width: 100%;
    max-width: 180px; 
    box-sizing: border-box;
}

.pending { background: linear-gradient(135deg, #f59e0b, #d97706); }
.proses { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.selesai { background: linear-gradient(135deg, #10b981, #059669); }

/* TOMBOL STYLE UMUM */
.btn {
    border: none;
    padding: 10px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.3s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #ffffff;
}

.btn-secondary {
    background: #e2e8f0;
    color: #475569;
}

/* EMPTY STATE */
.empty {
    text-align: center;
    padding: 40px 20px;
    color: #64748b;
}

.empty i {
    font-size: 40px;
    margin-bottom: 15px;
    color: #94a3b8;
}

.empty h3 {
    font-size: 18px;
    margin-bottom: 6px;
    color: #334155;
}

/* ======================================================
   KLAIM GARANSI MODAL CSS
====================================================== */
.modal-claim{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.5);
    justify-content:center;
    align-items:center;
    z-index:9999;
}

.modal-content-claim{
    background:#fff;
    width:500px;
    max-width:90%;
    border-radius:15px;
    padding:25px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.modal-content-claim h3 {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 15px;
}

.modal-content-claim textarea{
    width:100%;
    border:1px solid #ddd;
    border-radius:10px;
    padding:12px;
    resize:none;
    font-size: 14px;
    outline: none;
    margin-top: 10px;
}

.modal-content-claim textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
}

.modal-actions{
    display:flex;
    gap:10px;
    margin-top:15px;
    justify-content: flex-end;
}

/* ======================================================
   RESPONSIVE SUB-SYSTEM
====================================================== */
@media(max-width:1024px){
    .main { margin-left: 0; width: 100%; padding: 15px; }
    .sidebar { display: none; }
}
@media (max-width: 768px){
    .page-title h1 { font-size: 30px; }
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

        <a href="/customer/layanan">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            Layanan
        </a>

        <a href="/customer/riwayat" class="active">
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
        <div class="page-info">
            <h1>Riwayat Servis</h1>
            <p>Lihat seluruh riwayat perbaikan kendaraan Anda.</p>
        </div>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="page-title">
        <h1>
            <i class="fa-solid fa-clock-rotate-left"></i>
            Riwayat Servis
        </h1>
        <p>Data servis lengkap beserta status pengerjaan Anda.</p>
    </div>

    @php
        $totalServis = $bookings->count();
        $totalSelesai = $bookings->where('status', 'selesai')->count();
    @endphp

    <div class="stats">
        <div class="stat-card stat-total">
            <i class="fa-solid fa-file-lines"></i>
            <h4>Total Servis</h4>
            <div class="number">{{ $totalServis }}</div>
        </div>

        <div class="stat-card stat-selesai">
            <i class="fa-solid fa-circle-check"></i>
            <h4>Servis Selesai</h4>
            <div class="number">{{ $totalSelesai }}</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">Daftar Riwayat Servis</div>
            <div class="card-subtitle">
                Menampilkan seluruh booking dan status servis Anda.
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Layanan</th>
                        <th>Status Servis</th>
                        <th>Tanggal Masuk</th>
                        <th>Aksi Klaim Garansi</th>
                        <th>Status Claim</th>
                        <th>Catatan Admin</th>
                    </tr>
                </thead>

                <tbody>
                    @if($bookings->isEmpty())
                        <tr>
                            <td colspan="7">
                                <div class="empty">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <h3>Belum Ada Riwayat Servis</h3>
                                    <p>Riwayat booking Anda akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach($bookings as $item)
                            @php
                                $claim = $claims[$item->id] ?? null;
                            @endphp
                            <tr>
                                <td>
                                    <div class="kode">{{ $item->kode }}</div>
                                </td>

                                <td>
                                    <div class="service-name">{{ $item->jenis_servis }}</div>
                                </td>

                                <td>
                                    @php
                                        $status = strtolower(trim($item->status ?? 'pending'));

                                        if ($status == 'selesai') {
                                            $statusClass = 'selesai';
                                            $statusText = 'Selesai';
                                        } elseif ($status == 'proses') {
                                            $statusClass = 'proses';
                                            $statusText = 'Proses';
                                        } else {
                                            $statusClass = 'pending';
                                            $statusText = 'Pending';
                                        }
                                    @endphp

                                    <span class="badge {{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>

                                <td>
                                    {{ !empty($item->tanggal_masuk)
                                        ? date('d M Y H:i', strtotime($item->tanggal_masuk))
                                        : '-' }}
                                </td>

                                <td>
                                    @if($claim)

                                        <span class="badge bg-secondary">
                                            Claim Sudah Diajukan
                                        </span>

                                    @elseif($item->status == 'selesai')

                                        <button
                                            class="btn btn-success"
                                            onclick="openClaimModal('{{ $item->id }}')">
                                            <i class="fa fa-paper-plane"></i>
                                            Ajukan Klaim
                                        </button>

                                    @else

                                        <span class="badge bg-secondary">
                                            Servis Belum Selesai
                                        </span>

                                    @endif
                                </td>

                                <td>
                                    @if($claim)
                                        {{ $claim->status }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    @if($claim)
                                        {{ $claim->catatan_admin ?? 'Menunggu respon admin' }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>

<div id="claimModal" class="modal-claim">
    <div class="modal-content-claim">

        <h3>Klaim Garansi</h3>

        <form method="POST" action="{{ route('customer.claim.garansi') }}">
            @csrf

            <input type="hidden" name="booking_id" id="claim_booking_id">

            <textarea
                name="keluhan"
                rows="5"
                placeholder="Tuliskan keluhan klaim di sini..."
                required></textarea>

            <div class="modal-actions">
                <button type="submit" class="btn btn-success">
                    Kirim Klaim
                </button>

                <button type="button"
                        class="btn btn-secondary"
                        onclick="closeClaimModal()">
                    Batal
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function openClaimModal(id)
{
    document.getElementById('claim_booking_id').value = id;
    document.getElementById('claimModal').style.display = 'flex';
}

function closeClaimModal()
{
    document.getElementById('claimModal').style.display = 'none';
}

window.onclick = function(event) {
    let modal = document.getElementById('claimModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>