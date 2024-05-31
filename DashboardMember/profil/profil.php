<?php
session_start();
require "../../loginSystem/connect.php";

if (!isset($_SESSION["signIn"])) {
    header("Location: ../sign/member/sign_in.php");
    exit;
}

// Retrieve npm from session
$npm = $_SESSION['member']['npm'];

$sql = "SELECT npm, nama, jenis_kelamin, no_tlp, foto FROM member WHERE npm = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("s", $npm);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit;
}

// Set default profile image if not available
$profileImage = $user['foto'] ? '../../' . htmlspecialchars($user['foto']) : '../../assets/memberLogo.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>Profil || Member</title>
    <style>
        .card {
            border-radius: 15px;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        .bg-light-gradient {
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        }
    </style>
</head>
<body class="bg-light-gradient">
    <div class="container">
        <div class="card shadow p-4 mt-5 mb-5">
            <div class="text-center">
                <img src="<?php echo $profileImage; ?>" alt="Profile Image" class="profile-img mb-3">
                <h1 class="fw-bold">Profil</h1>
                <hr>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">NPM:</label>
                    <p class="form-control"><?php echo htmlspecialchars($user['npm']); ?></p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Lengkap:</label>
                    <p class="form-control"><?php echo htmlspecialchars($user['nama']); ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jenis Kelamin:</label>
                    <p class="form-control"><?php echo htmlspecialchars($user['jenis_kelamin']); ?></p>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">No Telepon:</label>
                    <p class="form-control"><?php echo htmlspecialchars($user['no_tlp']); ?></p>
                </div>
            </div>
            <div class="text-center">
                <a href="edit_profil.php" class="btn btn-primary">Edit Profil</a>
                <a href="../dashboardMember.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
