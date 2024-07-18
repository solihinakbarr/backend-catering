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

if (isset($_POST['btnConfirm'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $queryConfirm = mysqli_query($conn, "UPDATE orders SET status='$status' WHERE order_id='$order_id'");

    header("location: ./onproses/?confirm-success");
}

if (isset($_POST['btnCancel'])) {
    $order_id = $_POST['order_id'];

    $queryCancel = mysqli_query($conn, "DELETE FROM orders WHERE order_id='$order_id'");

    header("location: ./?cancel-success");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMA Catering | Pesanan</title>
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
                            <a href="#" class="nav-link active"><i class="fa fa-edit me-1"></i> Pesanan</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="../laporan/" class="nav-link"><i class="fa fa-file-text-o me-1"></i> Laporan</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="../testimoni/" class="nav-link"><i class="fa fa-quote-right me-1"></i>
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
                <span class="fs-3 text-white">> Pesanan</span>
            </main>
            <!-- Content -->
            <div class="col-md-10 ms-sm-auto col-lg-10 px-md-4 main-content content-section">
                <a href="./onproses/" class="btn btn-primary mb-3 me-1"><i class="fa fa-history"></i> Pesanan
                    dalam Proses</a>
                <?php
                if (isset($_GET['cancel-success'])) {
                ?>
                    <div class="alert alert-success alert-dismissible d-flex align-items-center fade show" role="alert">
                        <svg class="bi bi-check-circle-fill me-2" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                        <div>
                            <b>Berhasil</b> membatalkan pesanan
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>
                <div class="card">
                    <div class="card-body" style="background-color: #E0E0E0;">
                        <!-- tabel untuk menampilkan pesanan -->
                        <div class="table-responsive">
                            <table class="table table-sm table-hover bg-light">
                                <thead class="bg-primary text-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">No.Telp</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Tanggal Mulai</th>
                                        <th scope="col">Tanggal Selesai</th>
                                        <th scope="col">Pilihan Menu</th>
                                        <th scope="col">Minimal Order</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Order</th>
                                        <th scope="col">Tindakan</th>
                                    </tr>
                                </thead>
                                <?php
                                function formatRupiah($hargaMenu)
                                {
                                    return 'Rp' . number_format($hargaMenu, 0, ',', '.');
                                }

                                $no = 1;
                                $query = mysqli_query($conn, "SELECT * FROM orders INNER JOIN menu ON menu.id = orders.menu_id WHERE status='Pending' ORDER BY created_at DESC");
                                $row = mysqli_num_rows($query);
                                if ($row == null) {
                                ?>
                                    <tbody class="table-group-divider">
                                        <tr>
                                            <td colspan="14">Tidak ada data</td>
                                        </tr>
                                    </tbody>
                                    <?php
                                } else {
                                    while ($data = mysqli_fetch_array($query)) {
                                        $totalQty = $data['min_order'] * $data['quantity'];
                                        $totalPrice = $data['price'] * $data['quantity'];
                                    ?>
                                        <tbody class="table-group-divider">
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['name'] ?></td>
                                                <td><?= $data['phone_number'] ?></td>
                                                <td><?= $data['address'] ?></td>
                                                <td><?= $data['start_date'] ?></td>
                                                <td><?= $data['end_date'] ?></td>
                                                <td><?= $data['title'] ?></td>
                                                <td><?= $data['min_order'] ?> <?= $data['unit'] ?></td>
                                                <td><?= formatRupiah($data['price']) ?></td>
                                                <td><?= $data['quantity'] ?></td>
                                                <td>
                                                    <?= formatRupiah($data['total_price']) ?></td>
                                                <td><button class="btn btn-warning text-white btn-sm" disabled><?= $data['status'] ?></button></td>
                                                <td><?= $data['created_at'] ?></td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <form onclick="return confirm('Konfirmasi pesanan ini?')" action="" method="POST">
                                                            <input type="hidden" name="order_id" value="<?= $data['order_id'] ?>">
                                                            <input type="hidden" name="status" value="Proses">
                                                            <button type="submit" name="btnConfirm" class="btn btn-success"><i class="fa fa-check"></i>
                                                            </button>
                                                        </form>
                                                        <form onclick="return confirm('Apakah anda yakin ingin membatalkan pesanan ini?')" action="" method="POST">
                                                            <input type="hidden" name="order_id" value="<?= $data['order_id'] ?>">
                                                            <button type="submit" name="btnCancel" class="btn btn-danger"><i class="fa fa-remove"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
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