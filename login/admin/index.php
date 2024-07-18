<?php
define('BASHPATH', dirname(__FILE__));
include_once("../proses/koneksi.php");

session_start();
if (!$_SESSION['login']) {
    header("location: ../?forbidden-access");
}

if (isset($_POST['btnlogout'])) {
    session_destroy();
    header("location: ../?logout-success");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMA Catering | Dashboard</title>
    <link rel="stylesheet" href="../assets/style/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style/style.css">
    <link rel="shortcut icon" href="../assets/img/icon_tama-catering_bgrounded.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/style/cdn/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar d-md-none d-flex justify-content-between align-items-center sticky-top">
        <div>
            <img src="../assets/img/icon_admin.png" alt="nav-logo" class="logo me-1">
            <span class="fw-lighter">TAMA Catering</span>
        </div>
        <div class="hamburger" onclick="toggleSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm0-4a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm0-4a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11z" />
            </svg>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 d-md-block bg-primary sidebar">
                <div class="position-sticky">
                    <div class="mb-4 d-flex align-items-center justify-content-center">
                        <img src="../assets/img/icon_admin.png" alt="nav-logo" class="img-fluid d-none d-md-block" style="width: 90%;">
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item border-bottom">
                            <a href="#" class="nav-link active"><i class="fa fa-dashboard me-1"></i> Dashboard</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="./menu/" class="nav-link"><i class="fa fa-cutlery me-1"></i> Menu</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="./pesanan/" class="nav-link"><i class="fa fa-edit me-1"></i> Pesanan</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="./laporan/" class="nav-link"><i class="fa fa-file-text-o me-1"></i> Laporan</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="./testimoni/" class="nav-link"><i class="fa fa-quote-right me-1"></i>
                                Testimoni</a>
                        </li>
                        <li>
                            <form class="nav-link" onclick="return confirm('Apakah anda yakin ingin logout?')" action="" method="POST">
                                <button name="btnlogout" class="btn btn-danger px-5"> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Title Content -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 main-content bg-dark sticky-lg-top">
                <span class="fs-3 text-white">> Dashboard</span>
            </main>
            <!-- Content -->
            <div class="col-md-10 ms-sm-auto col-lg-10 px-md-4 main-content content-section">
                <div class="alert alert-dark" role="alert">
                    <span class="fs-3 fw-lighter">SELAMAT DATANG, Admin!</span>
                </div>
                <div class="card d-lg-flex flex-lg-row justify-content-lg-start align-content-lg-start align-items-lg-start gap-lg-4 d-flex flex-column justify-content-center align-content-center align-items-center" style="background-color: #E0E0E0;">
                    <div class="card w-50 border-dark mb-3" style="max-width: 18rem; flex: 1; margin: 1rem;">
                        <div class="card-body text-dark d-flex flex-column">
                            <?php
                            $dataMenu = mysqli_query($conn, "SELECT * FROM menu");
                            $jumlahDataMenu = mysqli_num_rows($dataMenu);
                            $dataPesanan = mysqli_query($conn, "SELECT * FROM orders WHERE status='Pending'");
                            $jumlahDataPesanan = mysqli_num_rows($dataPesanan);
                            ?>
                            <h5 class="card-title"><i class="fa fa-cutlery me-1"></i>
                                <span class="bg-dark text-light px-2" style="border-radius: 25px;"><?= $jumlahDataMenu ?></span>
                                Menu
                            </h5>
                            <p class="card-text">catering yang ditawarkan</p>
                            <a style="text-decoration: none;" href="./menu/">
                                <div class="mt-auto card-footer bg-dark text-white border-0 detail-button"><i class="fa fa-eye"></i> Lihat
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="card w-50 border-dark mb-3" style="max-width: 18rem; flex: 1; margin: 1rem;">
                        <div class="card-body text-dark d-flex flex-column">
                            <h5 class="card-title"><i class="fa fa-edit me-1"></i> <span class="bg-dark text-light px-2" style="border-radius: 25px;"><?= $jumlahDataPesanan ?></span> Pesanan</h5>
                            <p class="card-text">pelanggan <br>baru</p>
                            <a style="text-decoration: none;" href="./pesanan/">
                                <div class="mt-auto card-footer bg-dark text-white border-0 detail-button"><i class="fa fa-eye"></i> Lihat
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="card w-50 border-dark mb-3" style="max-width: 18rem; flex: 1; margin: 1rem;">
                        <div class="card-body text-dark d-flex flex-column">
                            <h5 class="card-title"><i class="fa fa-file-text-o me-1"></i> Laporan</h5>
                            <p class="card-text">pesanan dan pendapatan</p>
                            <a style="text-decoration: none;" href="./laporan/">
                                <div class="mt-auto card-footer bg-dark text-white border-0 detail-button"><i class="fa fa-eye"></i> Lihat
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="card w-50 border-dark mb-3" style="max-width: 18rem; flex: 1; margin: 1rem;">
                        <div class="card-body text-dark d-flex flex-column">
                            <h5 class="card-title"><i class="fa fa-quote-right me-1"></i> Testimoni</h5>
                            <p class="card-text">pelanggan <br>catering</p>
                            <a style="text-decoration: none;" href="./testimoni/">
                                <div class="mt-auto card-footer bg-dark text-white border-0 detail-button"><i class="fa fa-eye"></i> Lihat
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
    <script src="../assets/style/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>