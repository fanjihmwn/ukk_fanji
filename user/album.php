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
            color: #333; 
        }
        .navbar {
            background: linear-gradient(90deg, #007bff, #6610f2);
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: white !important; 
        }
        .card {
            border: none;
            border-radius: 10px; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.02); 
        }
        .card-header {
            background-color: #007bff;
            color: white; /
            font-weight: bold; 
        }
        .btn-primary {
            background-color: #28a745; 
            border-color: #28a745;
        }
        .btn-danger {
            background-color: #dc3545; 
            border-color: #dc3545;
        }
        .table thead {
            background-color: #343a40; 
            color: white; 
        }
        .modal-header {
            background-color: #007bff; 
            color: white; 
        }
        .modal-content {
            border-radius: 10px; 
        }
        footer {
            background-color: #f1f1f1; 
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

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-2">
                <div class="card-header">Tambah Album</div>
                <div class="card-body">
                    <form action="../config/aksi_album.php" method="POST">
                        <label class="form-label">Nama Album</label>
                        <input type="text" name="namaalbum" class="form-control" required>
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" required></textarea>
                        <button type="submit" class="btn btn-primary mt-2" name="tambah">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-header">Data Album</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Album</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $userid = $_SESSION['userid'];
                            $sql = mysqli_query($koneksi,"SELECT * FROM album WHERE userid='$userid'");
                            while($data = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data['namaalbum'] ?></td>
                                <td><?php echo $data['deskripsi'] ?></td>
                                <td><?php echo $data['tanggalbuat'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['albumid'] ?>">Edit</button>

                                    <div class="modal fade" id="edit<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../config/aksi_album.php" method="POST">
                                                        <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                                                        <label class="form-label">Nama Album</label>
                                                        <input type="text" name="namaalbum" value="<?php echo $data['namaalbum'] ?>" class="form-control" required>
                                                        <label class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" name="deskripsi" required><?php echo $data['deskripsi'] ?></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['albumid'] ?>">Hapus</button>

                                    <div class="modal fade" id="hapus<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../config/aksi_album.php" method="POST">
                                                        <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                                                        Apakah Anda yakin ingin menghapus data <strong><?php echo $data['namaalbum'] ?></strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
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
