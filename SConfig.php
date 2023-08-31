<?php
class SConfig
{
    public $_namaApp = "MAN1GAYO";
    public $_namaSekolah = "MAN 1 GAYO LUES";
    // public $_logoSekolah = "https://i.ibb.co/bXdStNj/LOGO-MAN.png";
    public $_logoSekolah = "http://localhost:8080/assets/images/logo.png";

    public $_nilaiminim = 75;
    public $_kuota = 200;
    public $_path_upload = ROOTPATH . 'public/uploads/temp/';

    function is_active($a, $b)
    {
        if ($a == $b) {
            echo "active";
        }
    }
}
