<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM pasien WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Dashboard Pasien</title>
        </head>
    <body>

        <h2>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

        <a href="input_data.php">Input Data Pasien</a> |
        <a href="logout.php">Logout</a>

        <br><br>

        <h3>Data Pasien Anda</h3>


        <?php if (mysqli_num_rows($result) > 0): ?>

            <table border="1" cellpadding="8">
    <tr bgcolor="#cccccc">
        <th>ID</th>
        <th>Nama Pasien</th>
        <th>Keluhan</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['nama_pasien']); ?></td>
        <td><?php echo htmlspecialchars($row['keluhan']); ?></td>
    </tr>
    <?php endwhile; ?>

</table>

<?php else: ?>

<p><b>Belum ada data pasien.</b> Silakan tambah data pasien baru.</p>

<?php endif; ?>

</body>
</html>