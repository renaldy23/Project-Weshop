<?php  
session_start();

require 'function/helper.php';
require 'function/koneksi.php';

$barang_id=$_GET['barang_id'];
$keranjang=$_SESSION['keranjang'];

unset($keranjang[$barang_id]);

$_SESSION['keranjang']= $keranjang;

header("location: ".BASE_URL."index.php?page=keranjang");

?>