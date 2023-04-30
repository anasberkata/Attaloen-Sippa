<?php
session_start();
include "../templates/header.php";
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title pt-2">Data Profile</h5>
                            </div>
                            <div class="col">
                                <a href="profile_edit.php" class="btn btn-warning text-white float-end"><i
                                        class="mdi mdi-account-edit"></i> Ubah</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <ul class="list-style-none">
                            <li class="d-flex no-block card-body">
                                <i class="mdi mdi-check-circle fs-4 w-30px mt-1"></i>
                                <div>
                                    <a href="#" class="mb-0 font-medium p-0">
                                        <?= $user["nama"]; ?>
                                    </a>
                                    <span class="text-muted">
                                        <?= $user["email"]; ?>
                                    </span>
                                </div>
                            </li>
                        </ul>
                        <ul class="list-style-none">
                            <li class="d-flex no-block card-body">
                                <i class="mdi mdi-check-circle fs-4 w-30px mt-1"></i>
                                <div>
                                    <a href="#" class="mb-0 font-medium p-0">
                                        Username :
                                        <?= $user["username"]; ?>
                                    </a>
                                    <span class="text-muted">
                                        Password :
                                        <?= $user["password"]; ?>
                                    </span>
                                </div>
                            </li>
                        </ul>
                        <ul class="list-style-none">
                            <li class="d-flex no-block card-body">
                                <i class="mdi mdi-check-circle fs-4 w-30px mt-1"></i>
                                <div>
                                    <a href="#" class="mb-0 font-medium p-0">
                                        Telepon :
                                        <?= $user["phone"]; ?>
                                    </a>
                                    <span class="text-muted">
                                        Jabatan :
                                        <?= $user["role"]; ?>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include "../templates/footer.php";
        ?>