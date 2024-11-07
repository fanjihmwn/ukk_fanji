<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Awal Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #111111, #5c0f0f); 
            font-family: 'Arial', sans-serif;
            color: white;
        }

        .navbar {
            background-color: #5c0f0f; 
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
        }

        .navbar-nav .nav-link:hover {
            color: #ffcc00 !important; 
        }

        .card {
            transition: transform 0.2s ease-in-out;
            border-radius: 10px;
            border: 1px solid #9e0000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
            background-color: #1d1d1d; 
        }

        .card:hover {
            transform: scale(1.05); 
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.4); 
        }

        .card-img-top {
            height: 20rem; 
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            background-color: #1d1d1d; 
            text-align: center;
            color: white; 
        }

        .card-footer {
            background-color: #5c0f0f; 
            text-align: center;
            padding: 10px;
            color: white; 
        }

        .btn-danger, .btn-primary {
            font-weight: bold;
        }

        .footer {
            background-color: #1d1d1d; 
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        .footer p {
            margin: 0;
        }

        .btn-danger {
            background-color: #e74a3b; 
            border: none;
        }

        .btn-danger:hover {
            background-color: #c0392b; 
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9; 
        }

        
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .col-md-3 {
            width: 24%;
            padding: 10px;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php">Tampilan Awal Galeri Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto"></div>
      <a href="register.php" class="btn btn-danger m-1">DAFTAR</a>
      <a href="login.php" class="btn btn-primary m-1">MASUK</a>
    </div>
  </div>
</nav>

<div class="container mt-3">
   
    <div class="text-center mb-5">
        <h1>Selamat Datang di Galeri Foto</h1>
    </div>

    <div class="row">
        <!-- Example photo cards -->       <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/god.jpg" class="card-img-top" alt="Gunung">
                
            </div>
        </div>
      
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/kk.jpg" class="card-img-top" alt="Laut">
               
            </div>
        </div>
      
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/mu.jpg" class="card-img-top" alt="Hutan">
               
            </div>
        </div>
   
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/dg.jpg" class="card-img-top" alt="Luar Angkasa">
               
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/rd.jpg" class="card-img-top" alt="Gurun">
             
            </div>
        </div>
    
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/bbp.jpg" class="card-img-top" alt="Salju">
            
            </div>
        </div>
     
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/mo.jpg" class="card-img-top" alt="Sunset">
             
            </div>
        </div>
 
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/mb.jpg" class="card-img-top" alt="Pantai">
               
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/sc.jpg" class="card-img-top" alt="Paris">
               
            </div>
        </div>
  
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/ssc.jpg" class="card-img-top" alt="Bunga">
              
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/kr.jpg" class="card-img-top" alt="Pemandangan">
                
            </div>
        </div>
      
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/su.jpg" class="card-img-top" alt="Bukit">
               
            </div>
        </div>

    </div>
</div>

<footer class="footer">
    <p>&copy; UKK RPL 2024 | FANJI</p>
  
</footer>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
