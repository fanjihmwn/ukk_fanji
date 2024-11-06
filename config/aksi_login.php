<?php

session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']); // Make sure to handle password securely in production

$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    $data = mysqli_fetch_array($sql);
    $_SESSION['username'] = $data['username'];
    $_SESSION['userid'] = $data['userid'];
    $_SESSION['role'] = $data['role']; // Store user role in session
    $_SESSION['status'] = 'login';
    
    // Redirect based on role
    if ($data['role'] == 'admin') {
        echo "<script>
            alert('Login berhasil sebagai admin');
            location.href='../admin/index.php';
        </script>";
    } else {
        echo "<script>
            alert('Login berhasil sebagai user');
            location.href='../user/index.php'; // Adjust this URL for regular users
        </script>";
    }
} else {
    echo "<script>
        alert('Username atau password salah');
        location.href='../login.php';
    </script>";
}

?>
