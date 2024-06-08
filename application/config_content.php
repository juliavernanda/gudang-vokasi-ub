<?php
$page = (isset($_GET['page']))? $_GET['page'] : '';
    switch($page){
        case 'dasbor': // $page == home (jika isi dari $page adalah home)
            include "./admin/index.php"; // load file home.php yang ada di folder views
            break;

        case 'barang_masuk': // $page == home (jika isi dari $page adalah home)
            include "./admin/barang_masuk/index.php";  // load file home.php yang ada di folder views
            break;
//
        case 'barang_keluar': // $page == home (jika isi dari $page adalah home)
            include "./admin/barang_keluar/index.php"; // load file home.php yang ada di folder views
            break;

//        default: // Ini untuk set default jika isi dari $page tidak ada pada 3 kondisi diatas
//            include "./application/admin/barang_masuk/index.php";
}
