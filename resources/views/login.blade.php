<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Mulish:wght@400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            height: 100vh;
            background: url('{{ asset("images/wallpaper padsi.jpg") }}') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="login-container" style="background-color: #D6EFFF; max-width: 400px; width: 100%; text-align: center; padding: 50px; border-radius: 10px; shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <h2 style="font-family: 'Playfair Display', sans-serif; margin-bottom: 25px; font-weight: bold; color: #000;">LOGIN</h2>
        <form method="POST" action="{{ route('login.custom') }}">
            @csrf
            <div class="mb-3" style="font-family: 'Fredoka', sans-serif; margin-bottom: 25px; font-weight: 700; color: #000;">
                <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan Email" required autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-3" style="font-family: 'Fredoka', sans-serif; margin-bottom: 25px; font-weight: 700; color: #000;">
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <button type="submit" class="mt-3 btn btn-primary" style="background-color: #fff; color: #000; padding: 10px 28px; font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; border-radius: 20px;">Login</button>
        </form>
    </div>
    </body>
</html>
