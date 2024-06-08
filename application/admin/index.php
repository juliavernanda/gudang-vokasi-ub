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
                                <h4 class="card-title">Data Stok Barang</h4>
                            </div>
                            <?php
                                if($_SESSION['role'] == "User"){
                            ?>
                            <div class="col-md-2 col-sm-6 col-6">
                                <a type="button" href="./controller/download_form.php" class="btn btn-info padding-10"  target="_blank" style="float: right;">
                                  Downlaod Form
                                </a>
                            </div>
                            <?php
                                } else {
                            ?>
                            <div class="col-md-2 col-sm-6 col-6">
                                <a onclick="create()" type="button" class="btn btn-info padding-10"  data-toggle="modal" data-target="#modalBarang" style="float: right;">
                                    Tambah
                                </a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="dataList" class="table table-striped table-no-bordered table-hover dataTables" cellspacing="0" width="100%" style="width:100%">
                                <thead class="bold">
                                    <tr>
                                        <th class="disabled-sorting">Nomor</th>
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <?php
                                        if($_SESSION['role'] == "Superadmin"){
                                        ?>
                                        <th>Harga</th>
                                        <th class="disabled-sorting text-center">Aksi</th>
                                        <?php
                                        }
                                        ?>
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
                                    $stk = '0';
                                    if($row["sisa_stok"] != null){
                                        echo '<td>'.$row["sisa_stok"].'</td>';
                                    }else if($row["sisa_stok"] == 0 && $row["jumlah_masuk"] != null){
                                        $stk = $row["jumlah_masuk"];
                                        echo '<td>'.$stk.'</td>';
                                    }else{
                                        echo '<td>0</td>';
                                    }
                                    echo '<td>'.$row["satuan"].'</td>';
                                    if($_SESSION['role'] == "Superadmin"){
                                        $id = $row["id"];
                                        echo '<td class="text-right">'."Rp " . number_format($row["harga"],2,',','.').'</td>';
                                        echo '<td class="td-actions text-center">
                                              <a onclick="edit(`'.$id.'`,`'.$row["kode"].'`,`'.$row["nama"].'`,`'.$row["harga"].'`,`'.$row["satuan"].'`)">
                                                <button type="button" class="btn btn-link btn-warning btnEdit" data-id="" data-toggle="tooltips" data-placement="top" title="Preview">
                                                  <i class="material-icons">edit</i>
                                                </button>
                                              </a>
                                              <a href="./controller/delete.php?table=m_barang&id='.$id.'">
                                                <button type="button" name="Delete" class="btn btn-link btn-danger btnDelete" data-id="" data-toggle="tooltips" data-placement="top" title="Preview">
                                                  <i class="material-icons">delete_forever</i>
                                                </button>
                                              </a>
                                            </td>';
                                    }
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
    function edit(id,txtKode,txtNama,txtHarga,txtSatuan){
        // console.log(data);
        $('#hdID').val(id);
        $('#txtKode').val(txtKode);
        $('#txtNama').val(txtNama);
        $('#txtHarga').val(txtHarga);
        $('#txtSatuan').val(txtSatuan);
        $('#my-modal-history').text('Edit Barang');
        $('#submit-update').text('Perbarui');
        $('#submit-update').attr('name','Update');
        $('#modalBarang').modal('show');
    }

    function create(){
        // console.log(data);
        $('#hdID').val("");
        $('#txtKode').val("");
        $('#txtNama').val("");
        $('#txtHarga').val("");
        $('#txtSatuan').val("");
        $('#my-modal-history').text('Tambah Barang');
        $('#submit-update').text('Submit');
        $('#submit-update').attr('name','Submit');
        $('#modalBarang').modal('show');
    }
</script>

