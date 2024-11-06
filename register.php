<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">              
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
        }

       
        .navbar {
            background-color: rgba(0, 123, 255, 0.8);
            transition: background-color 0.3s ease;
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            color: #ff5722 !important;
        }

       
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(230, 247, 255, 0.8));
            border-radius: 15px;
            padding: 2rem;
        }

       
        .form-label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
            box-shadow: none;
            border: 2px solid #007bff;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 86, 179, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

       
        .footer {
            background-color: #007bff;
            color: white;
            padding: 1.5rem 0;
            text-align: center;
            font-size: 14px;
        }

        .footer p {
            margin: 0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .card-body {
                padding: 1.5rem;
            }

            .btn-primary {
                width: 100%;
                padding: 14px;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">
        <a href="register.php" class="btn btn-outline-danger m-1">DAFTAR</a>
        <a href="login.php" class="btn btn-outline-danger m-1">MASUK</a>
      </div>
    </div>
  </div>
</nav>


<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold">Daftar Akun Baru</h4>
                    </div>
                    <form action="config/aksi_register.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="namalengkap">Nama Lengkap</label>
                            <input type="text" name="namalengkap" id="namalengkap" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                        </div>
                        <div class="d-grid mt-4">
                            <button class="btn btn-primary" type="submit" name="kirim">DAFTAR</button>
                        </div>
                    </form>
                    <hr>
                    <p class="text-center">Sudah Punya Akun? <a href="login.php" class="text-primary">Login Disini!</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2024 | UKK RPL | FANJI</p>
</footer>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>             