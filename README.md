# Tools Lifecycle Hub – TRL (ULTRA SUPER-STRICT / ENTERPRISE)

Repositori ini saat ini hanya berisi prototipe awal berbasis Kivy untuk pencatatan transaksi sederhana. Spesifikasi bisnis lengkap yang diminta (full-stack web app dengan backend, database enterprise, auth+RBAC, SLA engine, finite state machine, ekspor, dan lain-lain) belum terimplementasi di versi ini.

## Status Saat Ini
- Aplikasi Kivy lokal dengan form penambahan transaksi (nama barang, jumlah, satuan, penyerah, penerima, keterangan) dan tampilan daftar sederhana.
- Validasi dasar: semua field wajib, jumlah harus angka positif.
- Penyimpanan lokal SQLite (`barang.db`).

## Rencana Pengembangan (ringkas)
Untuk memenuhi spesifikasi ULTRA-STRICT, dibutuhkan redesign total menjadi aplikasi web full-stack dengan komponen berikut:
- **Backend**: framework web (mis. FastAPI/Django) dengan database relasional, model FSM, audit/event log, optimistik locking, dan modul SLA (kalender kerja, working hours, hitung business_duration, auto escalation).
- **Frontend**: UI web berbahasa Indonesia dengan action buttons sesuai FSM, upload dokumen, QR/Barcode scan, ekspor Excel/CSV, dan dashboard KPI.
- **Auth & RBAC**: password policy ketat, SoD enforcement, session timeout, e-sign snapshot per aksi.
- **Database & Seeder**: tabel master (kategori, lokasi, area/unit, work types, vendors, holidays, SLA settings, escalation matrix), tools register, borrow/damage/repair pipeline, attachments dengan hash, correction notes, seed data akun & transaksi demo.

## Catatan
- Implementasi penuh memerlukan pemilihan stack baru, desain skema detail, dan migrasi dari aplikasi Kivy ke arsitektur web. Dokumentasi ini mencatat gap tersebut agar pekerjaan berikutnya terarah.
