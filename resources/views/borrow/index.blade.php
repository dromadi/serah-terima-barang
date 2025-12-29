@extends('layouts.app')

@section('content')
<h4>Daftar Request Peminjaman</h4>
<table class="table table-bordered table-sm">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Tanggal Permintaan</th>
            <th>Jenis Pekerjaan</th>
            <th>Nama Peminjam</th>
            <th>Area/Unit</th>
            <th>No Item</th>
            <th>Permintaan Alat</th>
            <th>Rencana Peminjaman</th>
            <th>Rencana Kembali</th>
            <th>Nama Alat</th>
            <th>Kode Asset</th>
            <th>Tanggal Kirim</th>
            <th>Surat Jalan Kirim</th>
            <th>Tanggal Kembali</th>
            <th>Surat Jalan Kembali</th>
            <th>Kondisi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($requests as $request)
            @foreach ($request->items as $item)
            <tr>
                <td><a href="/borrow/{{ $request->id }}">{{ $request->request_no }}</a></td>
                <td>{{ optional($request->requested_at)->format('d-M-Y') }}</td>
                <td>{{ $request->workType->work_name ?? '-' }}</td>
                <td>{{ $request->peminjam_display_name }}</td>
                <td>{{ $request->areaUnit->area_name ?? '-' }}</td>
                <td>{{ $item->item_no }}</td>
                <td>{{ $item->permintaan_alat }}</td>
                <td>{{ optional($request->planned_start_at)->format('d-M-Y') }}</td>
                <td>{{ optional($request->planned_return_at)->format('d-M-Y') }}</td>
                <td>{{ $item->tool->tool_name ?? '-' }}</td>
                <td>{{ $item->tool->asset_no ?? '-' }}</td>
                <td>{{ optional($request->shipment)->sent_at?->format('d-M-Y') }}</td>
                <td>{{ $request->shipment->surat_jalan_kirim ?? '-' }}</td>
                <td>{{ optional($request->returnEntry)->received_at?->format('d-M-Y') }}</td>
                <td>{{ $request->returnEntry->surat_jalan_kembali ?? '-' }}</td>
                <td>{{ $item->kondisi_kembali ?? '-' }}</td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endsection
