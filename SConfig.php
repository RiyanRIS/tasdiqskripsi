<?php
class SConfig{
    public $_namaApp = "SIPEGA";
    public $_namaSekolah = "SMPN 3 TULUNGAGUNG";
    public $_logoSekolah = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrIRiGNTfuYw5wgx_vDIlQUuvGuMhQnqzGLb4p5AoaAw&s";

    function is_active($a, $b){
        if($a == $b){
            echo "active";
        }
    }
}