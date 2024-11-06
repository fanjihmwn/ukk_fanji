<?php 
session_start();
require_once ('../config/koneksi.php');
$userid = $_SESSION['userid'];
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda Belum Login');
    location.href='../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <style>
      
        body {
            background-color: #e9ecef; /* Light gray background */
            color: #333;
        }
        .navbar {
            background: linear-gradient(90deg, #007bff, #6610f2); /* Gradient background */
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: white !important;
        }
        .card {
            border: none;
            transition: transform 0.2s;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            background-color: #fff; /* White background for cards */
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.3);
        }
        .card-footer {
            background-color: #f8f9fa; /* Light footer for cards */
        }
        .modal-content {
            border-radius: 10px;
            background: #fff; /* White modal background */
        }
        .footer {
            background-color: rgba(255, 255, 255, 0.9);
        }
        .badge {
            margin: 2px;
        }
        .text-primary {
            color: #007bff !important;
        }
        .text-danger {
            color: #dc3545 !important;
        }
        .text-success {
            color: #28a745 !important;
        }
        .comment-input {
            background-color: #f1f1f1; /* Light gray background for comment input */
            border: none;
            border-radius: 5px;
        }
        .comment-input:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav mx-auto">
        <a href="home.php" class="nav-link">Home</a>
        <a href="album.php" class="nav-link">Album</a>
        <a href="foto.php" class="nav-link">Foto</a>
      </div>
      <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">LOGOUT</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <div class="row">
    <?php 
    $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
    while ($data = mysqli_fetch_array($query)) {
    ?>
    <div class="col-md-3 mt-2">
      <div class="card">
        <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid']; ?>">
          <img src="../assets/img/<?php echo $data['lokasifile']; ?>" class="card-img-top" title="<?php echo $data['judulfoto']; ?>" style="height: 12rem; border-top-left-radius: 10px; border-top-right-radius: 10px;">
          <div class="card-footer text-center">
            <?php 
            $fotoid = $data['fotoid'];
            $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
            if (mysqli_num_rows($ceksuka) == 1) { ?>
              <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']; ?>" class="text-danger"><i class="fa fa-heart m-1"></i></a>
            <?php } else { ?>
              <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']; ?>" class="text-dark"><i class="fa-regular fa-heart m-1"></i></a>
            <?php }
            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
            echo mysqli_num_rows($like) . ' Suka';
            ?>
            <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid']; ?>" class="text-dark"><i class="fa-regular fa-comment"></i></a>
            <?php
            $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
            echo mysqli_num_rows($jmlkomen) . ' Komentar';
            ?>
          </div>
        </a>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="komentar<?php echo $data['fotoid']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-8">
                  <img src="../assets/img/<?php echo $data['lokasifile']; ?>" class="card-img-top" title="<?php echo $data['judulfoto']; ?>">
                </div>
                <div class="col-md-4">
                  <div class="m-2">
                    <div class="overflow-auto">
                      <div class="sticky-top">
                        <strong><?php echo $data['judulfoto']; ?></strong><br>
                        <span class="badge bg-secondary"><?php echo $data['namalengkap']; ?></span>
                        <span class="badge bg-secondary"><?php echo $data['tanggalunggah']; ?></span>
                        <span class="badge bg-primary"><?php echo $data['namaalbum']; ?></span>
                      </div>
                      <hr>
                      <p><?php echo $data['deskripsifoto']; ?></p>
                      <hr>
                      <?php
                      $fotoid = $data['fotoid'];
                      $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                      while($row = mysqli_fetch_array($komentar)) {
                      ?>
                      <p>
                        <strong><?php echo $row['namalengkap']; ?></strong>
                        <?php echo $row['isikomentar']; ?>
                      </p>
                      <?php } ?>
                      <hr>
                      <div class="sticky-bottom">
                        <form action="../config/proses_komentar.php" method="POST">
                          <div class="input-group">
                            <input type="hidden" name="fotoid" value="<?php echo $data['fotoid']; ?>">
                            <input type="text" name="isikomentar" class="form-control comment-input" placeholder="Tambah Komentar" required>
                            <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">KIRIM</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

<footer class="footer d-flex justify-content-center border-top mt-3 p-3 bg-light">
    <p>&copy; UKK RPL 2024 | FANJI</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
