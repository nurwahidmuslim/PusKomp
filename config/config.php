<?php
$host = "localhost";
$username = "root";
$password = "";
$database_name = "perpus";
$connection = mysqli_connect($host, $username, $password, $database_name);

// === FUNCTION KHUSUS ADMIN START ===

// MENAMPILKAN DATA KATEGORI BUKU
function queryReadData($dataKategori) {
  global $connection;
  $result = mysqli_query($connection, $dataKategori);
  $items = [];
  while($item = mysqli_fetch_assoc($result)) {
    $items[] = $item;
  }     
  return $items;
}

// Menambahkan data buku 
function tambahBuku($dataBuku) {
  global $connection;
  
  $cover = upload();
  $idBuku = htmlspecialchars($dataBuku["id_buku"]);
  $kategoriBuku = $dataBuku["kategori"];
  $judulBuku = htmlspecialchars($dataBuku["judul"]);
  $pengarangBuku = htmlspecialchars($dataBuku["pengarang"]);
  $penerbitBuku = htmlspecialchars($dataBuku["penerbit"]);
  $tahunTerbit = $dataBuku["tahun_terbit"];
  $jumlahHalaman = $dataBuku["jumlah_halaman"];
  $deskripsiBuku = htmlspecialchars($dataBuku["buku_deskripsi"]);
  
  if(!$cover) {
    return 0;
  } 
  
  $queryInsertDataBuku = "INSERT INTO buku (cover, id_buku, kategori, judul, pengarang, penerbit, tahun_terbit, jumlah_halaman, buku_deskripsi) 
                          VALUES('$cover', '$idBuku', '$kategoriBuku', '$judulBuku', '$pengarangBuku', '$penerbitBuku', '$tahunTerbit', $jumlahHalaman, '$deskripsiBuku')";
  
  mysqli_query($connection, $queryInsertDataBuku);
  return mysqli_affected_rows($connection);
}

