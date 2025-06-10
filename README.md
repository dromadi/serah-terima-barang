# Serah Terima Barang

Aplikasi sederhana pencatatan serah terima barang berbasis Kivy. Proyek ini dapat dibangun menjadi aplikasi Android menggunakan Buildozer.

## Menjalankan di Desktop

1. Pastikan Python 3 dan dependensi Kivy terpasang.
2. Jalankan aplikasi dengan perintah:
   ```bash
   python3 main.py
   ```

## Membangun APK Android

1. Install Buildozer terlebih dahulu (lihat dokumentasi [Buildozer](https://buildozer.readthedocs.io)).
2. Jalankan perintah berikut:
   ```bash
   buildozer android debug
   ```
   Berkas APK akan berada di direktori `bin/android/debug/`.

Workflow GitHub `android.yml` di repositori ini juga dapat digunakan untuk membangun APK secara otomatis dan merilisnya ke halaman rilis GitHub.
