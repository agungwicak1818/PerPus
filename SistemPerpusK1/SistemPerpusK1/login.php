<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
$koneksi = mysqli_connect("localhost", "root", "", "db_perpusk1");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi, "SELECT * FROM tb_anggota WHERE nim = '$username'");

    // cek username
    if (mysqli_num_rows($data) === 1) {

        $row = mysqli_fetch_array($data);
        if ($password == $row["password"]) {
            if ($row['status'] == "Admin") {
                // set session
                $_SESSION["login"] = true;
                header("Location: index.php");
                exit;
            } else {
                $_SESSION["login"] = true;
                $_SESSION["username"] = $username;
                header("Location: halaman_anggota/index.php");
                exit;
            }
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PerpusK1</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="main-login">
            <div class="login">
                <h2>Login</h2>
                <div class="login-salah">
                    <?php if (isset($error)) : ?>
                        <p>username / password salah</p>
                    <?php endif; ?>
                </div>
                <div class="login-grub">

                    <form action="" method="post">
                        <div class="login-box">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username">
                        </div>
                        <div class="login-box">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="login-box">
                            <button type="submit" name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>