// Function upload gambar 
function upload() {
  $namaFile = $_FILES["cover"]["name"];
  $ukuranFile = $_FILES["cover"]["size"];
  $error = $_FILES["cover"]["error"];
  $tmpName = $_FILES["cover"]["tmp_name"];
  
  // cek apakah ada gambar yg diupload
  if($error === 4) {
    echo "<script>
    alert('Silahkan upload cover buku terlebih dahulu!')
    </script>";
    return 0;
  }
  
  // cek kesesuaian format gambar
  $allowedFormats = ['jpg', 'jpeg', 'png', 'svg', 'bmp', 'psd', 'tiff'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  
  if(!in_array($ekstensiGambar, $allowedFormats)) {
    echo "<script>
    alert('Format file tidak sesuai');
    </script>";
    return 0;
  }
  
  // batas ukuran file
  if($ukuranFile > 2000000) {
    echo "<script>
    alert('Ukuran file terlalu besar!');
    </script>";
    return 0;
  }
  
   //generate nama file baru, agar nama file tdk ada yg sama
  $namaFileBaru = uniqid() . "." . $ekstensiGambar;
  
  move_uploaded_file($tmpName, '../../imgDB/' . $namaFileBaru);
  return $namaFileBaru;
} 

// MENAMPILKAN SESUATU SESUAI DENGAN INPUTAN USER PADA * SEARCH ENGINE *
function search($keyword) {
  // search data buku
  $querySearch = "SELECT * FROM buku 
  WHERE
  judul LIKE '%$keyword%' OR
  kategori LIKE '%$keyword%'
  ";
  return queryReadData($querySearch);
  
  // search data pengembalian || member
  $dataPengembalian = "SELECT * FROM pengembalian 
  WHERE 
  id_pengembalian LIKE '%$keyword%' OR
  id_buku LIKE '%$keyword%' OR
  judul LIKE '%$keyword%' OR
  kategori LIKE '%$keyword%' OR
  npm LIKE '%$keyword%' OR
  nama LIKE '%$keyword%' OR
  tgl_pengembalian LIKE '%$keyword%' OR
  keterlambatan LIKE '%$keyword%' OR
  denda LIKE '%$keyword%'";
  return queryReadData($dataPengembalian);
}

function searchMember($keyword) {
   // search member terdaftar || admin
   $searchMember = "SELECT * FROM member WHERE 
   npm LIKE '%$keyword%' OR 
   nama LIKE '%$keyword%'
   ";
   return queryReadData($searchMember);
}

// DELETE DATA Buku
function delete($bukuId) {
  global $connection;
  $queryDeleteBuku = "DELETE FROM buku WHERE id_buku = '$bukuId'";
  mysqli_query($connection, $queryDeleteBuku);
  
  return mysqli_affected_rows($connection);
}

// UPDATE || EDIT DATA BUKU 
function updateBuku($dataBuku) {
  global $connection;

  $gambarLama = htmlspecialchars($dataBuku["coverLama"]);
  $idBuku = htmlspecialchars($dataBuku["id_buku"]);
  $kategoriBuku = $dataBuku["kategori"];
  $judulBuku = htmlspecialchars($dataBuku["judul"]);
  $pengarangBuku = htmlspecialchars($dataBuku["pengarang"]);
  $penerbitBuku = htmlspecialchars($dataBuku["penerbit"]);
  $tahunTerbit = $dataBuku["tahun_terbit"];
  $jumlahHalaman = $dataBuku["jumlah_halaman"];
  $deskripsiBuku = htmlspecialchars($dataBuku["buku_deskripsi"]);
  
  // pengecekan mengganti gambar || tidak
  if($_FILES["cover"]["error"] === 4) {
    $cover = $gambarLama;
  } else {
    $cover = upload();
    if (!$cover) {
      return 0;
    }
  }

  $queryUpdate = "UPDATE buku SET 
  cover = '$cover',
  kategori = '$kategoriBuku',
  judul = '$judulBuku',
  pengarang = '$pengarangBuku',
  penerbit = '$penerbitBuku',
  tahun_terbit = '$tahunTerbit',
  jumlah_halaman = $jumlahHalaman,
  buku_deskripsi = '$deskripsiBuku'
  WHERE id_buku = '$idBuku'";
  
  mysqli_query($connection, $queryUpdate);
  return mysqli_affected_rows($connection);
}

// Hapus member yang terdaftar
function deleteMember($npmMember) {
  global $connection;
  
  $deleteMember = "DELETE FROM member WHERE npm = $npmMember";
  mysqli_query($connection, $deleteMember);
  return mysqli_affected_rows($connection);
}

function updatePeminjaman($id, $id_buku, $npm, $tgl_peminjaman, $tgl_pengembalian) {
  global $connection;

  $updatePeminjaman = "UPDATE peminjaman SET id_buku = '$id_buku', npm = '$npm', tgl_peminjaman = '$tgl_peminjaman', tgl_pengembalian = '$tgl_pengembalian' WHERE id_peminjaman = $id";
  mysqli_query($connection, $updatePeminjaman);
  return mysqli_affected_rows($connection);
}

// Hapus history pengembalian data BUKU
function deleteDataPengembalian($idPengembalian) {
  global $connection;
  
  $deleteDataPengembalianBuku = "DELETE FROM pengembalian WHERE id_pengembalian = $idPengembalian";
  mysqli_query($connection, $deleteDataPengembalianBuku);
  return mysqli_affected_rows($connection);
}

// === FUNCTION KHUSUS ADMIN END ===

// === FUNCTION KHUSUS MEMBER START ===
// Peminjaman BUKU
function pinjamBuku($dataBuku) {
  global $connection;
  
  $idBuku = $dataBuku["id_buku"];
  $npm = $dataBuku["npm"];
  $tglPinjam = $dataBuku["tgl_peminjaman"];
  $tglKembali = $dataBuku["tgl_pengembalian"];

  // cek apakah user memiliki denda 
  $cekDenda = mysqli_query($connection, "SELECT denda FROM pengembalian WHERE npm = $npm AND denda > 0");
  if(mysqli_num_rows($cekDenda) > 0) {
    $item = mysqli_fetch_assoc($cekDenda);
    $jumlahDenda = $item["denda"];
    if($jumlahDenda > 0) {
       echo "<script>
       alert('Anda belum melunasi denda, silahkan lakukan pembayaran terlebih dahulu !');
       </script>";
       return 0;
    }
  }

  // cek batas user meminjam buku berdasarkan npm
  $npmResult = mysqli_query($connection, "SELECT COUNT(*) AS jumlahPinjam FROM peminjaman WHERE npm = $npm");
  $row = mysqli_fetch_assoc($npmResult);
  if ($row["jumlahPinjam"] >= 2) {
    echo "<script>
    alert('Anda sudah meminjam 2 buku, Harap kembalikan dahulu buku yg anda pinjam!');
    </script>";
    return 0;
  }
  
  $queryPinjam = "INSERT INTO peminjaman (id_buku, npm, tgl_peminjaman, tgl_pengembalian) VALUES ('$idBuku', '$npm', '$tglPinjam', '$tglKembali')";
  mysqli_query($connection, $queryPinjam);
  return mysqli_affected_rows($connection);
}

// Pengembalian BUKU
function pengembalian($dataBuku) {
  global $connection;
  
  // Variabel pengembalian
  $idPeminjaman = $dataBuku["id_peminjaman"];
  $idBuku = $dataBuku["id_buku"];
  $npm = $dataBuku["npm"];
  $tenggatPengembalian = $dataBuku["tgl_pengembalian"];
  $bukuKembali = $dataBuku["buku_kembali"];
  $keterlambatan = $dataBuku["keterlambatan"];
  $denda = $dataBuku["denda"];
  
  // Start transaction
  mysqli_begin_transaction($connection);
  
  try {
    // Alert if book is returned late
    if($bukuKembali > $tenggatPengembalian) {
      echo "<script>
      alert('Anda terlambat mengembalikan buku, harap bayar denda sesuai dengan jumlah yang ditentukan!');
      </script>";
    }

    // Delete borrowing record
    $hapusDataPeminjam = "DELETE FROM peminjaman WHERE id_peminjaman = $idPeminjaman";
    if (!mysqli_query($connection, $hapusDataPeminjam)) {
      throw new Exception('Gagal menghapus data peminjaman: ' . mysqli_error($connection));
    }

    // Insert return record
    $queryPengembalian = "INSERT INTO pengembalian (id_peminjaman, id_buku, npm, buku_kembali, keterlambatan, denda) VALUES ('$idPeminjaman', '$idBuku', '$npm', '$bukuKembali', '$keterlambatan', '$denda')";
    if (!mysqli_query($connection, $queryPengembalian)) {
      throw new Exception('Gagal memasukkan data pengembalian: ' . mysqli_error($connection));
    }

    // Commit transaction
    mysqli_commit($connection);

    echo "<script>
    alert('Terimakasih telah mengembalikan buku!');
    </script>";
    return true;
  } catch (Exception $e) {
    // Rollback transaction if any query fails
    mysqli_rollback($connection);
    
    echo "<script>
    alert('Buku gagal dikembalikan: " . $e->getMessage() . "');
    </script>";
    return false;
  }
}


function bayarDenda($data) {
  global $connection;
  $idPengembalian = $data["id_pengembalian"];
  $jmlDenda = $data["denda"];
  $jmlDibayar = $data["bayarDenda"];
  $calculate = $jmlDenda - $jmlDibayar;
  
  $bayarDenda = "UPDATE pengembalian SET denda = $calculate WHERE id_pengembalian = $idPengembalian";
  mysqli_query($connection, $bayarDenda);
  return mysqli_affected_rows($connection);
}

// === FUNCTION KHUSUS MEMBER END ===
?>
