        <!-- Sidebar -->
        <ul class="navbar-nav bg-white sidebar sidebar-light accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url('http://localhost:8080/assets'); ?>/img/sidebar.jpeg" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">Akhdani</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- SDM -->
            <?php if (session('akses') == 2) { ?>
                <div>
                    <div class="sidebar-heading mt-2">
                        SDM
                    </div>

                    <li class="nav-item <?= ($sidebar == 'baru' || $sidebar = 'history') ? "active" : ""; ?>">
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fas fa-layer-group"></i>
                            <span>Pengajuan PerdinKu <i class="fas fa-circle text-danger" <?= ($badge) ? "" : "hidden"; ?>></i></span>
                        </a>
                        <div id="collapseTwo" class="collapse <?= ($sidebar == 'baru' || $sidebar == 'history') ? "show" : ""; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-gray-300 py-2 collapse-inner rounded">
                                <a class="collapse-item <?= $sidebar == 'baru' ? "active" : ""; ?>" href="/perdin/sdm" id="baru">Pengajuan Baru <span class="badge-danger p-1 badge" <?= ($badge) ? "" : "hidden"; ?>><?= $badge; ?></span></a>
                                <a class="collapse-item <?= $sidebar == 'history' ? "active" : ""; ?>" href="/perdin/history" id="history">History Pengajuan</a>
                            </div>
                        </div>
                    </li>
                </div>
            <?php } elseif (session('akses') == 3) { ?>
                <!-- PEGAWAI -->
                <div>
                    <div class="sidebar-heading mt-2">
                        PEGAWAI
                    </div>
                    <li class="nav-item <?= $sidebar == 'perdinku' ? "active" : ""; ?>">
                        <a class="nav-link" href="/perdin/pegawai/<?= session('id'); ?>">
                            <i class="fas fa-layer-group"></i>
                            <span>PerdinKu</span></a>
                    </li>
                </div>
            <?php } else { ?>
                <div>
                    <div class="sidebar-heading mt-2">
                        ADMIN
                    </div>

                    <li class="nav-item <?= $sidebar == 'kota' ? "active" : ""; ?>">
                        <a class="nav-link" href="/kota">
                            <i class="fas fa-layer-group"></i>
                            <span>Master Kota</span></a>
                    </li>
                    <li class="nav-item <?= $sidebar == 'user' ? "active" : ""; ?>">
                        <a class="nav-link" href="/user">
                            <i class="fas fa-user"></i>
                            <span>Daftar User</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">
                </div>
                <!-- ADMIN -->
                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            <?php } ?>
        </ul>
        <!-- End of Sidebar -->