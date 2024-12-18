<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin HerbAI</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style_log.css">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Login Admin HerbAI</h2>
        </div>
        <!-- resources/views/admin/login.blade.php -->
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf  <!-- Laravel CSRF Token -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <!-- Forgot Password Link -->
            <div class="mb-3">
                <a href="/forgot-password" class="forgot-password">Lupa Password?</a>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-login">Login</button>
            </div>
        </form>

    </div>

    <!-- Bootstrap JS (Optional, for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
