<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="login.css?v=<?= time(); ?>" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js?v=<?= time(); ?>"></script>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <form id="reset-form" method="POST">
                <h3>Reset Password</h3>

                <div class="form-group">
                    <label for="username">Username</label>
                    <!-- Isi dengan username dari localStorage jika ada -->
                    <input type="text" id="username" name="username" placeholder="Masukkan Username">
                    <div id="username-error" class="error-message" style="display: none; color: red; font-size: 0.9em;"></div>
                </div>

                <div class="form-group">
                    <label for="new-password">Password Baru</label>
                    <input type="password" id="new-password" name="new-password" placeholder="Masukkan Password Baru" required>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Konfirmasi Password Baru</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Konfirmasi Password Baru" required>
                    <div id="password-error" class="error-message" style="display: none; color: red; font-size: 0.9em;"></div>
                </div>

                <div class="form-group">
                    <button type="submit" id="reset-btn">Reset Password</button>
                </div>

                <p>Sudah ingat? <a href="login.php">Login di sini</a></p>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Ambil username dari localStorage dan set ke kolom input
            const savedUsername = localStorage.getItem("savedUsername");
            if (savedUsername) {
                $('#username').val(savedUsername);  // Isi kolom username dengan yang disimpan di localStorage
            }
        });
    </script>
</body>
</html>
