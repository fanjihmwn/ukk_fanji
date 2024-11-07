<?php 
session_start();
include '../config/koneksi.php';

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
    <style>
        body {
            background-color: #f8f9fa; 
            color: #343a40; 
        }
        .navbar {
            background-color: #007bff; /* Biru */
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: white !important; 
        }
        .card {
            margin-top: 20px; 
            border: 2px solid #007bff; /* Border biru */
            border-radius: 10px; 
        }
        .card-header {
            background-color: #007bff; /* Biru */
            color: white; 
        }
        .btn-primary {
            background-color: #007bff; /* Biru */
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Biru gelap saat hover */
        }
        .btn-danger {
            background-color: #dc3545; /* Merah untuk tombol hapus */
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333; /* Merah gelap saat hover */
        }
        footer {
            background-color: #e9ecef; 
            color: #343a40; 
            padding: 10px 0; 
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
      <div class="navbar-nav me-auto">
        <a href="home.php" class="nav-link">Home</a>
        <a href="album.php" class="nav-link">Album</a>
        <a href="foto.php" class="nav-link">Foto</a>
      </div>
      <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">KELUAR</a>
    </div>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Tambah Foto</div>
                <div class="card-body">
                    <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                        <label class="form-label">Judul Foto</label>
                        <input type="text" name="judulfoto" class="form-control" required>
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsifoto" required></textarea>
                        <label class="form-label">Album</label>
                        <select class="form-control" name="albumid" required>
                            <?php
                            $sql_album = mysqli_query($koneksi, "SELECT * FROM album");
                            while($data_album = mysqli_fetch_array($sql_album)) {?> 
                                <option value="<?php echo $data_album['albumid'] ?>"><?php echo $data_album['namaalbum'] ?></option>
                            <?php } ?>
                        </select>
                        <label class="form-label">File</label>
                        <input type="file" class="form-control" name="lokasifile" required>
                        <button type="submit" class="btn btn-primary mt-2" name="tambah">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Galeri Foto</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Judul Foto</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Akun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $userid = $_SESSION['userid'];
                            $query = "SELECT * from foto INNER JOIN user ON foto.userid=user.userid";
                            $sql = mysqli_query($koneksi,$query);
                            while($data = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100"></td>
                                <td><?php echo $data['judulfoto'] ?></td>
                                <td><?php echo $data['deskripsifoto'] ?></td>
                                <td><?php echo $data['tanggalunggah'] ?></td>
                                <td><?php echo $data['namalengkap'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo$data['fotoid'] ?>">Edit</button>
                                    
                                    <div class="modal fade" id="edit<?php echo$data['fotoid'] ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                        <label class="form-label">Judul Foto</label>
                                                        <input type="text" name="judulfoto" value="<?php echo $data['judulfoto'] ?>" class="form-control" required>
                                                        <label class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsifoto" required><?php echo $data['deskripsifoto'] ?></textarea>
                                                        <label class="form-label">Album</label>
                                                        <select class="form-control" name="albumid">
                                                            <?php
                                                            $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                                                            while($data_album = mysqli_fetch_array($sql_album)) { ?> 
                                                                <option <?php if ($data_album['albumid'] == $data['albumid']) { ?> selected="selected" <?php } ?> value="<?php echo $data_album['albumid'] ?>"><?php echo $data_album['namaalbum'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label class="form-label">Foto</label>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <label class="form-label">Ganti File</label>
                                                                <input type="file" class="form-control" name="lokasifile">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo$data['fotoid'] ?>">Hapus</button>
                                    <!-- Hapus Modal -->
                                    <div class="modal fade" id="hapus<?php echo$data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../config/aksi_foto.php" method="POST">
                                                        <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                        Apakah anda yakin akan menghapus data <strong><?php echo $data['judulfoto'] ?></strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="hapus" class="btn btn-primary">Hapus Data</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; UKK RPL 2024 | FANJI</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
