<?php
session_start();
include "../templates/header.php";

$id_peminjaman = $_GET["id_peminjaman"];
$p = query(
    "SELECT * FROM peminjaman
    INNER JOIN users ON peminjaman.id_karyawan = users.id_user
    WHERE id_peminjaman = $id_peminjaman"
)[0];

$users = query("SELECT * FROM users WHERE NOT role_id = 1");

if (isset($_POST["edit_peminjaman"])) {
    if (peminjaman_edit($_POST) > 0) {
        echo "<script>
            alert('Data peminjaman berhasil diubah!');
            document.location.href = 'peminjaman.php';
          </script>";
    } else {
        echo "<script>
            alert('Data peminjaman gagal diubah!');
            document.location.href = 'peminjaman.php';
          </script>";
    }
}
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title pt-2">Ubah Data Peminjaman</h5>
                            </div>
                            <div class="col">
                                <a href="peminjaman.php" class="btn btn-warning text-white float-end"><i
                                        class="mdi mdi-arrow-left-bold"></i> Kembali</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <h4 class="card-title">Data Peminjaman</h4>

                                <div class="row">

                                    <input type="hidden" value="<?= $p["id_peminjaman"]; ?>" name="id_peminjaman" />

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="text-end control-label col-form-label">Karyawan</label>
                                            <select class="select2 form-select shadow-none"
                                                style="width: 100%; height: 36px" name="id_karyawan">
                                                <option value="<?= $p["id_karyawan"]; ?>"><?= $p["nama"]; ?></option>
                                                <?php foreach ($users as $u): ?>
                                                    <option value="<?= $u["id_user"]; ?>"><?= $u["nama"]; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="cono1"
                                                class="text-end control-label col-form-label">Keperluan</label>
                                            <textarea class="form-control" name="keperluan"
                                                rows="4"><?= $p["keperluan"]; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="text-end control-label col-form-label">Tanggal
                                                Peminjaman</label>
                                            <input type="date" class="form-control"
                                                value="<?= $p["tanggal_peminjaman"]; ?>" name="tanggal_peminjaman" />
                                        </div>
                                        <div class="form-group">
                                            <label class="text-end control-label col-form-label">Tanggal
                                                Pengambilan</label>
                                            <input type="date" class="form-control"
                                                value="<?= $p["tanggal_pengambilan"]; ?>" name="tanggal_pengambilan" />
                                        </div>
                                        <div class="form-group">
                                            <label class="text-end control-label col-form-label">Tanggal
                                                Pengembalian</label>
                                            <input type="date" class="form-control"
                                                value="<?= $p["tanggal_pengembalian"]; ?>"
                                                name="tanggal_pengembalian" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary" name="edit_peminjaman">
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