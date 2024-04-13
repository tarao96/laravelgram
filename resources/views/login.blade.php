<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/login.css'])
    <title>Larvelgram | Login</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="card-title">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="email" class="form-input" placeholder="Email" name="email" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" placeholder="Password" name="password" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="checkbox" />
                        <label for="remember" class="remember-label">ログイン状態を保持する</label>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
