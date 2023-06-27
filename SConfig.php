<?php
class SConfig{
    public $_namaApp = "SIPEGA";
    public $_namaOrganisasi = "SMPN 3 TULUNGAGUNG";
    public $_alamatOrganisasi = 'Jl. Srantil Bhakti No. 14A RT 15 RW 12<br />Kec. Banguntapan, Kab. Bantul, Daerah Istimewa Yogyakarta 66782';
    public $_sosmed = [
        'instagram' => 'https://www.instagram.com/',
        'tiktok' => '',
        'facebook' => '',
        'youtube' => '',
        'email' => 'humas@smpn3tulungagung.sch',
        'twitter' => '',
    ];

    public $_logoSekolah = "https://i.ibb.co/CwkFSRS/logo.png";
    // public $_logoSekolah = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrIRiGNTfuYw5wgx_vDIlQUuvGuMhQnqzGLb4p5AoaAw&s";

    public $_visi = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque voluptatem provident, velit ea dolore voluptatibus? Voluptate, cum laborum eligendi hic, reprehenderit aliquid temporibus dolor facilis tempora magnam beatae aliquam ipsum..';
    public $_waAdmin = '6289677249060';
    
    function is_active($a, $b){
        if($a == $b){
            echo "active";
        }
    }
}