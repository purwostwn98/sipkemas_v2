<?php
$session = \Config\Services::session();
?>

<!-- Pemohon -->
<?php if ($session->get('privUser') == 1) { ?>
    <li class="<?php if ($bttn == 'dtpemohon') {
                    echo 'nav-item active';
                } else {
                    echo 'nav-item';
                } ?>">
        <a class="nav-link my-1 py-1" href="/pemohon/biodata">
            <i class="fa-fw fas fa-user-tie"></i>
            <span>Biodata </span></a>
    </li>
    <!-- <li class="<?php if ($bttn == 'alur_bantuan') {
                        echo 'nav-item active';
                    } else {
                        echo 'nav-item';
                    } ?>">
        <a class="nav-link my-1 py-1" href="/pemohon/alur_bantuan">
            <i class="fab fa-stumbleupon-circle fa-fw"></i>
            <span>Alur Bantuan</span>
        </a>
    </li> -->
    <?php if ($session->get('idStsAjuan') == 1) { ?>
        <li class="<?php if ($bttn == 'syarat_ketentuan') {
                        echo 'nav-item active';
                    } else {
                        echo 'nav-item';
                    } ?>">
            <a class="nav-link my-1 py-1" href="/pemohon/syarat_ketentuan">
                <i class="fas fa-hands-helping fa-fw"></i>
                <span>Ajukan Bantuan</span></a>
        </li>
    <?php } elseif ($session->get('idStsAjuan') >= 2) { ?>
        <li class="<?php if ($bttn == 'resumeAjuan') {
                        echo 'nav-item active';
                    } else {
                        echo 'nav-item';
                    } ?>">
            <a class="nav-link my-1 py-1" href="/pemohon/resumeAjuan">
                <i class="fas fa-hands-helping fa-fw"></i>
                <span>Resume Bantuan</span></a>
        </li>
    <?php } ?>
<?php } ?>

<!-- Menu Kelurahan -->
<hr class="sidebar-divider my-0">
<?php if ($session->get('privUser') == 2) { ?>
    <li class="nav-item <?= ($bttn == 'dashboard' || $bttn == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/kelurahan/dashboard">
            <i class="fa-fw far fa-address-book"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item <?= ($bttn == 'dtpemohon' || $bttn == 'dftrpemohon') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/kelurahan/dftrpemohon_i">
            <i class="fa-fw far fa-address-book"></i>
            <span>Daftar Pemohon</span>
        </a>
    </li>

    <li class="nav-item <?= ($bttn == 'dftrajuan') ? 'active' : '' ?>">
        <a class="nav-link collapsed my-1 py-1" href="#" data-toggle="collapse" data-target="#kel_ajuan" aria-expanded="true" aria-controls="kel_ajuan">
            <i class="fa-fw far fa-list-alt"></i>
            <span>Daftar Ajuan</span>
        </a>
        <div id="kel_ajuan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Daftar Ajuan:</h6>
                <a class="collapse-item" href="/kelurahan/dftrajuan_i">Ajuan Individu</a>
                <a class="collapse-item" href="/kelurahan/dftrajuan_l">Ajuan Lembaga</a>
            </div>
        </div>
    </li>
    <!-- <li class="nav-item <?= ($bttn == 'alur_bantuan') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/pemohon/alur_bantuan">
            <i class="fab fa-stumbleupon-circle fa-fw"></i>
            <span>Alur Bantuan</span>
        </a>
    </li> -->
<?php } ?>

<!-- Menu Dinsos -->
<?php if ($session->get('privUser') == 3) { ?>
    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading">
        Halaman Dinsos
    </div>
    <li class="nav-item <?= ($bttn == 'dashboard_dinsos') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/dinsos/dashboard">
            <i class="fas fa-chart-line fa-fw"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item <?= ($bttn == 'sos_dftrajuan') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/dinsos/dftrajuan_i">
            <i class="fa-fw far fa-list-alt"></i>
            <span>Daftar Ajuan</span></a>
    </li>
<?php } ?>

<!-- Menu Kesra -->
<?php if ($session->get('privUser') == 4) { ?>
    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading">
        Halaman Kesra
    </div>
    <li class="nav-item <?= ($bttn == 'dashboard_kesra') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/kesra/dashboard">
            <i class="fas fa-chart-line fa-fw"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item <?= ($bttn == 'dftrajuan') ? 'active' : '' ?>">
        <a class="nav-link collapsed my-1 py-1" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-fw far fa-list-alt"></i>
            <span>Daftar Ajuan</span>
        </a>
        <div id="collapseTwo" class="collapse <?= ($bttn == 'dftrajuan') ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Daftar Ajuan:</h6>
                <a class="collapse-item" href="/kesra/dftrajuan_i">Ajuan Individu</a>
                <a class="collapse-item" href="/kesra/dftrajuan_l">Ajuan Lembaga</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?= ($bttn == 'dftrmitra') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/kesra/dftrMitra">
            <i class="fas fa-atom fa-fw"></i>
            <span>Daftar Mitra</span>
        </a>
    </li>
    <li class="nav-item <?= ($bttn == 'dftrbantuan') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/kesra/dftrBantuan">
            <i class="fas fa-atom fa-fw"></i>
            <span>Daftar Program</span>
        </a>
    </li>
    <li class="nav-item <?= ($bttn == 'user_mng') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/kesra/userManagement">
            <i class="fas fa-box-open fa-fw"></i>
            <span>User Management</span>
        </a>
    </li>
<?php } ?>

<!-- Menu Mitra -->
<?php if ($session->get('privUser') == 5) { ?>
    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading">
        Halaman Mitra
    </div>
    <li class="nav-item <?= ($bttn == 'dashboard_mitra') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/mitra/dashboard">
            <i class="fas fa-chart-line fa-fw"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item <?= ($bttn == 'mit_dftrajuan') ? 'active' : '' ?>">
        <a class="nav-link collapsed my-1 py-1" href="#" data-toggle="collapse" data-target="#mitraSub" aria-expanded="true" aria-controls="mitraSub">
            <i class="fa-fw far fa-list-alt"></i>
            <span>Daftar Ajuan</span>
        </a>
        <div id="mitraSub" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Daftar Ajuan:</h6>
                <a class="collapse-item" href="/mitra/dftrajuan_i">Ajuan Individu</a>
                <a class="collapse-item" href="/mitra/dftrajuan_l">Ajuan Lembaga</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?= ($bttn == 'dftrbantuan') ? 'active' : '' ?>">
        <a class="nav-link my-1 py-1" href="/mitra/dftprogram">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Daftar Program</span></a>
    </li>
<?php } ?>

<!-- Tombol Logout -->
<li class="nav-item">
    <a class="nav-link my-1 py-1" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-fw"></i>
        <span>Logout</span></a>
</li>