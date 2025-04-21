<!DOCTYPE html>
<html>
<head>
    <title>Daftar ke APK</title>
    <link rel="stylesheet" href="login.css?v=<?= time(); ?>" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js?v=<?= time(); ?>"></script> 
</head>
<body>
    <div class="container">
        <div class="login-box">
            <form id="daftar-form" method="POST">
                <h3>Pendaftaran Akun</h3>
                <div id="message" style="margin-bottom: 15px; color: red;"></div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukan Nama" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukan Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukan Password" required>
                </div>
                <div class="form-group">
                    <button type="button" id="daftar-btn">Daftar User</button>
                </div>
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
