<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Nota Servis</title>

<style>
body{
font-family:Arial;
background:#f4f6f9;
padding:30px;
}

/* CONTAINER */
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
border-bottom:2px solid #1e3a8a;
padding-bottom:10px;
margin-bottom:15px;
}

.header-left h2{
margin:0;
color:#1e3a8a;
}

.header-left p{
margin:2px 0;
}

.header-right{
text-align:right;
font-size:14px;
}

/* INFO */
.info{
margin-bottom:20px;
font-size:14px;
}

.info b{
display:inline-block;
width:90px;
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

/* BUTTON */
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

<div class="header-left">
<h2>Bengkel Dinamo</h2>
<p><b>Sumber Rezeki</b></p>

<p style="font-size:13px;color:#555;margin-top:5px;">
Jl.Raya Wonorejo No.5,<br>
Krajan, Pacar Keling,<br>
Kec. Kejayan, Pasuruan,<br>
Jawa Timur<br>
📞 081230711773
</p>
</div>

<div class="header-right">
Tanggal: {{ date('d-m-Y', strtotime($data->tanggal_selesai ?? now())) }}<br>
Status: {{ ucfirst($data->status_bayar ?? 'belum') }}
</div>

</div>

<!-- INFO CUSTOMER -->
<div class="info">
<p><b>Customer</b>: {{ $data->customer }}</p>
<p><b>Kode</b>: {{ $data->kode }}</p>
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
Terima kasih telah menggunakan jasa Bengkel Dinamo Sumber Rezeki 🙏
</div>

<button onclick="printNota()" class="print-btn">
🖨️ Print / Simpan PDF
</button>

</div>

</body>
</html>