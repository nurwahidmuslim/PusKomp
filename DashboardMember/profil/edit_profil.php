<?php
session_start();
require "../../loginSystem/connect.php";

if (!isset($_SESSION["signIn"])) {
    header("Location: ../sign/member/sign_in.php");
    exit;
}

// Retrieve npm from session
$npm = $_SESSION['member']['npm'];

// Fetch current user data
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_tlp = $_POST['no_tlp'];
    $foto = $user['foto'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileSize = $_FILES['foto']['size'];
        $fileType = $_FILES['foto']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = $npm . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../../foto_member/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $foto = 'foto_member/' . $newFileName;
            } else {
                echo "<script>alert('There was an error moving the uploaded file.');</script>";
            }
        } else {
            echo "<script>alert('Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions) . "');</script>";
        }
    }

    $update_sql = "UPDATE member SET nama = ?, jenis_kelamin = ?, no_tlp = ?, foto = ? WHERE npm = ?";
    $update_stmt = $connect->prepare($update_sql);
    $update_stmt->bind_param("sssss", $nama, $jenis_kelamin, $no_tlp, $foto, $npm);

    if ($update_stmt->execute()) {
        $_SESSION['member']['nama'] = $nama;  
        $_SESSION['member']['foto'] = $foto; 
        echo "<script>
                alert('Profile updated successfully!');
                window.location.href = 'profil.php';
              </script>";
    } else {
        echo "<script>
                alert('Profile update failed!');
              </script>";
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
    <title>Edit Profile || Member</title>
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
                <img src="<?php echo '../../' . htmlspecialchars($user['foto']); ?>" alt="Profile Image" class="profile-img mb-3">
                <h1 class="fw-bold">Edit Profile</h1>
                <hr>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="npm" class="form-label fw-semibold">NPM:</label>
                        <input type="text" class="form-control" id="npm" value="<?php echo htmlspecialchars($user['npm']); ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label for="nama" class="form-label fw-semibold">Nama Lengkap:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jenis_kelamin" class="form-label fw-semibold">Gender:</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki" <?php echo $user['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php echo $user['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="no_tlp" class="form-label fw-semibold">No Telepon:</label>
                        <input type="text" class="form-control" id="no_tlp" name="no_tlp" value="<?php echo htmlspecialchars($user['no_tlp']); ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="foto" class="form-label fw-semibold">Upload Photo:</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="profil.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>