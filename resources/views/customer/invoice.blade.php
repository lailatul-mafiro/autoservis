<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Invoice Servis</title>

<style>
body{
font-family:Arial;
background:#f4f6f9;
padding:30px;
}

/* BOX */
.invoice{
background:#fff;
max-width:800px;
margin:auto;
padding:25px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* HEADER */
.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.logo{
font-weight:bold;
font-size:18px;
color:#1e3a8a;
}

.invoice-title{
font-size:28px;
font-weight:bold;
color:#1e3a8a;
}

/* INFO */
.info{
display:flex;
justify-content:space-between;
margin-bottom:20px;
font-size:14px;
}

/* TABLE */
table{
width:100%;
border-collapse:collapse;
margin-top:10px;
}

th{
background:#1e3a8a;
color:#fff;
padding:10px;
font-size:13px;
}

td{
padding:10px;
border-bottom:1px solid #ddd;
font-size:13px;
text-align:center;
}

/* TOTAL */
.total-box{
margin-top:20px;
width:300px;
float:right;
}

.total-box div{
display:flex;
justify-content:space-between;
padding:6px 0;
}

.total-final{
font-weight:bold;
font-size:16px;
color:#1e3a8a;
}

/* FOOTER */
.footer{
margin-top:40px;
text-align:center;
font-size:13px;
}

/* PRINT BUTTON */
.print-btn{
margin-top:20px;
padding:10px;
background:#2563eb;
color:#fff;
border:none;
border-radius:6px;
cursor:pointer;
}

@media print {
.print-btn{
display:none;
}
}
</style>

<script>
function printNota(){
    window.print();
}
</script>

</head>

<body>

<div class="invoice">

<!-- HEADER -->
<div class="header">
<div class="logo">
🔧 Bengkel Dinamo<br>
<small>Servis Profesional</small>
</div>

<div class="invoice-title">
INVOICE
</div>
</div>

<!-- INFO -->
<div class="info">
<div>
<b>Customer:</b> {{ $data->customer }}<br>
<b>Kode:</b> {{ $data->kode }}
</div>

<div>
<b>Tanggal:</b> {{ date('d-m-Y', strtotime($data->tanggal_selesai ?? now())) }}<br>
<b>Status:</b> {{ ucfirst($data->status_bayar ?? 'belum') }}
</div>
</div>

<!-- TABLE -->
<table>
<thead>
<tr>
<th>Servis</th>
<th>Perbaikan</th>
<th>Harga</th>
</tr>
</thead>

<tbody>
<tr>
<td>{{ $data->jenis_servis }}</td>
<td>{{ $data->keterangan ?? '-' }}</td>
<td>Rp {{ number_format($data->harga ?? 0,0,',','.') }}</td>
</tr>
</tbody>
</table>

<!-- TOTAL -->
<div class="total-box">
<div>
<span>Subtotal</span>
<span>Rp {{ number_format($data->harga ?? 0,0,',','.') }}</span>
</div>

<div>
<span>Pajak</span>
<span>Rp 0</span>
</div>

<div class="total-final">
<span>Total</span>
<span>Rp {{ number_format($data->harga ?? 0,0,',','.') }}</span>
</div>
</div>

<div style="clear:both;"></div>

<!-- FOOTER -->
<div class="footer">
Terima kasih telah menggunakan jasa Bengkel Dinamo 🙏
</div>

<button onclick="printNota()" class="print-btn">
🖨️ Print / Simpan PDF
</button>

</div>

</body>
</html>