<?php
define('BASHPATH', dirname(__FILE__));
include_once("../../../proses/koneksi.php");

session_start();
if (!$_SESSION['login']) {
    header("location: ../../../?forbidden-access");
}

$menu_id = $_GET['id'];

// menghapus gambar pada direktori/folder
$queryDel = mysqli_query($conn, "SELECT * FROM menu WHERE id='$menu_id'");
$result = mysqli_fetch_assoc($queryDel);
$location = '../../../assets/img/img-menu/' . $result['image'];
unlink($location);

// jika dihapus, unlink juga gambar yang berada pada folder front end
$locationFE = '../../../../../frontend/public/images/'.$result['image'];
unlink($locationFE);

$query = mysqli_query($conn, "DELETE FROM menu WHERE id='$menu_id'");

header("location: ../../menu/?delete-menu-success");
