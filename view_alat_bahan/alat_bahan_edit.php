<?php
session_start();
include "../templates/header.php";

$id_alat_bahan = $_GET["id_alat_bahan"];
$ab = query(
    "SELECT * FROM alat_bahan
    INNER JOIN kategori ON alat_bahan.id_kategori = kategori.id_kategori
    WHERE id_alat_bahan = $id_alat_bahan"
)[0];

$kategori = query("SELECT * FROM kategori");

if (isset($_POST["edit_alat_bahan"])) {
    if (alat_bahan_edit($_POST) > 0) {
        echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'alat_bahan.php';
          </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah!');
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
                                <h5 class="card-title pt-2">Ubah Data Alat dan Bahan</h5>
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

                                <input type="hidden" value="<?= $ab["id_alat_bahan"]; ?>" name="id_alat_bahan" />
                                <input type="hidden" value="<?= $ab["gambar"]; ?>" name="gambar_lama" />

                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Kode Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $ab["kode"]; ?>"
                                            name="kode" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $ab["nama_alat_bahan"]; ?>"
                                            name="nama_alat_bahan" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Tipe, Merk &
                                        Spesifikasi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $ab["merk"]; ?>"
                                            name="merk" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Kategori</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select shadow-none"
                                            style="width: 100%; height: 36px" name="id_kategori">
                                            <option value="<?= $ab["id_kategori"]; ?>"><?= $ab["kategori"]; ?></option>
                                            <?php foreach ($kategori as $k): ?>
                                                <option value="<?= $k["id_kategori"]; ?>"><?= $k["kategori"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Qty</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $ab["qty"]; ?>" name="qty" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 text-end control-label col-form-label">
                                    </label>
                                    <div class="col-sm-9">
                                        <img src="../assets/img/alat_bahan/<?= $ab["gambar"]; ?>" class="img-thumbnail">
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
                                            <option value="<?= $ab["kondisi"]; ?>"><?= $ab["kondisi"]; ?></option>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cono1"
                                        class="col-sm-3 text-end control-label col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control"
                                            name="keterangan"><?= $ab["keterangan"]; ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary" name="edit_alat_bahan">
                                        Ubah
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