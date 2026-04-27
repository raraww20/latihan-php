<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pasien = $_POST['nama_pasien'];
    $keluhan = $_POST['keluhan'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO pasien (nama_pasien, keluhan, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nama_pasien, $keluhan, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan'); window.location='dashboard.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Form Input Data Pasien</h2>
<hr>

<form method="POST">
    <label>Nama Pasien:</label><br>
    <input type="text" name="nama_pasien" size="40" required><br><br>

    <label>Keluhan:</label><br>
    <textarea name="keluhan" rows="5" cols="40" required></textarea><br><br>

    <button type="submit">Simpan Data</button>
    <a href="dashboard.php">Kembali</a>
</form>