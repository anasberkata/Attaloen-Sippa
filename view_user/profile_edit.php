<?php
session_start();
include "../templates/header.php";

$roles = query("SELECT * FROM users_role");

if (isset($_POST["edit_profile"])) {
    if (profile_edit($_POST) > 0) {
        echo "<script>
            alert('Profile berhasil diubah!');
            document.location.href = 'profile.php';
          </script>";
    } else {
        echo "<script>
            alert('Profile gagal diubah!');
            document.location.href = 'profile.php';
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
                                <h5 class="card-title pt-2">Ubah Profile</h5>
                            </div>
                            <div class="col">
                                <a href="profile.php" class="btn btn-warning text-white float-end"><i
                                        class="mdi mdi-arrow-left-bold"></i> Kembali</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="" method="POST">
                            <div class="card-body">
                                <h4 class="card-title">Personal Info</h4>

                                <input type="hidden" value="<?= $user["id_user"]; ?>" name="id_user" />

                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Nama
                                        Lengkap</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $user["nama"]; ?>"
                                            name="nama" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $user["username"]; ?>"
                                            name="username" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" value="<?= $user["email"]; ?>"
                                            name="email" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" value="<?= $user["password"]; ?>"
                                            name="password" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">No. Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?= $user["phone"]; ?>"
                                            name="phone" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Jabatan</label>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select shadow-none"
                                            style="width: 100%; height: 36px" name="role">
                                            <option value="<?= $user["role_id"]; ?>"><?= $user["role"]; ?></option>
                                            <?php foreach ($roles as $r): ?>
                                                <option value="<?= $r["id_role"]; ?>"><?= $r["role"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary" name="edit_profile">
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