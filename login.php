<!DOCTYPE html>
<html>
<head>
    <title>Login ke APK</title>
    <link rel="stylesheet" href="login.css?v=<?= time(); ?>" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js?v=<?= time(); ?>"></script>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <form id="login-form" method="POST">
                <h3>Login Akun</h3>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
                    <div id="username-error" class="error-message" style="display: none; color: red; font-size: 0.9em;"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                    <div id="password-error" class="error-message" style="display: none; color: red; font-size: 0.9em;">
                        Password salah, silakan coba lagi.
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" id="login-btn">Login</button>
                </div>
                <p>Belum punya akun? <a href="daftar.php">Daftar</a></p>
            </form>
        </div>
    </div>
</body>
</html>
