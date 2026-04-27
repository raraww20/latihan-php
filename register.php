<?php
include 'config.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            // Redirect otomatis ke login setelah 2 detik
            echo "<script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location = 'login.php';
                  </script>";
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<h2>Form Sign Up</h2>
<hr>

<?php if ($error): ?>
    <p style="color: red;"><b><?php echo $error; ?></b></p>
<?php endif; ?>

<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Sign up</button>
</form>

<p>Sudah punya akun? <a href="login.php">Login</a></p>