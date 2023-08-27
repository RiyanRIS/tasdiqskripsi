<?php
$cfg = new \SConfig();
?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: green;color:white;">
    <a class="navbar-brand" href="#" style="color:white;">
        <img src="<?= (@$cfg->_logoSekolah ?? "") ?>" width="30" height="30" class="d-inline-block align-top" alt="">
        MAN 1 GAYO LUES
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link item-nav" href="<?= site_url() ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link item-nav" href="<?= site_url("alur") ?>">Alur pendaftaran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link item-nav" href="<?= site_url("jadwal") ?>">Jadwal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link item-nav" href="<?= site_url("persyaratan") ?>">Persyaratan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link item-nav" href="<?= site_url("login") ?>">Login</a>
            </li>
        </ul>
    </div>
</nav>