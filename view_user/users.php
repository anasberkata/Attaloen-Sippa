<?php
session_start();
include "../templates/header.php";

$users = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role"
);
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title pt-2">Data Pengguna</h5>
                            </div>
                            <div class="col">
                                <a href="user_add.php" class="btn btn-warning text-white float-end"><i
                                        class="mdi mdi-account-plus"></i> Tambah</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($users as $u): ?>
                                        <tr>
                                            <td>
                                                <?= $i; ?>
                                            </td>
                                            <td>
                                                <?= $u["nama"]; ?>
                                            </td>
                                            <td>
                                                <?= $u["username"]; ?>
                                            </td>
                                            <td>
                                                <?= $u["email"]; ?>
                                            </td>
                                            <td>
                                                <?php if ($u["role_id"] == 1): ?>
                                                    <span class="badge bg-success">
                                                    <?php else: ?>
                                                        <span class="badge bg-dark">
                                                        <?php endif; ?>
                                                        <?= $u["role"]; ?>
                                                    </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <a href="user_edit.php?id_user=<?= $u["id_user"] ?>"
                                                        class="btn btn-info text-white"><i
                                                            class="mdi mdi-account-edit"></i></a>
                                                    <a href="user_delete.php?id_user=<?= $u["id_user"] ?>"
                                                        class="btn btn-danger text-white"
                                                        onclick="return confirm('Yakin ingin menghapus <?= $u['nama']; ?>?');"><i
                                                            class="mdi mdi-delete"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include "../templates/footer.php";
        ?>