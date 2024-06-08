<div class="modal fade" id="modalClient" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg margin-top-30" role="document">
        <form id="formBarangMasuk" action="" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="_token" value="" />
            <input type="hidden" name="txtIdROP" id="txtIdROP"/>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="my-modal-history"><b> Tambah Data Barang Masuk </b></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <hr class="divider no-margin-bottom">
                    <div class="row ">
                        <input type="hidden" name="hdID" id="hdID">
                        <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Kode Barang :</span>
                        <div class="col-md-4 col-sm-9 col-9">
                            <div class="form-group" style="margin-top: 4px;">
                                <select class="selectpicker" id="txtIdBarang" name="txtIdBarang" data-size="7" data-style="select-with-transition" title="Kategori"  required >
                                    <option selected="" disabled="" value="0">Kode Barang</option>
                                    <?php
                                        $no = 1;
                                        //tampilkan tabel mahasiswa_ilkom
                                        $result=mysqli_query($conn,'SELECT * FROM m_barang');
                                        while ($row=mysqli_fetch_assoc($result))
                                        {
                                            $id = $row["id"];
                                            echo '<option value="'.$id.'">'.$row["kode"].'</option>';
                                        }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Jumlah :</span>
                        <div class="col-md-4 col-sm-9 col-9">
                            <div class="form-group">
                                <input type="number" class="form-control" value="" name="txtJumlah" id="txtJumlah" >
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Tanggal :</span>
                        <div class="col-md-4 col-sm-9 col-9">
                            <div class="form-group">
                                <input type="datetime-local" class="form-control" value="" name="txtDate" id="txtDate" >
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr class="divider">
                    <div class="text-right">
                        <button type="submit" name="Submit" id="submit-update" class="btn btn-md btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    // var today = new Date().toISOString().slice(0, 16);

    // document.getElementsByName("txtDate")[0].min = today;
</script>

<?php

// Check If form submitted, insert form data into users table.
if(isset($_POST['Submit'])) {
    $txtIdBarang = $_POST['txtIdBarang'];
    $txtJumlah = $_POST['txtJumlah'];
    $txtDate = $_POST['txtDate'];

    // Insert user data into table
    $result = mysqli_query($conn, "INSERT INTO t_barang_masuk(id_barang,jumlah,tanggal) VALUES('$txtIdBarang','$txtJumlah','$txtDate')");
}else if(isset($_POST['Update'])){
    $id = $_POST['hdID'];
    $txtIdBarang = $_POST['txtIdBarang'];
    $txtJumlah = $_POST['txtJumlah'];
    $txtDate = $_POST['txtDate'];
    $result = mysqli_query($conn, "UPDATE t_barang_masuk SET id_barang='$txtIdBarang',jumlah='$txtJumlah',tanggal='$txtDate' WHERE id=$id");
}
?>