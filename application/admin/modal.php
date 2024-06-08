<div class="modal fade" id="modalBarang" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog modal-lg margin-top-30" role="document">
        <form id="formBarang" action="" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="_token" value="" />
            <input type="hidden" name="txtIdROP" id="txtIdROP"/>
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="my-modal-history"><b> Tambah Barang Baru </b></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <hr class="divider no-margin-bottom">
                    <div class="row ">
                        <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Kode Barang :</span>
                        <div class="col-md-4 col-sm-9 col-9">
                            <div class="form-group">
                                <input type="hidden" name="hdID" id="hdID">
                                <input type="text" class="form-control" name="txtKode" id="txtKode">
                            </div>
                        </div>
                        <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Nama :</span>
                        <div class="col-md-4 col-sm-9 col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="txtNama" id="txtNama" >
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <!-- <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Satuan :</span>
                        <div class="col-md-4 col-sm-9 col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="txtSatuan" id="txtSatuan" >
                            </div>
                        </div> -->
                        <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Satuan :</span>
                        <div class="col-md-4 col-sm-9 col-9">
                            <div class="form-group" style="margin-top: 4px;">
                                <select class="selectpicker" id="txtSatuan" name="txtSatuan" data-size="7" data-style="select-with-transition" title="Tipe Satuan"  required >
                                    <option selected="" disabled="" value="0">Tipe Satuan</option>
                                    <option value="Buah">Buah</option>
                                    <option value="Rim">Rim</option>
                                    <option value="Roll">Roll</option>
                                </select>
                            </div>
                        </div>
                        <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Harga :</span>
                        <div class="col-md-4 col-sm-9 col-9">
                            <div class="form-group">
                                <input type="number" class="form-control" value="" name="txtHarga" id="txtHarga" >
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

<?php

// Check If form submitted, insert form data into users table.
if(isset($_POST['Submit'])) {
    $txtKode = $_POST['txtKode'];
    $txtNama = $_POST['txtNama'];
//    $txtJumlah = $_POST['txtJumlah'];
    $txtSatuan = $_POST['txtSatuan'];
    $txtHarga = $_POST['txtHarga'];
    // Insert user data into table
    $result = mysqli_query($conn, "INSERT INTO m_barang(nama,kode,harga,satuan) VALUES('$txtNama','$txtKode','$txtHarga','$txtSatuan')");
}else if(isset($_POST['Update'])){
    $id = $_POST['hdID'];
    $txtKode = $_POST['txtKode'];
    $txtNama = $_POST['txtNama'];
//    $txtJumlah = $_POST['txtJumlah'];
    $txtSatuan = $_POST['txtSatuan'];
    $txtHarga = $_POST['txtHarga'];
    $result = mysqli_query($conn, "UPDATE m_barang SET nama='$txtNama',kode='$txtKode',harga='$txtHarga',satuan='$txtSatuan' WHERE id=$id");
}
?>