# Tools Lifecycle Hub – TRL (Laravel 10)

Aplikasi full-stack untuk manajemen peminjaman, kerusakan, dan perbaikan tools dengan SLA business-hours, RBAC, audit log, dan koreksi terkontrol.

## Setup Singkat
1. Install dependency: `composer install`
2. Copy `.env.example` menjadi `.env` dan atur koneksi database.
3. Generate key: `php artisan key:generate`
4. Migrasi + seed: `php artisan migrate --seed`
5. Jalankan: `php artisan serve`

## Akun Seed
- admin@trl.local / Admin123!
- staff@trl.local / Staff123!
- requester@trl.local / Req123!
- vendor@trl.local / Vendor123!
- viewer@trl.local / View123!
- approverl1@trl.local / Approve123!
- approverfinal@trl.local / Approve123!

## Master Codes
- Categories: CAT-MEC/ELC/INS/NDT/LFT
- Locations: LOC-LON/LOC-KST/LOC-GSA
- Area Units: AU-UPHK/AU-OMBL/AU-PRIO
- Work Types: WORK-SE/WORK-RLA/WORK-OH/WORK-INS
- Vendors: VND-0001, VND-0002

## Flow Status + Action Buttons
### Borrow Request
DRAFT → SUBMITTED → APPROVED_L1 → APPROVED_FINAL → (REJECTED) → DISPATCHED → RETURNED → CLOSED

Action buttons: Submit, Approve L1, Approve Final, Reject, Dispatch, Return, Close

### Damage Ticket
REPORTED → VERIFIED → REPAIR_PLANNED → IN_REPAIR → QA_CHECK → (COMPLETED | SCRAPPED)

Action buttons: Verify, Plan Repair, Start Repair, QA Check, Complete, Scrap

## Dokumen Wajib Per Action
- Dispatch: surat_jalan_kirim + attachment SJ_KIRIM
- Return: surat_jalan_kembali + attachment SJ_KEMBALI
- Verify Damage: SK jika surat_kerusakan diisi
- Start Repair: attachment SJ_REPAIR_KIRIM
- QA Check: attachment SJ_REPAIR_TERIMA + BA
- Correction Note: attachment ND_CORRECTION

## SoD Rules
- Requester tidak boleh menjadi Approver.
- Approver L1 tidak boleh menjadi Approver Final untuk request yang sama.
- Dispatcher tidak boleh menjadi Receiver Return.
- Verifier damage tidak boleh menjadi QA Checker.
- TECH_VENDOR tidak boleh melakukan Verify/QA/Complete.

## SLA Engine + Kalender Kerja
- Jam kerja: Senin–Jumat 08:00–17:00
- Weekend: Sabtu/Minggu
- Holidays dikelola Admin

SLA dihitung dengan `BusinessTimeService::businessDurationInHours()`.

## Correction Note
Perubahan pada data setelah milestone harus memakai correction note:
- corr_no auto
- field_name, old_value, new_value, reason (min 20 karakter)
- attachment ND_CORRECTION
- approval oleh ADMIN_TRL

## Export + Checksum
Export tersedia untuk:
- Request
- Kerusakan/Perbaikan
- Master Tools

Setiap export menggunakan `export_batch_id` (TRL-EXP-YYYYMMDD-HHMMSS).
