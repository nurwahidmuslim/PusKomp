<?php
session_start();

if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../../sign/member/sign_in.php");
  exit;
}

require "../../config/config.php";
// query read semua buku
$buku = queryReadData("SELECT * FROM buku");
//search buku
if(isset($_POST["search"]) ) {
  $buku = search($_POST["keyword"]);
}
//read buku informatika
if(isset($_POST["informatika"]) ) {
$buku = queryReadData("SELECT * FROM buku WHERE kategori = 'informatika'");
}
//read buku bisnis
if(isset($_POST["bisnis"]) ) {
$buku = queryReadData("SELECT * FROM buku WHERE kategori = 'bisnis'");
}
//read buku filsafat
if(isset($_POST["filsafat"]) ) {
$buku = queryReadData("SELECT * FROM buku WHERE kategori = 'filsafat'");
}
//read buku novel
if(isset($_POST["novel"]) ) {
$buku = queryReadData("SELECT * FROM buku WHERE kategori = 'novel'");
}
//read buku sains
if(isset($_POST["sains"]) ) {
$buku = queryReadData("SELECT * FROM buku WHERE kategori = 'sains'");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Daftar Buku || Member</title>
  </head>
  <style>
      body {
          background-color: rgb(197, 197, 241);
      }
    .layout-card-custom {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1.5rem;
    }
    .btn-kategori {
      background-color: rgb(113, 113, 193); 
      color: white; 
    }
    .btn-kategori:hover {
      background-color: rgb(170, 166, 199);
      color: white; 
    }
    .btn-detail {
      background-color: rgb(158, 158, 209);
      color: white;
    }
    .btn-detail:hover {
      background-color: rgb(150, 150, 209);
      color: white;
    }

  </style>
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
       <!--Btn filter data kategori buku-->
      <div class="d-flex gap-2 mt-5 justify-content-center">
      <form action="" method="post">
        <div class="layout-card-custom">
         <button class="btn btn-primary btn-kategori" type="submit">Semua</button>
         <button type="submit" name="Pemrograman" class="btn btn-outline-primary btn-kategori">Pemrograman</button>
         <button type="submit" name="Basis Data" class="btn btn-outline-primary btn-kategori">Basis Data</button>
         <button type="submit" name="Robotik & IoT" class="btn btn-outline-primary btn-kategori">Robotik & IoT</button>
         <button type="submit" name="Jaringan & Keamanan" class="btn btn-outline-primary btn-kategori">Jaringan & Keamanan</button>
         <button type="submit" name="Kecerdasan Buatan" class="btn btn-outline-primary btn-kategori">Kecerdasan Buatan</button>
         <button type="submit" name="Pengembangan Perangkat Lunak" class="btn btn-outline-primary btn-kategori">Pengembangan Perangkat Lunak</button>
         <button type="submit" name="Sistem Operasi" class="btn btn-outline-primary btn-kategori">Sistem Operasi</button>
         </div>
        </form>
       </div>
       
      <div class="d-flex justify-content-center">
        <form action="" method="post" class="mt-3 mb-3">
          <div class="input-group mb-3">
            <input class="border p-2 rounded rounded-end-0 bg-tertiary" type="text" name="keyword" id="keyword" placeholder="Cari Buku...">
            <button class="border border-start-0 bg-light rounded rounded-start-0" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
      </div>

      
      <!--Card buku-->
    <div class="layout-card-custom">
       <?php foreach ($buku as $item) : ?>
       <div class="card" style="width: 15rem;">
         <img src="../../imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="250px">
         <div class="card-body">
           <h5 class="card-title"><?= $item["judul"]; ?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Kategori : <?= $item["kategori"]; ?></li>
          </ul>
        <div class="card-body">
          <a class="btn btn-success btn-detail" href="detailBuku.php?id=<?= $item["id_buku"]; ?>">Detail</a>
          </div>
        </div>
       <?php endforeach; ?>
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