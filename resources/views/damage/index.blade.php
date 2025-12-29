@extends('layouts.app')

@section('content')
<h4>Daftar Kerusakan/Perbaikan</h4>
<table class="table table-bordered table-sm">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Tanggal Kerusakan</th>
            <th>Surat Kerusakan</th>
            <th>Jenis Pekerjaan</th>
            <th>Pelapor</th>
            <th>Nama Alat</th>
            <th>No Asset</th>
            <th>Uraian Kerusakan</th>
            <th>Tahun Perolehan</th>
            <th>Tanggal Pengecekan</th>
            <th>Prioritas</th>
            <th>Hasil Verifikasi</th>
            <th>Usulan Tindak Lanjut</th>
            <th>Progress Perbaikan</th>
            <th>Nama Mitra/Swakelola</th>
            <th>Tanggal Kirim</th>
            <th>Surat Jalan Kirim</th>
            <th>Rencana Kembali</th>
            <th>Nilai Perbaikan</th>
            <th>Tanggal Terima</th>
            <th>Surat Jalan Terima</th>
            <th>Hasil Akhir</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reports as $report)
        <tr>
            <td><a href="/damage/{{ $report->id }}">{{ $report->ticket_no }}</a></td>
            <td>{{ optional($report->reported_at)->format('d-M-Y') }}</td>
            <td>{{ $report->surat_kerusakan ?? '-' }}</td>
            <td>{{ $report->workType->work_name ?? '-' }}</td>
            <td>{{ $report->reporter->name ?? '-' }}</td>
            <td>{{ $report->tool->tool_name ?? '-' }}</td>
            <td>{{ $report->tool->asset_no ?? '-' }}</td>
            <td>{{ $report->uraian_kerusakan }}</td>
            <td>{{ $report->tool->acquisition_year ?? '-' }}</td>
            <td>{{ optional($report->verified_at)->format('d-M-Y') }}</td>
            <td>{{ $report->priority }}</td>
            <td>{{ $report->verification_result }}</td>
            <td>{{ $report->recommendation }}</td>
            <td>{{ $report->progress }}</td>
            <td>{{ $report->vendor_name }}</td>
            <td>{{ optional($report->sent_at)->format('d-M-Y') }}</td>
            <td>{{ $report->surat_jalan_repair_kirim }}</td>
            <td>{{ optional($report->planned_return_at)->format('d-M-Y') }}</td>
            <td>{{ $report->repair_cost_idr }}</td>
            <td>{{ optional($report->received_at)->format('d-M-Y') }}</td>
            <td>{{ $report->surat_jalan_repair_terima }}</td>
            <td>{{ $report->hasil_akhir }}</td>
            <td>{{ $report->status }}</td>
            <td>{{ $report->remark }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
