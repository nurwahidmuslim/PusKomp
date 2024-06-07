<?php 
require "../../config/config.php";
$idBuku = $_GET["id"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Detail Buku || Member</title>
     <style>
      body {
          background-color: rgb(197, 197, 241);
      }
      .bg-purple {
        background-color: #6a0dad !important;
    }
    .btn-batal {
      background-color: rgb(113, 113, 193); 
      color: white; 
    }
    .btn-batal:hover {
      background-color: rgb(170, 166, 199);
      color: white; 
    }
    .btn-pinjam {
      background-color: rgb(158, 158, 209);
      color: white;
    }
    .btn-pinjam:hover {
      background-color: rgb(158, 158, 209);
      color: white;
    }
    </style>
  </head>
  <body class="d-flex flex-column min-vh-100">
    <nav class="navbar fixed-top bg-body-tertiary shadow-sm">
      <div class="container-fluid p-3">
        <a class="navbar-brand" href="#">
          <img src="../../assets/logoNav.png" alt="logo" width="120px">
        </a>
        
        <a class="btn btn-tertiary" href="../dashboardMember.php">Dashboard</a>
      </div>
    </nav>
    
    <div class="container mt-5 flex-grow-1 pt-5 mb-5">
      <h2 class="mt-5">Detail Buku</h2>
      <div class="d-flex justify-content-center">
      <div class="card" style="width: 18rem;">
        <?php foreach ($query as $item) : ?>
      <img src="../../imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="250px">
      <div class="card-body">
        <h5 class="card-title"><?= $item["judul"]; ?></h5>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Id Buku : <?= $item["id_buku"]; ?></li>
        <li class="list-group-item">Kategori : <?= $item["kategori"]; ?></li>
        <li class="list-group-item">Pengarang : <?= $item["pengarang"]; ?></li>
        <li class="list-group-item">Penerbit : <?= $item["penerbit"]; ?></li>
        <li class="list-group-item">Tahun terbit : <?= $item["tahun_terbit"]; ?></li>
        <li class="list-group-item">Jumlah halaman : <?= $item["jumlah_halaman"]; ?></li>
        <li class="list-group-item">Deskripsi buku : <?= $item["buku_deskripsi"]; ?></li>
      </ul>
      <?php endforeach; ?>
      <div class="card-body">
        <a href="daftarBuku.php" class="btn btn-danger btn-batal">Batal</a>
        <a href="../formPeminjaman/pinjamBuku.php?id=<?= $item["id_buku"]; ?>" class="btn btn-success btn-pinjam">Pinjam</a>
        </div>
        </div>
      </div>
      </div>
  
      <footer class="shadow-lg bg-subtle p-3 mt-auto">
        <div class="container-fluid d-flex justify-content-center">
          <p class="mt-2"><span class="text-primary">Ilmu Komputer Universitas Lampung</span> © 2024</p>
        </div>
      </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>