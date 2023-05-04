<?php
session_start();
include "../templates/header.php";

$kategori = query("SELECT * FROM kategori");

if (isset($_POST["add_alat_bahan"])) {
    if (alat_bahan_add($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'alat_bahan.php';
          </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'alat_bahan.php';
          </script>";
    }
}
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title pt-2">Tambah Data Alat dan Bahan</h5>
                            </div>
                            <div class="col">
                                <a href="alat_bahan.php" class="btn btn-warning text-white float-end"><i
                                        class="mdi mdi-arrow-left-bold"></i> Kembali</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <h4 class="card-title">Data Alat / Bahan</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Kode Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="kode" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nama_alat_bahan" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Tipe, Merk &
                                        Spesifikasi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="merk" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Kategori</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select shadow-none"
                                            style="width: 100%; height: 36px" name="id_kategori">
                                            <option>Pilih Kategori</option>
                                            <?php foreach ($kategori as $k): ?>
                                                <option value="<?= $k["id_kategori"]; ?>"><?= $k["kategori"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Qty</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="qty" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Gambar</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="gambar" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Kondisi</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select shadow-none"
                                            style="width: 100%; height: 36px" name="kondisi">
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cono1"
                                        class="col-sm-3 text-end control-label col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="keterangan"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary" name="add_alat_bahan">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include "../templates/footer.php";
        ?>