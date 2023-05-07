<?php
session_start();
include "../templates/header.php";

$users = query("SELECT * FROM users WHERE NOT role_id = 1");

if (isset($_POST["add_peminjaman"])) {
    if (peminjaman_add($_POST) > 0) {
        echo "<script>
            alert('Data peminjaman berhasil ditambah!');
            document.location.href = 'user_peminjaman.php';
          </script>";
    } else {
        echo "<script>
            alert('Data peminjaman gagal ditambah!');
            document.location.href = 'user_peminjaman.php';
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
                                <h5 class="card-title pt-2">Tambah Data Peminjaman</h5>
                            </div>
                            <div class="col">
                                <a href="user_peminjaman.php" class="btn btn-warning text-white float-end"><i
                                        class="mdi mdi-arrow-left-bold"></i> Kembali</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <h4 class="card-title">Data Peminjaman</h4>

                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="text-end control-label col-form-label">Nama</label>
                                            <input type="hidden" class="form-control" value="<?= $user["id_user"] ?>"
                                                name="id_karyawan" />
                                            <input type="text" class="form-control" value="<?= $user["nama"] ?>"
                                                name="nama_karyawan" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="cono1"
                                                class="text-end control-label col-form-label">Keperluan</label>
                                            <textarea class="form-control" name="keperluan" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="text-end control-label col-form-label">Tanggal
                                                Peminjaman</label>
                                            <input type="date" class="form-control" name="tanggal_peminjaman" />
                                        </div>
                                        <div class="form-group">
                                            <label class="text-end control-label col-form-label">Tanggal
                                                Pengambilan</label>
                                            <input type="date" class="form-control" name="tanggal_pengambilan" />
                                        </div>
                                        <div class="form-group">
                                            <label class="text-end control-label col-form-label">Tanggal
                                                Pengembalian</label>
                                            <input type="date" class="form-control" name="tanggal_pengembalian" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary" name="add_peminjaman">
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