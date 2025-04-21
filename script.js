$(document).ready(function () {

    $('#daftar-btn').click(function () {
        const nama = $('#nama').val().trim();
        const username = $('#username').val().trim();
        const password = $('#password').val().trim();

        if (nama === '' || username === '' || password === '') {
            $('#message').css('color', 'red').html('Semua kolom harus diisi!');
            return;
        }

        if (/\s/.test(username)) {
            $('#message').css('color', 'red').html('Username tidak boleh mengandung spasi!');
            return; 
        }

        $('#daftar-btn').html('Memproses...').prop('disabled', true);

        $.ajax({
            url: 'daftar-handler.php',
            type: 'POST',
            data: { nama, username, password },
            dataType: 'json',
            success: function (response) {
                $('#daftar-btn').html('Daftar User').prop('disabled', false);

                if (response.status === 'success') {
                    alert(response.message);
                    window.location.href = 'login.php'; 
                } else {
                    $('#message').css('color', 'red').html(response.message);
                }
            },
            error: function () {
                $('#daftar-btn').html('Daftar User').prop('disabled', false);
                $('#message').css('color', 'red').html('Terjadi kesalahan, silakan coba lagi.');
            }
        });
    });

    $('#daftar-form').on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault(); 
            $('#daftar-btn').click(); 
        }
    });
});




$(document).ready(function () {

    $('#login-btn').click(function () {
        const username = $('#username').val().trim();
        const password = $('#password').val().trim();

        if (username === '' || password === '') {
            alert('Username dan Password tidak boleh kosong.');
            return;
        }

        $('#username').removeClass('input-error');
        $('#username-error').hide();
        $('#password').removeClass('input-error');
        $('#password-error').hide();

        $('#login-btn').html('Memproses...').prop('disabled', true);

        $.ajax({
            url: 'login-handler.php',
            type: 'POST',
            data: { username, password },
            dataType: 'json',
            success: function (response) {
                $('#login-btn').html('Login').prop('disabled', false);

                if (response.status === 'success') {
                    alert('Selamat datang, ' + response.name + '!');
                    window.location.href = response.redirect; // Redirect setelah login sukses
                } else {
                    // Jika username tidak ditemukan atau password salah
                    if (response.reason === 'username_not_found') {
                        $('#username').addClass('input-error');
                        $('#username-error')
                            .text('Username tidak terdaftar, silakan periksa kembali.')
                            .show();
                    } else {
                        $('#password').addClass('input-error').val(''); // Kosongkan password input
                        $('#password-error')
                            .html('Password salah atau tidak sesuai, silakan coba lagi. <a href="lupa-password.php">Reset Password</a>')
                            .show();
                    }
                }
            },
            error: function () {
                $('#login-btn').html('Login').prop('disabled', false);
                alert('Terjadi kesalahan, silakan coba lagi.');
            }
        });
    });
});







$(document).ready(function () {

    $('#reset-btn').click(function (e) {
        e.preventDefault();

        const username = $('#username').val().trim();
        const newPassword = $('#new-password').val().trim();
        const confirmPassword = $('#confirm-password').val().trim();

        // Reset error states
        $('#username').removeClass('input-error');
        $('#confirm-password').removeClass('input-error');
        $('#username-error').hide();
        $('#password-error').hide();

        // Validasi inputan
        if (username === '' || newPassword === '' || confirmPassword === '') {
            alert('Semua kolom harus diisi!');
            return;
        }

        // Validasi password baru dan konfirmasi password
        if (newPassword !== confirmPassword) {
            $('#password-error')
                .text('Password baru dan konfirmasi tidak cocok.')
                .show();
            $('#confirm-password').addClass('input-error');
            $('#confirm-password').val(''); // Mengosongkan input confirm password jika tidak cocok
            return;
        }

        // Nonaktifkan tombol dan ubah teks menjadi "Memproses..."
        $('#reset-btn').html('Memproses...').prop('disabled', true);

        $.ajax({
            url: 'reset-password-handler.php',
            type: 'POST',
            dataType: 'json',
            data: {
                username: username,
                'new-password': newPassword,
                'confirm-password': confirmPassword
            },
            success: function (res) {
                $('#reset-btn').html('Reset Password').prop('disabled', false);

                if (res.status === 'success') {
                    alert(res.message);
                    window.location.href = 'login.php';  // Redirect ke halaman login setelah berhasil reset
                } else {
                    if (res.field === 'confirm-password') {
                        $('#confirm-password').addClass('input-error');
                        $('#password-error').text(res.message).show();
                    } else if (res.message.includes('Username tidak ditemukan')) {
                        $('#username').addClass('input-error');
                        $('#username-error').text(res.message).show();
                    } else {
                        alert(res.message); // Tampilkan pesan kesalahan umum
                    }
                }
            },
            error: function () {
                $('#reset-btn').html('Reset Password').prop('disabled', false);
                alert('Terjadi kesalahan saat menghubungi server.');
            }
        });
    });
});






$(document).ready(function () {
    $('#logout-btn').click(function (event) {
        event.preventDefault();

        if (confirm('Apakah Anda yakin ingin keluar dari akun?')) {
            $.ajax({
                url: 'logout.php',
                type: 'POST',
                data: { action: 'logout' },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        localStorage.removeItem('savedUsername');
                        window.location.href = 'login.php';
                    } else {
                        alert('Logout gagal: ' + response.message);
                    }
                },
                error: function (xhr) {
                    console.error('Logout error:', xhr.responseText);
                    alert('Terjadi kesalahan saat logout.');
                }
            });
        }
    });
});
