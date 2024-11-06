<?php 
session_start();
require_once("../config/koneksi.php");
$userid = $_SESSION['userid'];

if($_SESSION['status'] != 'login') {
    echo "<script>
        alert('Anda belum login');
        location.href='../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
            color: #495057; /* Dark text color */
        }
        .navbar {
            background-color: #343a40; /* Dark navbar */
        }
        .navbar-brand, .navbar-nav .nav-link, .btn-primary {
            color: #ffffff !important; /* White text */
        }
        .navbar-nav .nav-link:hover {
            color: #ffc107 !important; /* Yellow on hover */
        }
        .btn-outline-primary {
            color: #007bff; /* Blue text */
            border-color: #007bff; /* Blue border */
        }
        .btn-outline-primary:hover {
            background-color: #007bff; /* Blue background on hover */
            color: #ffffff; /* White text on hover */
        }
        .card {
            border: none;
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Soft shadow */
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
        }
        .card-footer {
            background-color: #343a40; /* Dark footer for cards */
            color: white; /* White text in card footer */
        }
        .card-img-top {
            height: 12rem; /* Fixed height for images */
            object-fit: cover; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">Website Galeri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto">
                    <a href="home.php" class="nav-link">Home</a>
                    <a href="album.php" class="nav-link">Album</a>
                    <a href="foto.php" class="nav-link">Foto</a>
                </div>
                <a href="../config/aksi_logout.php" class="btn btn-primary m-1">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h4>Album:</h4>
        <a href="home.php" class="btn btn-outline-primary">Semua Foto</a>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
        while($row = mysqli_fetch_array($query)) { ?>
            <a href="home.php?albumid=<?php echo $row['albumid'] ?>" class="btn btn-outline-primary">
                <?php echo $row['namaalbum'] ?>
            </a>
        <?php } ?>

        <div class="row mt-3">
            <?php
            if(isset($_GET['albumid'])) {
                $albumid = $_GET['albumid'];
                $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid' AND albumid='$albumid'");
                while($data = mysqli_fetch_array($query)) { ?>
                    <div class="col-md-3 mt-2">
                        <div class="card mb-2">
                            <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top" title="<?php echo $data['judulfoto']?>">
                            <div class="card-footer text-center">
                                <a style="color: red"><i class="fa fa-heart"></i></a>
                                <?php
                                    $fotoid = $data['fotoid'];
                                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                    echo mysqli_num_rows($like) . ' Suka';
                                ?>
                                <a style="color: blue"><i class="fa fa-comment"></i></a>
                                <?php
                                    $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                                    echo mysqli_num_rows($jmlkomen) . ' Komentar';
                                ?>
                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
                while($data = mysqli_fetch_array($query)) { ?>
                    <div class="col-md-3 mt-2">
                        <div class="card">
                            <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top" title="<?php echo $data['judulfoto']?>">
                            <div class="card-footer text-center">
                                <a style="color: red"><i class="fa fa-heart"></i></a>
                                <?php 
                                    $fotoid = $data['fotoid'];
                                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                    echo mysqli_num_rows($like) . ' Suka';
                                ?>
                                <a style="color: blue"><i class="fa fa-comment"></i></a>
                                <?php
                                    $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                                    echo mysqli_num_rows($jmlkomen) . ' Komentar';
                                ?>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
    <footer class="footer d-flex justify-content-center border-top mt-3 p-3 bg-light">
    <p>&copy; UKK RPL 2024 | FANJI</p>
</footer>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
