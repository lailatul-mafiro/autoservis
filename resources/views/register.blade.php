<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<style>
body{
font-family:Arial;
background:#eef2f7;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.card{
background:#fff;
padding:30px;
border-radius:10px;
width:350px;
}

input{
width:100%;
padding:10px;
margin:10px 0;
}

button{
width:100%;
padding:10px;
background:#22c55e;
color:#fff;
border:none;
cursor:pointer;
}
</style>

</head>

<body>

<div class="card">

<h2>Register</h2>

<form method="POST" action="/register">
@csrf

<input type="text" name="name" placeholder="Nama" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit">Daftar</button>

</form>

<p>Sudah punya akun? <a href="/login">Login</a></p>

</div>

</body>
</html>