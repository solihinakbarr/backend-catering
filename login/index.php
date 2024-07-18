<?php
define('BASHPATH', dirname(__FILE__));
include_once("./proses/koneksi.php");

session_start();

if (isset($_POST['btnlogin'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE (username='$username' OR email='$username') AND password='$password'");
    $ceklogin = mysqli_num_rows($query);
    if ($ceklogin == null) {
        header("location: ./?login-failed");
    } else {
        $_SESSION['login'] = true;
        header("location: ./admin/?login-success");
    }
}

if (isset($_SESSION['login'])) {
    header("location: ./admin/");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMA Catering | Login Admin</title>
    <link rel="stylesheet" href="./assets/style/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="stylesheet" href="./assets/style/cdn/css/font-awesome.min.css">
    <link rel="shortcut icon" href="./assets/img/icon_tama-catering_bgrounded.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container-fluid bg-primary">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-lg-6 d-flex justify-content-center align-items-center poppins-bold">
                <img class="img-fluid" width="400px" src="./assets/img/icon_tama-catering.png" alt="img-catering">
            </div>
            <div class="col-lg-6 mb-lg-0 mb-5 poppins-regular">
                <form action="" method="POST">
                    <div class="col-lg-8 mb-lg-4 mb-3">
                        <div class="form-text fs-3 text-white">Login Admin</div>
                    </div>
                    <?php
                    if (isset($_GET['login-failed'])) {
                    ?>
                    <div class="col-lg-8 mb-lg-4 mb-3">
                        <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show"
                            role="alert">
                            <svg class="bi bi-exclamation-triangle-fill me-2" width="1em" height="1em"
                                viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <div>
                                <b>Harap periksa</b> username atau password anda!
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <?php
                    } else if (isset($_GET['forbidden-access'])) {
                    ?>
                    <div class="col-lg-8 mb-lg-4 mb-3">
                        <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show"
                            role="alert">
                            <svg class="bi bi-exclamation-triangle-fill me-2" width="1em" height="1em"
                                viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>
                            <div>
                                <b>Akses dilarang</b> harus login terlebih dahulu!
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <?php
                    } else if (isset($_GET['logout-success'])) {
                    ?>
                    <div class="col-lg-8 mb-lg-4 mb-3">
                        <div class="alert alert-success alert-dismissible d-flex align-items-center fade show"
                            role="alert">
                            <svg class="bi bi-check-circle-fill me-2" width="1em" height="1em" viewBox="0 0 16 16"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>
                            <div>
                                <b>Berhasil</b> logout
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="col-lg-8 mb-lg-4 mb-3 d-flex">
                        <i class="fa fa-user align-items-center justify-content-center d-flex px-2 me-2 bg-light"
                            style="border-radius: 5px;"></i>
                        <input type="text" name="username" placeholder="Username or Email" class="form-control"
                            autofocus>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-lg-8 mb-lg-4 mb-3 d-flex">
                        <i class="fa fa-unlock-alt align-items-center justify-content-center d-flex px-2 me-2 bg-light"
                            style="border-radius: 5px;"></i>
                        <input type="password" name="password" placeholder="Password" class="form-control" autofocus>
                        <div class="form-text"></div>
                    </div>
                    <button type="submit" name="btnlogin" class="btn btn-info text-white px-5">SIGN IN</button>
                </form>
            </div>
        </div>
    </div>
    <script src="./assets/style/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>