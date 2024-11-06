<?php
    session_start();
    require_once("koneksi.php");
    $role= $_SESSION['role'];

    $fotoid = $_GET['fotoid'];
    $userid = $_SESSION['userid'];

    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

    if(mysqli_num_rows($ceksuka) == 1) {
        while($row = mysqli_fetch_array($ceksuka)) {
            $likeid = $row['likeid'];
            $query = mysqli_query($koneksi, "DELETE FROM likefoto WHERE likeid='$likeid'");

            if ($role == 'admin') {
                echo "<script>
                alert('Data Berhasil Disimpan!');
                location.href='../admin/index.php';
                </script>";
            
            }else {
                echo "<script>
                alert('Data Berhasil Disimpan!');
                location.href='../user/index.php';
                </script>";
            }
        }
    } else {
        $tanggalike = date('Y-m-d');
        $query = "INSERT INTO likefoto (fotoid, userid, tanggallike) VALUES ('$fotoid', '$userid', '$tanggalike')";
        $sql = mysqli_query($koneksi, $query);
    
        if ($role == 'admin') {
            echo "<script>
            alert('Data Berhasil Disimpan!');
            location.href='../admin/index.php';
            </script>";
        
        }else {
            echo "<script>
            alert('Data Berhasil Disimpan!');
            location.href='../user/index.php';
            </script>";
        }
    }
?>