<?php 
require "../../config/config.php"; 
$dataDenda = queryReadData("SELECT pengembalian.id_pengembalian, pengembalian.id_buku, buku.judul, pengembalian.npm, member.nama, pengembalian.buku_kembali, pengembalian.keterlambatan, pengembalian.denda
FROM pengembalian
INNER JOIN buku ON pengembalian.id_buku = buku.id_buku
INNER JOIN member ON pengembalian.npm = member.npm
WHERE pengembalian.denda > 0");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Kelola denda buku || admin</title>
     <style>
      body {
          background-color: rgb(197, 197, 241);
      }
      .bg-purple {
        background-color: #6a0dad !important;
    }
    </style>
  </head>
  <body class="d-flex flex-column min-vh-100">
    <nav class="navbar fixed-top bg-body-tertiary shadow-sm">
      <div class="container-fluid p-3">
        <a class="navbar-brand" href="#">
          <img src="../../assets/logoNav.png" alt="logo" width="120px">
        </a>
        
        <a class="btn btn-tertiary" href="../dashboardAdmin.php">Dashboard</a>
      </div>
    </nav>
    
    <div class="container mt-5 flex-grow-1 pt-5 mb-5">
      <div class="mt-5">
        <caption>List of denda</caption>
          <div class="table-responsive mt-3">
    <table class="table table-striped table-hover">
      <thead class="text-center">
      <tr>
        <th class="bg-purple text-light">id buku</th>
        <th class="bg-purple text-light">Judul buku</th>
        <th class="bg-purple text-light">NPM</th>
        <th class="bg-purple text-light">Nama</th>
        <th class="bg-purple text-light">Hari pengembalian</th>
        <th class="bg-purple text-light">Keterlambatan</th>
        <th class="bg-purple text-light">Denda</th>
      </tr>
      </thead>
        <?php foreach ($dataDenda as $item) : ?>
      <tr>
        <td><?= $item["id_buku"]; ?></td>
        <td><?= $item["judul"]; ?></td>
        <td><?= $item["npm"]; ?></td>
        <td><?= $item["nama"]; ?></td>
        <td><?= $item["buku_kembali"]; ?></td>
        <td><?= $item["keterlambatan"]; ?></td>
        <td><?= $item["denda"]; ?></td>
      </tr>
        <?php endforeach; ?>
    </table>
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