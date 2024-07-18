<?php
define('BASHPATH', dirname(__FILE__));
include_once("../../proses/koneksi.php");

session_start();
if (!$_SESSION['login']) {
    header("location: ../../?forbidden-access");
}

if (isset($_POST['btnlogout'])) {
    session_destroy();
    header("location: ../../?logout-success");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMA Catering | Testimoni Pelanggan</title>
    <link rel="stylesheet" href="../../assets/style/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/style/style.css">
    <link rel="shortcut icon" href="../../assets/img/icon_tama-catering_bgrounded.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/style/cdn/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar d-md-none d-flex justify-content-between align-items-center sticky-top">
        <div>
            <img src="../../assets/img/icon_admin.png" alt="nav-logo" class="logo me-1">
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
                        <img src="../../assets/img/icon_admin.png" alt="nav-logo" class="img-fluid d-none d-md-block" style="width: 90%;">
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item border-bottom">
                            <a href="../../admin/" class="nav-link"><i class="fa fa-dashboard me-1"></i>
                                Dashboard</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="../menu/" class="nav-link"><i class="fa fa-cutlery me-1"></i> Menu</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="../pesanan/" class="nav-link"><i class="fa fa-edit me-1"></i> Pesanan</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="../laporan/" class="nav-link"><i class="fa fa-file-text-o me-1"></i> Laporan</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="#" class="nav-link active"><i class="fa fa-quote-right me-1"></i>
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
                <span class="fs-3 text-white">> Testimoni Pelanggan</span>
            </main>
            <!-- Content -->
            <div class="col-md-10 ms-sm-auto col-lg-10 px-md-4 main-content content-section">
                <div class="card">
                    <div class="card-body" style="background-color: #E0E0E0;">
                        <!-- tabel untuk menampilkan testimoni dari pelanggan -->
                        <div class="table-responsive">
                            <table class="table table-hover bg-light">
                                <thead class="bg-primary text-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pelanggan</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Nama Keluarga</th>
                                      
                                    </tr>
                                </thead>
                                <?php
                                $no = 1;
                                $query = mysqli_query($conn, "SELECT * FROM testimoni");
                                $row = mysqli_num_rows($query);
                                if ($row == null) {
                                ?>
                                    <tbody class="table-group-divider">
                                        <tr>
                                            <td colspan="6">Tidak ada data</td>
                                        </tr>
                                    </tbody>
                                    <?php
                                } else {
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <tbody class="table-group-divider">
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['name'] ?></td>
                                                <td>
                                                    <?php
                                                    for ($i = 0; $i < $data['rate']; $i++) {
                                                        echo '<i class="fa fa-star"></i>';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $data['content'] ?></td>
                                                <td><?= $data['familyName'] ?></td>
                                             
                                            </tr>
                                        </tbody>
                                <?php
                                    }
                                }
                                ?>
                            </table>
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
    <script src="../../assets/style/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>