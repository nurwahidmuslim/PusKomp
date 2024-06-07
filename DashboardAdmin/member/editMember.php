<?php
session_start();

if (!isset($_SESSION["signIn"])) {
    header("Location: ../../sign/admin/sign_in.php");
    exit;
}
require "../../config/config1.php";

$id = $_GET["id"];
$member = queryReadData("SELECT * FROM member WHERE npm = '$id'")[0];

if (isset($_POST["submit"])) {
    $npm = $_POST["npm"];
    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $no_tlp = $_POST["no_tlp"];
    $password = !empty($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : $member["password"]; // Hash new password if provided
    
    $query = "UPDATE member SET npm = '$npm', nama = '$nama', jenis_kelamin = '$jenis_kelamin', no_tlp = '$no_tlp', password = '$password' WHERE npm = '$id'";
    
    if (queryExecute($query)) {
        header("Location: member.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
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
    <title>Edit Member</title>
    <style>
    body {
        background-color: rgb(197, 197, 241);
    }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Member</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" class="form-control" id="npm" name="npm" value="<?= $member["npm"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $member["nama"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?= $member["jenis_kelamin"] == "Laki-laki" ? "selected" : ""; ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $member["jenis_kelamin"] == "Perempuan" ? "selected" : ""; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="no_tlp" class="form-label">No Telepon</label>
                <input type="text" class="form-control" id="no_tlp" name="no_tlp" value="<?= $member["no_tlp"]; ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="d-flex justify-content-between">
                <a href="member.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
