<?php
define('BASHPATH', dirname(__FILE__));
include("../../../assets/fpdf/fpdf.php");
include_once("../../../proses/koneksi.php");

session_start();
if (!$_SESSION['login']) {
    header("location: ../../../?forbidden-access");
}

// Instance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 12);

function formatRupiah($hargaMenu)
{
    return 'Rp' . number_format($hargaMenu, 0, ',', '.');
}

$no = 1;
$totalPendapatan = 0; // Initialize total pendapatan

$query = mysqli_query($conn, "SELECT * FROM orders INNER JOIN menu ON menu.id = orders.menu_id WHERE status='Done' ORDER BY end_date DESC");
$row = mysqli_num_rows($query);
if ($row == null) {
    $pdf->Cell(270, 10, 'Tidak ada data untuk ditampilkan', 1, 1, 'C');
} else {
    // Judul laporan
    $pdf->Cell(270, 10, 'LAPORAN PESANAN - TAMA CATERING', 0, 1, 'C');

    // Header tabel
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Nama', 1, 0, 'C');
    $pdf->Cell(25, 7, 'No.Telp', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Alamat', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Tanggal Selesai', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Pilihan Menu', 1, 0, 'C');
    $pdf->Cell(20, 7, 'Min Order', 1, 0, 'C');
    $pdf->Cell(20, 7, 'Harga', 1, 0, 'C');
    $pdf->Cell(13, 7, 'Qty', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Total', 1, 1, 'C');

    $pdf->SetFont('Times', '', 10);
    while ($data = mysqli_fetch_array($query)) {
        $totalPendapatan += $data['total_price']; // Add to total pendapatan

        // Isi data tabel
        $pdf->Cell(10, 7, $no++, 1, 0, 'C');
        $pdf->Cell(30, 7, $data['name'], 1, 0, 'L');
        $pdf->Cell(25, 7, $data['phone_number'], 1, 0, 'C');
        $pdf->Cell(40, 7, $data['address'], 1, 0, 'L');
        $pdf->Cell(30, 7, $data['end_date'], 1, 0, 'L');
        $pdf->Cell(40, 7, $data['title'], 1, 0, 'L');
        $pdf->Cell(20, 7, $data['min_order'] . ' ' . $data['unit'], 1, 0, 'C');
        $pdf->Cell(20, 7, formatRupiah($data['price']), 1, 0, 'C');
        $pdf->Cell(13, 7, $data['quantity'], 1, 0, 'C');
        $pdf->Cell(40, 7,   formatRupiah($data['total_price']), 1, 1, 'C');
    }

    // Total pendapatan
    $pdf->SetFont('Times', 'B', 10);
    $pdf->Cell(228, 7, 'Total Pendapatan: ', 0, 0, 'R');
    $pdf->Cell(40, 7, formatRupiah($totalPendapatan), 0, 1, 'C');
}

$pdf->Output('laporan-pesanan-dan-pendapatan-tama-catering.pdf', 'I');
