<?php
class SConfig
{
    public $_namaApp = "MAN1GAYO";
    public $_namaSekolah = "MAN 1 GAYO LUES";
    public $_logoSekolah = "https://i.ibb.co/Bt5Cf2M/man.jpg";

    public $_nilaiminim = 75;

    function is_active($a, $b)
    {
        if ($a == $b) {
            echo "active";
        }
    }
}
