<?php

namespace App\Http\Controllers;

use App\Models\BorrowRequest;
use App\Models\DamageReport;
use App\Models\Tool;
use App\Services\AutoNumberService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function export(Request $request, string $type, AutoNumberService $autoNumber)
    {
        $batchId = $autoNumber->exportBatchId();
        $filename = sprintf('%s-%s.csv', $type, $batchId);

        $response = new StreamedResponse(function () use ($type, $batchId) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['export_batch_id', $batchId]);
            if ($type === 'requests') {
                fputcsv($handle, [
                    'No', 'Tanggal Permintaan', 'Jenis Pekerjaan', 'Nama Peminjam', 'Area/Unit', 'No Item', 'Permintaan Alat',
                    'Rencana Peminjaman', 'Rencana Kembali', 'Nama Alat', 'Kode Asset', 'Tanggal Kirim', 'Surat Jalan Kirim',
                    'Tanggal Kembali', 'Surat Jalan Kembali', 'Kondisi'
                ]);
                BorrowRequest::with(['items.tool', 'workType', 'areaUnit'])->chunk(200, function ($rows) use ($handle) {
                    foreach ($rows as $row) {
                        foreach ($row->items as $item) {
                            fputcsv($handle, [
                                $row->request_no,
                                optional($row->requested_at)->format('d-M-Y'),
                                optional($row->workType)->work_name,
                                $row->peminjam_display_name,
                                optional($row->areaUnit)->area_name,
                                $item->item_no,
                                $item->permintaan_alat,
                                optional($row->planned_start_at)->format('d-M-Y'),
                                optional($row->planned_return_at)->format('d-M-Y'),
                                optional($item->tool)->tool_name,
                                optional($item->tool)->asset_no,
                                optional($row->shipment)->sent_at?->format('d-M-Y'),
                                $row->shipment->surat_jalan_kirim ?? null,
                                optional($row->returnEntry)->received_at?->format('d-M-Y'),
                                $row->returnEntry->surat_jalan_kembali ?? null,
                                $item->kondisi_kembali,
                            ]);
                        }
                    }
                });
            }

            if ($type === 'damage') {
                fputcsv($handle, [
                    'No', 'Tanggal Kerusakan', 'Surat Kerusakan', 'Jenis Pekerjaan', 'Pelapor', 'Nama Alat', 'No Asset',
                    'Uraian Kerusakan', 'Tahun Perolehan', 'Tanggal Pengecekan', 'Prioritas', 'Hasil Verifikasi',
                    'Usulan Tindak Lanjut', 'Progress Perbaikan', 'Nama Mitra/Swakelola', 'Tanggal Kirim', 'Surat Jalan Kirim',
                    'Rencana Kembali', 'Nilai Perbaikan', 'Tanggal Terima', 'Surat Jalan Terima', 'Hasil Akhir', 'Status', 'Keterangan'
                ]);
                DamageReport::with(['tool', 'workType', 'reporter'])->chunk(200, function ($rows) use ($handle) {
                    foreach ($rows as $row) {
                        fputcsv($handle, [
                            $row->ticket_no,
                            optional($row->reported_at)->format('d-M-Y'),
                            $row->surat_kerusakan,
                            optional($row->workType)->work_name,
                            optional($row->reporter)->name,
                            optional($row->tool)->tool_name,
                            optional($row->tool)->asset_no,
                            $row->uraian_kerusakan,
                            $row->tool->acquisition_year ?? null,
                            optional($row->verified_at)->format('d-M-Y'),
                            $row->priority,
                            $row->verification_result,
                            $row->recommendation,
                            $row->progress,
                            $row->vendor_name,
                            optional($row->sent_at)->format('d-M-Y'),
                            $row->surat_jalan_repair_kirim,
                            optional($row->planned_return_at)->format('d-M-Y'),
                            $row->repair_cost_idr,
                            optional($row->received_at)->format('d-M-Y'),
                            $row->surat_jalan_repair_terima,
                            $row->hasil_akhir,
                            $row->status,
                            $row->remark,
                        ]);
                    }
                });
            }

            if ($type === 'tools') {
                fputcsv($handle, [
                    'asset_no', 'barcode', 'tool_name', 'category_code', 'location_code', 'acquisition_year',
                    'condition_status', 'availability_status', 'area_code', 'calibration_required', 'calibration_interval_months',
                    'last_calibration_date', 'next_calibration_due'
                ]);
                Tool::with(['category', 'location', 'areaUnit'])->chunk(200, function ($rows) use ($handle) {
                    foreach ($rows as $row) {
                        fputcsv($handle, [
                            $row->asset_no,
                            $row->barcode,
                            $row->tool_name,
                            $row->category->category_code ?? null,
                            $row->location->location_code ?? null,
                            $row->acquisition_year,
                            $row->condition_status,
                            $row->availability_status,
                            $row->areaUnit->area_code ?? null,
                            $row->calibration_required ? 'YA' : 'TIDAK',
                            $row->calibration_interval_months,
                            optional($row->last_calibration_date)->format('d-M-Y'),
                            optional($row->next_calibration_due)->format('d-M-Y'),
                        ]);
                    }
                });
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename=' . $filename);

        return $response;
    }
}
