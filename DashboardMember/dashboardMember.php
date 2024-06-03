<?php
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../sign/member/sign_in.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>Member Dashboard</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar fixed-top bg-body-tertiary shadow-sm">
        <div class="container-fluid p-3">
            <a class="navbar-brand" href="#">
                <img src="../assets/logoNav.png" alt="logo" width="120px">
            </a>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo htmlspecialchars($_SESSION['member']['foto']); ?>" alt="memberLogo" width="40px" class="rounded-circle">
                </button>
                <ul style="margin-left: -7rem;" class="dropdown-menu position-absolute mt-2 p-2">
                    <li>
                        <a class="dropdown-item text-center" href="#">
                            <img src="<?php echo htmlspecialchars($_SESSION['member']['foto']); ?>" alt="memberLogo" width="30px" class="rounded-circle">
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item text-center text-secondary" href="#">
                            <span class="text-capitalize"><?php echo $_SESSION['member']['nama']; ?></span>
                        </a>
                        <a class="dropdown-item text-center mb-2" href="#">Member</a>
                    </li>
                    <li>
                        <a class="dropdown-item text-center p-2 bg-primary text-light rounded mb-2" href="profil/profil.php">Profil <i class="fa-solid fa-user"></i></a>
                    </li>
                    <li>
                        <a class="dropdown-item text-center p-2 bg-danger text-light rounded" href="signOut.php">Sign Out <i class="fa-solid fa-right-to-bracket"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 flex-grow-1 pt-5 mb-5">
        <?php
        // Mendapatkan tanggal dan waktu saat ini
        $date = date('Y-m-d H:i:s'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)
        // Mendapatkan hari dalam format teks (e.g., Senin, Selasa, ...)
        $day = date('l');
        // Mendapatkan tanggal dalam format 1 hingga 31
        $dayOfMonth = date('d');
        // Mendapatkan bulan dalam format teks (e.g., Januari, Februari, ...)
        $month = date('F');
        // Mendapatkan tahun dalam format 4 digit (e.g., 2023)
        $year = date('Y');
        ?>

        <h1 class="mt-5 fw-bold">Dashboard - <span class="fs-4 text-secondary"><?php echo $day . " " . $dayOfMonth . " " . $month . " " . $year; ?></span></h1>
        <div class="alert alert-success" role="alert">Selamat datang member - <span class="text-capitalize fw-bold"><?php echo $_SESSION['member']['nama']; ?></span> di Dashboard PusKomp</div>

        <div class="mt-3 p-3">
            <div class="mt-4 p-3">
                <div class="row gap-2">
                    <div class="col bg-dark p-5 rounded">
                        <a class="text-center text-decoration-none fs-2" href="buku/daftarBuku.php" style="color: #FF9800;">Daftar Buku</a>
                    </div>
                    <div class="col bg-dark p-5 rounded">
                        <a class="text-center text-decoration-none fs-2" href="formPeminjaman/TransaksiPeminjaman.php" style="color: #FF9800;">Peminjaman</a>
                    </div>
                </div>
                <div class="row gap-2 mt-2">
                    <div class="col bg-dark p-5 rounded">
                        <a class="text-center text-decoration-none fs-2" href="formPeminjaman/TransaksiPengembalian.php" style="color: #FF9800;">Pengembalian</a>
                    </div>
                    <div class="col bg-dark p-5 rounded">
                        <a class="text-center text-decoration-none fs-2" href="formPeminjaman/TransaksiDenda.php" style="color: #FF9800;">Denda</a>
                    </div>
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
