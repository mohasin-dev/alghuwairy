<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; background: #f5f7fb; }
        .login-card { width: 100%; max-width: 430px; border: 0; border-radius: 16px; box-shadow: 0 18px 45px rgba(15, 23, 42, .1); }
        .brand { color: #063b24; }
        .btn-admin { background: #063b24; color: #fff; }
        .btn-admin:hover { background: #0b5d3b; color: #fff; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center p-3">
    <main class="card login-card p-4 p-md-5">
        <div class="text-center mb-4">
            <h1 class="h3 brand fw-bold">Admin Panel</h1>
            <p class="text-muted mb-0">Sign in to manage the website.</p>
        </div>

        <form method="post" action="{{ route('admin.login.store') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="email">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-check mb-4">
                <input id="remember" name="remember" type="checkbox" class="form-check-input" value="1">
                <label for="remember" class="form-check-label">Remember me</label>
            </div>
            <button type="submit" class="btn btn-admin w-100 py-2">Sign in</button>
        </form>
    </main>
</body>
</html>
