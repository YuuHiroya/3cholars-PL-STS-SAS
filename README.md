🎓 3cholars – Scholarship Information Platform

![image alt](https://github.com/YuuHiroya/3cholars-PL-STS-SAS/blob/692997bf375e04110482b52fddcc8e64f1419959/Logo.png)

Platform informasi beasiswa berbasis Laravel 12, MySQL, dan TailwindCSS, dengan pengelolaan database menggunakan HeidiSQL dan MySQL.

🎯 Tujuan Aplikasi

Memberikan informasi beasiswa yang lengkap, akurat, dan mudah diakses khusus untuk siswa SMA/SMK kelas 12.

Menjadi media panduan yang praktis agar siswa lebih siap melanjutkan pendidikan ke perguruan tinggi tanpa terhalang masalah biaya.

Membantu siswa menemukan beasiswa yang sesuai dengan kebutuhan, minat, dan jurusan yang ingin ditempuh.

🚀 Features

🔍 Pencarian beasiswa berdasarkan negara, universitas, atau jurusan

📑 Tampilan Grid dan List untuk daftar beasiswa

📝 Formulir pengajuan aplikasi beasiswa

📊 Dashboard siswa (status aplikasi, progress, riwayat)

🔐 Sistem autentikasi (registrasi & login)

📦 Installation
1. Clone Repository

git clone https://github.com/USERNAME/3cholars.git

cd 3cholars

2. Install Dependencies

composer install

npm install

3. Environment Setup

Salin file .env.example menjadi .env:

cp .env.example .env


Generate app key:

php artisan key:generate

4. Database Setup

Buat database baru di MySQL (kami menggunakan HeidiSQL
 untuk memudahkan pengelolaan database).

Sesuaikan konfigurasi .env:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=3cholars_db

DB_USERNAME=root

DB_PASSWORD=


Migrasi & seed database:

php artisan migrate --seed

5. Build Tailwind & Run Server

Setelah git pull, pastikan membangun ulang asset Tailwind:

npm run dev


Jalankan server Laravel (Herd otomatis, atau artisan manual):

php artisan serve


Akses aplikasi di:
👉 http://localhost:8000 atau https://3cholars.test (jika menggunakan Herd).

🏗️ Project Architecture
3cholars/
│── app/                # Business logic (Controllers, Models, Policies, etc)

│── bootstrap/          # Bootstrap files

│── config/             # Laravel config files

│── database/           # Migrations, factories, seeders

│── public/             # Public assets (compiled CSS/JS, images)

│── resources/          # Views (Blade), Tailwind CSS

│── routes/             # Web & API routes

│── storage/            # Cache, logs, uploads

│── tests/              # Unit & feature tests

│── .env.example        # Environment config sample

│── composer.json       # PHP dependencies

│── package.json        # JS dependencies

🧑‍💻 Contributing

Kami membuka kontribusi dari komunitas!

Fork repo ini

Buat branch baru (git checkout -b feature/nama-fitur)

Commit perubahan (git commit -m 'Add new feature')

Push branch (git push origin feature/nama-fitur)

Buat Pull Request

📜 License

Proyek ini dirilis di bawah lisensi MIT License.

Silakan gunakan, modifikasi, dan distribusikan sesuai kebutuhan.

🙌 Credits

Dibangun dengan ❤️ oleh tim 3cholars

Framework: Laravel

Local Dev: Laravel Herd

Database Management: HeidiSQL

Styling: TailwindCSS
