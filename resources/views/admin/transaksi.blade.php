<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Transaksi Admin</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

/* PENYESUAIAN: Link aktif dibuat rata tanpa pergeseran X */
.sidebar a.active {
    background:linear-gradient(90deg,#38bdf8,#2563eb);
    color:#ffffff;
    box-shadow:0 10px 25px rgba(37,99,235,0.35);
    transform: none; 
}

/* PENYESUAIAN: Garis indikator putih sejajar di dalam box menu */
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
   MAIN CONTENT & TABLE
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

.welcome { margin-bottom:15px; }
.welcome h2 { font-size:20px; color:#0f172a; margin-bottom:5px; }
.welcome p { color:#64748b; font-size:16px; }

.alert-success {
    background:#dcfce7;
    color:#166534;
    padding:14px 18px;
    border-radius:12px;
    border:1px solid #bbf7d0;
    margin-bottom:20px;
    font-weight:600;
}

.table-card {
    background:#ffffff;
    border-radius:18px;
    padding:20px;
    box-shadow:0 8px 20px rgba(0,0,0,0.04);
    border:1px solid #e2e8f0;
    overflow-x:auto;
}

table {
    width:100%;
    border-collapse:collapse;
}

th {
    padding:12px;
    background:#f1f5f9;
    font-weight:700;
    color:#0f172a;
    text-align:center;
}

td {
    padding:12px;
    border-bottom:1px solid #eee;
    text-align:center;
    vertical-align:middle;
    font-size:14px;
    color:#334155;
}

tbody tr:nth-child(even) { background:#f8fafc; }
tbody tr:hover { background:#f1f5f9; }

.kode {
    display:inline-block;
    padding:6px 12px;
    border-radius:10px;
    background:#1e3a8a;
    color:#ffffff;
    font-weight:700;
    font-size:13px;
}

/* BADGE STATUS */
.badge {
    display:inline-block;
    min-width:90px;
    padding:5px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    color:#ffffff;
}
.lunas { background:linear-gradient(135deg,#22c55e,#16a34a); }
.belum { background:linear-gradient(135deg,#ef4444,#dc2626); }
.menunggu-badge { background:linear-gradient(135deg,#f59e0b,#d97706); }
.ditolak-badge { background:linear-gradient(135deg,#64748b,#475569); }

/* BUTTONS */
.btn {
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    padding:9px 14px;
    border:none;
    border-radius:10px;
    text-decoration:none;
    color:#ffffff;
    font-size:13px;
    font-weight:700;
    cursor:pointer;
    transition:0.25s;
}
.btn-info { background: linear-gradient(135deg,#0ea5e9,#0284c7); }
.btn-save { background: linear-gradient(135deg,#3b82f6,#2563eb); }
.btn-nota { background: linear-gradient(135deg,#22c55e,#16a34a); }
.btn-success { background: linear-gradient(135deg,#22c55e,#15803d); }
.btn-close { background: #e2e8f0; color: #475569; }
.btn:hover { transform: translateY(-1px); filter: brightness(0.95); }
.btn-sm { padding: 6px 10px; font-size: 12px; }

/* MODAL POPUP */
.modal-overlay {
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(4px);
    display: flex; align-items: center; justify-content: center;
    z-index: 2000;
    opacity: 0; visibility: hidden;
    transition: all 0.3s ease;
}
.modal-overlay.active { opacity: 1; visibility: visible; }

.modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 18px;
    width: 100%;
    max-width: 600px;
    max-height: 85vh;
    overflow-y: auto;
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    transform: scale(0.9); transition: 0.3s ease;
}
.modal-overlay.active .modal-content { transform: scale(1); }
.modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.modal-header h3 { font-size: 20px; font-weight: 800; color: #0f172a; }
.modal-close-btn { background: none; border: none; font-size: 20px; cursor: pointer; color: #94a3b8; }

.form-group { margin-bottom: 15px; }
.form-group label { display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 6px; }
.form-group input, .form-group select {
    width: 100%; 
    padding: 8px 12px;
    height: 42px;
    border: 1px solid #cbd5e1; 
    border-radius: 10px; 
    outline: none; 
    font-size: 14px;
}
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }

.empty{ text-align:center; padding:60px 20px; color:#94a3b8; }
.empty i{ font-size:52px; margin-bottom:15px; color:#cbd5e1; }

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
        <h1>Data Transaksi</h1>
        <form method="POST" action="/logout">
            @csrf
            <button class="logout" type="submit">Logout</button>
        </form>
    </div>

    <div class="welcome">
        <h2>Kelola Transaksi 💳</h2>
        <p>Kelola pembayaran servis, edit harga, status pelunasan, dan isi catatan perbaikan kendaraan.</p>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Kode</th>
                    <th>Servis</th>
                    <th>Harga</th> 
                    <th>Pembayaran</th> 
                    <th>Bukti Transfer</th> 
                    <th>Detail</th> 
                    <th>Nota</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $t)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal_selesai ?? $t->created_at)->format('Y-m-d') }}</td>
                        <td>{{ $t->customer ?? '-' }}</td>
                        <td><span class="kode">{{ $t->kode ?? '-' }}</span></td>
                        <td>{{ $t->jenis_servis ?? '-' }}</td>
                        
                        <td style="font-weight: 700; color: #0f172a;">
                            Rp {{ number_format($t->harga ?? 0, 0, ',', '.') }}
                        </td>

                        <td>
                            @if(($t->status_bayar ?? 'belum') == 'lunas')
                                <span class="badge lunas">Lunas</span>
                            @elseif(($t->status_bayar ?? '') == 'upload_bukti')
                                <span class="badge menunggu-badge"> Menunggu Verifikasi </span>
                            @elseif(($t->status_bayar ?? '') == 'ditolak')
                                <span class="badge ditolak-badge">Ditolak</span>
                            @else
                                <span class="badge belum">Belum</span>
                            @endif
                            <br>
                            <small style="color: #64748b; font-weight: 600; display:inline-block; margin-top:4px;">
                                {{ $t->metode ?? 'Cash' }}
                            </small>
                        </td>

                        <td>
                            @if(!empty($t->bukti_pembayaran))
                                <a href="{{ asset('uploads/bukti/'.$t->bukti_pembayaran) }}"
                                   target="_blank"
                                   class="btn btn-success btn-sm">
                                    Lihat Bukti
                                </a>
                            @else
                                <span style="color:#999">Tidak Ada</span>
                            @endif
                        </td>

                        <td>
                            <button type="button" class="btn btn-info btn-detail-transaksi" 
                                data-id="{{ $t->id }}"
                                data-customer="{{ $t->customer ?? '-' }}"
                                data-servis="{{ $t->jenis_servis ?? '-' }}"
                                data-catatan="{{ $t->catatan ?? '' }}"
                                data-harga="{{ $t->harga ?? 0 }}"
                                data-status="{{ $t->status_bayar ?? 'belum' }}"
                                data-metode="{{ $t->metode ?? 'Cash' }}"
                                data-action="{{ route('admin.transaksi.update', $t->id) }}">
                                <i class="fa fa-list"></i> Detail
                            </button>
                        </td>

                        <td>
                            <a href="{{ route('admin.invoice', $t->booking_id) }}" target="_blank" class="btn btn-nota">
                                <i class="fa fa-file-invoice"></i> Nota
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="empty"> <i class="fa fa-receipt"></i><br><br>
                            <strong>Belum Ada Data Transaksi Selesai</strong>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="detailModal" class="modal-overlay" onclick="closeModal('detailModal')">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3>Detail & Kelola Transaksi</h3>
            <button class="modal-close-btn" onclick="closeModal('detailModal')">&times;</button>
        </div>
        
        <form id="form-update-modal" method="POST" action="">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" id="modal-customer" readonly style="background: #f1f5f9; color: #64748b; border-color: #e2e8f0;">
            </div>
            <div class="form-group">
                <label>Jenis Servis</label>
                <input type="text" id="modal-servis" readonly style="background: #f1f5f9; color: #64748b; border-color: #e2e8f0;">
            </div>

            <div class="form-group">
                <label for="modal-catatan">Catatan Servis</label>
                <textarea name="catatan" id="modal-catatan" rows="2" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:12px; resize:none; font-size:14px;" placeholder="Masukkan hasil pemeriksaan atau perbaikan kendaraan..."></textarea>
            </div>
            
            <div class="form-group">
                <label for="modal-harga">Harga Servis (Rp)</label>
                <input type="number" name="harga" id="modal-harga" required placeholder="Masukkan total harga">
            </div>

            <div class="form-group">
                <label for="modal-metode">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="modal-metode">
                    <option value="Cash">Cash</option>
                    <option value="Transfer">Transfer</option>
                </select>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
                <button type="button" class="btn btn-close" onclick="closeModal('detailModal')">Batal</button>
                <button type="submit" class="btn btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>