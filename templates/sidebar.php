<?php
$peminjaman_pending = query("SELECT * FROM peminjaman WHERE status_peminjaman = 2");
$total_peminjaman_pending = count($peminjaman_pending);
?>

<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../view_admin/dashboard.php"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Dashboard</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="../view_alat_bahan/alat_bahan.php" aria-expanded="false"><i
                            class="mdi mdi-dropbox"></i><span class="hide-menu">Data Alat &
                            Bahan</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="../view_peminjaman/peminjaman.php" aria-expanded="false"><i
                            class="mdi mdi-file-document"></i><span class="hide-menu">Data
                            Peminjaman <span class="badge bg-warning px-2 py-1">
                                <?= $total_peminjaman_pending; ?>
                            </span></span> </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Pengguna
                        </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="../view_user/profile.php" class="sidebar-link"><i
                                    class="mdi mdi-account-card-details"></i><span class="hide-menu"> Profile
                                </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="../view_user/users.php" class="sidebar-link"><i
                                    class="mdi mdi-account-multiple"></i><span class="hide-menu"> Data Pengguna
                                </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../logout.php"
                        onclick="return confirm('Yakin ingin keluar dari aplikasi?');"><i
                            class="mdi mdi-logout"></i><span class="hide-menu">Logout</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>