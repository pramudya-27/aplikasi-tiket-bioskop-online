# Panduan Setup Jenkins CI/CD untuk Laravel dengan Docker

Dokumen ini menjelaskan cara mengatur pipeline CI/CD menggunakan Jenkins untuk proyek Laravel ini, termasuk tahap deployment menggunakan Docker.

## Prasyarat

Pastikan server atau mesin Jenkins Anda memiliki:

1.  **PHP** (sesuai versi yang dibutuhkan Laravel, misal PHP 8.2+).
2.  **Composer** (terinstal secara global).
3.  **Node.js & NPM**.
4.  **Git**.
5.  **Docker & Docker Compose** (Wajib untuk tahap deployment).
6.  **Jenkins** yang sudah berjalan dan memiliki akses untuk menjalankan perintah `docker`.

## Langkah 1: Instalasi Plugin Jenkins

Masuk ke Dashboard Jenkins > **Manage Jenkins** > **Plugins** > **Available Plugins**, lalu instal plugin berikut jika belum ada:

- **Pipeline**
- **Git**
- **Blue Ocean** (Opsional)

## Langkah 2: Konfigurasi Proyek Baru

1.  Buat Item baru bertipe **Pipeline**.
2.  Pada konfigurasi **Definition**, pilih **Pipeline script from SCM**.
3.  Pilih **Git** dan masukkan URL repository.
4.  Pastikan **Script Path** adalah `Jenkinsfile`.
5.  Simpan.

## Langkah 3: Penjelasan Pipeline dengan Docker

File `Jenkinsfile` kini memiliki tahapan tambahan untuk deployment:

1.  **Preparation, Install Dependencies, Build Assets, Setup Application, Run Tests**:
    - Tahapan ini berjalan di _agent_ Jenkins (host machine) untuk memastikan kode valid dan lulus tes unit sebelum dibuatkan image Docker.
    - Ini memastikan _Fast Feedback_ jika ada error syntax atau tes yang gagal.

2.  **Deploy with Docker**:
    - `docker-compose down`: Mematikan container lama (jika ada).
    - `docker-compose up -d --build`: Membangun image baru dari kode terkini dan menjalankannya.
    - Aplikasi akan berjalan dalam container dengan nama `laravel_bioskop_app` pada port **8080** (bisa diakses di `http://localhost:8080`).

## File Konfigurasi Docker

- **Dockerfile**: Menggunakan base image `php:8.2-apache`. Sudah termasuk instalasi ekstensi PHP yang dibutuhkan, Composer, dan Node.js untuk build aset di dalam container (untuk production ready artifacts).
- **docker-compose.yml**: Mengatur service aplikasi dan mapping port 8080 ke 80. Menggunakan volume untuk file `.env`.

## Catatan Penting untuk Windows vs Linux

- **Windows**: Pastikan user yang menjalankan service Jenkins memiliki akses ke Docker Desktop.
- **Linux**: Pastikan user `jenkins` sudah dimasukkan ke dalam group `docker` (`sudo usermod -aG docker jenkins`) agar bisa menjalankan perintah docker tanpa sudo.

## Troubleshooting Deployment

- **Docker permission denied**: Cek grup user jenkins seperti poin di atas.
- **Port Conflict**: Jika port 8080 sudah terpakai, ubah mapping port di `docker-compose.yml` (misal `"8081:80"`).
- **Environment Variables**: Pastikan file `.env` sudah terbentuk di workspace (dilakukan oleh stage 'Preparation') sebelum Docker dijalankan, karena `docker-compose.yml` me-mount file tersebut.
