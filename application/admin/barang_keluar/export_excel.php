<?php
header("Content-type: application/vnd.ms-excel");

// membuat nama file ekspor "export-to-excel.xls"
header("Content-Disposition: attachment; filename=data barang keluar.xls");

include '../../../config/conn.php';
?>

<table id="dataList" class="table table-striped table-no-bordered table-hover dataTables" cellspacing="0" width="100%" style="width:100%">
    <thead class="bold">
    <tr>
        <th class="disabled-sorting">ID</th>
        <th>Kode Barang</th>
        <th>Nama</th>
        <th>Tanggal Masuk</th>
        <th>Satuan</th>
        <th>Jumlah</th>
    </tr>
    </thead>
    <!-- {{$no = 1}} -->
    <tbody>
    <?php
    $no = 1;
    //tampilkan tabel mahasiswa_ilkom
    $result=mysqli_query($conn,'SELECT * FROM m_barang INNER JOIN t_barang_keluar ON m_barang.id = t_barang_keluar.id_barang');
    while ($row=mysqli_fetch_assoc($result))
    {
        $id = $row["id"];
        echo '<tr>';
        echo '<td>'.$no++.'</td>';
        echo '<td>'.$row["kode"].'</td>';
        echo '<td>'.$row["nama"].'</td>';
        echo '<td>'.date("Y-m-d H:i:s",strtotime($row["tanggal"])).'</td>';
        echo '<td>'.$row["satuan"].'</td>';
        echo '<td>'.$row["jumlah"].'</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>