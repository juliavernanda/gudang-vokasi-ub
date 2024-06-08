<?php
header("Content-type: application/vnd.ms-excel");

// membuat nama file ekspor "export-to-excel.xls"
header("Content-Disposition: attachment; filename=data barang.xls");

include '../../config/conn.php';
?>

<table id="dataList" class="table table-striped table-no-bordered table-hover dataTables" cellspacing="0" width="100%" style="width:100%">
    <thead class="bold">
    <tr>
        <th class="disabled-sorting">ID</th>
        <th>Kode Barang</th>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Satuan</th>
    </tr>
    </thead>
    <!-- {{$no = 1}} -->
    <tbody>
    <?php
    $no = 1;
    //tampilkan tabel mahasiswa_ilkom
    $result=mysqli_query($conn,'SELECT * FROM sisa_stok');
    while ($row=mysqli_fetch_assoc($result))
    {
        echo '<tr>';
        echo '<td>'.$no++.'</td>';
        echo '<td>'.$row["kode"].'</td>';
        echo '<td>'.$row["nama"].'</td>';
        if($row["sisa_stok"] <= 0 || $row["sisa_stok"] == null){
            echo '<td>0</td>';
        }else{
            echo '<td>'.$row["sisa_stok"].'</td>';
        }
        echo '<td>'.$row["satuan"].'</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>