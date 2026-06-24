<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Auto Servis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            height:100vh;
            background:#0f3c74;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .register-wrapper{
            width:420px;
            background:#ffffff;
            border-radius:14px;
            padding:40px;
            box-shadow:0 20px 50px rgba(0,0,0,0.25);
        }

        h2{
            text-align:center;
            color:#0f3c74;
            margin-bottom:25px;
            font-weight:800;
        }

        .form-group{
            margin-bottom:18px;
        }

        label{
            font-size:14px;
            font-weight:600;
            color:#333;
        }

        input{
            width:90%;
            padding:12px;
            margin-top:6px;
            border-radius:8px;
            border:1px solid #ccc;
            font-size:14px;
            transition:0.3s;
        }

        input:focus{
            border-color:#d4a437;
            outline:none;
            box-shadow:0 0 6px rgba(212,164,55,0.4);
        }

        button{
            width:100%;
            padding:13px;
            margin-top:10px;
            background:#d4a437;
            color:#fff;
            border:none;
            border-radius:8px;
            font-size:15px;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover{
            background:#b88d2f;
        }

        .error{
            color:#e63946;
            font-size:14px;
            margin-bottom:10px;
            text-align:center;
        }

        .login-link{
            text-align:center;
            margin-top:18px;
            font-size:14px;
        }

        .login-link a{
            color:#0f3c74;
            font-weight:600;
            text-decoration:none;
        }

        .login-link a:hover{
            text-decoration:underline;
        }
    </style>
</head>
<body>

<div class="register-wrapper">

    <h2>Register Auto Servis</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/register">
        @csrf

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi password" required>
        </div>

        <button type="submit">Daftar</button>
    </form>

    <div class="login-link">
        Sudah punya akun? <a href="/login">Login</a>
    </div>

</div>

</body>
</html>