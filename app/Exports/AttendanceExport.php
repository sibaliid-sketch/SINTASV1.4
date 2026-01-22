<?php

namespace App\Exports;

use App\Models\SINTAS\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query ?: Attendance::with('user');
    }

    public function collection()
    {
        return $this->query->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Departemen',
            'Tanggal',
            'Check In',
            'Check Out',
            'Durasi Kerja (jam)',
            'Status',
            'Lokasi',
            'IP Address',
            'Catatan'
        ];
    }

    public function map($attendance): array
    {
        $statusLabels = [
            'present' => 'Hadir',
            'late' => 'Terlambat',
            'absent' => 'Tidak Hadir',
            'leave' => 'Cuti',
            'sick' => 'Sakit',
            'permission' => 'Izin',
        ];

        return [
            $attendance->user->name ?? '',
            $attendance->user->department ?? '',
            $attendance->date->format('d/m/Y'),
            $attendance->check_in ? $attendance->check_in->format('H:i:s') : '-',
            $attendance->check_out ? $attendance->check_out->format('H:i:s') : '-',
            $attendance->working_hours,
            $statusLabels[$attendance->status] ?? ucfirst($attendance->status),
            $attendance->location,
            $attendance->ip_address,
            $attendance->notes,
        ];
    }
}
