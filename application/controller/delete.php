<?php
// include database connection file
include_once("../../config/conn.php");
// Get id from URL to delete that user
    $id = $_GET['id'];
    $table = $_GET['table'];

// Delete user row from table based on given id
    $result = mysqli_query($conn, "DELETE FROM $table WHERE id=$id");

// After delete redirect to Home, so that latest user list will be displayed.
    if($table == "m_barang"){
        header("Location:./../index.php?page=dasbor");
    }else if($table == "t_barang_masuk"){
        header("Location:./../index.php?page=barang_masuk");
    }else if($table == "t_barang_keluar"){
        header("Location:./../index.php?page=barang_keluar");
    }
?>