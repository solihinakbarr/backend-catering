<?php
define('BASHPATH', dirname(__FILE__));
include_once("../../../proses/koneksi.php");

session_start();
if (!$_SESSION['login']) {
    header("location: ../../../?forbidden-access");
}

if (isset($_POST['btnlogout'])) {
    session_destroy();
    header("location: ../../../?logout-success");
}

if (isset($_POST['btnsimpan'])) {
    $title = $_POST['title'];
    $min_order = $_POST['min_order'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $detail = $_POST['detail'];

    // upload gambar
    $gambar = $_FILES['image']['name'];
    $ukuranGambar = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmp = $_FILES['image']['tmp_name'];

    // Validasi Gambar yang Di Upload
    // cek ini gambar atau bukan
    $imgValid = ['jpg', 'jpeg', 'png'];
    $img = explode('.', $gambar);
    $img = strtolower(end($img));
    if (!in_array($img, $imgValid)) {
        header("location: ./?error-is-not-an-image");
        return false;
    }

    // cek ukuran file gambar jika tidak boleh > 3MB 
    if ($ukuranGambar > 3000000) {
        header("location: ./?image-size-too-large-error");
        return false;
    }

    // buat nama file gambar
    $nameOfImg = uniqid();
    $nameOfImg .= '.';
    $nameOfImg .= $img;

    $query = mysqli_query($conn, "INSERT INTO menu (id, title, min_order, unit, price, description, detail, image) VALUES ('', '$title', '$min_order', '$unit', '$price', '$description', '$detail', '$nameOfImg')");

    // pindahkan gambar ke dalam folder
    $location = '../../../assets/img/img-menu/' . $nameOfImg;
    move_uploaded_file($tmp, $location);

    // pindahkan gambar ke dalam folder front end
    $locationFE = '../../../../../backend/public/images/'.$nameOfImg;
    copy($location, $locationFE);

    header("location: ../../menu/?add-menu-success");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMA Catering | Add Menu</title>
    <link rel="stylesheet" href="../../../assets/style/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/style/style.css">
    <link rel="shortcut icon" href="../../../assets/img/icon_tama-catering_bgrounded.png" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/style/cdn/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- jquery untuk preview image -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav class="navbar d-md-none d-flex justify-content-between align-items-center sticky-top">
        <div>
            <img src="../../../assets/img/icon_admin.png" alt="nav-logo" class="logo me-1">
            <span class="fw-lighter">TAMA Catering</span>
        </div>
        <div class="hamburger" onclick="toggleSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm0-4a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm0-4a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11z" />
            </svg>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 d-md-block bg-primary sidebar">
                <div class="position-sticky">
                    <div class="mb-4 d-flex align-items-center justify-content-center">
                        <img src="../../../assets/img/icon_admin.png" alt="nav-logo" class="img-fluid d-none d-md-block"
                            style="width: 90%;">
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item border-bottom">
                            <a href="../../../admin/" class="nav-link"><i class="fa fa-dashboard me-1"></i>
                                Dashboard</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="../../menu/" class="nav-link active"><i class="fa fa-cutlery me-1"></i> Menu</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="../../pesanan/" class="nav-link"><i class="fa fa-edit me-1"></i> Pesanan</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="../../laporan/" class="nav-link"><i class="fa fa-file-text-o me-1"></i>
                                Laporan</a>
                        </li>
                        <li class="nav-item border-bottom">
                            <a href="../../testimoni/" class="nav-link"><i class="fa fa-quote-right me-1"></i>
                                Testimoni</a>
                        </li>
                        <li>
                            <form class="nav-link" onclick="return confirm('Apakah anda yakin ingin logout?')" action=""
                                method="POST">
                                <button name="btnlogout" class="btn btn-danger px-5"> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Title Content -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 main-content bg-dark sticky-lg-top">
                <span class="fs-3 text-white">> Menu > Add</span>
            </main>
            <!-- Content -->
            <div class="col-md-10 ms-sm-auto col-lg-10 px-md-4 main-content content-section">
                <a href="../../menu/" class="btn btn-success mb-3"><i class="fa fa-arrow-left"></i> Kembali</a>
                <?php
                if (isset($_GET['error-is-not-an-image'])) {
                ?>
                <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
                    <svg class="bi bi-exclamation-triangle-fill me-2" width="1em" height="1em" viewBox="0 0 16 16"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <div>
                        Yang anda upload <b>bukanlah gambar</b>!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                } else if (isset($_GET['image-size-too-large-error'])) {
                ?>
                <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show" role="alert">
                    <svg class="bi bi-exclamation-triangle-fill me-2" width="1em" height="1em" viewBox="0 0 16 16"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <div>
                        Size gambar <b>terlalu besar, maksimal 3MB</b>!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                }
                ?>
                <div class="card">
                    <div class="card-body" style="background-color: #E0E0E0;">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nama Menu</label>
                                <div class="col-sm-8">
                                    <input type="text" name="title" class="form-control" placeholder="Masukan nama menu"
                                        required autofocus>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Minimal Pesanan</label>
                                <div class="col-sm-6">
                                    <input type="number" min="0" name="min_order" class="form-control"
                                        placeholder="Masukan minimal pesanan" required>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="unit" class="form-control" value="Porsi" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-8">
                                    <input type="number" min="0" name="price" class="form-control"
                                        placeholder="Masukan harga menu" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description"
                                        placeholder="Masukan deskripsi menu" required></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Detail</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="detail" placeholder="Masukan detail menu"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-4">
                                    <input type="file" name="image" class="form-control" onchange="upload(this)"
                                        required>
                                    <div class="form-text">Upload gambar hanya .jpg .jpeg .png</div>
                                    <div class="form-text">Maksimal size 3MB</div>
                                </div>
                                <!-- preview image -->
                                <div class="col-sm-4">
                                    <img id="imageMenu" class="img-thumbnail img-fluid">
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <div class="mb-3 row">
                            <div class="col-sm-6">
                                <button type="submit" name="btnsimpan" class="btn btn-primary"><i
                                        class="fa fa-download"></i>
                                    Simpan Menu</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('show');
    }

    // preview gambar
    function upload(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imageMenu').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
    <script src="../../../assets/style/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>