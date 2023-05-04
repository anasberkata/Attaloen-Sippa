<?php
session_start();
include "../templates/header.php";

$id_user = $_GET["id_user"];
$u = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role
    WHERE id_user = $id_user"
)[0];


$roles = query("SELECT * FROM users_role");

if (isset($_POST["edit_user"])) {
    if (user_edit($_POST) > 0) {
        echo "<script>
            alert('Pengguna berhasil diubah!');
            document.location.href = 'users.php';
          </script>";
    } else {
        echo "<script>
            alert('Pengguna gagal diubah!');
            document.location.href = 'users.php';
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
                                <h5 class="card-title pt-2">Ubah Data Pengguna</h5>
                            </div>
                            <div class="col">
                                <a href="users.php" class="btn btn-warning text-white float-end"><i
                                        class="mdi mdi-arrow-left-bold"></i> Kembali</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="" method="POST">
                            <div class="card-body">
                                <h4 class="card-title">Personal Info</h4>

                                <input type="hidden" value="<?= $u["id_user"]; ?>" name="id_user" />

                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Nama
                                        Lengkap</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $u["nama"]; ?>"
                                            name="nama" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $u["username"]; ?>"
                                            name="username" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" value="<?= $u["email"]; ?>"
                                            name="email" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" value="<?= $u["password"]; ?>"
                                            name="password" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">No. Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $u["phone"]; ?>"
                                            name="phone" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Jabatan</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select shadow-none"
                                            style="width: 100%; height: 36px" name="role">
                                            <option value="<?= $u["role_id"]; ?>"><?= $u["role"]; ?></option>
                                            <?php foreach ($roles as $r): ?>
                                                <option value="<?= $r["id_role"]; ?>"><?= $r["role"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary" name="edit_user">
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