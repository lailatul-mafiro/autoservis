<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Bengkel Sumber Rezeki</title>
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

        .login-wrapper{
            width:420px;
            background:#ffffff;
            border-radius:16px;
            padding:40px;
            box-shadow:0 20px 50px rgba(0,0,0,0.25);
        }

        .logo{
            text-align:center;
            margin-bottom:25px;
        }

        .logo img{
            width:140px;
        }

        h2{
            text-align:center;
            color:#0f3c74;
            margin-bottom:25px;
            font-weight:800;
        }

        .form-group{
            margin-bottom:15px;
        }

        label{
            font-size:14px;
            font-weight:600;
            color:#333;
        }

        input{
            width:100%;
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

        .success{
            color:#2a9d8f;
            font-size:14px;
            margin-bottom:10px;
            text-align:center;
        }

        .register-link{
            text-align:center;
            margin-top:18px;
            font-size:14px;
        }

        .register-link a{
            color:#0f3c74;
            font-weight:600;
            text-decoration:none;
        }

        .register-link a:hover{
            text-decoration:underline;
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <h2>Login Auto Servis</h2>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit">Masuk</button>
    </form>

    <div class="register-link">
        Belum punya akun? <a href="/register">Daftar</a>
    </div>

</div>

</body>
</html>