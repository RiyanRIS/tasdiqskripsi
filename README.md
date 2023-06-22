## Cara Instal Sistem

- Clone [repo ini](https://github.com/RiyanRIS/tasdiqskripsi)
- Download [AdminLTE](https://github.com/ColorlibHQ/AdminLTE/archive/refs/tags/v3.2.0.zip)
- Ambil folder "plugins" di AdminLTE lalu copy ke public/assets/
- Nyalakan xampp untuk akses database mysql
- Buat database lalu import file database.sql
- Rename file env menjadi .env (ada "." didepan)
- Buka file .env sesuaikan dengan settingan database yang dibuat tadi, seperti username, password dan nama database
- Jalankan terminal, ketik ```composer update``` 
- Lalu ketik ```php spark serve``` untuk memulai menjalankan server

### Akses Admin Default
- username: admin
- password: admin