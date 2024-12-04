# Web-Penjadwalan-Laravel
Web penjadwalan menggunakan framework laravel
<br>
framework yang digunakan `laravel` 
<br>
laravel: `8.83.6`

# Fitur
- Tambah;update;hapus;lihat data jadwal, dosen, matkul, ruangan
- Tampilan Home

# Screenshoot
<details>
    <summary>Foto Web</summary>
    <br>

|  |  |
| :---:  | :---:  |
| ![](screenshot/login.jpeg)            | ![](screenshot/home.jpeg)          
![](screenshot/dashboard.jpeg)  | ![](screenshot/matkul.jpeg)            
![](screenshot/dosen.jpeg)               | ![](screenshot/ruangan.jpeg)  
![](screenshot/jadwal.jpeg)            | ![](screenshot/jadwal2.jpeg)                


</details>  

# Cara install

#### Via Git
```bash
git clone https://github.com/abdiagung077/SIPERU-PPL.git
```

### Setup Aplikasi
Jalankan perintah 
```bash
composer install --ignore-platform-reqs
```
update composer
```bash
composer update --ignore-platform-reqs
```
Copy file .env dari .env.example
```bash
copy .env.example .env
```
Konfigurasi file .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```
Generate key
```bash
php artisan key:generate
```
Migrate database
```bash
php artisan migrate
```
Seeder table User
```bash
php artisan db:seed
```
Ubah 'email' menjadi 'username' di file AuthenticatesUsers.php
|  |
| :---:  |
|![](screenshot/install.png) |

Menjalankan aplikasi
```bash
php artisan serve
```

username: admin
<br>
password: admin

