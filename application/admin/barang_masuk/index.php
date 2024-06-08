<?php
include 'modal.php';
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="card-icon">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <h4 class="card-title">Daftar Barang Masuk</h4>
                            </div>
                            <div class="col-md-2 col-sm-2 col-6">
                                <a type="button" href="./admin/barang_masuk/export_excel.php" class="btn btn-info padding-10" target="_blank" id="btnAddNew" style="float: right;">
                                  Export Excel
                                </a>
                                <button onclick="create()" type="button" class="btn btn-info padding-10" data-toggle="modal" data-target="#modalClient" id="btnAddNew" style="float: right;">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="dataList" class="table table-striped table-no-bordered table-hover dataTables" cellspacing="0" width="100%" style="width:100%">
                                <thead class="bold">
                                <tr>
                                    <th class="disabled-sorting">ID</th>
                                    <th>Kode Barang</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Satuan</th>
                                    <th>Jumlah</th>
                                    <th class="disabled-sorting text-center">Aksi</th>
                                </tr>
                                </thead>
                                <!-- {{$no = 1}} -->
                                <tbody>
                                <?php
                                $no = 1;
                                //tampilkan tabel mahasiswa_ilkom
                                $result=mysqli_query($conn,'SELECT * FROM m_barang INNER JOIN t_barang_masuk ON m_barang.id = t_barang_masuk.id_barang');
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
                                    echo '<td class="td-actions text-center">
                                              <a onclick="edit(`'.$id.'`,`'.$row["id_barang"].'`,`'.$row["jumlah"].'`,`'.$row["tanggal"].'`)">
                                                <button type="button" class="btn btn-link btn-warning btnEdit" data-id="" data-toggle="tooltips" data-placement="top" title="Preview">
                                                  <i class="material-icons">edit</i>
                                                </button>
                                              </a>
                                              <a href="./controller/delete.php?table=t_barang_masuk&id='.$id.'">
                                                <button type="button" name="Delete" class="btn btn-link btn-danger btnDelete" data-id="" data-toggle="tooltips" data-placement="top" title="Preview">
                                                  <i class="material-icons">delete_forever</i>
                                                </button>
                                              </a>
                                            </td>';
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>
<script type="text/javascript">
    function edit(id,txtIdBarang,txtJumlah,txtDate,txtSatuan){
        // console.log(data);
        $('#hdID').val(id);
        $('#txtIdBarang').val(txtIdBarang).trigger('change');
        $('#txtJumlah').val(txtJumlah);
        $('#txtDate').val(txtDate);
        $('#my-modal-history').text('Edit Data');
        $('#submit-update').text('Perbarui');
        $('#submit-update').attr('name','Update');
        $('#modalClient').modal('show');
    }

    function create(){
        // console.log(data);
        $('#hdID').val("");
        $('#txtIdBarang').val(0).trigger('change');
        $('#txtJumlah').val("");
        $('#txtDate').val("");
        $('#my-modal-history').text('Tambah Data');
        $('#submit-update').text('Submit');
        $('#submit-update').attr('name','Submit');
        $('#modalClient').modal('show');
    }
</script>