<?php
require "../../config/config.php";

$id = $_GET['id'];
$peminjaman = queryReadData("SELECT * FROM peminjaman WHERE id_peminjaman = $id")[0];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_buku = $_POST['id_buku'];
    $npm = $_POST['npm'];
    $tgl_peminjaman = $_POST['tgl_peminjaman'];
    $tgl_pengembalian = $_POST['tgl_pengembalian'];

    if (updatePeminjaman($id, $id_buku, $npm, $tgl_peminjaman, $tgl_pengembalian)) {
        echo "<script>alert('Peminjaman berhasil diupdate'); window.location.href='peminjamanBuku.php';</script>";
    } else {
        echo "<script>alert('Peminjaman gagal diupdate'); window.location.href='editPeminjaman.php?id=$id';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>Edit Peminjaman || admin</title>
    <style>
      body {
          background-color: rgb(197, 197, 241);
      }
      .bg-purple {
          background-color: #6a0dad !important;
      }
      .btn-kembali {
      background-color: rgb(113, 113, 193); 
      color: white; 
    }
    .btn-kembali:hover {
      background-color: rgb(170, 166, 199);
      color: white; 
    }
    .btn-update {
      background-color: rgb(158, 158, 209);
      border-color:rgb(158, 158, 209);
      color: white;
    }
    .btn-update:hover {
      background-color: rgb(150, 150, 209);
      border-color:rgb(150, 150, 209);
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
        
        <a class="btn btn-tertiary" href="../dasboardAdmin.php">Dashboard</a>
      </div>
    </nav>

    <div class="container mt-5 flex-grow-1 pt-5 mb-5">
      <div class="mt-5">
        <h2>Edit Peminjaman</h2>
        <form method="post">
          <div class="mb-3">
            <label for="id_buku" class="form-label">Id Buku</label>
            <input type="text" class="form-control" id="id_buku" name="id_buku" value="<?= $peminjaman['id_buku']; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="npm" class="form-label">NPM</label>
            <input type="text" class="form-control" id="npm" name="npm" value="<?= $peminjaman['npm']; ?>">
          </div>
          <div class="mb-3">
            <label for="tgl_peminjaman" class="form-label">Tanggal Peminjaman</label>
            <input type="date" class="form-control" id="tgl_peminjaman" name="tgl_peminjaman" value="<?= $peminjaman['tgl_peminjaman']; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="tgl_pengembalian" class="form-label">Tanggal Pengembalian</label>
            <input type="date" class="form-control" id="tgl_pengembalian" name="tgl_pengembalian" value="<?= $peminjaman['tgl_pengembalian']; ?>" required>
          </div>
          <button type="submit" class="btn btn-primary btn-update">Update</button>
          <a href="peminjamanBuku.php" class="btn btn-secondary btn-kembali">Kembali</a>
        </form>
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