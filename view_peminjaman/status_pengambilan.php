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

if (isset($_POST["edit_pengambilan_status"])) {
    if (status_pengambilan_edit($_POST) > 0) {
        echo "<script>
            alert('Status pengambilan berhasil diubah!');
            document.location.href = 'peminjaman.php';
          </script>";
    } else {
        echo "<script>
            alert('Status pengambilan gagal diubah!');
            document.location.href = 'peminjaman.php';
          </script>";
    }
}
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
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
                                <h4 class="card-title">Status Pengambilan :
                                    <?php if ($p["status_pengembalian"] == 1): ?>
                                        Sudah
                                    <?php else: ?>
                                        Belum
                                    <?php endif; ?>
                                </h4>

                                <div class="row">

                                    <input type="hidden" value="<?= $p["id_peminjaman"]; ?>" name="id_peminjaman" />

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="text-end control-label col-form-label">Status</label>
                                            <select class="select2 form-select shadow-none"
                                                style="width: 100%; height: 36px" name="status_pengambilan">
                                                <option value="1">Sudah</option>
                                                <option value="2">Belum</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary" name="edit_pengambilan_status">
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